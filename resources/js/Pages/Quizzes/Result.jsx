import MainLayout from '@/Layouts/MainLayout';
import { Link } from '@inertiajs/react';

export default function Result({ attempt }) {
    const passed = attempt.percentage >= 50;

    return (
        <MainLayout>
            <div className="min-h-screen bg-gray-50 py-10 px-4">
                <div className="max-w-3xl mx-auto space-y-6">

                    {/* Summary card */}
                    <div className="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <div className={`px-8 py-8 text-center ${passed ? 'bg-green-50' : 'bg-red-50'}`}>
                            <div className={`inline-flex items-center justify-center h-16 w-16 rounded-full text-3xl mb-4 ${passed ? 'bg-green-100' : 'bg-red-100'}`}>
                                {passed ? '🎉' : '😞'}
                            </div>
                            <h1 className="text-2xl font-bold text-gray-800">{attempt.quiz_name}</h1>
                            <p className="text-gray-500 mt-1">{attempt.participant_name} · {attempt.participant_email}</p>
                            <div className={`mt-3 inline-flex items-center rounded-full px-5 py-1.5 text-sm font-semibold ${passed ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600'}`}>
                                {passed ? 'PASSED' : 'FAILED'} — {attempt.percentage}%
                            </div>
                        </div>

                        <div className="grid grid-cols-2 sm:grid-cols-4 divide-x divide-y sm:divide-y-0 divide-gray-100">
                            <Stat label="Total Questions" value={attempt.total_questions} />
                            <Stat label="Correct" value={attempt.correct_answers} color="text-green-600" />
                            <Stat label="Incorrect" value={attempt.incorrect_answers} color="text-red-500" />
                            <Stat label="Score" value={`${attempt.earned_points} / ${attempt.total_points}`} />
                        </div>
                    </div>

                    {/* Section-by-section review */}
                    {attempt.sections.map(section => (
                        <div key={section.id}>
                            <div className="bg-indigo-50 border border-indigo-100 rounded-2xl px-6 py-4 mb-4">
                                <h2 className="text-base font-bold text-indigo-800">{section.title}</h2>
                                {section.description && (
                                    <div className="text-sm text-indigo-600 mt-1" dangerouslySetInnerHTML={{ __html: section.description }} />
                                )}
                            </div>

                            <div className="space-y-4">
                                {section.questions.map((question, qi) => (
                                    <QuestionResult key={question.id} question={question} index={qi} />
                                ))}
                            </div>
                        </div>
                    ))}

                    <div className="flex justify-center pt-2">
                        <Link
                            href="/students/quiz-attempts"
                            className="rounded-xl bg-indigo-600 px-8 py-3 text-white font-semibold hover:bg-indigo-700 shadow-md"
                        >
                            Back to My Attempts
                        </Link>
                    </div>
                </div>
            </div>
        </MainLayout>
    );
}

function Stat({ label, value, color = 'text-gray-800' }) {
    return (
        <div className="px-6 py-4 text-center">
            <p className={`text-xl font-bold ${color}`}>{value}</p>
            <p className="text-xs text-gray-500 mt-0.5">{label}</p>
        </div>
    );
}

function QuestionResult({ question, index }) {
    const borderColor = question.is_correct ? 'border-green-200' : 'border-red-200';
    const bgColor = question.is_correct ? 'bg-green-50' : 'bg-red-50';

    return (
        <div className={`rounded-2xl border ${borderColor} overflow-hidden`}>
            <div className={`flex items-start gap-3 px-5 py-4 ${bgColor}`}>
                <span className="inline-flex items-center justify-center h-6 w-6 rounded-full bg-white text-xs font-bold text-gray-600 shrink-0 mt-0.5">
                    {index + 1}
                </span>
                <div className="flex-1">
                    {question.type === 'FILL_BLANK' ? (
                        <FillBlankResult question={question} />
                    ) : (
                        <p className="text-sm font-semibold text-gray-800" dangerouslySetInnerHTML={{ __html: question.name }} />
                    )}
                </div>
                <span className={`shrink-0 text-xs font-semibold px-2.5 py-1 rounded-full ${question.is_correct ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600'}`}>
                    {question.is_correct ? `+${question.points} pts` : '0 pts'}
                </span>
            </div>

            <div className="bg-white px-5 py-4 space-y-2">
                {(question.type === 'ONE_CORRECT' || question.type === 'MULTIPLE_CORRECT') && (
                    question.options.map(opt => (
                        <OptionRow key={opt.id} opt={opt} />
                    ))
                )}

                {question.type === 'FREE_TEXT' && (
                    <FreeTextResult question={question} />
                )}

                {question.type === 'MATCHING' && (
                    <MatchingResult question={question} />
                )}
            </div>
        </div>
    );
}

