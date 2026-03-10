import { usePage, Link } from '@inertiajs/react';

const links = [
    { href: '/students/profile',         label: 'My Profile',        icon: '👤' },
    { href: '/students/settings',         label: 'Edit Profile',      icon: '✏️' },
    { href: '/students/change-password',  label: 'Change Password',   icon: '🔒' },
    { href: '/courses/enrolled',          label: 'Enrolled Courses',  icon: '📚' },
    { href: '/students/quiz-attempts',    label: 'Quiz Attempts',     icon: '🧩' },
    { href: '/attendance',                label: 'Attendance',        icon: '📋' },
    { href: '/students/calendar',         label: 'Calendar',          icon: '📅' },
];

export default function StudentSidebar() {
    const { url } = usePage();

    return (
        <aside className="w-full lg:w-64 shrink-0">
            <div className="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <nav className="py-2">
                    {links.map(link => {
                        const active = url.startsWith(link.href);
                        return (
                            <Link
                                key={link.href}
                                href={link.href}
                                className={`flex items-center gap-3 px-5 py-3 text-sm transition-colors ${
                                    active
                                        ? 'bg-indigo-50 text-indigo-700 font-semibold border-r-2 border-indigo-600'
                                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                                }`}
                            >
                                <span>{link.icon}</span>
                                {link.label}
                            </Link>
                        );
                    })}
                </nav>
            </div>
        </aside>
    );
}
