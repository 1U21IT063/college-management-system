<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = ['student_id','total_fee','paid_fee','balance_fee','status','payment_date'];

    public function student()
{
    return $this->belongsTo(Student::class);
}
}
