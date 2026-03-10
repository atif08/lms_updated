import { useState, useEffect, useRef } from 'react';
import { router, usePage } from '@inertiajs/react';

// Quiz is rendered without the main nav (full-screen focus mode)
export default function TakeQuiz({ quiz, topic }) {
    const [started, setStarted] = useState(false);
    const [answers, setAnswers] = useState({});           // ONE_CORRECT: { qId: optId }
    const [multiAnswers, setMultiAnswers] = useState({});  // MULTIPLE_CORRECT: { qId: [optId] }
    const [matchingAnswers, setMatchingAnswers] = useState({});
    const [fillBlanks, setFillBlanks] = useState({});      // { qId: [val1, val2] }
    const [freeText, setFreeText] = useState({});
    const [timeLeft, setTimeLeft] = useState(600);
    const [submitting, setSubmitting] = useState(false);
    const timerRef = useRef(null);
    const { auth } = usePage().props;

    // Timer
    useEffect(() => {
        if (!started) return;
        timerRef.current = setInterval(() => {
            setTimeLeft(prev => {
                if (prev <= 1) { clearInterval(timerRef.current); handleSubmit(true); return 0; }
                return prev - 1;
            });
        }, 1000);
        return () => clearInterval(timerRef.current);
    }, [started]);

    const minutes = Math.floor(timeLeft / 60).toString().padStart(2, '0');
    const seconds = (timeLeft % 60).toString().padStart(2, '0');

    const handleSubmit = (force = false) => {
        if (!force && !window.confirm('Are you sure you want to submit your answers?')) return;
        clearInterval(timerRef.current);
        setSubmitting(true);
        router.post('/students/quizzes/submit', {
            quiz_id:           quiz.id,
            topic_id:          topic.id,
            answers,
            multi_answers:     multiAnswers,
            matching_answers:  matchingAnswers,
            fill_blank:        fillBlanks,
            free_text:         freeText,
        }, { onError: () => setSubmitting(false) });
    };

    if (!started) {
        return (
            <div className="min-h-screen bg-gray-50 flex items-center justify-center px-4">
                <div className="bg-white rounded-3xl shadow-xl p-12 max-w-sm w-full text-center space-y-6">
                    <img src="/assets/images/quiz.png" alt="" className="h-24 mx-auto" onError={e => e.target.style.display='none'} />
                    <h2 className="text-3xl font-bold text-gray-800">{quiz.name}</h2>
                    <p className="text-gray-500"><strong>{quiz.total_questions}</strong> Questions</p>
                    <button
                        onClick={() => setStarted(true)}
                        className="w-full rounded-2xl bg-indigo-600 py-3 text-white font-semibold hover:bg-indigo-700 transition-colors shadow-md"
                    >
                        Start Quiz
                    </button>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-gray-50 select-none">
            {/* Sticky header */}
            <div className="sticky top-0 z-40 bg-white border-b border-gray-100 shadow-sm">
                <div className="max-w-3xl mx-auto px-4 py-3 flex items-center justify-between flex-wrap gap-3">
                    <h1 className="text-base font-bold text-gray-800">{quiz.name}</h1>
                    <div className="flex items-center gap-4 text-sm text-gray-600">
                        <span>📝 {quiz.total_questions} Questions</span>
                        <span className={`font-mono font-bold text-lg ${timeLeft < 60 ? 'text-red-500' : 'text-indigo-600'}`}>
                            ⏱ {minutes}:{seconds}
                        </span>
                    </div>
                </div>
            </div>

            <div className="max-w-3xl mx-auto px-4 py-8 space-y-8">
                {quiz.sections.map(section => (
                    <div key={section.id}>
                        <div className="bg-indigo-50 border border-indigo-100 rounded-2xl px-6 py-4 mb-4">
                            <h2 className="text-base font-bold text-indigo-800">{section.title}</h2>
                            {section.description && (
                                <div className="text-sm text-indigo-600 mt-1" dangerouslySetInnerHTML={{ __html: section.description }} />
                            )}
                        </div>

                        <div className="space-y-5">
                            {section.questions.map((question, qi) => (
                                <QuestionCard
                                    key={question.id}
                                    question={question}
                                    index={qi}
                                    answers={answers}
                                    multiAnswers={multiAnswers}
                                    matchingAnswers={matchingAnswers}
                                    fillBlanks={fillBlanks}
                                    freeText={freeText}
                                    setAnswers={setAnswers}
                                    setMultiAnswers={setMultiAnswers}
                                    setMatchingAnswers={setMatchingAnswers}
                                    setFillBlanks={setFillBlanks}
                                    setFreeText={setFreeText}
                                />
                            ))}
                        </div>
                    </div>
                ))}

                <div className="flex justify-end pt-4">
                    <button
                        onClick={() => handleSubmit()}
                        disabled={submitting}
                        className="rounded-xl bg-indigo-600 px-8 py-3 text-white font-semibold hover:bg-indigo-700 disabled:opacity-50 shadow-md"
                    >
                        {submitting ? 'Submitting…' : 'Submit Answers'}
                    </button>
                </div>
            </div>
        </div>
    );
}

function QuestionCard({ question, index, answers, multiAnswers, matchingAnswers, fillBlanks, freeText,
    setAnswers, setMultiAnswers, setMatchingAnswers, setFillBlanks, setFreeText }) {

    return (
        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p className="text-sm font-semibold text-gray-700 mb-4">
                <span className="inline-flex items-center justify-center h-6 w-6 rounded-full bg-indigo-100 text-indigo-600 text-xs font-bold mr-2">
                    {index + 1}
                </span>
                {question.type === 'FILL_BLANK'
                    ? null  // rendered inline below
                    : <span dangerouslySetInnerHTML={{ __html: question.name }} />
                }
            </p>

            {question.type === 'ONE_CORRECT' && (
                <div className="space-y-2">
                    {question.options.map(opt => (
                        <label key={opt.id} className="flex items-center gap-3 p-3 rounded-xl cursor-pointer hover:bg-gray-50 border border-transparent has-[:checked]:border-indigo-300 has-[:checked]:bg-indigo-50">
                            <input type="radio" name={`answers[${question.id}]`}
                                value={opt.id}
                                checked={answers[question.id] == opt.id}
                                onChange={() => setAnswers(prev => ({ ...prev, [question.id]: opt.id }))}
                                className="text-indigo-600 accent-indigo-600"
                            />
                            <span className="text-sm text-gray-700">{opt.name}</span>
                        </label>
                    ))}
                </div>
            )}

            {question.type === 'MULTIPLE_CORRECT' && (
                <div className="space-y-2">
                    {question.options.map(opt => {
                        const selected = (multiAnswers[question.id] ?? []).includes(opt.id);
                        return (
                            <label key={opt.id} className={`flex items-center gap-3 p-3 rounded-xl cursor-pointer hover:bg-gray-50 border ${selected ? 'border-indigo-300 bg-indigo-50' : 'border-transparent'}`}>
                                <input type="checkbox"
                                    checked={selected}
                                    onChange={() => setMultiAnswers(prev => {
                                        const cur = prev[question.id] ?? [];
                                        return { ...prev, [question.id]: selected ? cur.filter(id => id !== opt.id) : [...cur, opt.id] };
                                    })}
                                    className="accent-indigo-600"
                                />
                                <span className="text-sm text-gray-700">{opt.name}</span>
                            </label>
                        );
                    })}
                </div>
            )}

            {question.type === 'FREE_TEXT' && (
                <textarea
                    rows={4}
                    value={freeText[question.id] ?? ''}
                    onChange={e => setFreeText(prev => ({ ...prev, [question.id]: e.target.value }))}
                    placeholder="Type your answer here…"
                    className="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none"
                />
            )}

            {question.type === 'FILL_BLANK' && (
                <FillBlankQuestion
                    question={question}
                    fillBlanks={fillBlanks}
                    setFillBlanks={setFillBlanks}
                />
            )}

            {question.type === 'MATCHING' && (
                <div className="space-y-3">
                    {question.options.map((opt, i) => (
                        <div key={opt.id} className="flex items-center gap-3">
                            <span className="text-sm text-gray-700 w-1/2 bg-gray-50 rounded-lg px-3 py-2">{opt.name}</span>
                            <input
                                type="text"
                                placeholder="Type matching answer…"
                                value={(matchingAnswers[question.id] ?? [])[i] ?? ''}
                                onChange={e => setMatchingAnswers(prev => {
                                    const cur = [...(prev[question.id] ?? [])];
                                    cur[i] = e.target.value;
                                    return { ...prev, [question.id]: cur };
                                })}
                                className="w-1/2 rounded-xl border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
}

function FillBlankQuestion({ question, fillBlanks, setFillBlanks }) {
    // Parse [[Blank_X]] occurrences from the question HTML
    const parts = question.name.replace(/(<p[^>]*>)|(<\/p>)/g, '').split(/\[\[Blank_\d+\]\]/);
    const blanks = (question.name.match(/\[\[Blank_\d+\]\]/g) ?? []);

    return (
        <div className="text-sm text-gray-700 leading-relaxed flex flex-wrap items-center gap-1">
            {parts.map((part, i) => (
                <span key={i}>
                    <span dangerouslySetInnerHTML={{ __html: part }} />
                    {i < blanks.length && (
                        <input
                            type="text"
                            placeholder="…"
                            value={(fillBlanks[question.id] ?? [])[i] ?? ''}
                            onChange={e => setFillBlanks(prev => {
                                const cur = [...(prev[question.id] ?? [])];
                                cur[i] = e.target.value;
                                return { ...prev, [question.id]: cur };
                            })}
                            className="inline-block border-b-2 border-indigo-400 bg-transparent outline-none px-2 text-indigo-700 w-28 text-center"
                        />
                    )}
                </span>
            ))}
        </div>
    );
}
