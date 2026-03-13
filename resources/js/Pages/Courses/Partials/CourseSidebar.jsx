import MediaIcon from './MediaIcon';
import InstallmentGate from './InstallmentGate';

/** Returns which installment group (1, 2, or 3) a topic at `index` belongs to. */
function getInstallmentGroup(index, total) {
    if (total === 0) return 1;
    const third = total / 3;
    if (index < third) return 1;
    if (index < third * 2) return 2;
    return 3;
}

export default function CourseSidebar({
    topics,
    progressMap,
    openTopics,
    toggleTopic,
    loadContent,
    toggleProgress,
    enrollment,
    onPayInstallment,
}) {
    const isEmi = enrollment?.is_emi ?? false;
    const installmentProgress = enrollment?.installment_progress ?? 3;

    const renderedGates = new Set();

    return (
        <div
            className="shrink-0 border-l border-gray-200 overflow-y-auto"
            style={{ width: 340, backgroundColor: '#EFEEFE' }}
        >
            <div className="px-4 py-3 bg-white border-b border-gray-200 sticky top-0 z-10">
                <h5 className="font-semibold text-sm text-gray-800">Course Content</h5>
            </div>

            {topics.map((topic, index) => {
                const group = getInstallmentGroup(index, topics.length);
                const isLocked = isEmi && installmentProgress < group;

                const gateNode = isLocked && !renderedGates.has(group)
                    ? (renderedGates.add(group), (
                        <InstallmentGate
                            key={`gate-${group}`}
                            installmentNo={group}
                            onPay={onPayInstallment}
                        />
                    ))
                    : null;

                return (
                    <div key={topic.id}>
                        {gateNode}

                        <div className={`border-b border-gray-200 ${isLocked ? 'opacity-40 pointer-events-none select-none' : ''}`}>
                            <button
                                onClick={() => toggleTopic(topic.id)}
                                className="w-full flex items-center justify-between px-4 py-3 text-left bg-white hover:bg-gray-50 font-semibold text-sm text-gray-800"
                            >
                                <span className="flex-1 pr-2">{topic.name}</span>
                                <span className={`text-gray-400 text-xs shrink-0 transition-transform duration-200 ${openTopics.has(topic.id) ? 'rotate-180' : ''}`}>
                                    {isLocked ? '🔒' : '▼'}
                                </span>
                            </button>

                            {openTopics.has(topic.id) && (
                                <div>
                                    {topic.items.map((item, idx) => {
                                        if (item.kind === 'media_lesson') {
                                            return (
                                                <div key={idx}>
                                                    <div className="px-4 py-2 text-xs font-semibold text-gray-600 bg-white/60 border-t border-gray-100">
                                                        {item.name}
                                                    </div>
                                                    {item.media.map(m => {
                                                        const key = `${m.progressable_type}__${m.progressable_id}`;
                                                        return (
                                                            <div
                                                                key={m.id}
                                                                className="flex items-center gap-2.5 px-4 py-2.5 hover:bg-white cursor-pointer group border-t border-gray-100"
                                                            >
                                                                <input
                                                                    type="checkbox"
                                                                    checked={progressMap[key] ?? false}
                                                                    onChange={e => toggleProgress(
                                                                        m.progressable_id, m.progressable_type,
                                                                        item.topic_id, item.id, e.target.checked
                                                                    )}
                                                                    className="shrink-0 accent-indigo-600"
                                                                    style={{ transform: 'scale(1.4)' }}
                                                                    onClick={e => e.stopPropagation()}
                                                                />
                                                                <span
                                                                    className="text-xs text-gray-700 flex-1 group-hover:text-indigo-600 transition-colors"
                                                                    onClick={() => loadContent(m.url, m.media_type, item.description, m.id)}
                                                                >
                                                                    <MediaIcon type={m.media_type} /> {m.name}
                                                                </span>
                                                            </div>
                                                        );
                                                    })}
                                                </div>
                                            );
                                        }

                                        if (item.kind === 'lesson') {
                                            const key = `${item.progressable_type}__${item.progressable_id}`;
                                            return (
                                                <div
                                                    key={idx}
                                                    className="flex items-center gap-2.5 px-4 py-2.5 hover:bg-white cursor-pointer group border-t border-gray-100"
                                                >
                                                    <input
                                                        type="checkbox"
                                                        checked={progressMap[key] ?? false}
                                                        onChange={e => toggleProgress(
                                                            item.progressable_id, item.progressable_type,
                                                            item.topic_id, item.id, e.target.checked
                                                        )}
                                                        className="shrink-0 accent-indigo-600"
                                                        style={{ transform: 'scale(1.4)' }}
                                                        onClick={e => e.stopPropagation()}
                                                    />
                                                    <span
                                                        className="text-xs text-gray-700 flex-1 group-hover:text-indigo-600 transition-colors"
                                                        onClick={() => loadContent(item.url, item.lesson_type, item.description)}
                                                    >
                                                        <MediaIcon type={item.lesson_type} /> {item.name}
                                                    </span>
                                                </div>
                                            );
                                        }

                                        if (item.kind === 'quiz') {
                                            return (
                                                <div
                                                    key={idx}
                                                    className="flex items-center gap-2.5 px-4 py-2.5 hover:bg-white cursor-pointer group border-t border-gray-100"
                                                    onClick={() => loadContent(item.url, 'quiz')}
                                                >
                                                    <span className="text-lg shrink-0">🧩</span>
                                                    <span className="text-xs text-gray-700 flex-1 group-hover:text-indigo-600 transition-colors">
                                                        {item.name}
                                                    </span>
                                                </div>
                                            );
                                        }

                                        return null;
                                    })}
                                </div>
                            )}
                        </div>
                    </div>
                );
            })}
        </div>
    );
}
