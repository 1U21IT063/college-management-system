<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add foreign key to students table for department
        if (Schema::hasTable('students') && !Schema::hasColumn('students', 'department_id')) {
            Schema::table('students', function (Blueprint $table) {
                $table->unsignedBigInteger('department_id')->nullable()->after('phone');
                $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
                $table->string('registration_number')->nullable()->unique()->after('year');
                $table->date('enrollment_date')->nullable()->after('registration_number');
            });
        }

        // Add foreign key to staff table for department
        if (Schema::hasTable('staff') && !Schema::hasColumn('staff', 'department_id')) {
            Schema::table('staff', function (Blueprint $table) {
                $table->unsignedBigInteger('department_id')->nullable()->after('phone');
                $table->string('qualification')->nullable()->after('department_id');
                $table->integer('experience')->nullable()->after('qualification');
                $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            });
        }

        // Add foreign keys to fees table
        if (Schema::hasTable('fees') && Schema::hasColumn('fees', 'student_id')) {
            Schema::table('fees', function (Blueprint $table) {
                if (!Schema::hasColumn('fees', 'description')) {
                    $table->text('description')->nullable()->after('payment_date');
                }
                // Add foreign key constraint if not exists
                try {
                    $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
                } catch (\Exception $e) {
                    // Foreign key might already exist
                }
            });
        }

        // Add foreign keys to marks table
        if (Schema::hasTable('marks') && Schema::hasColumn('marks', 'student_id')) {
            Schema::table('marks', function (Blueprint $table) {
                try {
                    $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
                } catch (\Exception $e) {
                    // Foreign key might already exist
                }
            });
        }

        // Add foreign keys to attendance table
        if (Schema::hasTable('attendances') && Schema::hasColumn('attendances', 'student_id')) {
            Schema::table('attendances', function (Blueprint $table) {
                try {
                    $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
                } catch (\Exception $e) {
                    // Foreign key might already exist
                }
            });
        }

        // Add foreign key to courses table for department
        if (Schema::hasTable('courses') && !Schema::hasColumn('courses', 'department_id')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->unsignedBigInteger('department_id')->nullable()->after('duration');
                $table->integer('credits')->nullable()->after('department_id');
                $table->text('description')->nullable()->after('credits');
                $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign keys
        Schema::table('students', function (Blueprint $table) {
            try {
                $table->dropForeign(['department_id']);
            } catch (\Exception $e) {}
        });

        Schema::table('staff', function (Blueprint $table) {
            try {
                $table->dropForeign(['department_id']);
            } catch (\Exception $e) {}
        });

        Schema::table('fees', function (Blueprint $table) {
            try {
                $table->dropForeign(['student_id']);
            } catch (\Exception $e) {}
        });

        Schema::table('marks', function (Blueprint $table) {
            try {
                $table->dropForeign(['student_id']);
            } catch (\Exception $e) {}
        });

        Schema::table('attendances', function (Blueprint $table) {
            try {
                $table->dropForeign(['student_id']);
            } catch (\Exception $e) {}
        });

        Schema::table('courses', function (Blueprint $table) {
            try {
                $table->dropForeign(['department_id']);
            } catch (\Exception $e) {}
        });
    }
};
