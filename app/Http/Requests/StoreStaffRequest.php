<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:staff,email',
            'phone' => 'required|string|max:20|regex:/^[0-9\+\-\s\(\)]+$/',
            'department_id' => 'required|integer|exists:departments,id',
            'role' => 'required|string|in:professor,lecturer,assistant,staff',
            'qualification' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Staff name is required',
            'email.unique' => 'This email is already registered',
            'department_id.required' => 'Department selection is required',
            'role.required' => 'Staff role is required',
        ];
    }
}
