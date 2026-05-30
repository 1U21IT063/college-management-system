<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isStaff();
    }

    public function rules(): array
    {
        return [
            'student_id' => 'required|integer|exists:students,id',
            'total_fee' => 'required|numeric|min:0|decimal:0,2',
            'paid_fee' => 'required|numeric|min:0|decimal:0,2',
            'payment_date' => 'required|date|before_or_equal:today',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'Student selection is required',
            'total_fee.required' => 'Total fee amount is required',
            'paid_fee.required' => 'Paid fee amount is required',
            'paid_fee.numeric' => 'Paid fee must be a valid number',
        ];
    }
}
