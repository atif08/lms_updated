<div class="form-group col-lg-12 mb-2">
    <label class="control-label">Video (Upload directly to Vimeo)</label>

    @php
        /** @var \Domain\Courses\Models\Lesson|null $lesson */
        $lesson = $options['item'] ?? null;
        $course = $options['course'] ?? null;
        $topic = $options['topic'] ?? null;
    @endphp

    @if(!$lesson || !$lesson->id || !$course || !$topic)
        <div class="alert alert-info">
            Please save the lesson first, then upload the video to Vimeo with progress.
        </div>
    @else
        @php
            // Get existing video media for this lesson using the 'videos' collection
            // We want all of them, not just the first one.
            $videos = $lesson->getMedia('videos')->sortBy('order_column');
        @endphp

        <div class="row mb-4" id="sortableVideos-{{ $lesson->id }}">
            @foreach($videos as $videoMedia)
                <div class="col-md-6 mb-3" data-media-id="{{ $videoMedia->id }}">
                    <div class="card h-100 p-3 bg-light" id="existingVideoCard-{{ $lesson->id }}-{{ $videoMedia->id }}">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="drag-handle me-2" style="cursor: grab; padding-top: 2px;" title="Drag to reorder">
                                <i class="fas fa-grip-vertical text-muted"></i>
                            </div>
                            <div class="flex-grow-1 me-2">
                                <div class="d-flex align-items-center mb-1">
                                    <h6 class="mb-0 me-2" id="videoNameLabel-{{ $videoMedia->id }}"><i class="fas fa-video"></i> {{ $videoMedia->name }}</h6>
                                    <button type="button" class="btn btn-link btn-sm p-0 edit-name-btn" data-media-id="{{ $videoMedia->id }}" title="Edit Name">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                                <div class="d-none edit-name-container" id="editNameContainer-{{ $videoMedia->id }}">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control video-name-input" value="{{ $videoMedia->name }}" id="videoNameInput-{{ $videoMedia->id }}">
                                        <button class="btn btn-primary save-name-btn" type="button" 
                                                data-media-id="{{ $videoMedia->id }}" 
                                                data-update-url="{{ route('courses.topics.lessons.vimeo.update-title', ['course' => $course->id, 'topic' => $topic->id, 'lesson' => $lesson->id]) }}">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button class="btn btn-secondary cancel-name-btn" type="button" data-media-id="{{ $videoMedia->id }}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-1">
                                <button
                                    type="button"
                                    class="btn btn-sm btn-warning replace-video-btn"
                                    data-lesson-id="{{ $lesson->id }}"
                                    data-media-id="{{ $videoMedia->id }}"
                                    data-init-url="{{ route('courses.topics.lessons.vimeo.init', ['course' => $course->id, 'topic' => $topic->id, 'lesson' => $lesson->id]) }}"
                                    data-replace-url="{{ route('courses.topics.lessons.vimeo.replace', ['course' => $course->id, 'topic' => $topic->id, 'lesson' => $lesson->id]) }}"
                                    data-csrf="{{ csrf_token() }}"
                                    title="Replace video"
                                    onclick="window.vimeoToggleReplace && window.vimeoToggleReplace('{{ $videoMedia->id }}')">
                                    <i class="fas fa-exchange-alt"></i>
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-info sync-video-btn"
                                    data-lesson-id="{{ $lesson->id }}"
                                    data-media-id="{{ $videoMedia->id }}"
                                    data-sync-url="{{ route('courses.topics.lessons.vimeo.update', ['course' => $course->id, 'topic' => $topic->id, 'lesson' => $lesson->id]) }}"
                                    data-csrf="{{ csrf_token() }}"
                                    title="Sync player settings (Hide buttons, etc)">
                                    <i class="fas fa-sync"></i>
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-danger delete-video-btn"
                                    data-lesson-id="{{ $lesson->id }}"
                                    data-media-id="{{ $videoMedia->id }}"
                                    data-course-id="{{ $course->id }}"
                                    data-topic-id="{{ $topic->id }}"
                                    data-delete-url="{{ route('courses.topics.lessons.vimeo.destroy', ['course' => $course->id, 'topic' => $topic->id, 'lesson' => $lesson->id]) }}"
                                    data-csrf="{{ csrf_token() }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-2">
                            <small class="text-muted d-block"><strong>Filename:</strong> {{ $videoMedia->file_name }}</small>
                            <small class="text-muted d-block"><strong>Vimeo ID:</strong> {{ $videoMedia->getCustomProperty('vimeo_id') }}</small>
                        </div>

                        {{-- Embed preview --}}
                        @if($videoMedia->getCustomProperty('vimeo_embed_url'))
                            @php
                                $embedUrl = $videoMedia->getCustomProperty('vimeo_embed_url');
                                // Parse existing URL components
                                $urlComponents = parse_url($embedUrl);
                                $queryParams = [];
                                if (isset($urlComponents['query'])) {
                                    parse_str($urlComponents['query'], $queryParams);
                                }

                                // Merge with forced privacy params
                                // Note: We use string keys and values to ensure they override correctly
                                $forcedParams = [
                                    'title' => '0',
                                    'byline' => '0',
                                    'portrait' => '0',
                                    'badge' => '0',
                                    'share' => '0',
                                    'like' => '0',
                                    'watchlater' => '0',
                                    'autopause' => '0',
                                    'loop' => '1',
                                    'dnt' => '1',
                                    'background' => '1', // Adding background=1 as a forceful fallback to hide controls if needed, though loop=1 should suffice usually. No wait, background hides EVERYTHING. Let's stick to hiding buttons.
                                    // Actually, let's remove background=1, it makes it unplayable/uncontrollable.
                                ];
                                // But specifically for valid parameters:
                                // To hide "Share", "Like", "Watch Later": share=0, like=0, watchlater=0.
                                // These require the video owner to have a Plus/PRO account for some settings to take effect embed-side.
                                // However, passing them is the best we can do.
                                
                                $finalParams = array_merge($queryParams, $forcedParams);
                                
                                // Rebuild URL
                                $embedUrl = $urlComponents['scheme'] . '://' . $urlComponents['host'] . $urlComponents['path'] . '?' . http_build_query($finalParams);
                            @endphp
                            <div class="mt-auto">
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src="{{ $embedUrl }}"
                                        width="100%"
                                        height="200"
                                        frameborder="0"
                                        allow="autoplay; fullscreen; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning mt-auto mb-0 p-2">
                                <small>No embed URL available.</small>
                            </div>
                        @endif

                        <div id="deleteStatus-{{ $lesson->id }}-{{ $videoMedia->id }}" class="mt-2"></div>

                        {{-- Replace upload UI (hidden by default) --}}
                        <div class="replace-upload-container d-none mt-2" id="replaceContainer-{{ $videoMedia->id }}">
                            <hr class="my-2">
                            <div class="mb-2">
                                <label class="small text-muted mb-1">Select replacement video</label>
                                <input type="file" accept="video/*" class="form-control form-control-sm replace-file-input" id="replaceFileInput-{{ $videoMedia->id }}">
                            </div>
                            <div class="progress mb-1" style="height: 16px;">
                                <div id="replaceProgressBar-{{ $videoMedia->id }}" class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
                            </div>
                            <div class="small text-muted" id="replaceProgressText-{{ $videoMedia->id }}"></div>
                            <div class="d-flex gap-1 mt-1">
                                <button type="button" class="btn btn-sm btn-primary replace-start-btn" id="replaceStartBtn-{{ $videoMedia->id }}" data-media-id="{{ $videoMedia->id }}" onclick="window.vimeoStartReplace && window.vimeoStartReplace('{{ $videoMedia->id }}')">Upload</button>
                                <button type="button" class="btn btn-sm btn-secondary replace-cancel-btn" data-media-id="{{ $videoMedia->id }}" onclick="window.vimeoCancelReplace && window.vimeoCancelReplace('{{ $videoMedia->id }}')">Cancel</button>
                            </div>
                            <div id="replaceStatus-{{ $videoMedia->id }}" class="mt-1"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Upload form (Always visible now) --}}
        <div class="card p-3" id="vimeoCard-{{ $lesson->id }}"
             data-lesson-id="{{ $lesson->id }}"
             data-course-id="{{ $course->id }}"
             data-topic-id="{{ $topic->id }}"
             data-init-url="{{ route('courses.topics.lessons.vimeo.init', ['course'=>$course->id,'topic'=>$topic->id,'lesson'=>$lesson->id]) }}"
             data-complete-url="{{ route('courses.topics.lessons.vimeo.complete', ['course'=>$course->id,'topic'=>$topic->id,'lesson'=>$lesson->id]) }}"
             data-csrf="{{ csrf_token() }}">
            
            <h6 class="mb-3"><i class="fas fa-cloud-upload-alt"></i> Upload New Video</h6>

            <div class="mb-3">
                <label class="small text-muted mb-1">Video Display Name (Optional)</label>
                <input type="text" id="vimeoDisplayName-{{ $lesson->id }}" class="form-control" placeholder="Enter video name..." />
            </div>

            <div class="mb-2">
                <label class="small text-muted mb-1">Select Video File</label>
                <input type="file" id="vimeoFileInput-{{ $lesson->id }}" accept="video/*" class="form-control" />
            </div>
            <div class="mt-3">
                <div class="progress" style="height: 20px;">
                    <div id="vimeoProgressBar-{{ $lesson->id }}" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
                <div class="small text-muted mt-1" id="vimeoProgressText-{{ $lesson->id }}"></div>
            </div>
            <div class="mt-2 d-flex gap-2">
                <button type="button" class="btn btn-primary" id="vimeoStartBtn-{{ $lesson->id }}">Start Upload</button>
                <button type="button" class="btn btn-secondary" id="vimeoPauseBtn-{{ $lesson->id }}" disabled>Pause</button>
                <button type="button" class="btn btn-secondary" id="vimeoResumeBtn-{{ $lesson->id }}" disabled>Resume</button>
                <button type="button" class="btn btn-danger" id="vimeoCancelBtn-{{ $lesson->id }}" disabled>Cancel</button>
            </div>
            <div class="mt-2" id="vimeoUploadStatus-{{ $lesson->id }}"></div>
        </div>

        {{-- DELETE VIDEO SCRIPT (Delegated) --}}
        <script>
            (function(){
                // Use delegation for delete buttons
                document.addEventListener('click', async function(e) {
                    const btn = e.target.closest('.delete-video-btn');
                    if (!btn) return;

                    // Ensure we only handle clicks for this specific lesson's scope if needed, 
                    // or just rely on the data attributes.
                    // To be safe against multiple forms, let's allow it globally but verify data.
                    if (!btn.dataset.deleteUrl) return;

                    e.preventDefault();

                    if (!confirm('Are you sure you want to delete this video? This will remove it from Vimeo and cannot be undone.')) {
                        return;
                    }

                    const lessonId = btn.dataset.lessonId;
                    const mediaId = btn.dataset.mediaId;
                    const deleteUrl = btn.dataset.deleteUrl;
                    const csrf = btn.dataset.csrf;
                    // Specific status div for this card
                    const statusDiv = document.getElementById('deleteStatus-' + lessonId + '-' + mediaId);

                    // Disable button and show loading
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                    try {
                        const response = await fetch(deleteUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrf,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ media_id: mediaId })
                        });

                        const data = await response.json();

                        if (response.ok) {
                            if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-success py-1 my-1">Deleted!</div>';
                            
                            // Remove the card from DOM
                            const card = document.getElementById('existingVideoCard-' + lessonId + '-' + mediaId);
                            if (card) {
                                // Fade out or just remove
                                card.closest('.col-md-6').remove();
                            }
                        } else {
                            if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-danger py-1 my-1">' + (data.message || 'Failed') + '</div>';
                            btn.disabled = false;
                            btn.innerHTML = '<i class="fas fa-trash"></i>';
                        }
                    } catch (error) {
                        if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-danger py-1 my-1">Error: ' + error.message + '</div>';
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fas fa-trash"></i>';
                    }
                });

                // Use delegation for sync buttons
                document.addEventListener('click', async function(e) {
                    const btn = e.target.closest('.sync-video-btn');
                    if (!btn) return;

                    if (!btn.dataset.syncUrl) return;

                    e.preventDefault();

                    const lessonId = btn.dataset.lessonId;
                    const mediaId = btn.dataset.mediaId;
                    const syncUrl = btn.dataset.syncUrl;
                    const csrf = btn.dataset.csrf;
                    const originalText = btn.innerHTML;
                    const statusDiv = document.getElementById('syncStatus-' + lessonId + '-' + mediaId);

                    btn.disabled = true;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Syncing...';
                    if (statusDiv) statusDiv.innerHTML = ''; // Clear previous status

                    try {
                        const response = await fetch(syncUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrf,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ media_id: mediaId })
                        });

                        const data = await response.json();

                        if (response.ok) {
                            if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-success py-1 my-1">Settings synced!</div>';
                        } else {
                            if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-danger py-1 my-1">' + (data.message || 'Failed to sync settings') + '</div>';
                        }
                    } catch (error) {
                        if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-danger py-1 my-1">Error: ' + error.message + '</div>';
                    } finally {
                        btn.disabled = false;
                        btn.innerHTML = originalText;
                    }
                });

                // Handle Inline Naming Update
                document.addEventListener('click', function(e) {
                    const editBtn = e.target.closest('.edit-name-btn');
                    if (editBtn) {
                        const mediaId = editBtn.dataset.mediaId;
                        document.getElementById('videoNameLabel-' + mediaId).classList.add('d-none');
                        editBtn.classList.add('d-none');
                        document.getElementById('editNameContainer-' + mediaId).classList.remove('d-none');
                        return;
                    }

                    const cancelBtn = e.target.closest('.cancel-name-btn');
                    if (cancelBtn) {
                        const mediaId = cancelBtn.dataset.mediaId;
                        document.getElementById('videoNameLabel-' + mediaId).classList.remove('d-none');
                        document.querySelector(`.edit-name-btn[data-media-id="${mediaId}"]`).classList.remove('d-none');
                        document.getElementById('editNameContainer-' + mediaId).classList.add('d-none');
                        return;
                    }

                    const saveBtn = e.target.closest('.save-name-btn');
                    if (saveBtn) {
                        const mediaId = saveBtn.dataset.mediaId;
                        const updateUrl = saveBtn.dataset.updateUrl;
                        const newName = document.getElementById('videoNameInput-' + mediaId).value;
                        const csrf = '{{ csrf_token() }}';

                        if (!newName) {
                            alert('Please enter a name');
                            return;
                        }

                        saveBtn.disabled = true;
                        saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                        fetch(updateUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrf,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ media_id: mediaId, name: newName })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message === 'Video name updated successfully') {
                                document.getElementById('videoNameLabel-' + mediaId).innerHTML = '<i class="fas fa-video"></i> ' + data.name;
                                // Reset UI
                                document.getElementById('videoNameLabel-' + mediaId).classList.remove('d-none');
                                document.querySelector(`.edit-name-btn[data-media-id="${mediaId}"]`).classList.remove('d-none');
                                document.getElementById('editNameContainer-' + mediaId).classList.add('d-none');
                            } else {
                                alert('Error: ' + (data.message || 'Unknown error'));
                                saveBtn.disabled = false;
                                saveBtn.innerHTML = '<i class="fas fa-check"></i>';
                            }
                        })
                        .catch(err => {
                            alert('Error: ' + err.message);
                            saveBtn.disabled = false;
                            saveBtn.innerHTML = '<i class="fas fa-check"></i>';
                        });
                    }
                });
            })();
        </script>

        {{-- UPLOAD SCRIPT (Existing script, kept mostly same but ensuring ID uniqueness matches) --}}
        <script src="https://cdn.jsdelivr.net/npm/tus-js-client@latest/dist/tus.min.js"></script>
        <script>
            (function(){
                const boot = function(){
                    const root = document.getElementById('vimeoCard-{{ $lesson->id }}');
                    if(!root){ return; }
                    const lessonId = root.dataset.lessonId;
                    const courseId = root.dataset.courseId;
                    const topicId = root.dataset.topicId;
                    const initUrl = root.dataset.initUrl;
                    const completeUrl = root.dataset.completeUrl;
                    const csrf = root.dataset.csrf;
 
                    const displayNameInput = document.getElementById('vimeoDisplayName-' + lessonId);
                    const fileInput = document.getElementById('vimeoFileInput-' + lessonId);
                    const pb = document.getElementById('vimeoProgressBar-' + lessonId);
                    const pt = document.getElementById('vimeoProgressText-' + lessonId);
                    const status = document.getElementById('vimeoUploadStatus-' + lessonId);
                    const btnStart = document.getElementById('vimeoStartBtn-' + lessonId);
                    const btnPause = document.getElementById('vimeoPauseBtn-' + lessonId);
                    const btnResume = document.getElementById('vimeoResumeBtn-' + lessonId);
                    const btnCancel = document.getElementById('vimeoCancelBtn-' + lessonId);

                    // If elements aren't in DOM yet, do nothing.
                    if(!fileInput || !btnStart){ return; }
                    // Prevent binding multiple times on navigation/renders (e.g., Livewire, PJAX)
                    if(btnStart.dataset.bound === '1'){ return; }
                    btnStart.dataset.bound = '1';

                    let currentUpload = null;
                    let initData = null;

                    function setProgress(pct){
                        pb.style.width = pct + '%';
                        pb.setAttribute('aria-valuenow', pct);
                        pb.textContent = pct + '%';
                    }

                    function setStatus(msg, type='info'){
                        status.innerHTML = '<div class="alert alert-' + (type==='error'?'danger':type) + ' py-2 my-2">' + msg + '</div>';
                    }

                    function toggleButtons(state){
                        if(state==='idle'){
                            btnStart.disabled = false; btnPause.disabled = true; btnResume.disabled = true; btnCancel.disabled = true;
                        } else if(state==='uploading'){
                            btnStart.disabled = true; btnPause.disabled = false; btnResume.disabled = true; btnCancel.disabled = false;
                        } else if(state==='paused'){
                            btnStart.disabled = true; btnPause.disabled = true; btnResume.disabled = false; btnCancel.disabled = false;
                        } else if(state==='done'){
                            btnStart.disabled = true; btnPause.disabled = true; btnResume.disabled = true; btnCancel.disabled = true;
                        }
                    }

                    async function initVimeo(file){
                        const form = new URLSearchParams();
                        // Pull name from display name input or file name
                        const customName = displayNameInput ? displayNameInput.value : '';
                        const nameField = document.querySelector('input[name="name"]');
                        const descField = document.querySelector('textarea[name="description"], input[name="description"]');
                        
                        form.append('name', customName || (nameField ? nameField.value : (file && file.name) || 'Lesson Video'));
                        if(descField && descField.value){ form.append('description', descField.value); }
                        form.append('size', String(file.size));

                        const res = await fetch(initUrl, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }, body: form });
                        if(!res.ok){ throw new Error('Failed to init Vimeo upload'); }
                        return res.json();
                    }

                    async function completeVimeo(uri, videoName){
                        const form = new URLSearchParams();
                        form.append('uri', uri);
                        if (videoName) { form.append('name', videoName); }
                        const res = await fetch(completeUrl, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }, body: form });
                        if(!res.ok){ throw new Error('Failed to complete Vimeo upload'); }
                        return res.json();
                    }

                    btnStart.addEventListener('click', async function(){
                        const file = fileInput.files && fileInput.files[0];
                        if(!file){ setStatus('Please choose a video file first.', 'warning'); return; }
                        try {
                            setStatus('Initializing upload with Vimeo...');
                            toggleButtons('uploading');
                            setProgress(0);
                            initData = await initVimeo(file);
                            if(!initData || !initData.upload_link){ throw new Error('Missing upload link from Vimeo.'); }

                            currentUpload = new (window.tus || tus).Upload(file, {
                                uploadUrl: initData.upload_link,
                                chunkSize: 5 * 1024 * 1024,
                                retryDelays: [0, 1000, 3000, 5000],
                                metadata: { filename: file.name, filetype: file.type || 'video/mp4' },
                                onError: function(error){ setStatus('Upload error: ' + error, 'error'); toggleButtons('idle'); },
                                onProgress: function(bytesSent, bytesTotal){
                                    const pct = Math.floor(bytesSent / bytesTotal * 100);
                                    setProgress(pct);
                                    pt.textContent = `${(bytesSent/1024/1024).toFixed(1)}MB / ${(bytesTotal/1024/1024).toFixed(1)}MB`;
                                },
                                onSuccess: async function(){
                                    try {
                                        setStatus('Finalizing upload...');
                                        const customName = displayNameInput ? displayNameInput.value : '';
                                        const videoNameForComplete = customName || (document.querySelector('input[name="name"]') ? document.querySelector('input[name="name"]').value : '');
                                        
                                        const done = await completeVimeo(initData.uri, videoNameForComplete);
                                        setStatus('Upload complete! Refreshing page...', 'success');
                                        toggleButtons('done');
                                        // Reload page to show the video
                                        setTimeout(() => window.location.reload(), 1500);
                                    } catch(e){
                                        setStatus('Finalize error: ' + e.message, 'error');
                                        toggleButtons('idle');
                                    }
                                }
                            });

                            currentUpload.start();
                        } catch (e) {
                            setStatus(e.message || 'Failed to start upload', 'error');
                            toggleButtons('idle');
                        }
                    });

                    btnPause.addEventListener('click', function(){
                        if(currentUpload){ currentUpload.abort(); toggleButtons('paused'); setStatus('Upload paused.'); }
                    });
                    btnResume.addEventListener('click', function(){
                        if(currentUpload){ currentUpload.start(); toggleButtons('uploading'); setStatus('Resuming upload...'); }
                    });
                    btnCancel.addEventListener('click', function(){
                        if(currentUpload){ currentUpload.abort(); currentUpload = null; setProgress(0); pt.textContent=''; toggleButtons('idle'); setStatus('Upload canceled.', 'warning'); }
                    });

                    toggleButtons('idle');
                };

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', boot);
                } else {
                    boot();
                }
                // Handle Livewire v3 and other client-side navigations
                document.addEventListener('livewire:navigated', boot);
            })();
        </script>

        {{-- REPLACE VIDEO FUNCTIONS (global so they work in AJAX-loaded modals) --}}
        <script>
            window.vimeoToggleReplace = function(mediaId) {
                var container = document.getElementById('replaceContainer-' + mediaId);
                if (!container) return;
                container.classList.toggle('d-none');
                // Reset UI when hiding
                if (container.classList.contains('d-none')) {
                    var fileInput = document.getElementById('replaceFileInput-' + mediaId);
                    if (fileInput) fileInput.value = '';
                    var pb = document.getElementById('replaceProgressBar-' + mediaId);
                    if (pb) { pb.style.width = '0%'; pb.textContent = '0%'; }
                    var pt = document.getElementById('replaceProgressText-' + mediaId);
                    if (pt) pt.textContent = '';
                    var st = document.getElementById('replaceStatus-' + mediaId);
                    if (st) st.innerHTML = '';
                }
            };

            window.vimeoCancelReplace = function(mediaId) {
                var container = document.getElementById('replaceContainer-' + mediaId);
                if (container) {
                    container.classList.add('d-none');
                    var fileInput = document.getElementById('replaceFileInput-' + mediaId);
                    if (fileInput) fileInput.value = '';
                    var pb = document.getElementById('replaceProgressBar-' + mediaId);
                    if (pb) { pb.style.width = '0%'; pb.textContent = '0%'; }
                    var pt = document.getElementById('replaceProgressText-' + mediaId);
                    if (pt) pt.textContent = '';
                    var st = document.getElementById('replaceStatus-' + mediaId);
                    if (st) st.innerHTML = '';
                }
                if (window._replaceUploads && window._replaceUploads[mediaId]) {
                    window._replaceUploads[mediaId].abort();
                    delete window._replaceUploads[mediaId];
                }
            };

            window.vimeoStartReplace = async function(mediaId) {
                var replaceBtn = document.querySelector('.replace-video-btn[data-media-id="' + mediaId + '"]');
                if (!replaceBtn) return;

                var initUrl = replaceBtn.dataset.initUrl;
                var replaceUrl = replaceBtn.dataset.replaceUrl;
                var csrf = replaceBtn.dataset.csrf;

                var fileInput = document.getElementById('replaceFileInput-' + mediaId);
                var file = fileInput && fileInput.files && fileInput.files[0];
                var pb = document.getElementById('replaceProgressBar-' + mediaId);
                var pt = document.getElementById('replaceProgressText-' + mediaId);
                var statusDiv = document.getElementById('replaceStatus-' + mediaId);
                var startBtn = document.getElementById('replaceStartBtn-' + mediaId);

                if (!file) {
                    if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-warning py-1 my-1">Please select a video file first.</div>';
                    return;
                }

                startBtn.disabled = true;
                startBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
                if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-info py-1 my-1">Initializing upload...</div>';

                try {
                    var nameLabel = document.getElementById('videoNameLabel-' + mediaId);
                    var videoName = nameLabel ? nameLabel.textContent.trim() : 'Replacement Video';

                    var form = new URLSearchParams();
                    form.append('name', videoName);
                    form.append('size', String(file.size));

                    var initRes = await fetch(initUrl, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                        body: form,
                    });

                    if (!initRes.ok) throw new Error('Failed to initialize upload with Vimeo');
                    var initData = await initRes.json();
                    if (!initData || !initData.upload_link) throw new Error('Missing upload link from Vimeo.');

                    if (!window._replaceUploads) window._replaceUploads = {};

                    window._replaceUploads[mediaId] = new (window.tus || tus).Upload(file, {
                        uploadUrl: initData.upload_link,
                        chunkSize: 5 * 1024 * 1024,
                        retryDelays: [0, 1000, 3000, 5000],
                        metadata: { filename: file.name, filetype: file.type || 'video/mp4' },
                        onError: function(error) {
                            if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-danger py-1 my-1">Upload error: ' + error + '</div>';
                            startBtn.disabled = false;
                            startBtn.innerHTML = 'Upload';
                        },
                        onProgress: function(bytesSent, bytesTotal) {
                            var pct = Math.floor(bytesSent / bytesTotal * 100);
                            if (pb) { pb.style.width = pct + '%'; pb.textContent = pct + '%'; }
                            if (pt) pt.textContent = (bytesSent/1024/1024).toFixed(1) + 'MB / ' + (bytesTotal/1024/1024).toFixed(1) + 'MB';
                        },
                        onSuccess: async function() {
                            try {
                                if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-info py-1 my-1">Finalizing replacement...</div>';

                                var completeForm = new URLSearchParams();
                                completeForm.append('media_id', mediaId);
                                completeForm.append('uri', initData.uri);
                                completeForm.append('name', videoName);

                                var completeRes = await fetch(replaceUrl, {
                                    method: 'POST',
                                    headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                                    body: completeForm,
                                });

                                if (!completeRes.ok) throw new Error('Failed to finalize replacement');

                                if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-success py-1 my-1">Video replaced! Refreshing...</div>';
                                setTimeout(function() { window.location.reload(); }, 1500);
                            } catch (err) {
                                if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-danger py-1 my-1">Finalize error: ' + err.message + '</div>';
                                startBtn.disabled = false;
                                startBtn.innerHTML = 'Upload';
                            }
                        },
                    });

                    if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-info py-1 my-1">Uploading to Vimeo...</div>';
                    window._replaceUploads[mediaId].start();

                } catch (err) {
                    if (statusDiv) statusDiv.innerHTML = '<div class="alert alert-danger py-1 my-1">' + (err.message || 'Failed to start upload') + '</div>';
                    startBtn.disabled = false;
                    startBtn.innerHTML = 'Upload';
                }
            };
        </script>

        {{-- SORTABLE VIDEO REORDER --}}
        <script>
            (function(){
                var container = document.getElementById('sortableVideos-{{ $lesson->id }}');
                if (!container || typeof Sortable === 'undefined') return;

                new Sortable(container, {
                    handle: '.drag-handle',
                    animation: 150,
                    onEnd: function () {
                        var newOrder = Array.from(container.children).map(function (el) {
                            return el.getAttribute('data-media-id');
                        });

                        $.ajax({
                            url: '{{ route('courses.topics.lessons.vimeo.reorder', ['course' => $course->id, 'topic' => $topic->id, 'lesson' => $lesson->id]) }}',
                            method: 'POST',
                            data: { order: newOrder },
                            success: function () {
                                console.log('Video order saved');
                            },
                            error: function () {
                                alert('Failed to save video order');
                            }
                        });
                    }
                });
            })();
        </script>
    @endif
</div>
