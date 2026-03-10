import { useEffect, useRef, useState } from 'react';
import MainLayout from '@/Layouts/MainLayout';
import Breadcrumb from '@/Components/Common/Breadcrumb';
import StudentSidebar from '@/Components/Common/StudentSidebar';

export default function CalendarIndex({ calendar_events }) {
    const [selectedEvent, setSelectedEvent] = useState(null);
    const calRef = useRef(null);

    useEffect(() => {
        const loadScript = (src) =>
            new Promise((res) => {
                if (document.querySelector(`script[src="${src}"]`)) { res(); return; }
                const s = document.createElement('script');
                s.src = src; s.onload = res;
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
                    events: calendar_events ?? [],
                    editable: false,
                    selectable: true,
                    eventClick(event) {
                        setSelectedEvent({
                            title:       event.title,
                            description: event.description,
                            url:         event.eventUrl ?? event.url,
                            start:       event.start ? window.moment(event.start).format('ddd, MMM D - hh:mm A') : null,
                            end:         event.end   ? window.moment(event.end).format('ddd, MMM D - hh:mm A')   : null,
                        });
                    },
                });
            }
        };

        init();

        return () => {
            if (calRef.current && window.jQuery) {
                try { window.jQuery(calRef.current).fullCalendar('destroy'); } catch {}
            }
        };
    }, []);

    return (
        <MainLayout>
            <Breadcrumb title="Calendar" items={['Home', 'Calendar']} />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div className="flex flex-col lg:flex-row gap-8">
                    <StudentSidebar />

                    <div className="flex-1 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div ref={calRef} />
                    </div>
                </div>
            </div>

            {/* Event detail modal */}
            {selectedEvent && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
                    <div className="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
                        <div className="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                            <h3 className="text-base font-semibold text-gray-800">Event Details</h3>
                            <button onClick={() => setSelectedEvent(null)} className="text-gray-400 hover:text-gray-600 text-xl leading-none">✕</button>
                        </div>
                        <div className="px-6 py-5 space-y-3 text-sm">
                            <p><span className="font-medium text-gray-500">Title:</span> {selectedEvent.title}</p>
                            {selectedEvent.description && (
                                <p><span className="font-medium text-gray-500">Description:</span> {selectedEvent.description}</p>
                            )}
                            {(selectedEvent.start || selectedEvent.end) && (
                                <p>
                                    <span className="font-medium text-gray-500">Time:</span>{' '}
                                    {selectedEvent.start}{selectedEvent.end ? ` → ${selectedEvent.end}` : ''}
                                </p>
                            )}
                            {selectedEvent.url && (
                                <a href={selectedEvent.url} target="_blank" rel="noreferrer" className="text-indigo-600 hover:underline">
                                    Visit event page →
                                </a>
                            )}
                        </div>
                        <div className="px-6 py-4 border-t border-gray-100 flex justify-end">
                            <button onClick={() => setSelectedEvent(null)} className="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </MainLayout>
    );
}
