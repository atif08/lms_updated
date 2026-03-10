import MainLayout from '@/Layouts/MainLayout';
import Breadcrumb from '@/Components/Common/Breadcrumb';
import StudentSidebar from '@/Components/Common/StudentSidebar';
import { router } from '@inertiajs/react';

export default function Enrolled({ courses }) {
    return (
        <MainLayout>
            <Breadcrumb title="Enrolled Courses" items={['Home', 'Enrolled Courses']} />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div className="flex flex-col lg:flex-row gap-8">
                    <StudentSidebar />

                    <div className="flex-1">
                        {courses.data.length === 0 ? (
                            <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center">
                                <p className="text-gray-400 text-sm">No enrolled courses found.</p>
                            </div>
                        ) : (
                            <div className="space-y-4">
                                {courses.data.map(course => (
                                    <CourseCard key={course.id} course={course} />
                                ))}
                            </div>
                        )}

                        {/* Pagination */}
                        {courses.last_page > 1 && (
                            <div className="mt-6 flex justify-center gap-2">
                                {courses.links.map((link, i) => (
                                    <button
                                        key={i}
                                        disabled={!link.url || link.active}
                                        onClick={() => link.url && router.visit(link.url)}
                                        className={`px-3 py-1.5 rounded-lg text-sm border transition-colors ${
                                            link.active
                                                ? 'bg-indigo-600 text-white border-indigo-600'
                                                : link.url
                                                ? 'border-gray-200 text-gray-600 hover:bg-gray-50'
                                                : 'border-gray-100 text-gray-300 cursor-not-allowed'
                                        }`}
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                    />
                                ))}
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </MainLayout>
    );
}

function CourseCard({ course }) {
    return (
        <a
            href={`/courses/${course.slug}`}
            className="flex items-center gap-5 bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow"
        >
            <img
                src={course.image}
                alt={course.name}
                className="h-20 w-28 rounded-xl object-cover shrink-0 bg-gray-100"
                onError={e => { e.target.src = '/frontend/img/placeholder.jpg'; }}
            />
            <div className="flex-1 min-w-0">
                <h3 className="text-base font-semibold text-gray-800 truncate">{course.name}</h3>
                <p className="mt-1 text-sm text-indigo-500 font-medium">View Course →</p>
            </div>
        </a>
    );
}
