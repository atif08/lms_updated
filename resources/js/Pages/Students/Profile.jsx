import { usePage, Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import Breadcrumb from '@/Components/Common/Breadcrumb';
import StudentSidebar from '@/Components/Common/StudentSidebar';

export default function Profile() {
    const { auth } = usePage().props;
    const user = auth.user;

    const fields = [
        { label: 'First Name',   value: user.first_name },
        { label: 'Last Name',    value: user.last_name },
        { label: 'Username',     value: user.name },
        { label: 'Email',        value: user.email },
        { label: 'Phone Number', value: [user.country_code, user.mobile].filter(Boolean).join(' ') },
        { label: 'Gender',       value: user.gender },
        { label: 'National ID',  value: user.national_id },
        { label: 'Qualification',value: user.qualification_name },
        { label: 'Institution',  value: user.institution },
        { label: 'Graduation Year', value: user.graduation_year },
        { label: 'Major',        value: user.major },
    ];

    return (
        <MainLayout>
            <Breadcrumb title="My Profile" items={['Home', 'My Profile']} />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div className="flex flex-col lg:flex-row gap-8">
                    <StudentSidebar />

                    <div className="flex-1 space-y-6">
                        {/* Avatar + name card */}
                        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-5">
                            <img
                                src={user.avatar || '/frontend/img/students/profile-avatar.png'}
                                alt={user.name}
                                className="h-20 w-20 rounded-full object-cover ring-4 ring-indigo-100"
                                onError={e => { e.target.src = '/frontend/img/students/profile-avatar.png'; }}
                            />
                            <div>
                                <h2 className="text-xl font-bold text-gray-800">{user.name}</h2>
                                <p className="text-sm text-gray-500">{user.user_type}</p>
                            </div>
                            <Link
                                href="/students/settings"
                                className="ml-auto inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700"
                            >
                                ✏️ Edit Profile
                            </Link>
                        </div>

                        {/* Details grid */}
                        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 className="text-base font-semibold text-gray-700 mb-5">Personal Information</h3>
                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5">
                                {fields.map(f => (
                                    <div key={f.label}>
                                        <p className="text-xs font-medium text-gray-400 uppercase tracking-wider">{f.label}</p>
                                        <p className="mt-1 text-sm text-gray-800">{f.value || <span className="text-gray-300 italic">—</span>}</p>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* Quick links */}
                        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 className="text-base font-semibold text-gray-700 mb-4">Account Settings</h3>
                            <div className="flex gap-3 flex-wrap">
                                <Link href="/students/settings"
                                   className="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    ✏️ Edit Profile
                                </Link>
                                <Link href="/students/change-password"
                                   className="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    🔒 Change Password
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </MainLayout>
    );
}
