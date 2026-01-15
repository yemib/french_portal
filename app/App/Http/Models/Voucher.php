<?php

namespace App\App\Http\Models;

use App\Http\Models\Payment;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        "code",
        "serial_number",
        "amount",
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
