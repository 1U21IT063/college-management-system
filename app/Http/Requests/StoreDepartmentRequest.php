<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'department_name' => 'required|string|max:255|unique:departments,department_name',
            'hod' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'building' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20|regex:/^[0-9\+\-\s\(\)]+$/',
        ];
    }

    public function messages(): array
    {
        return [
            'department_name.required' => 'Department name is required',
            'department_name.unique' => 'This department already exists',
            'hod.required' => 'Head of Department name is required',
        ];
    }
}
