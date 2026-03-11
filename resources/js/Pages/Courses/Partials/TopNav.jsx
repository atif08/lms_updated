export default function TopNav({ course, progress }) {
    return (
        <nav className="fixed top-0 left-0 right-0 z-50 h-14 bg-gray-900 flex items-center justify-between px-5">
            <a href="/courses/enrolled" className="flex items-center gap-1.5 text-white text-sm hover:text-gray-300 transition-colors">
                <svg className="h-4 w-4" fill="none" stroke="currentColor" strokeWidth={2.5} viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Dashboard
            </a>

            <div className="flex items-center gap-3">
                <span className="text-white text-xs font-medium">Progress</span>
                <div className="relative w-36 h-7 bg-gray-600 rounded-full overflow-hidden">
                    <div
                        className="h-full rounded-full transition-all duration-1000"
                        style={{ width: `${progress}%`, backgroundColor: `hsl(${progress * 1.2}, 100%, 45%)` }}
                    />
                    <span className="absolute inset-0 flex items-center justify-center text-xs font-bold text-white">
                        {progress}%
                    </span>
                </div>
            </div>
        </nav>
    );
}
