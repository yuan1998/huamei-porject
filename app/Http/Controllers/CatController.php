<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatController extends ApiController
{


	/**
	 * New model.
	 * @param \App\Articles $model [description]
	 */
    public function __construct(\App\Cat $model)
	{
		$this->model = $model;
	}
}
