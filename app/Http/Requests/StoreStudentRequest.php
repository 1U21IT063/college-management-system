<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isStaff();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email',
            'phone' => 'required|string|max:20|regex:/^[0-9\+\-\s\(\)]+$/',
            'department_id' => 'required|integer|exists:departments,id',
            'year' => 'required|integer|min:1|max:4',
            'registration_number' => 'nullable|string|max:50|unique:students,registration_number',
            'enrollment_date' => 'nullable|date|before_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Student name is required',
            'email.unique' => 'This email is already registered',
            'department_id.required' => 'Department selection is required',
            'phone.regex' => 'Please enter a valid phone number',
            'year.min' => 'Year must be between 1 and 4',
        ];
    }
}
