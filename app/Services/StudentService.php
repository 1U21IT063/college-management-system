<?php

namespace App\Services;

use App\Models\Student;

class StudentService
{
    /**
     * Get student's complete profile with all related data
     */
    public function getStudentProfile(Student $student): array
    {
        $feeService = new FeeService();
        $markService = new MarkService();
        $attendanceService = new AttendanceService();

        return [
            'student' => $student,
            'fees_summary' => $feeService->getStudentFeeSummary($student),
            'marks_summary' => $markService->getStudentMarkSummary($student),
            'attendance_summary' => $attendanceService->getStudentAttendanceSummary($student),
            'recent_marks' => $student->marks()->latest()->take(5)->get(),
            'recent_fees' => $student->fees()->latest()->take(5)->get(),
            'recent_attendance' => $student->attendances()->latest()->take(5)->get(),
        ];
    }

    /**
     * Get students by department
     */
    public function getStudentsByDepartment($departmentId, $perPage = 15)
    {
        return Student::where('department_id', $departmentId)
            ->with('department')
            ->paginate($perPage);
    }

    /**
     * Get students by year
     */
    public function getStudentsByYear($year, $perPage = 15)
    {
        return Student::where('year', $year)
            ->with('department')
            ->paginate($perPage);
    }

    /**
     * Search students
     */
    public function searchStudents($search, $perPage = 15)
    {
        return Student::where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('registration_number', 'LIKE', "%{$search}%")
            ->with('department')
            ->paginate($perPage);
    }

    /**
     * Get students with low fees
     */
    public function getStudentsWithPendingFees()
    {
        return Student::whereHas('fees', function ($query) {
            $query->where('status', 'pending');
        })->with('fees')->get();
    }

    /**
     * Get students with low attendance
     */
    public function getStudentsWithLowAttendance($threshold = 75)
    {
        $attendanceService = new AttendanceService();
        $students = Student::all();

        return $students->filter(function ($student) use ($attendanceService, $threshold) {
            return $attendanceService->getAttendancePercentage($student) < $threshold;
        });
    }

    /**
     * Get enrolled students count by department
     */
    public function getEnrollmentByDepartment(): array
    {
        return Student::selectRaw('department_id, count(*) as count')
            ->groupBy('department_id')
            ->with('department')
            ->get()
            ->pluck('count', 'department.department_name')
            ->toArray();
    }
}
