import { useState } from 'react';
import { router } from '@inertiajs/react';
import AssignmentsSection from './AssignmentsSection';

const DEFAULT_AVATAR = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='20' fill='%23e0e7ff'/%3E%3Ccircle cx='20' cy='16' r='7' fill='%23a5b4fc'/%3E%3Cellipse cx='20' cy='36' rx='12' ry='9' fill='%23a5b4fc'/%3E%3C/svg%3E";

export default function BottomSection({ course, assignments, activeTab, setActiveTab, activeContent, loadContent }) {
    const tabs = [
        { id: 'overview',      label: 'Overview' },
        { id: 'description',   label: 'Description' },
        ...(course.is_question ? [{ id: 'qa', label: 'Q&A' }] : []),
        { id: 'announcements', label: 'Announcements' },
        { id: 'assignments',   label: 'Assignments' },
    ];

    return (
        <div className="flex-none flex flex-col overflow-hidden" style={{ height: 320 }}>
            <div className="flex border-b border-gray-200 bg-white sticky top-0 z-10 overflow-x-auto">
                {tabs.map(tab => (
                    <button
                        key={tab.id}
                        onClick={() => setActiveTab(tab.id)}
                        className={`px-5 py-3 text-sm font-semibold whitespace-nowrap transition-colors shrink-0 ${
                            activeTab === tab.id
                                ? 'text-indigo-600 border-b-2 border-indigo-600'
                                : 'text-gray-500 hover:text-gray-700'
                        }`}
                    >
                        {tab.label}
                        {tab.id === 'announcements' && course.announcement && (
                            <span className="ml-1.5 inline-block h-2 w-2 rounded-full bg-orange-400 animate-pulse" />
                        )}
                    </button>
                ))}
            </div>

            <div className="p-5 overflow-y-auto flex-1">
                {activeTab === 'overview' && (
                    <div className="prose max-w-none text-sm text-gray-700"
                        dangerouslySetInnerHTML={{ __html: course.description || '<p>No overview available.</p>' }} />
                )}

                {activeTab === 'description' && (
                    <div className="prose max-w-none text-sm text-gray-700"
                        dangerouslySetInnerHTML={{
                            __html: activeContent?.description || '<p class="text-gray-400">Select a lesson to view its description.</p>'
                        }} />
                )}

                {activeTab === 'qa' && course.is_question && (
                    <QASection course={course} />
                )}

                {activeTab === 'announcements' && (
                    <div className="prose max-w-none text-sm text-gray-700"
                        dangerouslySetInnerHTML={{ __html: course.announcement || '<p class="text-gray-400">No announcements yet.</p>' }} />
                )}

                {activeTab === 'assignments' && (
                    <AssignmentsSection assignments={assignments} loadContent={loadContent} />
                )}
            </div>
        </div>
    );
}

function QASection({ course }) {
    const [question, setQuestion]     = useState('');
    const [submitting, setSubmitting] = useState(false);

    const handleSubmit = (e) => {
        e.preventDefault();
        if (!question.trim()) return;
        setSubmitting(true);
        router.post(`/courses/${course.id}/question`, { name: question }, {
            onFinish: () => { setSubmitting(false); setQuestion(''); },
        });
    };

    return (
        <div className="space-y-6 max-w-2xl">
            <form onSubmit={handleSubmit} className="bg-gray-50 rounded-xl p-4 space-y-3 border border-gray-100">
                <h5 className="font-semibold text-sm text-gray-700">Ask a Question</h5>
                <textarea
                    value={question}
                    onChange={e => setQuestion(e.target.value)}
                    rows={3}
                    placeholder="Type your question…"
                    className="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none"
                />
                <button type="submit" disabled={submitting || !question.trim()}
                    className="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 disabled:opacity-50">
                    {submitting ? 'Submitting…' : 'Submit Question'}
                </button>
            </form>

            <div className="space-y-5">
                <h5 className="font-semibold text-sm text-gray-700">All Questions ({course.questions.length})</h5>
                {course.questions.length === 0 ? (
                    <p className="text-gray-400 text-sm">No questions yet. Be the first to ask!</p>
                ) : (
                    course.questions.map(q => (
                        <div key={q.id} className="flex gap-3">
                            <img
                                src={q.user_avatar || DEFAULT_AVATAR}
                                alt=""
                                className="h-10 w-10 rounded-full object-cover shrink-0"
                                onError={e => { e.target.src = DEFAULT_AVATAR; }}
                            />
                            <div className="flex-1 min-w-0">
                                <p className="font-semibold text-sm text-gray-800">{q.name}</p>
                                {q.answers.map((a, i) => (
                                    <p key={i} className="text-sm text-gray-600 mt-1 bg-indigo-50 rounded-lg px-3 py-2">{a.answer}</p>
                                ))}
                                <p className="text-xs text-gray-400 mt-1">{q.user_name} · {q.created_at_human}</p>
                            </div>
                        </div>
                    ))
                )}
            </div>
        </div>
    );
}
