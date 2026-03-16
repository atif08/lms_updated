import { usePage, router, Link } from '@inertiajs/react';

const AVATAR_FALLBACK = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='20' fill='%23e0e7ff'/%3E%3Ccircle cx='20' cy='16' r='7' fill='%23a5b4fc'/%3E%3Cellipse cx='20' cy='36' rx='12' ry='9' fill='%23a5b4fc'/%3E%3C/svg%3E";
import { useEffect, useRef, useState } from 'react';

export default function MainLayout({ children, hideHeader = false }) {
    const { auth, domain, flash } = usePage().props;
    const user = auth?.user;

    return (
        <div className="min-h-screen bg-gray-50">
            {!hideHeader && <Header user={user} domain={domain} />}
            <main>{children}</main>
            <FlashMessages flash={flash} />
        </div>
    );
}

function Header({ user, domain }) {
    const [dropdownOpen, setDropdownOpen] = useState(false);
    const dropdownRef = useRef(null);

    useEffect(() => {
        function handleClickOutside(e) {
            if (dropdownRef.current && !dropdownRef.current.contains(e.target)) {
                setDropdownOpen(false);
            }
        }
        document.addEventListener('mousedown', handleClickOutside);
        return () => document.removeEventListener('mousedown', handleClickOutside);
    }, []);

    const logoSrc = domain?.is_asti ? '/frontend/img/ASTI.png' : '/frontend/img/BUC.png';

    return (
        <header className="bg-white shadow-sm sticky top-0 z-50">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="flex items-center justify-between h-16">
                    {/* Logo */}
                    <Link href="/students/dashboard" className="flex-shrink-0">
                        <img src={logoSrc} alt="Logo" className="h-10 w-auto" />
                    </Link>

                    {/* Right side */}
                    <div className="flex items-center gap-4">
                        {!user && (
                            <Link
                                href="/login"
                                className="text-sm font-medium text-indigo-600 hover:text-indigo-800"
                            >
                                Sign In
                            </Link>
                        )}

                        {user && (
                            <div className="relative" ref={dropdownRef}>
                                <button
                                    onClick={() => setDropdownOpen(prev => !prev)}
                                    className="flex items-center gap-2 focus:outline-none"
                                >
                                    <div className="relative">
                                        <img
                                            src={user.avatar || AVATAR_FALLBACK}
                                            alt={user.name}
                                            className="h-9 w-9 rounded-full object-cover ring-2 ring-indigo-200"
                                            onError={e => { e.target.onerror = null; e.target.src = AVATAR_FALLBACK; }}
                                        />
                                        <span className="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white" />
                                    </div>
                                    <span className="hidden sm:block text-sm font-medium text-gray-700">
                                        {user.name}
                                    </span>
                                </button>

                                {dropdownOpen && (
                                    <div className="absolute right-0 mt-2 w-56 rounded-xl bg-white shadow-lg ring-1 ring-black/5 py-1 z-50">
                                        <div className="px-4 py-3 border-b border-gray-100">
                                            <p className="text-sm font-semibold text-gray-800">{user.name}</p>
                                            <p className="text-xs text-gray-500">{user.user_type}</p>
                                        </div>

                                        {user.is_student && (
                                            <AttendanceTimer checkIn={user.check_in} />
                                        )}

                                        <DropdownLink href="/students/dashboard" icon="🏠">
                                            Dashboard
                                        </DropdownLink>

                                        {user.is_admin_or_faculty && (
                                            <DropdownLink href="/admin/courses" icon="⚙️">
                                                Go To Admin
                                            </DropdownLink>
                                        )}

                                        <LogoutButton totalHoursRef={null} />
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </header>
    );
}

function AttendanceTimer({ checkIn }) {
    const [elapsed, setElapsed] = useState('--:--:--');

    useEffect(() => {
        if (!checkIn) return;

        const checkInTime = new Date(checkIn);

        const tick = () => {
            const diff = Math.floor((Date.now() - checkInTime.getTime()) / 1000);
            if (diff < 0) { setElapsed('00:00:00'); return; }
            const h = Math.floor(diff / 3600).toString().padStart(2, '0');
            const m = Math.floor((diff % 3600) / 60).toString().padStart(2, '0');
            const s = (diff % 60).toString().padStart(2, '0');
            setElapsed(`${h}:${m}:${s}`);
        };

        tick();
        const id = setInterval(tick, 1000);
        return () => clearInterval(id);
    }, [checkIn]);

    return (
        <div className="px-4 py-2 text-xs text-gray-500 flex items-center gap-1 border-b border-gray-100">
            <span>🕒</span>
            <span>{elapsed} Hrs</span>
        </div>
    );
}

function DropdownLink({ href, icon, children }) {
    return (
        <Link
            href={href}
            className="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
        >
            <span>{icon}</span>
            {children}
        </Link>
    );
}

function LogoutButton() {
    const handleLogout = () => {
        // Submit logout via form POST to preserve CSRF
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/logout';

        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
        form.appendChild(csrf);

        document.body.appendChild(form);
        form.submit();
    };

    return (
        <button
            onClick={handleLogout}
            className="flex w-full items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50"
        >
            <span>🚪</span>
            Logout
        </button>
    );
}

function FlashMessages({ flash }) {
    const [visible, setVisible] = useState(true);

    useEffect(() => {
        setVisible(true);
        const id = setTimeout(() => setVisible(false), 4000);
        return () => clearTimeout(id);
    }, [flash]);

    if (!visible || (!flash?.success && !flash?.error)) return null;

    const isSuccess = !!flash.success;

    return (
        <div
            className={`fixed bottom-6 right-6 z-50 flex items-center gap-3 rounded-xl px-5 py-3 shadow-lg text-sm font-medium text-white transition-all ${
                isSuccess ? 'bg-green-500' : 'bg-red-500'
            }`}
        >
            <span>{isSuccess ? '✅' : '❌'}</span>
            <span>{flash.success ?? flash.error}</span>
            <button onClick={() => setVisible(false)} className="ml-2 opacity-70 hover:opacity-100">✕</button>
        </div>
    );
}
