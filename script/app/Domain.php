<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table="domains";
    protected $fillable= ['domain', 'full_domain', 'status', 'user_id', 'template_id', 'shop_type'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function theme()
    {
    	return $this->belongsTo('App\Models\Template','template_id','id');
    }
}
