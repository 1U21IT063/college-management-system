<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Fee;
use Illuminate\Pagination\Paginator;

class FeeService
{
    /**
     * Calculate fee balance and update status
     */
    public function calculateBalance(array $data): array
    {
        $balance = $data['total_fee'] - $data['paid_fee'];
        $data['balance_fee'] = $balance;
        $data['status'] = $balance == 0 ? 'paid' : ($balance < 0 ? 'overdue' : 'pending');

        return $data;
    }

    /**
     * Get student's fee summary
     */
    public function getStudentFeeSummary(Student $student): array
    {
        $fees = $student->fees();

        return [
            'total_fee' => $fees->sum('total_fee'),
            'paid_fee' => $fees->sum('paid_fee'),
            'balance_fee' => $fees->sum('balance_fee'),
            'paid_percentage' => $fees->sum('total_fee') > 0 
                ? round(($fees->sum('paid_fee') / $fees->sum('total_fee')) * 100, 2) 
                : 0,
            'pending_count' => $fees->where('status', 'pending')->count(),
            'paid_count' => $fees->where('status', 'paid')->count(),
        ];
    }

    /**
     * Send fee reminder
     */
    public function sendFeeReminder(Fee $fee)
    {
        if ($fee->status === 'pending' && $fee->balance_fee > 0) {
            // Send notification/email
            // $fee->student->notify(new FeeReminderNotification($fee));
            return true;
        }

        return false;
    }

    /**
     * Get fees by status
     */
    public function getFeesByStatus(string $status, int $perPage = 15): Paginator
    {
        return Fee::with('student')
            ->where('status', $status)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Generate fee report
     */
    public function getFeeReport(array $filters = []): array
    {
        $query = Fee::query();

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['start_date'])) {
            $query->whereDate('payment_date', '>=', $filters['start_date']);
        }

        if (isset($filters['end_date'])) {
            $query->whereDate('payment_date', '<=', $filters['end_date']);
        }

        $fees = $query->get();

        return [
            'total_count' => $fees->count(),
            'total_fee_amount' => $fees->sum('total_fee'),
            'total_paid_amount' => $fees->sum('paid_fee'),
            'total_balance' => $fees->sum('balance_fee'),
            'fees' => $fees,
        ];
    }
}