function OptionRow({ opt }) {
    let bg = 'bg-white border-gray-100';
    let icon = null;

    if (opt.is_correct && opt.submitted) {
        bg = 'bg-green-50 border-green-200';
        icon = <span className="text-green-600 font-bold">✓</span>;
    } else if (opt.is_correct && !opt.submitted) {
        bg = 'bg-blue-50 border-blue-200';
        icon = <span className="text-blue-500 text-xs font-semibold">Correct</span>;
    } else if (!opt.is_correct && opt.submitted) {
        bg = 'bg-red-50 border-red-200';
        icon = <span className="text-red-500 font-bold">✗</span>;
    }

    return (
        <div className={`flex items-center justify-between px-4 py-2.5 rounded-xl border text-sm ${bg}`}>
            <span className="text-gray-700">{opt.name}</span>
            {icon}
        </div>
    );
}

function FreeTextResult({ question }) {
    const submitted = question.submitted_answers?.[0]?.answer_text;
    return (
        <div className="space-y-2 text-sm">
            <p className="text-gray-500 font-medium">Your answer:</p>
            <div className="bg-gray-50 rounded-xl px-4 py-3 text-gray-700 min-h-[60px]">
                {submitted || <span className="text-gray-400 italic">No answer submitted</span>}
            </div>
            <p className="text-xs text-gray-400">Free text answers are manually graded.</p>
        </div>
    );
}

function MatchingResult({ question }) {
    return (
        <div className="space-y-2">
            {question.options.map((opt, i) => {
                const submitted = question.submitted_answers?.[i]?.answer_text;
                const isCorrect = submitted?.toLowerCase().trim() === opt.answer?.toLowerCase().trim();
                return (
                    <div key={opt.id} className="flex items-center gap-3 text-sm">
                        <span className="w-1/2 bg-gray-50 rounded-lg px-3 py-2 text-gray-700">{opt.name}</span>
                        <div className={`w-1/2 rounded-lg px-3 py-2 flex items-center justify-between ${isCorrect ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-600'}`}>
                            <span>{submitted || <span className="italic text-gray-400">—</span>}</span>
                            {!isCorrect && opt.answer && (
                                <span className="text-xs text-blue-600 ml-2">({opt.answer})</span>
                            )}
                        </div>
                    </div>
                );
            })}
        </div>
    );
}

function FillBlankResult({ question }) {
    const parts = question.name.replace(/(<p[^>]*>)|(<\/p>)/g, '').split(/\[\[Blank_\d+\]\]/);
    const blanks = (question.name.match(/\[\[Blank_\d+\]\]/g) ?? []);

    // Collect submitted fill_blank texts from options
    const submitted = question.options.map((_, i) => question.submitted_answers?.[i]?.answer_text ?? '');
    const correct = question.options.map(o => o.answer ?? '');

    return (
        <div className="text-sm text-gray-700 leading-relaxed flex flex-wrap items-center gap-1">
            <p className="font-semibold text-gray-800 w-full mb-2">Fill in the blanks:</p>
            {parts.map((part, i) => (
                <span key={i}>
                    <span dangerouslySetInnerHTML={{ __html: part }} />
                    {i < blanks.length && (() => {
                        const sub = submitted[i] ?? '';
                        const cor = correct[i] ?? '';
                        const ok = sub.toLowerCase().trim() === cor.toLowerCase().trim();
                        return (
                            <span className={`inline-block border-b-2 px-2 mx-1 font-medium ${ok ? 'border-green-400 text-green-700' : 'border-red-400 text-red-600'}`}>
                                {sub || '___'}
                                {!ok && cor && <span className="text-xs text-blue-600 ml-1">({cor})</span>}
                            </span>
                        );
                    })()}
                </span>
            ))}
        </div>
    );
}
