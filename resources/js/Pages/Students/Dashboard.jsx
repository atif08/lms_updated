import { usePage } from '@inertiajs/react';
import { useEffect, useRef } from 'react';
import MainLayout from '@/Layouts/MainLayout';
import Breadcrumb from '@/Components/Common/Breadcrumb';

const STAT_CARDS = [
    { href: '/students/profile',      label: 'MY PROFILE',       icon: '👤', bg: 'from-indigo-500 to-indigo-700' },
    { href: '/courses/enrolled',      label: 'ENROLLED COURSES', icon: '📚', bg: 'from-violet-500 to-violet-700' },
    { href: '/students/quiz-attempts',label: 'QUIZ ATTEMPTS',    icon: '🧩', bg: 'from-sky-500 to-sky-700' },
];

export default function Dashboard({ calendar_events, latest_announcement }) {
    const { auth, domain } = usePage().props;
    const user = auth.user;

    const headerBg = domain?.is_asti
        ? "url('/frontend/img/Asti-Bg.png')"
        : "url('/frontend/img/buc-Bg.png')";

    const bannerColor = domain?.is_asti ? '#e42327' : '#1d1d56';

    return (
        <MainLayout>
            <Breadcrumb title="Dashboard" items={['Home', 'Dashboard']} />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

                {/* Announcement banner */}
                {latest_announcement && (
                    <div
                        className="overflow-hidden rounded-xl py-3 px-4"
                        style={{ backgroundColor: bannerColor }}
                    >
                        <div className="whitespace-nowrap overflow-hidden">
                            <span
                                className="inline-block text-white font-semibold text-base animate-[marquee_20s_linear_infinite]"
                                style={{ paddingLeft: '100%' }}
                            >
                                {latest_announcement}
                            </span>
                        </div>
                    </div>
                )}

                {/* User header */}
                <div
                    className="relative flex items-center gap-5 p-6 rounded-2xl overflow-hidden"
                    style={{ backgroundImage: headerBg, backgroundSize: 'cover', backgroundPosition: 'center' }}
                >
                    <div className="bg-black/30 absolute inset-0 pointer-events-none" />
                    <img
                        src={user.avatar || '/frontend/img/students/profile-avatar.png'}
                        alt={user.name}
                        className="h-20 w-20 rounded-full object-cover ring-4 ring-white/30 relative z-10"
                        onError={e => { e.target.src = '/frontend/img/students/profile-avatar.png'; }}
                    />
                    <div className="relative z-10">
                        <h2 className="text-xl font-bold text-white">{user.name}</h2>
                        <p className="text-white/80 text-sm">{user.email}</p>
                    </div>
                </div>

                {/* Stat cards */}
                <div className="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    {STAT_CARDS.map(card => (
                        <a
                            key={card.href}
                            href={card.href}
                            className={`flex flex-col items-center justify-center gap-3 p-10 rounded-2xl bg-gradient-to-br ${card.bg} text-white shadow-md hover:-translate-y-1 transition-transform`}
                        >
                            <span className="text-4xl bg-white/20 rounded-full h-16 w-16 flex items-center justify-center">
                                {card.icon}
                            </span>
                            <p className="font-bold tracking-wide text-sm">{card.label}</p>
                        </a>
                    ))}
                </div>

                {/* Calendar */}
                <CalendarSection events={calendar_events} />
            </div>
        </MainLayout>
    );
}

function CalendarSection({ events }) {
    const calRef = useRef(null);

    useEffect(() => {
        // Load FullCalendar v3 scripts dynamically (same version as the original)
        const loadScript = (src) =>
            new Promise((res) => {
                if (document.querySelector(`script[src="${src}"]`)) { res(); return; }
                const s = document.createElement('script');
                s.src = src;
                s.onload = res;
                document.head.appendChild(s);
            });

        const loadCss = (href) => {
            if (document.querySelector(`link[href="${href}"]`)) return;
            const l = document.createElement('link');
            l.rel = 'stylesheet'; l.href = href;
            document.head.appendChild(l);
        };

        loadCss('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css');

        const init = async () => {
            await loadScript('https://code.jquery.com/jquery-3.7.1.min.js');
            await loadScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js');
            await loadScript('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js');

            if (calRef.current && window.jQuery) {
                window.jQuery(calRef.current).fullCalendar({
                    events: events ?? [],
                    editable: false,
                    selectable: true,
                    eventClick(event) {
                        alert(`${event.title}\n${event.description ?? ''}`);
                    },
                });
            }
        };

        init();

        return () => {
            if (calRef.current && window.jQuery) {
                window.jQuery(calRef.current).fullCalendar('destroy');
            }
        };
    }, []);

    return (
        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 className="text-base font-semibold text-gray-700 mb-4">Calendar</h3>
            <div ref={calRef} />
        </div>
    );
}
