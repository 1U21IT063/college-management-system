<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Student;
use App\Models\Staff;
use App\Models\Course;
use App\Models\Department;
use App\Models\Fee;
use App\Models\Mark;
use App\Policies\StudentPolicy;
use App\Policies\StaffPolicy;
use App\Policies\CoursePolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\FeePolicy;
use App\Policies\MarkPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Student::class => StudentPolicy::class,
        Staff::class => StaffPolicy::class,
        Course::class => CoursePolicy::class,
        Department::class => DepartmentPolicy::class,
        Fee::class => FeePolicy::class,
        Mark::class => MarkPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
