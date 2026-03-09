<?php

return [

    'settings' => [
        'url' => '',
        'icon' => '',
        'title' => 'Administration',
        'permissions' => [\Domain\Users\Enums\PermissionsEnum::ROLES()->value], // Add permissions here
        'children' => [
            'user' => [
                'icon' => 'fas fa-users',
                'title' => 'Users',
                'url' => 'admin/users',
                'permissions' => [\Domain\Users\Enums\PermissionsEnum::USERS()->value], // Add permissions here
            ],
            'not-enrolled-users' => [
                'icon' => 'fas fa-user-slash',
                'title' => 'Not Enrolled Users',
                'url' => 'admin/users?not_enrolled=1',
                'permissions' => [\Domain\Users\Enums\PermissionsEnum::USERS()->value], // Add permissions here
            ],
            'roles' => [
                'icon' => 'fas fa-link',
                'title' => 'Roles',
                'url' => 'admin/roles',
                'permissions' => [\Domain\Users\Enums\PermissionsEnum::ROLES()->value], // Add permissions here
            ],
        ],
    ],
    'courses' => [
        'url' => '',
        'icon' => '',
        'title' => 'Courses Management',
        'permissions' => [\Domain\Users\Enums\PermissionsEnum::COURSES()->value], // Add permissions here
        'children' => [
            'batches' => [
                'icon'  => 'fas fa-hat-wizard',
                'title' => 'Course Batches',
                'url'   => 'admin/batches',
                'permissions' => [\Domain\Users\Enums\PermissionsEnum::COURSES()->value], // Add permissions here
            ],
            'categories' => [
                'icon' => 'fas fa-home',
                'title' => 'Categories',
                'url' => 'admin/categories',
                'permissions' => [\Domain\Users\Enums\PermissionsEnum::CATEGORIES()->value], // Add permissions here
            ],
            'courses' => [
                'icon' => 'fas fa-book-open',
                'title' => 'Courses',
                'url' => 'admin/courses',
                'permissions' => [\Domain\Users\Enums\PermissionsEnum::COURSES()->value], // Add permissions here
            ],
            'progress' => [
                'icon' => 'fas fa-chart-line',
                'title' => 'Course Progress',
                'url' => 'admin/courses/progress',
                'permissions' => [\Domain\Users\Enums\PermissionsEnum::COURSES()->value], // Add permissions here
            ],
            'submitted-assignments' => [
                'icon' => 'fas fa-book',
                'title' => 'Submitted Assignments',
                'url' => 'admin/submitted-assignments',
                'permissions' => [\Domain\Users\Enums\PermissionsEnum::SUBMITTED_ASSIGNMENTS()->value], // Add permissions here
            ],
        ],
    ],
    'quiz' => [
        'url' => '',
        'icon' => '',
        'title' => 'Quizzes',
        'permissions' => [\Domain\Users\Enums\PermissionsEnum::QUIZ_REPOSITORY()->value], // Add permissions here
        'children' => [
            'quizzes' => [
                'icon' => 'fas fa-question-circle',
                'title' => 'Quiz Repository',
                'url' => 'admin/quizzes',
                'permissions' => [\Domain\Users\Enums\PermissionsEnum::QUIZ_REPOSITORY()->value], // Add permissions here
            ],
            'attempts' => [
                'icon' => 'fas fa-user-edit',
                'title' => 'Quiz Attempts',
                'url' => 'admin/quiz-attempts',
                'permissions'=> [\Domain\Users\Enums\PermissionsEnum::QUIZ_ATTEMPTS()->value],
            ],
        ],
    ],
    'calendars' => [
        'url' => '',
        'icon' => '',
        'title' => 'Calendars',
        'permissions' => [\Domain\Users\Enums\PermissionsEnum::CALENDARS()->value], // Add permissions here
        'children' => [
            'calender' => [
                'icon' => 'fas fa-calendar-check',
                'title' => 'Calendars Scheduling',
                'url' => 'admin/calendars',
                'permissions' => [\Domain\Users\Enums\PermissionsEnum::CALENDARS()->value], // Add permissions here
            ],
            'attendances' => [
                'icon' => 'fas fa-calendar-alt',
                'title' => 'Attendance Records',
                'url' => 'admin/attendances',
                'permissions' => [\Domain\Users\Enums\PermissionsEnum::ATTENDANCES()->value], // Add permissions here
            ],
        ],
    ],
    'reports' => [
        'url' => '',
        'icon' => '',
        'title' => 'Reports',
        'children' => [
            'exports' => [
                'url' => 'admin/exports',
                'icon' => 'fa fa-download',
                'title' => 'Export Requests',
                'parent' => 'false',
                "permissions"=>[]
            ],
            'support_ticket' => [
                'url' => 'admin/support-tickets',
                'icon' => 'fa fa-download',
                'title' => 'Support Tickets',
                'parent' => 'false',
                "permissions"=>[]
            ],
            'referral_report' => [
                'url' => 'admin/referral-report',
                'icon' => 'fas fa-user-plus',
                'title' => 'Referral Enrollments',
                'parent' => 'false',
                "permissions"=>[]
            ],
        ],
    ]
];
