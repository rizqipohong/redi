<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AccountRatapay extends Model
{
    protected $table = 'account_ratapay';
    protected $fillable = [
        'customer_id',
        'email',
        'name',
        'account_number',
        'account_currency',
        'account_last_active',
        'account_created_time',
        'account_id',
        'account_balance',
        'phone',
        'account_status',
        'link_status',
    ];
}
