<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeePayment extends Model
{
  protected $fillable = [
    'student_id',
    'amount',
    'payment_date',
    'payment_mode',
    'remark'
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
