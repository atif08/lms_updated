<?php $page = 'course-details'; ?>
@extends('frontend.layouts.mainlayout')
@section('style')
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
            /*ogg  */
        }

        /* Sidebar Accordion css */
        .card {
            border-bottom: 1px solid #d7d7d7;
            margin-bottom: 0px;
        }

        .accordion .list-group-item {
            cursor: pointer;
            border: none;
            border-radius: 0px;
            /*padding: 20px !important;*/
            font-size: 20px;
        }

        .accordion .list-group-item:hover,
        .accordion .list-group-item.active {
            background-color: #e9e9e9 !important;
            color: #f66962 !important;
        }

        .card-header[aria-expanded="true"] i {
            transform: rotate(180deg);
        }


        .profile-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .question-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .question-text {
            flex-grow: 1;
        }

        .answer {
            margin-left: 65px;
            margin-bottom: 10px;
        }


        /* content area css */
        .content-area {
            /* height:610px; */
            height: 66.5vh;
            overflow-y: auto;
            background-color: #f8f9fa;
            /* padding: 20px; */
            border: 1px solid #dee2e6;
        }

        .responsive-iframe {
            height: 600px;
        }

        /* Adjust height for smaller screens */
        @media (max-width: 992px) {
            .content-area {
                height: 50vh;
            }

            .responsive-iframe {
                height: auto;
            }
        }

        .content-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .content-description {
            font-size: 16px;
        }

        /*.sidebar-container {
                        background-color: #EFEEFE;
                    }*/

        .sidebar {
            /* height: 863px; */
            height: calc(100vh - 56px);
            overflow-y: auto;
            /*background-color: #EFEEFE;
                        border: 1px solid #dee2e6;*/

        }

        @media (max-width: 992px) {
            .sidebar {
                height: auto;
            }
        }

        .nav-link {
            cursor: pointer;
        }

        .tab-content-area {
            height: 100px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 10px;
            margin-top: 10px;
        }


        .beep {
            position: relative;
            display: inline-flex;
            align-items: center;
            margin-left: 8px;
        }

        .beep .dot {
            width: 8px;
            height: 8px;
            background-color: orange;
            border-radius: 50%;
            position: absolute;
            left: -12px;
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1.5);
                opacity: 1;
            }

            50% {
                transform: scale(1);
                opacity: 0;
                /* Fade out */
            }

            100% {
                transform: scale(1.5);
                opacity: 1;
            }
        }

        /* tab css */
        /*.nav-tabs .nav-link {
                        color: #392C7D;
                        border: none;
                    }

                    .nav-tabs .nav-link.active {
                        color: #F66962;
                        background-color: transparent;
                        border: none;
                    }

                    .nav-tabs .nav-link:hover {
                        color: #F66962;
                    } */

        /* Center alignment of the tabs */
        .nav-tabs {
            display: flex;
            justify-content: center;
        }

        /* quiz css */
        .custom-container-h {
            height: 56vh;
            display: flex;
        }

        .quiz-card {
            border: 2px dashed #ddd;
            border-radius: 8px;
            text-align: center;
            padding: 20px;
            max-width: 350px;
            margin: auto;
        }

        .quiz-card img {
            width: 100px;
            margin-bottom: 15px;
        }

        .quiz-card h5 {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .quiz-card p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .quiz-card button {
            background-color: #6C63FF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            box-shadow: 0 4px #4e4bd1;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .quiz-card button:hover {
            background-color: #4e4bd1;
            box-shadow: 0 2px #4e4bd1;
        }

        .custom-min-height {
            min-height: auto;
        }

        .custom-display {
            display: none;
        }

        .custom-flex {
            flex: 1;
        }

        .remove-padding {
            padding: 0;
        }

        .text-nowrap {
            white-space: nowrap;
            flex: 1;
        }

        .font-15 {
            font-size: 15px;
        }

        .scrollable-section {
            max-height: none;
            overflow: visible;

        }

        .text-white {
            color: white;
        }

        /* Custom progress bar style */
        .custom-progress {
            width: 200px;
            height: 40px;
            background-color: #becdd7;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }

        .custom-progress-bar {
            height: 100%;
            width: 0;
            background-color: #3ca8f4;
            background-image: linear-gradient(45deg,
            rgba(255, 255, 255, 0.15) 25%,
            transparent 25%,
            transparent 50%,
            rgba(255, 255, 255, 0.15) 50%,
            rgba(255, 255, 255, 0.15) 75%,
            transparent 75%,
            transparent);
            background-size: 1rem 1rem;
            transition: width 1s ease-in-out;
            border-radius: 20px;
        }

        /* Text inside the progress bar */
        .progress-text {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
        }


        @media (max-width: 992px) {
            .custom-progress {
                width: 100px;
                height: 20px;
            }

            .percentage {
                font-size: 12px;
            }
        }

        .table-responsive-custom {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-responsive-custom table {
            width: 100%;
            min-width: 600px;
        }



        /* .sidebar-container {
                        position: fixed;
                        right: 0;
                        top: 56px;
                    }

                    .navbar-fix{
                        top: 0;
                        right: 0;
                        left: 0;
                        position: fixed;
                  }

                  .custom-pt{
                   padding-top: 55px;
                  } */

        .loader {
            position: relative;
            height: 15px;
            width: 100px;
            overflow: hidden;
            border-radius: 50px;
            background: hsl(0, 0%, 95%);
            transition: transform 250ms ease;
        }

        .loader::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 50px;
            background: red;
            animation-name: move;
            animation-iteration-count: infinite;
            animation-duration: 2s;
            transition: transform 250ms ease;
        }

        @keyframes move {
            0% {
                transform: translateX(-100%);
            }

            50% {
                transform: translateX(100%);
                background: yellow;
            }

            100% {
                transform: translateX(-100%);
                background: limegreen;
            }
        }

        .loader:hover::before {
            transform: translateX(10px);
        }

        .modal-body-custom-height {
            height: 308px;
            overflow-y: auto;
            white-space: normal;
        }
        .sidebar-container {
            height: 100vh;
            overflow: hidden;
            background-color: #EFEEFE;
            padding: 0;
        }

        .sidebar {
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            background-color: #EFEEFE;
            border-left: 1px solid #dee2e6;
        }

        @media (max-width: 992px) {
            .sidebar-container {
                height: auto;
                overflow: visible;
            }

            .sidebar {
                height: auto;
                overflow: visible;
              }
         }

    </style>
@endsection
@section('content')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-fix">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Back to Dashboard -->
            <a class="navbar-brand" href="{{url('/courses/enrolled')}}">
                <i class="fas fa-angle-left"></i> Go back to dashboard
            </a>
            <!-- Progress Section -->
            <div class="progress-section d-flex align-items-center">
                <div>
                    <div class="text-white">Progress</div>
                </div>
                <div class="px-2">
                    <div class="custom-progress">
                        <div class="custom-progress-bar" id="progress-bar"></div>
                        <div class="progress-text">
                            <span class="percentage text-black" id="percentage-text"> {{$course_progress}}% </span>
                        </div>
                    </div>
                </div>
            </div>
    </nav>
    <div class="container-fluid bg-white">
        <div class="row">
            <!-- Main Content Area -->
            <div class="col-lg-8 col-md-12 remove-padding">
                <div id="pdf-loader" style="display: none;">
                    <div class="row align-items-center justify-content-center py-1">
                        <div class="loader"></div>
                    </div>
                    </div>

                <div id="pdf-nav" class="d-flex justify-content-center align-items-center p-2 bg-light" style="display: none;">
                    <button class="btn btn-secondary btn-sm" id="prev-page">
                        <i class="fas fa-arrow-left"></i> Prev
                    </button>
                    <span class="mx-3"> Page <span id="page-num">1</span> of <span id="page-count">0</span></span>
                    <button class="btn btn-secondary btn-sm" id="next-page">
                        Next <i class="fas fa-arrow-right"></i>
                    </button>
                </div>

                <div id="pdf-loader" style="display: none;">
                    <div class="row align-items-center justify-content-center py-1">
                        <div class="loader"></div>
                    </div>
                </div>

                <div id="content-area" class="content-area"
                     style="overflow-x:hidden!important; overflow-y:visible!important; max-width:100%!important; width:100%!important; box-sizing:border-box;">

                </div>


                <!-- Tabs Section -->
                @include('frontend.courses.partial.tabs-section')
                <!-- Container to load the tab content -->
                <div id="tabContentContainer" class="tab-content mt-1">
                    <!-- Initial content if any -->
                </div>
                <!-- Hidden content containers -->
                <!-- Overview -->
                <div class="card overview-sec custom-display" id="overviewContent">
                    <div class="card-body scrollable-section">
                        <h5 class="subs-title">Overview</h5>
                        {!! $course->description !!}
                    </div>
                </div>
                <div class="card overview-sec custom-display" id="lessonContent">
                    <div class="card-body scrollable-section">
                        <p id="lesson-content"></p>
                    </div>
                </div>
                @include('frontend.courses.partial.question-answer-section')
                <!-- announcement section -->
                @include('frontend.courses.partial.announcement-section')
                <!-- assignments section -->
                <div id="assignments" class="custom-display">
                    <div class="container scrollable-section my-1">
                        <!-- Loop through assignments here -->
                        @component('frontend.courses.partial.assignments-section',['course_assignments'=>$course_assignments])
                        @endcomponent
                        <!-- Add more assignments as needed -->
                    </div>
                </div>
            </div>
            <!-- Content Sidebar -->
            @include('frontend.courses.partial.content-sidebar')

        </div>
    </div>

    @component('components.frontend.modals.course-answer-modal')@endcomponent
    @component('components.frontend.modals.upload-assignment-modal')@endcomponent
    @component('components.frontend.modals.uploaded-assignment-view-modal')@endcomponent
    <!-- The Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog"
         aria-labelledby="askQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header pb-2">
                    <h5 class="subs-title mb-0" id="askQuestionModalLabel">Upload
                        Assignment</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                                        <span aria-hidden="true"><i class="fa fa-times"
                                                                    aria-hidden="true"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="questionDescription">
                                <h5 class="subs-title mb-0 mt-2">Additional
                                    Notes</h5>
                            </label>
                            <textarea class="form-control" id="questionDescription"
                                      rows="5"></textarea>
                            <label for="questionDescription">
                                <h5 class="subs-title mb-0 mt-2">Upload
                                    Assignment</h5>
                            </label>
                            <input type="file" class="form-control custom-min-height"
                                   id="fileUpload" accept=".pdf">
                        </div>
                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary float-end">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentsModalLabel">Assignment Comments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Comments content will be dynamically inserted here -->
                    <p id="commentsText">Loading comments...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Bootstrap JS and dependencies -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script>
        // Function to Handle Content Loading
        function loadContent(url, type, description) {
            const contentArea = document.getElementById("content-area");
            contentArea.innerHTML = ''; // Clear existing content
            $('#lesson-content').html('');
            $('#lesson-content').html(description);

            if (type === "pdf") {
                loadPdfDocument(url);
                // renderPDF(url);
            } else if (type === "powerpoint") {
                contentArea.innerHTML +=
                    `<iframe src="https://docs.google.com/viewer?url=${url}&embedded=true" width="100%" height="600px" frameborder="0"></iframe>`;
            } else if (type === "video") {
                contentArea.innerHTML +=
                    `<video controls width="100%" height="99%"><source src="${url}" type="video/webm">Your browser does not support the video tag.</video>`;
            } else if (type === 'EXTERNAL_LINK') {
                contentArea.innerHTML +=
                    `<iframe src="${url}" width="100%" height="600" allow="autoplay"></iframe>`;
            } else if (type === "doc" || type === "ppt" || type === "pptx") {
                contentArea.innerHTML +=
                    `<iframe src="https://docs.google.com/gview?embedded=true&url=${url}&embedded=true" width="100%" height="600px" frameborder="0"></iframe>`;
            } else if (type === "image") {
                contentArea.innerHTML += `<img src="${url}" width="100%" height="600px" frameborder="0" alt=""/>`;
            } else if (type === "IFRAME") {
                contentArea.innerHTML += url;
            } else if (type === "quiz") {
                contentArea.innerHTML += `<div class="container mt-5 custom-container-h">
                    <div class="quiz-card">
                        <img src="{{\Illuminate\Support\Facades\URL::asset('assets/images/quiz.png')}}" alt="Quiz Image" class="img-fluid">
                        <h5>QUIZ: This is a quiz test</h5>
                        <p>Please go to quiz page for more information</p>
                        <button type="button" class="btn btn-primary" onclick="window.open('${url}', '_blank')">Start Quiz</button>
                    </div>
                </div>`;
            } else {
                alert(filename);
                contentArea.innerHTML += `<div class="content-description">Content for ${filename}.</div>`;
            }
        }

        $(document).on('change', '.mark-lesson-complete', function (e) {
            const data = {
                "progressable_id": $(this).data('progressable-id'),
                "progressable_type": $(this).data('progressable-type'),
                "topic_id": $(this).data('topic-id'),
                "lesson_id": $(this).data('lesson-id'),
                "is_checked": $(this).prop('checked')
            };

            makePostCall('{{route('courses.post.mark-complete', $course->id)}}', data, function (response) {
                var topicId = $(this).data('topic-id');
                $('#percentage-text').html(response.course_progress + '%');
                $('.custom-modal-assignment').html(response);
                initCourseProgress();
            });
        });
    </script>
    <script>
        function scrollToTopAndLoadContent(url, mediaType) {
            window.scrollTo({top: 0, behavior: 'smooth'});
            loadContent(url, mediaType);
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Get the modal and comments button elements
            var commentsModal = document.getElementById('commentsModal');
            var commentsText = document.getElementById('commentsText');

            // Add event listener for when the modal is shown
            commentsModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget; // Button that triggered the modal
                var comments = button.getAttribute('data-comments'); // Extract comments from data attribute
                // Insert comments into the modal body
                commentsText.textContent = comments || 'No comments available';
            });
        });


        $(document).on('click', '.btn-answer', function (e) {
            $('#courseAnswerModal form').attr('action', $(this).data('url'));
        });

        // Add event listeners to tab links
        document.querySelectorAll(".nav-link").forEach((link) => {
            link.addEventListener("click", function () {
                const tabId = this.getAttribute("href").substring(1); // Get the tab id from href
                loadTabContent(`${tabId} content goes here.`, tabId);
            });
        });


        // Function to load the content for the selected tab
        function loadTabContent(contentId) {
            const tabContentContainer = document.getElementById('tabContentContainer');
            const content = document.getElementById(contentId).innerHTML;

            // Clear existing content
            tabContentContainer.innerHTML = '';

            // Insert the selected content
            tabContentContainer.innerHTML = content;

            // Reattach the "Read More" event listener after the content is loaded
            reattachReadMoreListener();
        }


        // Function to reattach the "Read More" event listener
        function reattachReadMoreListener() {
            const textElement = document.getElementById("overviewText");
            const moreTextElement = document.getElementById("moreText");
            const toggleButton = document.getElementById("toggleButton");

            if (!textElement || !toggleButton || !moreTextElement) {
                return;
            }

            const fullText = moreTextElement.innerHTML;
            const truncatedText = fullText.split(/(?<!\w\.\w.)(?<![A-Z][a-z]\.)(?<=\.|\?)\s/).slice(0, 2).join(' ') +
                '...'; // Adjust this for proper truncation

            let isExpanded = false;

            function toggleText() {
                if (isExpanded) {
                    textElement.innerHTML = truncatedText;
                    moreTextElement.style.display = 'none';
                    toggleButton.innerText = "Read More";
                } else {
                    textElement.innerHTML = fullText;
                    moreTextElement.style.display = 'block';
                    toggleButton.innerText = "Read Less";
                }
                isExpanded = !isExpanded;
            }

            // Initialize with truncated text
            textElement.innerHTML = truncatedText;

            // Attach the event listener to the button
            toggleButton.addEventListener('click', toggleText);
        }

        // Load the "Overview" tab content by default when the page loads
        document.addEventListener('DOMContentLoaded', function () {
            loadTabContent('overviewContent');
        });

        $(document).ready(function () {
            $(document).on('click', '.btn-answer', function (e) {
                $('#courseAnswerModal form').attr('action', $(this).data('url'));
            });
            // Trigger the modal when the "View Assignment" button is clicked
            $('.uploadedAssignmentViewBtn').on('click', function () {
                // Get the assignment details from the button's data attributes
                const topicName = $(this).data('topic-name');
                const assignmentDescription = $(this).data('siignment-description');
                const assignmentMedia = $(this).data('siignment-image');

                // Populate the modal with the assignment details
                $('#topicName').text(topicName);
                $('#assignmentDescription').text(assignmentDescription);
                $('#assignmentMedia').attr('href', assignmentMedia);
            });
            $(document).on('click', '.upload-assignment-btn', function (e) {
                e.preventDefault();
                makeGetCall($(this).data('url'), {}, function (response) {
                    var topicId = $(this).data('topic-id');
                    $('.custom-modal-assignment').html(response);
                })
            });

        });

        $(document).on('keydown', function (e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
                e.preventDefault(); // Disable print functionality
            }
        });

        $(document).on('contextmenu', 'img, video', function () {
            return false; // Disable right-click on these elements
        });

        window.addEventListener('load', function () {
            initCourseProgress()
        });

        function initCourseProgress() {
            // Get the percentage from the span element
            const percentageText = document.getElementById('percentage-text');
            const percentage = parseInt(percentageText.textContent); // Parse the text content as an integer
            const progressBar = document.getElementById('progress-bar');
            // Animate the progress bar with a delay
            setTimeout(() => {
                progressBar.style.width = `${percentage}%`;
            }, 500); // Starts the animation with a slight delay
            // Optionally, you can adjust the color based on the percentage value
            progressBar.style.backgroundColor = `hsl(${percentage * 1.2}, 100%, 50%)`;
        }
    </script>
    <script>
        /**
         * Use to load PDF.
         */
        let pdfDoc = null;
        let pageNum = 1;
        let pageIsRendering = false;
        let pageNumIsPending = null;

        // Get references to your elements
        const pdfLoader = document.getElementById('pdf-loader');
        const pdfContainer = document.getElementById('content-area');
        const pdfNav = document.getElementById('pdf-nav');
        const pageNumSpan = document.getElementById('page-num');
        const pageCountSpan = document.getElementById('page-count');
        const prevPageBtn = document.getElementById('prev-page');
        const nextPageBtn = document.getElementById('next-page');

        /**
         * This function loads the PDF document and renders the FIRST page.
         * It REPLACES your old renderPDF function.
         */
        function loadPdfDocument(url) {
            pdfDoc = null;
            pageNum = 1;

            const pdfjsLib = window['pdfjs-dist/build/pdf'];
            if (!pdfjsLib) {
                console.error('PDF.js library is not loaded.');
                return;
            }

            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

            // Show the loader
            pdfLoader.style.display = 'block';

            const loadingTask = pdfjsLib.getDocument(url);
            loadingTask.promise.then(function (pdf) {
                pdfDoc = pdf;
                pageCountSpan.textContent = pdfDoc.numPages;

                // Render the first page
                renderPage(pageNum);

                // Show navigation
                pdfNav.style.display = 'flex';

            }).catch(function (error) {
                console.error("Error loading PDF: ", error);
                alert("Failed to load the PDF file. Please try again later.");
                pdfLoader.style.display = 'none';
            });
        }

        /**
         * Renders a specific page number into the canvas.
         */
        function renderPage(num) {
            if (pageIsRendering) {
                pageNumIsPending = num;
                return;
            }

            pageIsRendering = true;
            pageNumSpan.textContent = num; // Update page number display

            // Get the page
            pdfDoc.getPage(num).then(function (page) {

                // Calculate the scale to fit the container width
                const viewport = page.getViewport({ scale: 1 });
                const containerWidth = pdfContainer.clientWidth;
                const dynamicScale = containerWidth / viewport.width;
                const scaledViewport = page.getViewport({ scale: dynamicScale });

                // Create canvas
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = scaledViewport.height;
                canvas.width = scaledViewport.width;
                canvas.classList.add('pdfCanvas');

                // Clear previous page and add new canvas
                pdfContainer.innerHTML = '';
                pdfContainer.appendChild(canvas);

                // Render the PDF page
                const renderContext = {
                    canvasContext: context,
                    viewport: scaledViewport
                };

                page.render(renderContext).promise.then(function () {
                    pageIsRendering = false;
                    pdfLoader.style.display = 'none'; // Hide loader after render

                    // If another page was requested while rendering, render it now
                    if (pageNumIsPending !== null) {
                        renderPage(pageNumIsPending);
                        pageNumIsPending = null;
                    }
                });
            });
        }

        /**
         * Queues a page render to prevent conflicts.
         */
        function queueRenderPage(num) {
            if (pageIsRendering) {
                pageNumIsPending = num;
            } else {
                renderPage(num);
            }
        }

        // --- Navigation button event handlers ---
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }

        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }

        // Add event listeners to buttons
        prevPageBtn.addEventListener('click', onPrevPage);
        nextPageBtn.addEventListener('click', onNextPage);
    </script>
@endpush
