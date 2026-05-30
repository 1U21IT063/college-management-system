<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Mark;

class MarkService
{
    /**
     * Calculate grade based on total marks
     */
    public function calculateGrade(int $total): string
    {
        return match (true) {
            $total >= 90 => 'A+',
            $total >= 75 => 'A',
            $total >= 60 => 'B',
            $total >= 50 => 'C',
            default => 'F',
        };
    }

    /**
     * Get student's mark summary
     */
    public function getStudentMarkSummary(Student $student): array
    {
        $marks = $student->marks();

        $allMarks = $marks->get();
        $totalMarks = $allMarks->count();
        $averageMarks = $allMarks->avg('total_mark');
        $highestMark = $allMarks->max('total_mark');
        $lowestMark = $allMarks->min('total_mark');

        return [
            'total_subjects' => $totalMarks,
            'average_marks' => round($averageMarks, 2),
            'highest_mark' => $highestMark,
            'lowest_mark' => $lowestMark,
            'grade_a_plus' => $allMarks->where('grade', 'A+')->count(),
            'grade_a' => $allMarks->where('grade', 'A')->count(),
            'grade_b' => $allMarks->where('grade', 'B')->count(),
            'grade_c' => $allMarks->where('grade', 'C')->count(),
            'grade_f' => $allMarks->where('grade', 'F')->count(),
        ];
    }

    /**
     * Get grade distribution
     */
    public function getGradeDistribution(): array
    {
        return Mark::selectRaw('grade, count(*) as count')
            ->groupBy('grade')
            ->pluck('count', 'grade')
            ->toArray();
    }

    /**
     * Get marks by subject
     */
    public function getMarksBySubject(string $subject)
    {
        return Mark::where('subject', 'LIKE', "%{$subject}%")
            ->with('student')
            ->get();
    }

    /**
     * Get top performers
     */
    public function getTopPerformers(int $limit = 10): array
    {
        return Mark::selectRaw('student_id, avg(total_mark) as average_marks')
            ->groupBy('student_id')
            ->orderByDesc('average_marks')
            ->limit($limit)
            ->with('student')
            ->get()
            ->toArray();
    }
}
