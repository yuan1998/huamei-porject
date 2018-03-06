<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{

    public $model;
    public $errorMsgs = [];


    /**
     * The Method is Save Error Msg.
     * @param [type] $msg [description]
     */
    public function addError($msg = null)
    {

    	return $msg
    	? array_push($this->errorMsgs, $msg)
    	: false;

    }


    /**
     * The Method is Get All Error Msg.
     * @return Array   ErrorMsgs.
     */
    public function getError()
    {
    	return $this->errorMsgs;
    }


    /**
     * The Method is Return JSON Result.
     * @param  boolean|Array|Model  $r      result.
     * @param  Number $stauts   response status code.
     * @return JSON          Response Json.
     */
    public function resultReturn($r,$status = false)
    {

    	$result = $r
    	? ["success" => true, "data" => $r]
    	: ["success" => false, "msg" => $this->getError()];

    	if(!$status)
    		$status =  $r ? 200 : 400;

    	return \Response::json($result, $status);

    }


    /**
     * The method is common add data method.
     */
    public function add()
    {

		$data = request()->toArray();

		if(method_exists($this,'addValidator')){

			$data = $this->addValidator();

			if(!$data)
				return $this->resultReturn($data);
		}

    	$r = $this->model->create($data);

    	return $this->resultReturn($r->id);

    }



    /**
     * The is Common Method . remove data in the request id.
     */
    public function remove()
    {
		$id = request('id');

    	$row = $this->findIdValidator($id);

    	$r = $row ? $row->delete() : false;

    	$this->resultReturn($r);
    }



    /**
     * The Method is find id in the Model table .if exists return model , else return false.
     * @param  Number $id  table Id
     * @return Boolean|Model
     */
    public function findIdValidator($id = null)
    {

    	if($id)
    		if($row = $this->model->find($id))
    			return $row;



		$this->addError('id unexists or not find ');

    	return false;

    }
}
