<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

    public $guarded = "id";


    public $fillable = ['name','message','user_id'];


}
