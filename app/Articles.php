<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{

	/**
	 * The attribute Is File Table Limit Field.
	 * @var [type]
	 */
    public $fillable = ['title','content',"cat_id"];


}
