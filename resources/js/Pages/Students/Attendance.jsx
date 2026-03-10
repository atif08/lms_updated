import MainLayout from '@/Layouts/MainLayout';
import Breadcrumb from '@/Components/Common/Breadcrumb';
import StudentSidebar from '@/Components/Common/StudentSidebar';

const STATUS_STYLE = {
    PRESENT: 'bg-green-100 text-green-700',
    ABSENT:  'bg-red-100 text-red-700',
};

export default function Attendance({ attendance }) {
    return (
        <MainLayout>
            <Breadcrumb title="Attendance" items={['Home', 'Attendance']} />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div className="flex flex-col lg:flex-row gap-8">
                    <StudentSidebar />

                    <div className="flex-1">
                        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div className="px-6 py-5 border-b border-gray-100">
                                <h3 className="text-base font-semibold text-gray-800">Attendance Records</h3>
                            </div>

                            <div className="overflow-x-auto">
                                <table className="w-full text-sm">
                                    <thead>
                                        <tr className="border-b border-gray-100 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            <th className="px-6 py-3">Date</th>
                                            <th className="px-6 py-3">Check In</th>
                                            <th className="px-6 py-3">Check Out</th>
                                            <th className="px-6 py-3">Hours</th>
                                            <th className="px-6 py-3">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody className="divide-y divide-gray-50">
                                        {attendance.length === 0 ? (
                                            <tr>
                                                <td colSpan={5} className="px-6 py-10 text-center text-gray-400">
                                                    No attendance records found.
                                                </td>
                                            </tr>
                                        ) : (
                                            attendance.map(a => (
                                                <tr key={a.id} className="hover:bg-gray-50 transition-colors">
                                                    <td className="px-6 py-4 text-gray-700">{a.date}</td>
                                                    <td className="px-6 py-4 text-gray-700">{a.check_in ?? '—'}</td>
                                                    <td className="px-6 py-4 text-gray-700">{a.check_out ?? '—'}</td>
                                                    <td className="px-6 py-4 font-semibold text-gray-800">{a.hours} Hrs</td>
                                                    <td className="px-6 py-4">
                                                        <span className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ${STATUS_STYLE[a.status] ?? 'bg-gray-100 text-gray-600'}`}>
                                                            {a.status}
                                                        </span>
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
