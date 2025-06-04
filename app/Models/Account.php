<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    protected $fillable = [
        'bank_name',
        'account_number',
        'account_name',
        'routing',
        'branch',
        'account_balance',
        'note',
    ];
}
