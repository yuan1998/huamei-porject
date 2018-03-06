<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{


	/**
	 * The Attribute is create table fill field name.
	 * @var [type]
	 */
    public $fillable = ['title','parent_id'];

}
