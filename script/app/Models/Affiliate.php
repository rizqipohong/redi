<?php

namespace App\Models;
use App\Plan;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    protected $table = 'affiliate_membership';
    protected $fillable = [
        'user_id',
        'member_id',
        'plan_id',
        'link',
        'commision',
    ];
    public function userReff(){
        return $this->hasOne(User::class,'id', 'user_id');
    }
    public function member(){
        return $this->hasOne(User::class,'id', 'member_id');
    }
    public function plan(){
        return $this->hasOne(Plan::class,'id', 'plan_id');
    }
}
