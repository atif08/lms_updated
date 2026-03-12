import { useState, useEffect, useRef, useCallback } from 'react';
import axios from 'axios';

const CSRF = () => document.querySelector('meta[name="csrf-token"]')?.content;

const TYPES = {
    highlight: { label: 'Highlight', bg: 'rgba(253,230,138,0.55)', border: 'none' },
    underline:  { label: 'Underline', bg: 'transparent',            border: '2.5px solid rgba(52,211,153,0.9)' },
    important:  { label: 'Important', bg: 'rgba(252,165,165,0.55)', border: 'none' },
};

let _id = 0;
const nextId = () => `ann-${Date.now()}-${++_id}`;

function injectCss() {
    if (document.getElementById('_pdf_tl_css')) return;
    const s = document.createElement('style');
    s.id = '_pdf_tl_css';
    s.textContent = `
        .pdf-tl{position:absolute;left:0;top:0;overflow:hidden;line-height:1;
                user-select:text;-webkit-user-select:text;pointer-events:auto;}
        .pdf-tl span{color:transparent;position:absolute;white-space:pre;
                     cursor:text;transform-origin:0% 0%;}
        .pdf-tl span::selection{background:rgba(99,102,241,0.25);}
    `;
    document.head.appendChild(s);
}

const ZOOM_STEP = 0.25;
const ZOOM_MIN  = 0.5;
const ZOOM_MAX  = 4;

