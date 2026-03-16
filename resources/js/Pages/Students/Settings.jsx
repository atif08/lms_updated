import { useForm, usePage, Link, router } from '@inertiajs/react';

const AVATAR_FALLBACK = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='20' fill='%23e0e7ff'/%3E%3Ccircle cx='20' cy='16' r='7' fill='%23a5b4fc'/%3E%3Cellipse cx='20' cy='36' rx='12' ry='9' fill='%23a5b4fc'/%3E%3C/svg%3E";
import { useRef, useState } from 'react';
import MainLayout from '@/Layouts/MainLayout';
import Breadcrumb from '@/Components/Common/Breadcrumb';
import StudentSidebar from '@/Components/Common/StudentSidebar';
import InputField, { inputClass } from '@/Components/UI/InputField';

const DEFAULT_AVATAR = AVATAR_FALLBACK;

const COUNTRY_CODES = [
    '+971', '+92', '+1', '+44', '+91', '+49', '+33', '+81', '+86', '+61',
    '+55', '+7', '+39', '+34', '+82', '+31', '+46', '+47', '+45', '+358',
    '+64', '+966', '+20', '+27', '+234', '+254', '+62', '+60', '+66',
];

const GENDERS = ['male', 'female'];

export default function Settings() {
    const { auth } = usePage().props;
    const user = auth.user;

    const { data, setData, post, processing, errors } = useForm({
        first_name:         user.first_name          ?? '',
        last_name:          user.last_name           ?? '',
        name:               user.name                ?? '',
        country_code:       user.country_code        ?? '+971',
        mobile:             user.mobile              ?? '',
        qualification_name: user.qualification_name  ?? '',
        institution:        user.institution         ?? '',
        graduation_year:    user.graduation_year     ?? '',
        major:              user.major               ?? '',
        national_id:        user.national_id         ?? '',
        gender:             user.gender              ?? 'male',
    });

    const submit = (e) => {
        e.preventDefault();
        post('/students/settings');
    };

    return (
        <MainLayout>
            <Breadcrumb title="Settings" items={['Home', 'Edit Profile']} />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div className="flex flex-col lg:flex-row gap-8">
                    <StudentSidebar />

                    <div className="flex-1 space-y-5">
                        {/* Avatar card */}
                        <AvatarUploader currentAvatar={user.avatar} />

                        {/* Profile form */}
                        <div className="bg-white rounded-2xl shadow-sm border border-gray-100">
                            {/* Tabs */}
                            <div className="flex border-b border-gray-100 px-6 pt-5 gap-4">
                                <Link href="/students/settings"
                                   className="pb-3 text-sm font-semibold text-indigo-600 border-b-2 border-indigo-600">
                                    Edit Profile
                                </Link>
                                <Link href="/students/change-password"
                                   className="pb-3 text-sm font-medium text-gray-500 hover:text-gray-700">
                                    Change Password
                                </Link>
                            </div>

                            <form onSubmit={submit} className="p-6 space-y-6">
                                <div>
                                    <h5 className="text-sm font-semibold text-gray-700">Personal Details</h5>
                                    <p className="text-xs text-gray-400 mt-0.5">Edit your personal information</p>
                                </div>

                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <InputField label="First Name" error={errors.first_name}>
                                        <input type="text" value={data.first_name} onChange={e => setData('first_name', e.target.value)} className={inputClass} />
                                    </InputField>

                                    <InputField label="Last Name" error={errors.last_name}>
                                        <input type="text" value={data.last_name} onChange={e => setData('last_name', e.target.value)} className={inputClass} />
                                    </InputField>

                                    <InputField label="Username" error={errors.name}>
                                        <input type="text" value={data.name} onChange={e => setData('name', e.target.value)} className={inputClass} />
                                    </InputField>

                                    <InputField label="Phone Number" error={errors.mobile}>
                                        <div className="flex gap-2">
                                            <select
                                                value={data.country_code}
                                                onChange={e => setData('country_code', e.target.value)}
                                                className="rounded-lg border border-gray-300 px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white w-24 shrink-0"
                                            >
                                                {COUNTRY_CODES.map(c => (
                                                    <option key={c} value={c}>{c}</option>
                                                ))}
                                            </select>
                                            <input
                                                type="text"
                                                value={data.mobile}
                                                onChange={e => setData('mobile', e.target.value)}
                                                className={`${inputClass} flex-1`}
                                                placeholder="Phone number"
                                            />
                                        </div>
                                    </InputField>

                                    <InputField label="Qualification" error={errors.qualification_name}>
                                        <input type="text" value={data.qualification_name} onChange={e => setData('qualification_name', e.target.value)} className={inputClass} placeholder="e.g. BSc Computer Science" />
                                    </InputField>

                                    <InputField label="Institution" error={errors.institution}>
                                        <input type="text" value={data.institution} onChange={e => setData('institution', e.target.value)} className={inputClass} placeholder="University / School name" />
                                    </InputField>

                                    <InputField label="Graduation Year" error={errors.graduation_year}>
                                        <input type="text" value={data.graduation_year} onChange={e => setData('graduation_year', e.target.value)} className={inputClass} placeholder="e.g. 2022" />
                                    </InputField>

                                    <InputField label="Major Subject" error={errors.major}>
                                        <input type="text" value={data.major} onChange={e => setData('major', e.target.value)} className={inputClass} placeholder="e.g. Mathematics" />
                                    </InputField>

                                    <InputField label="National Document ID" error={errors.national_id}>
                                        <input type="text" value={data.national_id} onChange={e => setData('national_id', e.target.value)} className={inputClass} />
                                    </InputField>

                                    <InputField label="Gender" error={errors.gender}>
                                        <select value={data.gender} onChange={e => setData('gender', e.target.value)} className={inputClass}>
                                            {GENDERS.map(g => (
                                                <option key={g} value={g}>{g.charAt(0).toUpperCase() + g.slice(1)}</option>
                                            ))}
                                        </select>
                                    </InputField>
                                </div>

                                <div>
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
                                        {processing ? 'Saving…' : 'Update Profile'}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </MainLayout>
    );
}

