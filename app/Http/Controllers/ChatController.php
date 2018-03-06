<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends ApiController
{

	protected $SendMessageRules = [
		'message' => 'required',
		'name' => 'required',
	];



	/**
	 * New Model
	 */
    public function __construct()
    {
    	$this->model = new \App\Chat;
    }


    /**
     * The Method Is User Send Message Api
     * @return [type] [description]
     */
    public function sendMessage()
    {
    	$data = request();

    	$data->name = request()->ip();


    	$r = $this->model->create($data);

    	hmyy120.vip


    }
}
