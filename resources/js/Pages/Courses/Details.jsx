import { useState } from 'react';
import axios from 'axios';
import TopNav from './Partials/TopNav';
import ContentViewer from './Partials/ContentViewer';
import BottomSection from './Partials/BottomSection';
import CourseSidebar from './Partials/CourseSidebar';
import InstallmentPaymentModal from './Partials/InstallmentPaymentModal';

export default function Details({ course, topics, assignments, course_progress, enrollment }) {
    const [activeContent, setActiveContent] = useState(null);
    const [activeTab, setActiveTab]         = useState('overview');
    const [progress, setProgress]           = useState(course_progress);
    const [openTopics, setOpenTopics]       = useState(new Set());
    const [payingInstallment, setPayingInstallment] = useState(null);
    const [installmentProgress, setInstallmentProgress] = useState(enrollment.installment_progress);

    const [progressMap, setProgressMap] = useState(() => {
        const map = {};
        topics.forEach(topic =>
            topic.items.forEach(item => {
                if (item.kind === 'media_lesson') {
                    item.media.forEach(m => {
                        map[`${m.progressable_type}__${m.progressable_id}`] = m.completed;
                    });
                } else if (item.kind === 'lesson') {
                    map[`${item.progressable_type}__${item.progressable_id}`] = item.completed;
                }
            })
        );
        return map;
    });

    const loadContent = (url, mediaType, description = '', mediaId = null) => {
        setActiveContent({ url, mediaType, description, mediaId });
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    const toggleProgress = async (progressableId, progressableType, topicId, lessonId, isChecked) => {
        const key = `${progressableType}__${progressableId}`;
        setProgressMap(prev => ({ ...prev, [key]: isChecked }));

        try {
            const res = await axios.post(
                `/courses/${course.id}/mark-complete`,
                { progressable_id: progressableId, progressable_type: progressableType, topic_id: topicId, lesson_id: lessonId, is_checked: isChecked },
                { headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content } }
            );
            if (res.data?.course_progress !== undefined) {
                setProgress(res.data.course_progress);
            }
        } catch {
            setProgressMap(prev => ({ ...prev, [key]: !isChecked }));
        }
    };

    const toggleTopic = (id) =>
        setOpenTopics(prev => {
            const next = new Set(prev);
            next.has(id) ? next.delete(id) : next.add(id);
            return next;
        });

    const handlePaymentSuccess = (newProgress) => {
        setInstallmentProgress(newProgress);
        setPayingInstallment(null);
    };

    const enrollmentWithProgress = { ...enrollment, installment_progress: installmentProgress };

    return (
        <div className="h-screen flex flex-col overflow-hidden bg-white">
            <TopNav course={course} progress={progress} />

            <div className="flex flex-1 overflow-hidden" style={{ paddingTop: 56 }}>
                <div className="flex-1 flex flex-col overflow-y-auto min-w-0">
                    <ContentViewer activeContent={activeContent} />
                    <BottomSection
                        course={course}
                        assignments={assignments}
                        activeTab={activeTab}
                        setActiveTab={setActiveTab}
                        activeContent={activeContent}
                        loadContent={loadContent}
                    />
                </div>

                <CourseSidebar
                    topics={topics}
                    progressMap={progressMap}
                    openTopics={openTopics}
                    toggleTopic={toggleTopic}
                    loadContent={loadContent}
                    toggleProgress={toggleProgress}
                    enrollment={enrollmentWithProgress}
                    onPayInstallment={setPayingInstallment}
                />
            </div>

            {payingInstallment && (
                <InstallmentPaymentModal
                    course={course}
                    installmentNo={payingInstallment}
                    installmentProgress={payingInstallment}
                    userId={enrollment.user_id}
                    onSuccess={handlePaymentSuccess}
                    onClose={() => setPayingInstallment(null)}
                />
            )}
        </div>
    );
}