export default function PdfAnnotationViewer({ url, mediaId }) {
    const wrapperRef    = useRef(null);
    const scrollAreaRef = useRef(null);
    const containerRef  = useRef(null);
    const canvasRef     = useRef(null);
    const tlRef         = useRef(null);
    const pdfDocRef     = useRef(null);
    const saveTimer     = useRef(null);
    const toolbarRef    = useRef(null);
    const zoomRef       = useRef(1);

    const [pageNum, setPageNum]           = useState(1);
    const [pageCount, setPageCount]       = useState(0);
    const [zoom, _setZoom]                = useState(1);
    // canvasPx tracks the rendered canvas CSS pixel size — used to position
    // annotations in px rather than %, so they stay correct across zoom changes.
    const [canvasPx, setCanvasPx]         = useState({ w: 0, h: 0 });
    const [loading, setLoading]           = useState(true);
    const [annotations, setAnnotations]   = useState([]);
    const [saving, setSaving]             = useState(false);
    const [isFullscreen, setIsFullscreen] = useState(false);
    const [toolbar, _setToolbar]          = useState(null);
    const [annoType, setAnnoType]         = useState('highlight');
    const [comment, setComment]           = useState('');

    const setZoom    = (v) => { zoomRef.current = v; _setZoom(v); };
    const setToolbar = (v) => { toolbarRef.current = v; _setToolbar(v); };

    // ── PDF.js ────────────────────────────────────────────────────────────────
    const loadPdfJs = useCallback(async () => {
        if (window['pdfjs-dist/build/pdf']) return window['pdfjs-dist/build/pdf'];
        await new Promise(res => {
            const src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js';
            if (document.querySelector(`script[src="${src}"]`)) { res(); return; }
            const s = document.createElement('script');
            s.src = src; s.onload = res;
            document.head.appendChild(s);
        });
        const lib = window['pdfjs-dist/build/pdf'];
        lib.GlobalWorkerOptions.workerSrc =
            'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';
        return lib;
    }, []);

    // Returns { w, h } — the canvas CSS pixel dimensions after rendering
    const renderPage = useCallback(async (doc, num, zoomLevel) => {
        const page  = await doc.getPage(num);
        const vp0   = page.getViewport({ scale: 1 });
        const baseW = scrollAreaRef.current?.clientWidth || 800;
        const scale = (baseW / vp0.width) * (zoomLevel ?? zoomRef.current);
        const vp    = page.getViewport({ scale });

        const canvas = canvasRef.current;
        if (!canvas) return { w: 0, h: 0 };
        canvas.width  = vp.width;
        canvas.height = vp.height;
        await page.render({ canvasContext: canvas.getContext('2d'), viewport: vp }).promise;

        if (tlRef.current) {
            tlRef.current.innerHTML = '';
            tlRef.current.style.width  = `${vp.width}px`;
            tlRef.current.style.height = `${vp.height}px`;
            const lib = window['pdfjs-dist/build/pdf'];
            lib.renderTextLayer({
                textContent: await page.getTextContent(),
                container:   tlRef.current,
                viewport:    vp,
                textDivs:    [],
            });
        }

        // vp.width / vp.height are the canvas CSS pixel dimensions (no devicePixelRatio
        // scaling in our setup), so we return them directly for annotation positioning.
        return { w: vp.width, h: vp.height };
    }, []);

    // ── Load PDF on url change ────────────────────────────────────────────────
    useEffect(() => {
        let cancelled = false;
        setLoading(true);
        setPageNum(1);
        setToolbar(null);
        pdfDocRef.current = null;
        injectCss();

        (async () => {
            const lib = await loadPdfJs();
            if (cancelled) return;
            const doc = await lib.getDocument(url).promise;
            if (cancelled) return;
            pdfDocRef.current = doc;
            setPageCount(doc.numPages);
            const px = await renderPage(doc, 1, zoomRef.current);
            if (!cancelled) {
                setCanvasPx(px);
                setLoading(false);
            }
        })().catch(() => setLoading(false));

        return () => { cancelled = true; };
    }, [url]);

    // ── Page nav ──────────────────────────────────────────────────────────────
    const goTo = async (num) => {
        if (!pdfDocRef.current || num < 1 || num > pageCount || loading) return;
        setLoading(true);
        setToolbar(null);
        setPageNum(num);
        const px = await renderPage(pdfDocRef.current, num, zoomRef.current);
        setCanvasPx(px);
        setLoading(false);
    };

    const changeZoom = async (delta) => {
        if (!pdfDocRef.current || loading) return;
        const next = Math.min(ZOOM_MAX, Math.max(ZOOM_MIN,
            parseFloat((zoomRef.current + delta).toFixed(2))));
        setZoom(next);
        setLoading(true);
        setToolbar(null);
        const px = await renderPage(pdfDocRef.current, pageNum, next);
        setCanvasPx(px);
        setLoading(false);
    };

    // ── Load annotations ──────────────────────────────────────────────────────
    useEffect(() => {
        if (!mediaId) return;
        setAnnotations([]);
        axios.get(`/pdf-annotations/${mediaId}`, { headers: { 'X-CSRF-TOKEN': CSRF() } })
            .then(r => setAnnotations(Array.isArray(r.data) ? r.data : []))
            .catch(() => {});
    }, [mediaId]);

    const persist = useCallback((updated) => {
        if (!mediaId) return;
        clearTimeout(saveTimer.current);
        saveTimer.current = setTimeout(async () => {
            setSaving(true);
            try {
                await axios.post(`/pdf-annotations/${mediaId}`,
                    { annotations: updated },
                    { headers: { 'X-CSRF-TOKEN': CSRF() } }
                );
            } finally { setSaving(false); }
        }, 800);
    }, [mediaId]);

    // ── Text selection → show toolbar ────────────────────────────────────────
    const handleMouseUp = useCallback((e) => {
        if (e.target.closest?.('[data-ann-popup]')) return;

        const sel = window.getSelection();
        if (!sel || sel.isCollapsed) { setToolbar(null); return; }

        const range = sel.getRangeAt(0);
        if (!tlRef.current?.contains(range.commonAncestorContainer)) {
            setToolbar(null); return;
        }

        if (!canvasRef.current || !containerRef.current) return;

        // Use the canvas bounding rect as the coordinate origin.
        // Annotations are stored as fractions (0–100) of the canvas CSS dimensions,
        // then rendered back as explicit px — so they are zoom-independent.
        const cr = canvasRef.current.getBoundingClientRect();
        const cw = cr.width;
        const ch = cr.height;

        const rects = Array.from(range.getClientRects())
            .map(r => ({
                x: ((r.left - cr.left) / cw) * 100,
                y: ((r.top  - cr.top)  / ch) * 100,
                w: (r.width  / cw) * 100,
                h: (r.height / ch) * 100,
            }))
            .filter(r => r.w > 0.05 && r.h > 0.05);

        if (!rects.length) { setToolbar(null); return; }

        const last = Array.from(range.getClientRects()).pop();
        const containerRect = containerRef.current.getBoundingClientRect();
        setToolbar({ x: last.right - containerRect.left, y: last.bottom - containerRect.top, rects });
    }, []);

    // ── Save annotation ───────────────────────────────────────────────────────
    const saveAnnotation = () => {
        const t = toolbarRef.current;
        if (!t) return;
        const ann = { id: nextId(), page: pageNum, rects: t.rects, type: annoType, comment };
        setAnnotations(prev => { const u = [...prev, ann]; persist(u); return u; });
        setToolbar(null);
        setComment('');
        window.getSelection()?.removeAllRanges();
    };

    const deleteAnnotation = (id) => {
        setAnnotations(prev => { const u = prev.filter(a => a.id !== id); persist(u); return u; });
    };

    // ── Fullscreen ────────────────────────────────────────────────────────────
    const toggleFullscreen = () => {
        document.fullscreenElement ? document.exitFullscreen() : wrapperRef.current?.requestFullscreen();
    };
    useEffect(() => {
        const h = () => setIsFullscreen(!!document.fullscreenElement);
        document.addEventListener('fullscreenchange', h);
        return () => document.removeEventListener('fullscreenchange', h);
    }, []);

    const pageAnnotations = annotations.filter(a => a.page === pageNum);

    return (
        <div ref={wrapperRef} className="flex flex-col border-b border-gray-200 bg-white"
            style={{ height: isFullscreen ? '100vh' : '66vh' }}>

            {/* ── Top bar ── */}
            <div className="flex items-center gap-3 px-4 py-2 bg-gray-100 border-b border-gray-200 text-sm shrink-0 flex-wrap">
                <button onClick={() => goTo(pageNum - 1)} disabled={pageNum <= 1 || loading}
                    className="px-3 py-1 rounded bg-white border border-gray-300 disabled:opacity-40 hover:bg-gray-50">
                    ← Prev
                </button>
                <span className="text-gray-600 text-xs">Page {pageNum} of {pageCount || '…'}</span>
                <button onClick={() => goTo(pageNum + 1)} disabled={pageNum >= pageCount || loading}
                    className="px-3 py-1 rounded bg-white border border-gray-300 disabled:opacity-40 hover:bg-gray-50">
                    Next →
                </button>

                <span className="w-px h-5 bg-gray-300" />

                <button onClick={() => changeZoom(-ZOOM_STEP)} disabled={zoom <= ZOOM_MIN || loading}
                    className="px-2 py-1 rounded bg-white border border-gray-300 disabled:opacity-40 hover:bg-gray-50 text-base leading-none"
                    title="Zoom out">−</button>
                <span className="text-xs text-gray-600 min-w-[3rem] text-center">{Math.round(zoom * 100)}%</span>
                <button onClick={() => changeZoom(ZOOM_STEP)} disabled={zoom >= ZOOM_MAX || loading}
                    className="px-2 py-1 rounded bg-white border border-gray-300 disabled:opacity-40 hover:bg-gray-50 text-base leading-none"
                    title="Zoom in">+</button>

                <span className="w-px h-5 bg-gray-300" />

                {Object.entries(TYPES).map(([k, v]) => (
                    <span key={k} className="hidden sm:inline-flex items-center gap-1 text-xs text-gray-500">
                        <span className="inline-block w-3 h-3 rounded-sm border border-gray-200"
                            style={{ background: v.bg, borderBottom: v.border }} />
                        {v.label}
                    </span>
                ))}
                <span className="text-gray-400 text-xs">← select text to annotate</span>

                <div className="ml-auto flex items-center gap-2">
                    {saving && <span className="text-xs text-indigo-400 animate-pulse">Saving…</span>}
                    {annotations.length > 0 && (
                        <span className="text-xs text-gray-400">
                            {annotations.length} annotation{annotations.length !== 1 ? 's' : ''}
                        </span>
                    )}
                    <button onClick={toggleFullscreen}
                        className="w-7 h-7 flex items-center justify-center rounded bg-white border border-gray-300 hover:bg-gray-50"
                        title={isFullscreen ? 'Exit fullscreen' : 'Fullscreen'}>
                        {isFullscreen ? (
                            <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                                <path strokeLinecap="round" strokeLinejoin="round" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M15 9h4.5M15 9V4.5M15 9l5.25-5.25M9 15H4.5M9 15v4.5M9 15l-5.25 5.25M15 15h4.5M15 15v4.5M15 15l5.25 5.25" />
                            </svg>
                        ) : (
                            <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                                <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                            </svg>
                        )}
                    </button>
                </div>
            </div>

            {/* ── PDF canvas area ── */}
            <div ref={scrollAreaRef} className="flex-1 overflow-auto bg-gray-50 flex justify-center p-4">
                <div ref={containerRef} className="relative inline-block" onMouseUp={handleMouseUp}>

                    {loading && (
                        <div className="absolute inset-0 flex items-center justify-center bg-gray-50 z-10 min-w-[200px] min-h-[200px]">
                            <div className="flex gap-1">
                                {[0, 1, 2].map(i => (
                                    <div key={i} className="h-2 w-2 rounded-full bg-indigo-400 animate-bounce"
                                        style={{ animationDelay: `${i * 0.15}s` }} />
                                ))}
                            </div>
                        </div>
                    )}

                    <canvas ref={canvasRef} className="block shadow-md" />

                    {/* Text layer — transparent, enables text selection */}
                    <div ref={tlRef} className="pdf-tl" />

                    {/* Saved annotation overlays — rendered in px from canvasPx so
                        positions stay correct when zoom changes */}
                    {canvasPx.w > 0 && pageAnnotations.map(ann =>
                        ann.rects.map((rect, ri) => (
                            <AnnotationRect
                                key={`${ann.id}-${ri}`}
                                rect={rect}
                                ann={ann}
                                first={ri === 0}
                                onDelete={deleteAnnotation}
                                canvasPx={canvasPx}
                            />
                        ))
                    )}

                    {/* Annotation input popup */}
                    {toolbar && (
                        <AnnotationPopup
                            toolbar={toolbar}
                            annoType={annoType}
                            setAnnoType={setAnnoType}
                            comment={comment}
                            setComment={setComment}
                            onSave={saveAnnotation}
                            onCancel={() => { setToolbar(null); window.getSelection()?.removeAllRanges(); }}
                            canvasWidth={canvasPx.w}
                        />
                    )}
                </div>
            </div>
        </div>
    );
}

