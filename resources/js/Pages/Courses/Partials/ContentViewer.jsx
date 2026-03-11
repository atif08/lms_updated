import { useState, useEffect, useRef } from 'react';

export default function ContentViewer({ activeContent }) {
    if (!activeContent) {
        return (
            <div className="flex items-center justify-center bg-gray-50 border-b border-gray-200" style={{ height: '66vh' }}>
                <p className="text-gray-400 text-sm">Select a lesson from the sidebar to start learning</p>
            </div>
        );
    }

    const { url, mediaType, description } = activeContent;

    if (mediaType === 'pdf') return <PdfViewer url={url} />;

    if (mediaType === 'video') {
        return (
            <div className="bg-black border-b border-gray-200" style={{ height: '66vh' }}>
                <video controls className="w-full h-full" key={url}>
                    <source src={url} />
                </video>
            </div>
        );
    }

    if (['powerpoint', 'ppt', 'doc', 'document'].includes(mediaType)) {
        return (
            <div className="border-b border-gray-200" style={{ height: '66vh' }}>
                <iframe
                    src={`https://docs.google.com/gview?embedded=true&url=${encodeURIComponent(url)}`}
                    className="w-full h-full border-0"
                    title="Document"
                />
            </div>
        );
    }

    if (mediaType === 'EXTERNAL_LINK') {
        return (
            <div className="border-b border-gray-200" style={{ height: '66vh' }}>
                <iframe src={url} className="w-full h-full border-0" allow="autoplay" title="External content" />
            </div>
        );
    }

    if (mediaType === 'image') {
        return (
            <div className="flex items-center justify-center bg-gray-100 border-b border-gray-200 overflow-auto" style={{ height: '66vh' }}>
                <img src={url} alt="" className="max-w-full max-h-full object-contain" />
            </div>
        );
    }

    if (mediaType === 'IFRAME') {
        return (
            <div className="border-b border-gray-200" style={{ height: '66vh' }}
                dangerouslySetInnerHTML={{ __html: url }} />
        );
    }

    if (mediaType === 'quiz') {
        return (
            <div className="flex items-center justify-center bg-gray-50 border-b border-gray-200" style={{ height: '66vh' }}>
                <div className="text-center p-10 border-2 border-dashed border-indigo-200 rounded-2xl max-w-xs">
                    <img src="/assets/images/quiz.png" alt="" className="h-24 mx-auto mb-4"
                        onError={e => { e.target.style.display = 'none'; }} />
                    <h5 className="font-bold text-lg text-gray-800 mb-2">QUIZ</h5>
                    <p className="text-gray-500 text-sm mb-5">Click below to take the quiz</p>
                    <a
                        href={url}
                        className="rounded-2xl bg-indigo-600 px-6 py-2.5 text-white font-semibold hover:bg-indigo-700 shadow transition-colors"
                    >
                        Start Quiz
                    </a>
                </div>
            </div>
        );
    }

    return null;
}

const ZOOM_STEP = 0.25;
const ZOOM_MIN  = 0.5;
const ZOOM_MAX  = 3;

