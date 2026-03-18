export default function TopNav({ course, progress }) {
    const { percentage = 0, completed = 0, total = 0 } = progress ?? {};

    return (
        <nav className="fixed top-0 left-0 right-0 z-50 h-14 bg-gray-900 flex items-center justify-between px-5">
            <a href="/courses/enrolled" className="flex items-center gap-1.5 text-white text-sm hover:text-gray-300 transition-colors">
                <svg className="h-4 w-4" fill="none" stroke="currentColor" strokeWidth={2.5} viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Dashboard
            </a>

            <div className="flex items-center gap-3">
                <div className="flex flex-col items-end gap-1">
                    <div className="flex items-center gap-2">
                        <span className="text-gray-400 text-xs">
                            <span className="text-white font-semibold">{completed}</span>
                            {' of '}
                            <span className="text-white font-semibold">{total}</span>
                            {' complete'}
                        </span>
                        <span className="text-xs font-bold" style={{ color: `hsl(${percentage * 1.2}, 80%, 55%)` }}>
                            {percentage}%
                        </span>
                    </div>
                    <div className="w-48 h-2 bg-gray-600 rounded-full overflow-hidden">
                        <div
                            className="h-full rounded-full transition-all duration-700"
                            style={{ width: `${percentage}%`, backgroundColor: `hsl(${percentage * 1.2}, 80%, 45%)` }}
                        />
                    </div>
                </div>
            </div>
        </nav>
    );
}
