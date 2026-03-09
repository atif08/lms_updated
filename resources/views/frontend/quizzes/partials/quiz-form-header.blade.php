<div class="quiz-header" style="display:none;">
    <div class="card-quiz border px-5 py-3 rounded">
        <img src="https://i.postimg.cc/7L4QrLtm/student-grades.png" class="img-fluid custom-img-h" alt="Icon">
        <h4>{{ $quiz->quiz_questions->count()/2 }}/{{ $quiz->quiz_questions->count() }}</h4>
        <p>Qualifying Score<br/><span class="text-danger custom-font-weight">(50% necessary to pass)</span></p>
    </div>
    <div class="card-quiz border px-5 py-3 rounded">
        <img src="https://i.postimg.cc/pdBcWtgx/student-test.png" class="img-fluid custom-img-h" alt="Icon">
        <h4>0/{{ $quiz->quiz_questions->count() }}</h4>
        <p>Attempts</p>
    </div>
    <div class="card-quiz border px-5 py-3 rounded">
        <img src="https://i.postimg.cc/SxCtP9dn/question.png" class="img-fluid custom-img-h" alt="Icon">
        <h4>{{ $quiz->quiz_questions->count() }}</h4>
        <p>Questions</p>
    </div>
    <div class="card-quiz border px-5 py-3 rounded">
        <img src="https://i.postimg.cc/ncsWvgQY/clock.png" class="img-fluid custom-img-h" alt="Icon">
        <h4 class="time-remaining" id="timer">10:00</h4>
        <p>Remaining Time</p>
    </div>
</div>
<div class="alert alert-primary my-4 mx-5 p-0 row justify-content-center align-items-center text-center"
     style="display:none;">
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs"
            type="module"></script>

    <dotlottie-player src="https://lottie.host/b4e49116-3d48-4948-a8f8-1477be3cc28a/mm0h8cFYsU.json"
                      background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay>
    </dotlottie-player>
    Please note that you have to complete all the questions and submit before the remaining time
    ends.
</div>
