import MainLayout from '@/Layouts/MainLayout';
import Breadcrumb from '@/Components/Common/Breadcrumb';
import StudentSidebar from '@/Components/Common/StudentSidebar';

export default function QuizAttempts({ quiz_attempts }) {
    return (
        <MainLayout>
            <Breadcrumb title="Quiz Attempts" items={['Home', 'Quiz Attempts']} />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div className="flex flex-col lg:flex-row gap-8">
                    <StudentSidebar />

                    <div className="flex-1">
                        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div className="px-6 py-5 border-b border-gray-100">
                                <h3 className="text-base font-semibold text-gray-800">My Quiz Attempts</h3>
                            </div>

                            <div className="overflow-x-auto">
                                <table className="w-full text-sm">
                                    <thead>
                                        <tr className="border-b border-gray-100 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            <th className="px-4 py-3">#</th>
                                            <th className="px-4 py-3">Topic</th>
                                            <th className="px-4 py-3">Questions</th>
                                            <th className="px-4 py-3">Total Pts</th>
                                            <th className="px-4 py-3">Correct</th>
                                            <th className="px-4 py-3">Incorrect</th>
                                            <th className="px-4 py-3">Earned Pts</th>
                                            <th className="px-4 py-3">Date</th>
                                            <th className="px-4 py-3">Result</th>
                                            <th className="px-4 py-3">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody className="divide-y divide-gray-50">
                                        {quiz_attempts.length === 0 ? (
                                            <tr>
                                                <td colSpan={10} className="px-6 py-10 text-center text-gray-400">
                                                    No quiz attempts found.
                                                </td>
                                            </tr>
                                        ) : (
                                            quiz_attempts.map((attempt, i) => (
                                                <tr key={attempt.id} className="hover:bg-gray-50 transition-colors">
                                                    <td className="px-4 py-3 text-gray-500">{i + 1}</td>
                                                    <td className="px-4 py-3 text-gray-700 font-medium">{attempt.topic_name ?? '—'}</td>
                                                    <td className="px-4 py-3 text-gray-600">{attempt.total_questions}</td>
                                                    <td className="px-4 py-3 text-gray-600">{attempt.total_points}</td>
                                                    <td className="px-4 py-3 text-green-600 font-medium">{attempt.correct_answers}</td>
                                                    <td className="px-4 py-3 text-red-500 font-medium">{attempt.incorrect_answers}</td>
                                                    <td className="px-4 py-3 text-gray-700">
                                                        {attempt.earned_points}
                                                        <span className="text-gray-400 text-xs ml-1">({attempt.percentage}%)</span>
                                                    </td>
                                                    <td className="px-4 py-3 text-gray-500">{attempt.date}</td>
                                                    <td className="px-4 py-3">
                                                        <span className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold ${
                                                            attempt.percentage >= 50
                                                                ? 'bg-green-100 text-green-700'
                                                                : 'bg-red-100 text-red-600'
                                                        }`}>
                                                            {attempt.percentage >= 50 ? 'Pass' : 'Fail'}
                                                        </span>
                                                    </td>
                                                    <td className="px-4 py-3">
                                                        <a
                                                            href={`/students/quiz-attempts/${attempt.id}/result`}
                                                            className="rounded-lg bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-600 hover:bg-indigo-100"
                                                        >
                                                            Details
                                                        </a>
                                                    </td>
                                                </tr>
                                            ))
                                        )}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </MainLayout>
    );
}
