<?php

namespace App\Frontend\Courses\Controllers;

use App\Http\Controllers\BaseController;
use App\Notifications\SendAnswerNotification;
use App\Services\FlashMessage;
use Domain\Courses\Models\CourseQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CourseAnswerController extends BaseController
{
    public function __invoke(Request $request, CourseQuestion $question): RedirectResponse
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        $question->answers()->create($request->all());

        $question->user->notify(new SendAnswerNotification($question, $request->get('answer')));

        FlashMessage::success('Answer submitted successfully !!');

        return redirect()->back();
    }
}
