<?php

namespace App\Admin\Quizzes\Controllers;

use App\Admin\DataTables\Quizzes\QuizAttemptDataTable;
use App\Http\Controllers\BaseController;
use App\Models\Batch;
use App\Services\FlashMessage;
use Domain\Courses\Models\Course;
use Domain\Quizzes\Models\QuizAttempt;
use Domain\Users\Enums\UserTypeEnum;
use Domain\Users\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuizAttemptController extends BaseController
{
    public function index(Request $request): View|JsonResponse
    {

        $data_table = new QuizAttemptDataTable(user: $this->user, current_account: $this->current_account, request: $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

//        $data_table->setFilterData([
//            'batches' => Batch::all(),
//            'users' => User::query()->whereIn('user_type', [UserTypeEnum::STANDARD_STUDENT(), UserTypeEnum::ACCELERATED_STUDENT()])->get(),
//            'courses' => Course::query()->active()->get(),
//        ]);

        return $this->renderView('admin.quizzes.attempts.index', compact('data_table'));

    }

    public function show(QuizAttempt $quiz_attempt): View
    {
        $quiz_attempt_answers = collect($quiz_attempt->answers);

        return $this->renderView('admin.quizzes.attempts.details', compact('quiz_attempt', 'quiz_attempt_answers'));
    }

    public function update(Request $request, $quizAttemptId): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'points' => 'required|numeric|min:0',
            'question_id' => 'required|exists:questions,id',
            'question_option_id' => 'required|exists:question_options,id',
        ]);

        // Find the quiz attempt record
        $quiz_attempt = QuizAttempt::query()->findOrFail($quizAttemptId);

        // Increment the points and correct answer count
        $quiz_attempt->increment('earned_points', $request->get('points'));
        $quiz_attempt->increment('correct_answers');

        // Update the quiz attempt answer
        $quiz_attempt->answers()
            ->where('quiz_question_id', $request->get('question_id'))
            ->update([
                'question_option_id' => $request->get('question_option_id'),
                'points' => $request->get('points'),
            ]);

        FlashMessage::success('Points added successfully');

        return redirect()->back();
    }
}
