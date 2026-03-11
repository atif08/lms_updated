import { useState } from 'react';
import { router } from '@inertiajs/react';
import axios from 'axios';
import Modal from './Modal';
import Spinner from './Spinner';

export default function AssignmentsSection({ assignments, loadContent }) {
    const [openItems, setOpenItems]     = useState(new Set());
    const [uploadModal, setUploadModal] = useState(null);
    const [extendModal, setExtendModal] = useState(null);
    const [commentModal, setCommentModal] = useState(null);

    const toggleItem = (id) =>
        setOpenItems(prev => {
            const next = new Set(prev);
            next.has(id) ? next.delete(id) : next.add(id);
            return next;
        });

    if (assignments.length === 0) {
        return <p className="text-gray-400 text-sm">No assignments for this course.</p>;
    }

    return (
        <>
            <div className="space-y-3">
                {assignments.map(a => (
                    <div key={a.id} className="border border-gray-200 rounded-xl overflow-hidden">
                        <button
                            onClick={() => toggleItem(a.id)}
                            className="w-full flex items-start gap-3 px-4 py-3 text-left bg-gray-50 hover:bg-gray-100 text-sm"
                        >
                            <div className="flex-1 flex flex-wrap gap-x-3 gap-y-1 items-center">
                                <button
                                    type="button"
                                    onClick={e => { e.stopPropagation(); loadContent(a.media_url, a.media_type); }}
                                    className="text-indigo-600 font-semibold underline hover:text-indigo-800"
                                >
                                    View Task
                                </button>
                                <span className="text-gray-700">: {a.name}</span>
                                <span className="text-gray-400">|</span>
                                <span><strong>Due:</strong> {a.due_date}</span>
                                <a
                                    href={a.media_url}
                                    download
                                    onClick={e => e.stopPropagation()}
                                    className="text-indigo-600 underline font-medium hover:text-indigo-800"
                                >
                                    Download
                                </a>
                            </div>
                            <span className={`mt-1 shrink-0 text-gray-500 text-xs transition-transform duration-200 ${openItems.has(a.id) ? 'rotate-180' : ''}`}>▼</span>
                        </button>

                        {openItems.has(a.id) && (
                            <div className="p-4 space-y-4">
                                <div className="overflow-x-auto rounded-lg border border-gray-200">
                                    <table className="w-full text-xs min-w-[500px]">
                                        <thead>
                                            <tr className="bg-gray-50 text-gray-500 uppercase tracking-wider">
                                                <th className="px-3 py-2 text-left">Submitted File</th>
                                                <th className="px-3 py-2 text-left">Comments</th>
                                                <th className="px-3 py-2 text-left">Status</th>
                                                <th className="px-3 py-2 text-left">Date</th>
                                                <th className="px-3 py-2 text-left">Score</th>
                                            </tr>
                                        </thead>
                                        <tbody className="divide-y divide-gray-100">
                                            {a.submitted.length === 0 ? (
                                                <tr>
                                                    <td colSpan={5} className="px-3 py-5 text-center text-gray-400">
                                                        No submissions yet
                                                    </td>
                                                </tr>
                                            ) : (
                                                a.submitted.map(s => (
                                                    <tr key={s.id} className="hover:bg-gray-50">
                                                        <td className="px-3 py-2">
                                                            {s.media_url ? (
                                                                <button
                                                                    onClick={() => loadContent(s.media_url, s.media_type)}
                                                                    className="text-indigo-600 underline font-medium"
                                                                >
                                                                    View Task
                                                                </button>
                                                            ) : '—'}
                                                        </td>
                                                        <td className="px-3 py-2 max-w-[160px]">
                                                            {s.comments && s.comments.length > 20 ? (
                                                                <>
                                                                    {s.comments.substring(0, 20)}…{' '}
                                                                    <button
                                                                        onClick={() => setCommentModal(s.comments)}
                                                                        className="text-indigo-600 underline"
                                                                    >
                                                                        Read More
                                                                    </button>
                                                                </>
                                                            ) : (s.comments || '—')}
                                                        </td>
                                                        <td className="px-3 py-2">{s.status}</td>
                                                        <td className="px-3 py-2">{s.date}</td>
                                                        <td className="px-3 py-2">{s.score}/100</td>
                                                    </tr>
                                                ))
                                            )}
                                        </tbody>
                                    </table>
                                </div>

                                {a.is_due_passed ? (
                                    <button
                                        onClick={() => setExtendModal(a.id)}
                                        className="rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-600 transition-colors"
                                    >
                                        Request for Extend Date
                                    </button>
                                ) : (
                                    <button
                                        onClick={() => setUploadModal({ id: a.id, name: a.name })}
                                        className="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition-colors"
                                    >
                                        Submit Assignment
                                    </button>
                                )}
                            </div>
                        )}
                    </div>
                ))}
            </div>

            {uploadModal && (
                <AssignmentUploadModal
                    assignment={uploadModal}
                    onClose={() => setUploadModal(null)}
                />
            )}
            {extendModal && (
                <ExtendRequestModal
                    assignmentId={extendModal}
                    onClose={() => setExtendModal(null)}
                />
            )}
            {commentModal && (
                <Modal title="Comments" onClose={() => setCommentModal(null)}>
                    <p className="text-sm text-gray-700 whitespace-pre-wrap">{commentModal}</p>
                </Modal>
            )}
        </>
    );
}

