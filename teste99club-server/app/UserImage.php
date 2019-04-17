<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
   /**
     * @var array
     */
    protected $fillable = ['user_id','path', 'created_at', 'updated_at'];
    
}
