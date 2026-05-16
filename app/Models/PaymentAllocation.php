<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentAllocation extends Model
{
    //

    protected $fillable = [
    'fee_payment_id',
    'monthly_fee_id',
    'amount'
];

public function monthlyFee()
{
    return $this->belongsTo(MonthlyFee::class);
}
}
