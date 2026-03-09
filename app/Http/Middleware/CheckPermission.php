<?php

// app/Http/Middleware/CheckPermission.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        // Define permissions for different routes
        $permissions = [

            'categories.index' => 'view_categories',
            'courses.index' => 'view_courses',
            'topics.index' => 'view_topics',
            'lessons.index' => 'view_lessons',
            'quizzes.index' => 'view_quizzes',
            'questions.index' => 'view_questions',
            'question_types.index' => 'view_question_types',
        ];

        // Extract the route name
        $routeName = $request->route()->getName();

        // Check if the route has a defined permission
        if (array_key_exists($routeName, $permissions)) {
            $permission = $permissions[$routeName];

            // Check if the user has the required permission
            if ($request->user()->can($permission)) {
                return $next($request);
            }

            return abort(403, 'Unauthorized action.');
        }

        // Allow access if no permission is defined for the route
        return $next($request);
    }
}
