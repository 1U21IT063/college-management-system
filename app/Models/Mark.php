<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable = [
        'student_id',
        'subject',
        'grade',
        'internal_mark',
        'external_mark',
        'total_mark',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

