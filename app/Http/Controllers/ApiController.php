<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Validator;

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



    /**
     * The Method is create data Validator .
     * @Author   Yuan1998
     * @DateTime 2018-03-06T17:29:55+0800
     * @param    Array                   $rules  Validator rules.
     * @param    Array                   $data    Validate data.
     * @return   Array|Boolean                          result.
     */
    public function validator($rules,$data = null)
    {
        // get data
        if(!$data){
            $data = $this->filterData(request()->toArray());
        }

        $v = Validator::make($data,$rules);

        if($v->fails())
        {
            $this->errorMsgs = $v->errors();
            return false;
        }

        return $data;
    }
}
