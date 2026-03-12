<?php

use App\Admin\Assignments\Controllers\ApproveExtendAssignmentRequestController;
use App\Admin\Assignments\Controllers\AssignmentController;
use App\Admin\Assignments\Controllers\GenerateTeacherAssignmentReportController;
use App\Admin\Assignments\Controllers\RejectExtendAssignmentRequestController;
use App\Admin\Assignments\Controllers\SubmittedAssignmentsController;
use App\Admin\Assignments\Controllers\UserSubmittedAssignmentsController;
use App\Admin\Attendance\Controllers\AttendanceController as AdminAttendanceController;
use App\Admin\Batches\Controllers\BatchesController;
use App\Admin\Calendar\Controllers\CalendarEventController;
use App\Admin\Categories\Controllers\CategoryController;
use App\Admin\Courses\Controllers\CourseProgressReportController;
use App\Admin\Courses\Controllers\CoursesController;
use App\Admin\Courses\Controllers\LessonController;
use App\Admin\Courses\Controllers\TopicController;
use App\Admin\FileLibrary\Controllers\FileLibraryController;
use App\Admin\Quizzes\Controllers\QuestionController;
use App\Admin\Quizzes\Controllers\QuizAttemptController;
use App\Admin\Quizzes\Controllers\QuizController;
use App\Admin\Quizzes\Controllers\QuizSectionController;
use App\Admin\Reports\Controllers\ExportRequestController;
use App\Admin\Settings\Controllers\PermissionsController;
use App\Admin\Settings\Controllers\RolesController;
use App\Admin\SupportTicket\Controllers\SupportTicketController;
use App\Admin\Users\Controllers\UserFullReportController;
use App\Admin\Users\Controllers\UsersController;
use App\Frontend\Assignments\Controllers\AssignmentController as FEAssignmentController;
use App\Frontend\Assignments\Controllers\StoreStudentAssignmentController;
use App\Frontend\Courses\Controllers\CourseAnswerController;
use App\Frontend\Courses\Controllers\CourseController;
use App\Frontend\Courses\Controllers\CourseProgressController;
use App\Frontend\Courses\Controllers\CourseQuestionController;
use App\Frontend\Courses\Controllers\PdfAnnotationController;
use App\Frontend\Students\Controllers\AttendanceController;
use App\Frontend\Students\Controllers\EnrolledCoursesIndexController;
use App\Frontend\Students\Controllers\EnrollmentController;
use App\Frontend\Students\Controllers\StudentCalendarController;
use App\Frontend\Students\Controllers\StudentProfileController;
use App\Frontend\Students\Controllers\StudentQuizController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\General\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportsController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::mediaLibrary();

