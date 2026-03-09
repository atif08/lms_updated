<div class="row justify-content-center">
    <div class="col-12">
        <ul class="nav nav-tabs" id="
        customTabs">
            <li class>

                <h5 class="nav-link subs-title active" onclick="loadTabContent('overviewContent')"
                    data-bs-toggle="tab">Overview</h5>
            </li>
            <li class>
                <h5 class="nav-link subs-title" onclick="loadTabContent('lessonContent')" data-bs-toggle="tab">
                    Description
                </h5>
            </li>
            @if($course->is_question)
                <li class="nav-item">

                    <h5 class="nav-link subs-title" onclick="loadTabContent('qaContent')"
                        data-bs-toggle="tab">
                        Q&A</h5>

                </li>
            @endif

            <li class="nav-item">
                <h5 class="nav-link subs-title" onclick="loadTabContent('announcementContent')"
                    data-bs-toggle="tab"> <span class="beep parent">
                                    Announcements <span class="dot"></span>
                                </span></h5>


            </li>
            <li class="nav-item">
                <h5 class="nav-link subs-title" onclick="loadTabContent('assignments')"
                    data-bs-toggle="tab">Assignments</h5>
            </li>
        </ul>
    </div>
</div>
