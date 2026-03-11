<?php

namespace App\Frontend\Courses\Controllers;

use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Domain\Courses\Actions\CalculateUserCourseProgressAction;
use Domain\Courses\Enums\LessonTypeEnum;
use Domain\Courses\Models\Course;
use Domain\Courses\Models\Lesson;
use Domain\Quizzes\Models\Quiz;
use Domain\Users\Enums\UserTypeEnum;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends BaseController
{
    public function __invoke(Course $course): Response
    {
        $user = $this->user;

        $course->load('user_course_progress');
        $completedIds = $course->user_course_progress->pluck('progressable_id')->toArray();

        $topics = $course->topics()->with([
            'topicables' => function ($q) use ($user) {
                $q->whereHas('topicable', function ($query) use ($user) {
                    $query->where('is_active', 1);
                    if ($user->user_type == UserTypeEnum::ACCELERATED_STUDENT()) {
                        $query->where('is_fast_track', 1);
                    }
                });
            },
            'topicables.topicable' => function (MorphTo $morphTo) {
                $morphTo->morphWith([
                    Lesson::class => ['media', 'users'],
                ]);
            },
        ])->active()->get();

        $topicsData = $topics->map(function ($topic) use ($user, $completedIds) {
            $items = [];

            foreach ($topic->topicables as $topicable) {
                $model = $topicable->topicable;

                if ($model instanceof Lesson) {
                    $lessonUsers = $model->users ?? collect();
                    if ($lessonUsers->count() > 0 && ! $lessonUsers->contains($user)) {
                        continue;
                    }

                    if ($model->type == LessonTypeEnum::Media()) {
                        $mediaItems = ($model->media ?? collect())->map(fn ($m) => [
                            'id' => $m->id,
                            'url' => $m->original_url,
                            'name' => $m->name,
                            'media_type' => get_media_type($m),
                            'completed' => in_array($m->id, $completedIds),
                            'progressable_id' => $m->id,
                            'progressable_type' => get_class($m),
                        ]);

                        if ($mediaItems->isNotEmpty()) {
                            $items[] = [
                                'kind' => 'media_lesson',
                                'id' => $model->id,
                                'name' => $model->name,
                                'description' => $model->description ?? '',
                                'topic_id' => $topic->id,
                                'media' => $mediaItems->values(),
                            ];
                        }
                    } else {
                        $items[] = [
                            'kind' => 'lesson',
                            'id' => $model->id,
                            'name' => $model->name,
                            'description' => $model->description ?? '',
                            'url' => $model->external_link,
                            'lesson_type' => $model->type,
                            'topic_id' => $topic->id,
                            'completed' => in_array($model->id, $completedIds),
                            'progressable_id' => $model->id,
                            'progressable_type' => get_class($model),
                        ];
                    }
                } elseif ($model instanceof Quiz) {
                    $items[] = [
                        'kind' => 'quiz',
                        'id' => $model->id,
                        'name' => $model->name,
                        'url' => route('students.quiz.show', ['topic' => $topicable->topic_id, 'quiz' => $model->id]),
                    ];
                }
            }

            return ['id' => $topic->id, 'name' => $topic->name, 'items' => $items];
        });

        $questions = $course->questions()->with(['user.media', 'answers'])->get()->map(fn ($q) => [
            'id' => $q->id,
            'name' => $q->name,
            'user_name' => $q->user->name,
            'user_avatar' => get_image($q->user->media),
            'created_at_human' => $q->created_at->diffForHumans(),
            'answers' => $q->answers->map(fn ($a) => ['answer' => $a->answer]),
        ]);

        $assignments = $user->assignments()
            ->where('course_id', $course->id)
            ->with([
                'media',
                'submitted_assignments' => fn ($q) => $q->where('user_id', $user->id)->with('media'),
            ])
            ->get()
            ->filter(fn ($a) => $a->hasMedia('ASSIGNMENT'))
            ->map(fn ($a) => [
                'id' => $a->id,
                'name' => $a->name,
                'due_date' => Carbon::parse($a->pivot->due_date)->format(config('constants.date_format')),
                'is_due_passed' => Carbon::parse($a->pivot->due_date)->isPast(),
                'media_url' => $a->getFirstMediaUrl('ASSIGNMENT'),
                'media_type' => get_media_type($a->getFirstMedia('ASSIGNMENT')),
                'submitted' => $a->submitted_assignments->map(fn ($s) => [
                    'id' => $s->id,
                    'status' => $s->status,
                    'score' => $s->score,
                    'comments' => $s->comments,
                    'date' => Carbon::parse($s->created_at)->format(config('constants.date_format')),
                    'media_url' => $s->getFirstMediaUrl('assignment'),
                    'media_type' => $s->hasMedia('assignment') ? get_media_type($s->getFirstMedia('assignment')) : null,
                ]),
            ])->values();

        return Inertia::render('Courses/Details', [
            'course' => [
                'id' => $course->id,
                'name' => $course->name,
                'slug' => $course->slug,
                'description' => $course->description,
                'announcement' => $course->announcement,
                'is_question' => (bool) $course->is_question,
                'questions' => $questions,
            ],
            'topics' => $topicsData,
            'assignments' => $assignments,
            'course_progress' => (new CalculateUserCourseProgressAction)->handle($course),
        ]);
    }
}
