<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msgs extends Model
{
    protected $table = "messages";
    protected $fillable = ['title','text','slug','user_id'];
}
