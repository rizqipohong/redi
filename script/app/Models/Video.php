<?php
namespace App\Models;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    protected $fillable = ['name', 'link','created_by'];
    public function user(){
        return $this->hasOne(User::class,'id','created_by');
    }
}
