
<div class="modal fade" id="courseAnswerModal">
    <div class="modal-dialog modal-dialog-centered modal-xl" style="text-align: center;    width: 100%;">
        <div class="modal-content">
            <form method="post" action="">
                @csrf
                <div class="card-body">

                <div class="input-block">
                                    <textarea rows="4" class="form-control"
                                              placeholder="Write your answer" name="answer"></textarea>
                </div>
                <div class="submit-section">
                    <button class="btn submit-btn course-answer-btn" type="submit">Submit</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>