Route::prefix('admin')->group(function () {

    Route::get('/', [UsersController::class, 'handleRedirect'])->name('admin.home');
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('admin.get.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.post.login');

    Route::middleware(['auth', 'check_user_type'])->group(function () {
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('{user}/assignment-report', GenerateTeacherAssignmentReportController::class)->name('get.assignment-report');
            Route::get('/', [UsersController::class, 'getIndex'])->name('get.index');
            Route::get('/{user}/profile', [UsersController::class, 'getUserProfile'])->name('get.partial-profile');
            Route::get('/{user}/full-report', UserFullReportController::class)->name('get.full-report');
            Route::get('/login', [UsersController::class, 'getLogin'])->name('get.login');
            Route::get('/details', [UsersController::class, 'getDetails'])->name('get.details');
            Route::post('/details', [UsersController::class, 'postDetails'])->name('post.details');
            Route::post('/password', [UsersController::class, 'postPassword'])->name('post.password');
            Route::post('/status', [UsersController::class, 'postStatus'])->name('post.status');
            Route::delete('/{user}', [UsersController::class, 'destroy'])->name('post.delete');
        });

        /** Course routes start */
        Route::prefix('courses')->name('courses.')->group(function () {
            Route::prefix('/{course}/topics')->name('topics.')->group(function () {
                Route::get('/', [TopicController::class, 'index'])->name('get');
                Route::get('/create', [TopicController::class, 'create'])->name('create');
                Route::get('/{topic}/edit', [TopicController::class, 'edit'])->name('edit');
                Route::post('/store', [TopicController::class, 'store'])->name('store');
                Route::put('{topic}/update', [TopicController::class, 'update'])->name('update');
                Route::get('{topic}/destroy', [TopicController::class, 'destroy'])->name('destroy');
                Route::post('/save-order', [TopicController::class, 'saveOrder'])->name('order');
                Route::prefix('/{topic}/lessons')->name('lessons.')->group(function () {
                    Route::get('/create', [LessonController::class, 'create'])->name('create');
                    Route::get('/{lesson}/edit', [LessonController::class, 'edit'])->name('edit');
                    Route::post('/store', [LessonController::class, 'store'])->name('store');
                    Route::put('{lesson}/update', [LessonController::class, 'update'])->name('update');
                    Route::get('{lesson}/destroy', [LessonController::class, 'destroy'])->name('destroy');
                });
            });
            Route::get('progress', [CourseProgressReportController::class, 'index'])->name('get.progress');
            Route::get('progress/details', [CourseProgressReportController::class, 'detail']);
            Route::get('/{course}/topics/{topic}/lessons', [LessonController::class, 'index'])->name('topics.lessons');
            Route::post('/{course}/status', [CoursesController::class, 'changeStatus'])->name('change.status');
        });

        Route::prefix('topics')->name('topics.')->group(function () {
            Route::post('/save-order', [LessonController::class, 'saveOrder'])->name('order');
            Route::post('/{topic}/quizzes/{quiz}/save', [TopicController::class, 'saveTopicQuiz'])->name('quizzes.save');
        });
        Route::delete('/topicables/{topicable}/detach', [TopicController::class, 'detachTopicable'])->name('topics.topicable.detach');
        Route::get('medias', [LessonController::class, 'getMedia'])->name('media.get');
        /** Course routes end */

        /** Quiz routes start */
        Route::get('quizzes-ajax', [QuizController::class, 'getAjaxList'])->name('quizzes.getAjaxList');
        Route::prefix('quizzes')->name('quizzes.')->group(function () {

            Route::prefix('/{quiz}/questions')->group(function () {
                Route::get('create', [QuestionController::class, 'create'])->name('questions.create');
                Route::get('/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
                Route::post('/store', [QuestionController::class, 'store'])->name('questions.store');
                Route::put('{question}/update', [QuestionController::class, 'update'])->name('questions.update');
                Route::get('{question}/destroy', [QuestionController::class, 'destroy'])->name('questions.delete');
                Route::delete('{question}/destroy', [QuestionController::class, 'destroy'])->name('questions.destroy');
            });
        });
        Route::get('quizzes-list', [QuizController::class, 'getQuiz'])->name('quizzes.get');
        Route::resource('quiz-attempts', QuizAttemptController::class);
        Route::resource('quizzes', QuizController::class);
        Route::resource('quiz-sections', QuizSectionController::class);
        /** Quiz Routes end */
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
        Route::get('roles/{role}/assign-permissions', [RolesController::class, 'assignPermissions'])->name('roles.assignPermissions');
        Route::put('roles/{role}/update-permissions', [RolesController::class, 'updatePermissions'])->name('roles.updatePermissions');

        Route::resource('file-libraries', FileLibraryController::class);
        Route::prefix('file-libraries')->name('file-libraries.')->group(function () {
            Route::get('/download/{id}', [FileLibraryController::class, 'download'])->name('download');
            Route::post('/share', [FileLibraryController::class, 'share'])->name('share');
        });

        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'getIndex'])->name('get.index');
            Route::post('/', [ProfileController::class, 'postIndex'])->name('post.index');
            Route::post('/password', [ProfileController::class, 'postPassword'])->name('post.password');
        });

        Route::prefix('general')->name('general.')->group(function () {
            Route::get('/menus', [GeneralController::class, 'getMenus'])->name('get.menus');
            Route::get('/marketplaces', [GeneralController::class, 'getMarketplaces'])->name('get.marketplaces');
            Route::post('/marketplaces', [GeneralController::class, 'postMarketplaces'])->name('post.marketplaces');
        });

        /** Attendance Routes Start */
        Route::prefix('attendances')->name('attendances.')->group(function () {
            Route::get('/', [AdminAttendanceController::class, 'index'])->name('index');
        });

        Route::resource('attendances', AdminAttendanceController::class);

        /** Exports Routes Start */
        Route::prefix('exports')->group(function () {
            Route::get('/', [ExportRequestController::class, 'getIndex']);
            Route::get('/download', [ExportRequestController::class, 'getDownload']);
            Route::post('/delete', [ExportRequestController::class, 'postDelete']);
            Route::get('/export-request', [ExportRequestController::class, 'getExportRequest'])->name('exports.get.export-request');
        });

        Route::prefix('assignments')->name('assignments.')->group(function () {
            Route::get('/{assignment}/users/{user}/submissions', UserSubmittedAssignmentsController::class)->name('submissions');
            Route::post('/approve-extend-request', ApproveExtendAssignmentRequestController::class)->name('approve-extend-request');
            Route::resource('/', AssignmentController::class);

        });

        Route::get('submitted-assignments/student/{student}/topic/{topic}', [SubmittedAssignmentsController::class, 'detail'])->name('submitted-assignments.detail');
        Route::resource('submitted-assignments', SubmittedAssignmentsController::class);

        Route::post('/assignment-extend-request/{assignment_extend_request}/reject', RejectExtendAssignmentRequestController::class)->name('extend-date.reject');

        Route::resource('calendars', CalendarEventController::class);
        Route::get('batches/{batch}/users', [BatchesController::class, 'getUsers'])->name('batches.get.users');
        Route::resource('batches', BatchesController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('courses', CoursesController::class);
        Route::resource('topics', TopicController::class);
        Route::resource('lessons', LessonController::class);
        Route::resource('questions', QuestionController::class);
        Route::resource('/support-tickets', SupportTicketController::class);

    });

});

