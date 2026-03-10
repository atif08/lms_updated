import { useForm, Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import Breadcrumb from '@/Components/Common/Breadcrumb';
import StudentSidebar from '@/Components/Common/StudentSidebar';
import InputField, { inputClass } from '@/Components/UI/InputField';

export default function ChangePassword() {
    const { data, setData, post, processing, errors, reset } = useForm({
        current_password:      '',
        password:              '',
        password_confirmation: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post('/students/change-password', {
            onSuccess: () => reset(),
        });
    };

    return (
        <MainLayout>
            <Breadcrumb title="Settings" items={['Home', 'Change Password']} />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div className="flex flex-col lg:flex-row gap-8">
                    <StudentSidebar />

                    <div className="flex-1">
                        <div className="bg-white rounded-2xl shadow-sm border border-gray-100">
                            {/* Tabs */}
                            <div className="flex border-b border-gray-100 px-6 pt-5 gap-4">
                                <Link href="/students/settings"
                                   className="pb-3 text-sm font-medium text-gray-500 hover:text-gray-700">
                                    Edit Profile
                                </Link>
                                <Link href="/students/change-password"
                                   className="pb-3 text-sm font-semibold text-indigo-600 border-b-2 border-indigo-600">
                                    Change Password
                                </Link>
                            </div>

                            <form onSubmit={submit} className="p-6 max-w-md space-y-5">
                                <InputField label="Current Password" error={errors.current_password}>
                                    <input
                                        type="password"
                                        value={data.current_password}
                                        onChange={e => setData('current_password', e.target.value)}
                                        className={inputClass}
                                        required
                                    />
                                </InputField>

                                <InputField label="New Password" error={errors.password}>
                                    <input
                                        type="password"
                                        value={data.password}
                                        onChange={e => setData('password', e.target.value)}
                                        className={inputClass}
                                        placeholder="Min. 8 characters"
                                        required
                                    />
                                </InputField>

                                <InputField label="Confirm New Password" error={errors.password_confirmation}>
                                    <input
                                        type="password"
                                        value={data.password_confirmation}
                                        onChange={e => setData('password_confirmation', e.target.value)}
                                        className={inputClass}
                                        placeholder="Repeat new password"
                                        required
                                    />
                                </InputField>

                                <button
                                    type="submit"
                                    disabled={processing}
                                    className="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 disabled:opacity-60 transition-opacity"
                                >
                                    {processing && (
                                        <svg className="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                                            <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                                        </svg>
                                    )}
                                    {processing ? 'Updating…' : 'Reset Password'}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </MainLayout>
    );
}
