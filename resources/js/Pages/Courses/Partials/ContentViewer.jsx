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

function PdfViewer({ url }) {
    const containerRef = useRef(null);
    const pdfDocRef    = useRef(null);
    const [pageNum, setPageNum]     = useState(1);
    const [pageCount, setPageCount] = useState(0);
    const [loading, setLoading]     = useState(true);

    const renderPage = async (doc, num) => {
        if (!containerRef.current) return;
        const page           = await doc.getPage(num);
        const containerWidth = containerRef.current.clientWidth || 800;
        const viewport       = page.getViewport({ scale: 1 });
        const scaledViewport = page.getViewport({ scale: containerWidth / viewport.width });

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
            await renderPage(doc, 1);
            if (!cancelled) setLoading(false);
        };

        init().catch(() => setLoading(false));
        return () => { cancelled = true; };
    }, [url]);

    const goTo = async (num) => {
        if (!pdfDocRef.current || num < 1 || num > pageCount) return;
        setPageNum(num);
        await renderPage(pdfDocRef.current, num);
    };

    return (
        <div className="flex flex-col border-b border-gray-200" style={{ height: '66vh' }}>
            <div className="flex items-center justify-center gap-4 p-2 bg-gray-100 text-sm shrink-0">
                <button onClick={() => goTo(pageNum - 1)} disabled={pageNum <= 1}
                    className="px-3 py-1 rounded bg-white border border-gray-300 disabled:opacity-40 hover:bg-gray-50">
                    ← Prev
                </button>
                <span className="text-gray-600">Page {pageNum} of {pageCount || '…'}</span>
                <button onClick={() => goTo(pageNum + 1)} disabled={pageNum >= pageCount}
                    className="px-3 py-1 rounded bg-white border border-gray-300 disabled:opacity-40 hover:bg-gray-50">
                    Next →
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
