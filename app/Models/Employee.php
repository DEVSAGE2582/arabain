<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'contact_no',
        'email',
        'passport_no',
        'issue_date',
        'expiry_date',
        'id_no',
        'mailing_address',
        'nationality',
        'father_name',
        'mother_name',
        'dob',
        'doj',
        'designation',
        'qualification',
        'salary',
        'bonus',
        'food_allowance',
        'transport_allowance',
        'id_image',
        'photo',
        'job_note',
    ];
}
