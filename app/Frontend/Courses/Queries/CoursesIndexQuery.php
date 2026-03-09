<?php

namespace App\Frontend\Courses\Queries;

use Domain\Courses\Enums\CourseStatusEnum;
use Domain\Courses\Models\Course;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CoursesIndexQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = Course::query()
            ->with([
                'media',
                'teachers',
            ])->where('is_active', true)
            ->where('course_status', CourseStatusEnum::PUBLISH());

        parent::__construct($query);

        $this
            ->allowedFilters([
                AllowedFilter::partial('name'), // Add columns you want to search
                //                AllowedFilter::partial('postcode'),
                //                AllowedFilter::exact('type'),
                //                AllowedFilter::exact('listing_status'),
                //                AllowedFilter::scope('min_price'),
                //                AllowedFilter::scope('max_price'),
            ])->allowedSorts([
                'id',
                'created_at',
            ])->defaultSort('-id');
    }
}
