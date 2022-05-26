<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    protected $table = 'tutorial';
    protected $fillable = ['name', 'link', 'created_by'];
    public function user(){
        return $this->hasOne(User::class,'id','created_by');
    }
}
