export default function Breadcrumb({ title, items = [] }) {
    return (
        <div className="bg-white border-b border-gray-100">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <h1 className="text-xl font-bold text-gray-800">{title}</h1>
                <nav className="flex items-center gap-2 text-sm text-gray-500">
                    {items.map((item, i) => (
                        <span key={i} className="flex items-center gap-2">
                            {i > 0 && <span className="text-gray-300">/</span>}
                            <span className={i === items.length - 1 ? 'text-indigo-600 font-medium' : ''}>
                                {item}
                            </span>
                        </span>
                    ))}
                </nav>
            </div>
        </div>
    );
}