function AvatarUploader({ currentAvatar }) {
    const fileRef = useRef(null);
    const [preview, setPreview] = useState(null);
    const [uploading, setUploading] = useState(false);
    const [error, setError] = useState(null);

    const handleFileChange = (e) => {
        const file = e.target.files[0];
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            setError('Please select an image file.');
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            setError('Image must be smaller than 2 MB.');
            return;
        }

        setError(null);
        setPreview(URL.createObjectURL(file));
    };

    const handleUpload = () => {
        const file = fileRef.current?.files[0];
        if (!file) return;

        setUploading(true);
        const form = new FormData();
        form.append('avatar', file);
        form.append('_token', document.querySelector('meta[name="csrf-token"]')?.content ?? '');

        router.post('/students/avatar', form, {
            forceFormData: true,
            onFinish: () => setUploading(false),
            onError: () => {
                setError('Upload failed. Please try again.');
                setUploading(false);
            },
        });
    };

    const displayed = preview ?? (currentAvatar || DEFAULT_AVATAR);

    return (
        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h5 className="text-sm font-semibold text-gray-700 mb-4">Profile Picture</h5>

            <div className="flex items-center gap-6">
                {/* Avatar preview */}
                <div className="relative shrink-0">
                    <img
                        src={displayed}
                        alt="Avatar"
                        className="h-24 w-24 rounded-full object-cover ring-4 ring-indigo-100"
                        onError={e => { e.target.src = DEFAULT_AVATAR; }}
                    />
                    <button
                        type="button"
                        onClick={() => fileRef.current?.click()}
                        className="absolute bottom-0 right-0 h-7 w-7 rounded-full bg-indigo-600 text-white flex items-center justify-center shadow hover:bg-indigo-700 transition-colors"
                        title="Change photo"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" className="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2.5}>
                            <path strokeLinecap="round" strokeLinejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.768-6.768a2 2 0 112.828 2.828L11.828 15.828a4 4 0 01-1.414.94l-3.414.586.586-3.414a4 4 0 01.94-1.414z" />
                        </svg>
                    </button>
                </div>

                {/* Info + actions */}
                <div className="flex-1 min-w-0">
                    <p className="text-sm text-gray-600">Click the pencil icon or the button below to upload a new profile picture.</p>
                    <p className="text-xs text-gray-400 mt-1">JPG, PNG or GIF · max 2 MB</p>

                    {error && <p className="mt-2 text-xs text-red-500">{error}</p>}

                    <div className="mt-3 flex items-center gap-3 flex-wrap">
                        <button
                            type="button"
                            onClick={() => fileRef.current?.click()}
                            className="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors"
                        >
                            Choose Photo
                        </button>

                        {preview && (
                            <button
                                type="button"
                                onClick={handleUpload}
                                disabled={uploading}
                                className="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 disabled:opacity-60 transition-opacity"
                            >
                                {uploading && (
                                    <svg className="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                                        <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                                    </svg>
                                )}
                                {uploading ? 'Uploading…' : 'Save Photo'}
                            </button>
                        )}

                        {preview && !uploading && (
                            <button
                                type="button"
                                onClick={() => { setPreview(null); setError(null); if (fileRef.current) fileRef.current.value = ''; }}
                                className="text-sm text-gray-400 hover:text-gray-600"
                            >
                                Cancel
                            </button>
                        )}
                    </div>
                </div>
            </div>

            <input
                ref={fileRef}
                type="file"
                accept="image/*"
                className="hidden"
                onChange={handleFileChange}
            />
        </div>
    );
}
