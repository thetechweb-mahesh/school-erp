<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyFee extends Model
{
   protected $fillable = [
    'student_id',
    'month',
    'amount',
    'paid',
    'balance'
];

public function student()
{
    return $this->belongsTo(Student::class);
}

public function allocations()
{
    return $this->hasMany(PaymentAllocation::class);
}
}