function AssignmentUploadModal({ assignment, onClose }) {
    const [description, setDescription] = useState('');
    const [file, setFile]               = useState(null);
    const [uploading, setUploading]     = useState(false);
    const [error, setError]             = useState('');

    const handleSubmit = (e) => {
        e.preventDefault();
        if (!file) { setError('Please select a file.'); return; }
        setUploading(true);

        const form = new FormData();
        form.append('media', file);
        form.append('assignment_id', assignment.id);
        form.append('description', description);

        router.post('/assignments', form, {
            forceFormData: true,
            onSuccess: () => onClose(),
            onError: (errors) => setError(Object.values(errors).join(', ')),
            onFinish: () => setUploading(false),
        });
    };

    return (
        <Modal title={`Submit: ${assignment.name}`} onClose={onClose}>
            <form onSubmit={handleSubmit} className="space-y-4">
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                    <textarea
                        rows={4}
                        value={description}
                        onChange={e => setDescription(e.target.value)}
                        className="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none"
                        placeholder="Any notes for your instructor…"
                    />
                </div>
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">Upload Assignment</label>
                    <input
                        type="file"
                        onChange={e => { setFile(e.target.files[0]); setError(''); }}
                        className="w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                    />
                </div>
                {error && <p className="text-xs text-red-500">{error}</p>}
                <div className="flex justify-end">
                    <button
                        type="submit"
                        disabled={uploading}
                        className="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 disabled:opacity-60 transition-opacity"
                    >
                        {uploading && <Spinner />}
                        {uploading ? 'Uploading…' : 'Submit'}
                    </button>
                </div>
            </form>
        </Modal>
    );
}

function ExtendRequestModal({ assignmentId, onClose }) {
    const [submitting, setSubmitting] = useState(false);
    const [error, setError]           = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        setSubmitting(true);
        setError('');

        try {
            await axios.post(
                '/assignments/date-extend/store',
                { assignment_id: assignmentId },
                { headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content } }
            );
            onClose();
            alert('Extension request submitted successfully.');
        } catch (err) {
            const msg = err.response?.data?.message || 'An error occurred.';
            setError(msg);
            if (err.response?.status === 403) window.location.reload();
        } finally {
            setSubmitting(false);
        }
    };

    return (
        <Modal title="Request for Extension" onClose={onClose}>
            <form onSubmit={handleSubmit} className="space-y-4">
                <p className="text-sm text-gray-600">
                    Are you sure you want to send a request for an extension?
                </p>
                {error && <p className="text-xs text-red-500">{error}</p>}
                <div className="flex justify-end gap-3">
                    <button type="button" onClick={onClose}
                        className="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                        Cancel
                    </button>
                    <button type="submit" disabled={submitting}
                        className="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 disabled:opacity-60">
                        {submitting && <Spinner />}
                        {submitting ? 'Submitting…' : 'Request Extension'}
                    </button>
                </div>
            </form>
        </Modal>
    );
}