// ── Annotation overlay ─────────────────────────────────────────────────────────

function AnnotationRect({ rect, ann, first, onDelete, canvasPx }) {
    const [tip, setTip] = useState(false);
    const t = TYPES[ann.type] ?? TYPES.highlight;

    // Convert stored % fractions back to explicit px using the current canvas size.
    // This keeps annotations in the correct position regardless of zoom level.
    const style = {
        position: 'absolute',
        left:   `${(rect.x / 100) * canvasPx.w}px`,
        top:    `${(rect.y / 100) * canvasPx.h}px`,
        width:  `${(rect.w / 100) * canvasPx.w}px`,
        height: `${(rect.h / 100) * canvasPx.h}px`,
        background:   t.bg,
        borderBottom: t.border,
        zIndex: 5,
        pointerEvents: first ? 'auto' : 'none',
        cursor: first ? 'pointer' : 'default',
    };

    return (
        <div
            style={style}
            onMouseEnter={() => first && setTip(true)}
            onMouseLeave={() => setTip(false)}
        >
            {first && tip && (
                <div data-ann-popup className="absolute bottom-full mb-1 left-0 bg-white border border-gray-200 rounded-lg shadow-lg p-2 text-xs z-20 min-w-[120px]">
                    <p className="font-semibold text-gray-700 mb-0.5">{t.label}</p>
                    {ann.comment && (
                        <p className="text-gray-500 mb-1.5 max-w-[200px] whitespace-pre-wrap">{ann.comment}</p>
                    )}
                    <button onClick={() => onDelete(ann.id)} className="text-red-400 hover:text-red-600">
                        Delete
                    </button>
                </div>
            )}
        </div>
    );
}