function PdfViewer({ url }) {
    const containerRef = useRef(null);
    const pdfDocRef    = useRef(null);
    const [pageNum, setPageNum]     = useState(1);
    const [pageCount, setPageCount] = useState(0);
    const [loading, setLoading]     = useState(true);
    const [zoom, setZoom]           = useState(1);
    const [isFullscreen, setIsFullscreen] = useState(false);
    const wrapperRef = useRef(null);

    const renderPage = async (doc, num, zoomLevel = 1) => {
        if (!containerRef.current) return;
        const page           = await doc.getPage(num);
        const containerWidth = containerRef.current.clientWidth || 800;
        const viewport       = page.getViewport({ scale: 1 });
        const baseScale      = containerWidth / viewport.width;
        const scaledViewport = page.getViewport({ scale: baseScale * zoomLevel });

        const canvas  = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.height = scaledViewport.height;
        canvas.width  = scaledViewport.width;

        containerRef.current.innerHTML = '';
        containerRef.current.appendChild(canvas);

        await page.render({ canvasContext: context, viewport: scaledViewport }).promise;
    };

    useEffect(() => {
        let cancelled = false;
        setLoading(true);
        setPageNum(1);
        setZoom(1);
        pdfDocRef.current = null;

        const init = async () => {
            if (!window['pdfjs-dist/build/pdf']) {
                await new Promise(res => {
                    const src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js';
                    if (document.querySelector(`script[src="${src}"]`)) { res(); return; }
                    const s = document.createElement('script');
                    s.src = src; s.onload = res;
                    document.head.appendChild(s);
                });
            }
            if (cancelled) return;

            const lib = window['pdfjs-dist/build/pdf'];
            lib.GlobalWorkerOptions.workerSrc =
                'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

            const doc = await lib.getDocument(url).promise;
            if (cancelled) return;

            pdfDocRef.current = doc;
            setPageCount(doc.numPages);
            await renderPage(doc, 1, 1);
            if (!cancelled) setLoading(false);
        };

        init().catch(() => setLoading(false));
        return () => { cancelled = true; };
    }, [url]);

    const goTo = async (num) => {
        if (!pdfDocRef.current || num < 1 || num > pageCount) return;
        setPageNum(num);
        await renderPage(pdfDocRef.current, num, zoom);
    };

    const changeZoom = async (newZoom) => {
        const clamped = Math.min(ZOOM_MAX, Math.max(ZOOM_MIN, newZoom));
        setZoom(clamped);
        if (pdfDocRef.current) {
            await renderPage(pdfDocRef.current, pageNum, clamped);
        }
    };

    const toggleFullscreen = () => {
        if (!document.fullscreenElement) {
            wrapperRef.current?.requestFullscreen();
            setIsFullscreen(true);
        } else {
            document.exitFullscreen();
            setIsFullscreen(false);
        }
    };

    useEffect(() => {
        const onFsChange = () => setIsFullscreen(!!document.fullscreenElement);
        document.addEventListener('fullscreenchange', onFsChange);
        return () => document.removeEventListener('fullscreenchange', onFsChange);
    }, []);

    return (
        <div ref={wrapperRef} className="flex flex-col border-b border-gray-200 bg-white" style={{ height: isFullscreen ? '100vh' : '66vh' }}>
            <div className="flex items-center justify-center gap-3 p-2 bg-gray-100 text-sm shrink-0 flex-wrap">
                {/* Page navigation */}
                <button onClick={() => goTo(pageNum - 1)} disabled={pageNum <= 1}
                    className="px-3 py-1 rounded bg-white border border-gray-300 disabled:opacity-40 hover:bg-gray-50">
                    ← Prev
                </button>
                <span className="text-gray-600">Page {pageNum} of {pageCount || '…'}</span>
                <button onClick={() => goTo(pageNum + 1)} disabled={pageNum >= pageCount}
                    className="px-3 py-1 rounded bg-white border border-gray-300 disabled:opacity-40 hover:bg-gray-50">
                    Next →
                </button>

                {/* Divider */}
                <span className="w-px h-5 bg-gray-300" />

                {/* Zoom controls */}
                <button onClick={() => changeZoom(zoom - ZOOM_STEP)} disabled={zoom <= ZOOM_MIN}
                    className="w-7 h-7 flex items-center justify-center rounded bg-white border border-gray-300 disabled:opacity-40 hover:bg-gray-50 text-lg font-bold leading-none"
                    title="Zoom out">
                    −
                </button>
                <span className="text-gray-600 w-12 text-center">{Math.round(zoom * 100)}%</span>
                <button onClick={() => changeZoom(zoom + ZOOM_STEP)} disabled={zoom >= ZOOM_MAX}
                    className="w-7 h-7 flex items-center justify-center rounded bg-white border border-gray-300 disabled:opacity-40 hover:bg-gray-50 text-lg font-bold leading-none"
                    title="Zoom in">
                    +
                </button>
                <button onClick={() => changeZoom(1)} disabled={zoom === 1}
                    className="px-2 py-1 rounded bg-white border border-gray-300 disabled:opacity-40 hover:bg-gray-50 text-xs"
                    title="Reset zoom">
                    Reset
                </button>

                {/* Divider */}
                <span className="w-px h-5 bg-gray-300" />

                {/* Fullscreen */}
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
            <div className="relative flex-1 overflow-auto bg-gray-50">
                {loading && (
                    <div className="absolute inset-0 flex items-center justify-center bg-gray-50 z-10">
                        <div className="flex gap-1">
                            {[0, 1, 2].map(i => (
                                <div key={i} className="h-2 w-2 rounded-full bg-indigo-400 animate-bounce"
                                    style={{ animationDelay: `${i * 0.15}s` }} />
                            ))}
                        </div>
                    </div>
                )}
                <div ref={containerRef} />
            </div>
        </div>
    );
}