Route::middleware('auth.frontend')->group(function () {
    //    Route::get('courses', CoursesIndexController::class)->name('courses.get');
    Route::post('courses/{course}/question', CourseQuestionController::class)->name('courses.post.question');
    Route::post('courses/{course}/mark-complete', [CourseProgressController::class, 'markComplete'])->name('courses.post.mark-complete');
    Route::get('courses/enrolled', EnrolledCoursesIndexController::class)->name('courses.get.enrolled');
    Route::get('courses/{course:slug}', CourseController::class)->name('courses.get.details');
    Route::get('courses/{course}/users/{user}/enroll', EnrollmentController::class)->name('courses.user.enroll');
    Route::post('questions/{question}/answer', CourseAnswerController::class)->name('question.post.answer');
    Route::get('pdf-annotations/{mediaId}', [PdfAnnotationController::class, 'show'])->name('pdf-annotations.show');
    Route::post('pdf-annotations/{mediaId}', [PdfAnnotationController::class, 'upsert'])->name('pdf-annotations.upsert');

    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.get');
    Route::post('attendance/hours', [AttendanceController::class, 'saveHours'])->name('attendance.post.hours');

    Route::get('students/dashboard', [StudentProfileController::class, 'dashboard'])->name('students.get.dashboard');
    Route::get('students/profile', [StudentProfileController::class, 'index'])->name('students.get.profile');
    Route::get('students/settings', [StudentProfileController::class, 'getSettings'])->name('students.get.settings');
    Route::post('students/settings', [StudentProfileController::class, 'postSettings'])->name('students.post.settings');
    Route::post('students/avatar', [StudentProfileController::class, 'uploadAvatar'])->name('students.post.avatar');
    Route::get('students/change-password', [StudentProfileController::class, 'getChangePassword'])->name('students.get.change-password');
    Route::post('students/change-password', [StudentProfileController::class, 'postChangePassword'])->name('students.post.change-password');
    Route::get('students/calendar', [StudentCalendarController::class, 'index'])->name('students.get.calendar');
    Route::get('students/quiz-attempts', [StudentQuizController::class, 'getQuizAttempts'])->name('students.get.quiz-attempts');
    Route::get('students/topics/{topic}/quizzes/{quiz}/takequiz', [StudentQuizController::class, 'show'])->name('students.quiz.show');
    Route::post('students/quizzes/submit', [StudentQuizController::class, 'submit'])->name('students.quiz.submit');
    Route::get('students/attempt/quizzes', [StudentQuizController::class, 'index'])->name('students.quiz.index');
    Route::get('students/quiz-attempts/{quiz_attempt}/result', [StudentQuizController::class, 'quizResult'])->name('students.quiz-attempts.result');
    //    assignments start
    Route::prefix('assignments')->name('assignment.')->group(function () {
        Route::get('/form', [FEAssignmentController::class, 'getAssignment'])->name('get.form');
        Route::get('/{assignment}', [FEAssignmentController::class, 'show'])->name('show');
        Route::post('/', StoreStudentAssignmentController::class)->name('store');
        Route::delete('/{assignment}', [FEAssignmentController::class, 'destroy'])->name('destroy');
        Route::post('/date-extend/store', [FEAssignmentController::class, 'storeDateExtend'])
            ->name('date-extend.store');
    });

    //    assignments end
});

Route::get('/home', [HomeController::class, 'getIndex']);
Route::get('/', [HomeController::class, 'getIndex'])->name('home');

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'getIndex'])->name('get.index');
});

Route::prefix('imports')->name('imports.')->group(function () {
    Route::get('/', [ImportsController::class, 'getIndex'])->name('get.index');
    Route::post('/download', [ImportsController::class, 'getDownload'])->name('get.download');
    Route::get('/requests', [ImportsController::class, 'getRequests'])->name('get.requests');
    Route::post('/requests', [ImportsController::class, 'postRequests'])->name('post.requests');
    Route::post('/mappings', [ImportsController::class, 'postMappings'])->name('post.mappings');
});