// ── Annotation type + comment popup ───────────────────────────────────────────

function AnnotationPopup({ toolbar, annoType, setAnnoType, comment, setComment, onSave, onCancel, canvasWidth }) {
    return (
        <div
            data-ann-popup
            className="absolute z-20 bg-white border border-gray-200 rounded-xl shadow-xl p-3 w-64"
            style={{ left: Math.min(toolbar.x, canvasWidth - 264), top: toolbar.y + 8 }}
            onMouseDown={e => e.stopPropagation()}
            onMouseUp={e => e.stopPropagation()}
        >
            <p className="text-xs font-semibold text-gray-700 mb-2">Annotation Type</p>
            <div className="flex gap-1.5 mb-3">
                {Object.entries(TYPES).map(([key, val]) => (
                    <button
                        key={key}
                        onClick={() => setAnnoType(key)}
                        className={`flex-1 py-1 rounded-lg border text-xs font-medium transition-colors ${
                            annoType === key ? 'border-indigo-500 ring-1 ring-indigo-400' : 'border-gray-200'
                        }`}
                        style={{ background: val.bg === 'transparent' ? '#f0fdf4' : val.bg }}
                    >
                        {val.label}
                    </button>
                ))}
            </div>
            <textarea
                rows={2}
                value={comment}
                onChange={e => setComment(e.target.value)}
                placeholder="Add a comment (optional)…"
                className="w-full rounded-lg border border-gray-300 px-2 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-400 resize-none mb-2"
            />
            <div className="flex gap-2 justify-end">
                <button onClick={onCancel}
                    className="px-3 py-1 text-xs rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50">
                    Cancel
                </button>
                <button onClick={onSave}
                    className="px-3 py-1 text-xs rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700">
                    Save
                </button>
            </div>
        </div>
    );
}
