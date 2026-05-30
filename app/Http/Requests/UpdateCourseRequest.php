<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:50|unique:courses,course_code,' . $this->course?->id,
            'duration' => 'required|integer|min:1|max:12',
            'credits' => 'nullable|integer|min:1|max:10',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'course_name.required' => 'Course name is required',
            'course_code.unique' => 'This course code is already used',
        ];
    }
}
