<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceService
{
    /**
     * Get student's attendance percentage
     */
    public function getAttendancePercentage(Student $student): float
    {
        $total = $student->attendances()->count();

        if ($total === 0) {
            return 0;
        }

        $present = $student->attendances()->where('status', 'present')->count();

        return round(($present / $total) * 100, 2);
    }

    /**
     * Get attendance summary for a student
     */
    public function getStudentAttendanceSummary(Student $student, $month = null): array
    {
        $query = $student->attendances();

        if ($month) {
            $query->whereMonth('date', $month);
        }

        $attendances = $query->get();

        return [
            'total_days' => $attendances->count(),
            'present_days' => $attendances->where('status', 'present')->count(),
            'absent_days' => $attendances->where('status', 'absent')->count(),
            'leave_days' => $attendances->where('status', 'leave')->count(),
            'percentage' => $attendances->count() > 0 
                ? round(($attendances->where('status', 'present')->count() / $attendances->count()) * 100, 2)
                : 0,
        ];
    }

    /**
     * Mark attendance for a date
     */
    public function markAttendance(array $data): bool
    {
        foreach ($data['status'] as $student_id => $status) {
            Attendance::create([
                'student_id' => $student_id,
                'date' => $data['date'] ?? now()->toDateString(),
                'status' => $status,
            ]);
        }

        return true;
    }

    /**
     * Get attendance report
     */
    public function getAttendanceReport(array $filters = []): array
    {
        $query = Attendance::query();

        if (isset($filters['student_id'])) {
            $query->where('student_id', $filters['student_id']);
        }

        if (isset($filters['start_date'])) {
            $query->whereDate('date', '>=', $filters['start_date']);
        }

        if (isset($filters['end_date'])) {
            $query->whereDate('date', '<=', $filters['end_date']);
        }

        $attendances = $query->get();

        return [
            'total_records' => $attendances->count(),
            'present_count' => $attendances->where('status', 'present')->count(),
            'absent_count' => $attendances->where('status', 'absent')->count(),
            'leave_count' => $attendances->where('status', 'leave')->count(),
            'data' => $attendances,
        ];
    }

    /**
     * Get attendance by date range
     */
    public function getAttendanceByDateRange($startDate, $endDate)
    {
        return Attendance::whereBetween('date', [$startDate, $endDate])
            ->with('student')
            ->get();
    }
}
