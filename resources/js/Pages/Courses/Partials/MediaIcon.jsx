const ICONS = {
    pdf: '📄', video: '🎬', image: '🖼️',
    powerpoint: '📊', ppt: '📊', doc: '📝', document: '📝',
    EXTERNAL_LINK: '🔗', IFRAME: '🖥️',
};

export default function MediaIcon({ type }) {
    return <span className="mr-1">{ICONS[type] ?? '📁'}</span>;
}
