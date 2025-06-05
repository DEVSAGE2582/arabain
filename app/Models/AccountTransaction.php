<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountTransaction extends Model
{
     protected $fillable = [
        'account_id',
        'type',
        'amount',
        'operation_date',
        'sub_type',
        'created_by',
    ];
}
