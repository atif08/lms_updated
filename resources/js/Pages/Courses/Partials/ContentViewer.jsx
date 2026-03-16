import PdfAnnotationViewer from './PdfAnnotationViewer';

// No vh units — each case uses flex-1 so the parent flex column controls the height.
const BASE = 'flex-1 min-h-0 overflow-hidden w-full';

export default function ContentViewer({ activeContent }) {
    if (!activeContent) {
        return (
            <div className={`${BASE} flex items-center justify-center bg-gray-50 border-b border-gray-200`}>
                <p className="text-gray-400 text-sm">Select a lesson from the sidebar to start learning</p>
            </div>
        );
    }

    const { url, mediaType, mediaId } = activeContent;

    if (mediaType === 'pdf') {
        return (
            <div className={`${BASE} border-b border-gray-200`}>
                <PdfAnnotationViewer url={url} mediaId={mediaId} />
            </div>
        );
    }

    if (mediaType === 'vimeo') {
        return (
            <div className={`${BASE} relative border-b border-gray-200`} style={{ backgroundColor: '#000' }}>
                <iframe
                    key={url}
                    src={url}
                    style={{ position: 'absolute', top: 0, left: 0, width: '100%', height: '100%', border: 'none' }}
                    allow="autoplay; fullscreen; picture-in-picture"
                    allowFullScreen
                    title="Vimeo video"
                />
            </div>
        );
    }

    if (mediaType === 'video') {
        return (
            <div className={`${BASE} bg-black border-b border-gray-200`}>
                <video controls className="w-full h-full" key={url}>
                    <source src={url} />
                </video>
            </div>
        );
    }

    if (['powerpoint', 'ppt', 'doc', 'document'].includes(mediaType)) {
        return (
            <div className={`${BASE} border-b border-gray-200`}>
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
            <div className={`${BASE} border-b border-gray-200`}>
                <iframe src={url} className="w-full h-full border-0" allow="autoplay" title="External content" />
            </div>
        );
    }

    if (mediaType === 'image') {
        return (
            <div className={`${BASE} flex items-center justify-center bg-gray-100 border-b border-gray-200`}>
                <img src={url} alt="" className="max-w-full max-h-full object-contain" />
            </div>
        );
    }

    if (mediaType === 'IFRAME') {
        return (
            <div className={`${BASE} border-b border-gray-200`}
                dangerouslySetInnerHTML={{ __html: url }} />
        );
    }

    if (mediaType === 'quiz') {
        return (
            <div className={`${BASE} flex items-center justify-center bg-gray-50 border-b border-gray-200`}>
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
