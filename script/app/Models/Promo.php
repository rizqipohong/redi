<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promo';
    protected $fillable = ['name', 'link', 'start_date', 'end_date', 'created_by'];
    public function user(){
        return $this->hasOne(User::class,'id','created_by');
    }
}
