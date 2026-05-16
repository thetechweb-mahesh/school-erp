<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
protected $fillable = [
     'user_id',
    'name',
    'father_name',
    'mobile',
    'class',
    'roll_no',
    'subjects',
    'total_fee',
    'paid_fee',
    'balance_fee',
    'photo'
];


public function payments()
{
    return $this->hasMany(FeePayment::class);
}
public function monthlyFees()
{
    return $this->hasMany(MonthlyFee::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}
}
