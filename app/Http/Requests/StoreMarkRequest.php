<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isStaff();
    }

    public function rules(): array
    {
        return [
            'student_id' => 'required|integer|exists:students,id',
            'subject' => 'required|string|max:100',
            'internal_mark' => 'required|numeric|min:0|max:50',
            'external_mark' => 'required|numeric|min:0|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'Student selection is required',
            'subject.required' => 'Subject name is required',
            'internal_mark.required' => 'Internal marks are required',
            'external_mark.required' => 'External marks are required',
            'internal_mark.max' => 'Internal marks cannot exceed 50',
            'external_mark.max' => 'External marks cannot exceed 50',
        ];
    }
}
