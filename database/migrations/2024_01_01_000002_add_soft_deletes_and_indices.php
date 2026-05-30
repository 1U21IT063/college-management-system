<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations - Add soft deletes to all models
     */
    public function up(): void
    {
        $tables = ['students', 'staff', 'courses', 'departments', 'fees', 'marks', 'attendances'];

        foreach ($tables as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'deleted_at')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->softDeletes();
                });
            }
        }

        // Add indices for better query performance
        if (Schema::hasTable('students')) {
            Schema::table('students', function (Blueprint $table) {
                $table->index('department_id');
                $table->index('email');
                $table->index('name');
            });
        }

        if (Schema::hasTable('staff')) {
            Schema::table('staff', function (Blueprint $table) {
                $table->index('department_id');
                $table->index('email');
                $table->index('role');
            });
        }

        if (Schema::hasTable('fees')) {
            Schema::table('fees', function (Blueprint $table) {
                $table->index('student_id');
                $table->index('status');
                $table->index('payment_date');
            });
        }

        if (Schema::hasTable('marks')) {
            Schema::table('marks', function (Blueprint $table) {
                $table->index('student_id');
                $table->index('subject');
                $table->index('grade');
            });
        }

        if (Schema::hasTable('attendances')) {
            Schema::table('attendances', function (Blueprint $table) {
                $table->index('student_id');
                $table->index('date');
                $table->index('status');
            });
        }

        if (Schema::hasTable('courses')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->index('department_id');
                $table->index('course_code');
            });
        }

        if (Schema::hasTable('departments')) {
            Schema::table('departments', function (Blueprint $table) {
                $table->index('department_name');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['students', 'staff', 'courses', 'departments', 'fees', 'marks', 'attendances'];

        foreach ($tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'deleted_at')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropSoftDeletes();
                });
            }
        }

        // Drop indices
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    try {
                        $table->dropIndex([$table->getTable() . '_' . $table->getTable() . '_id_index']);
                    } catch (\Exception $e) {}
                });
            }
        }
    }
};
