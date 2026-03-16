import { useRef } from 'react';
import PdfAnnotationViewer from './PdfAnnotationViewer';

// Single source of truth for the viewer height.
// calc(100vh - 56px) fills everything below the sticky TopNav (56px).
const VIEWER_H = 'calc(100vh - 56px)';
const VIEWER_STYLE = { height: VIEWER_H, width: '100%' };

export default function ContentViewer({ activeContent }) {
    if (!activeContent) {
        return (
            <div className="flex items-center justify-center bg-gray-50 border-b border-gray-200" style={VIEWER_STYLE}>
                <p className="text-gray-400 text-sm">Select a lesson from the sidebar to start learning</p>
            </div>
        );
    }

    const { url, mediaType, mediaId } = activeContent;

    if (mediaType === 'pdf') {
        return (
            <div style={VIEWER_STYLE} className="border-b border-gray-200">
                <PdfAnnotationViewer url={url} mediaId={mediaId} />
            </div>
        );
    }

    if (mediaType === 'vimeo') {
        return (
            <div style={{ ...VIEWER_STYLE, position: 'relative', backgroundColor: '#000' }} className="border-b border-gray-200">
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
            <div className="bg-black border-b border-gray-200" style={VIEWER_STYLE}>
                <video controls className="w-full h-full" key={url}>
                    <source src={url} />
                </video>
            </div>
        );
    }

    if (['powerpoint', 'ppt', 'doc', 'document'].includes(mediaType)) {
        return (
            <div className="border-b border-gray-200" style={VIEWER_STYLE}>
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
            <div className="border-b border-gray-200" style={VIEWER_STYLE}>
                <iframe src={url} className="w-full h-full border-0" allow="autoplay" title="External content" />
            </div>
        );
    }

    if (mediaType === 'image') {
        return (
            <div className="flex items-center justify-center bg-gray-100 border-b border-gray-200 overflow-auto" style={VIEWER_STYLE}>
                <img src={url} alt="" className="max-w-full max-h-full object-contain" />
            </div>
        );
    }

    if (mediaType === 'IFRAME') {
        return (
            <div className="border-b border-gray-200" style={VIEWER_STYLE}
                dangerouslySetInnerHTML={{ __html: url }} />
        );
    }

    if (mediaType === 'quiz') {
        return (
            <div className="flex items-center justify-center bg-gray-50 border-b border-gray-200" style={VIEWER_STYLE}>
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
