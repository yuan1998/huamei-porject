<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \App\User;



class UserController extends ApiController
{


   /**
    * Signup Rules
    *
    * @var Array
    */
   private $signupRules = [
      'username'=>'required|between:6,32|unique:users',
      'password'=>'required|min:6',
      'email'=>'required|email|unique:users',
   ];



   /**
    * [__construct description]
    * @Yuan1998
    * @DateTime 2018-01-23T15:16:51+0800
    */
   public function __construct(\App\User $user)
   {
      $this->model = $user;
   }



   /**
    * Login Api
    * @Yuan1998
    * @DateTime 2018-01-23T15:03:59+0800
    * @return   Array                   ['success'=>true|false,'data|msg'=>Array]
    */
   	public function login()
   	{
      	if(session('user'))
         	return err('请先登出');


        $user = $this->loginValidate()

      	if(! $user)
      		return err('invalid username or password');

      	session(['user'=>$user]);

      	return suc();

   	}



   /**
    * Login Validator.
    * @Yuan1998
    * @DateTime 2018-01-23T15:05:14+0800
    * @return   Array|false                   Validate pass,return data,else return false.
    */
   	private function loginValidate()
   	{
   		$username = request('username');
   		$password = request('password');


   		if($password && $username){

   			$user = $this->model->where('username',$username)->first();

   			if($user && Hash::check($password,$user['password'])
   				return $user;

   		}

   		return false;

   	}




   /**
    * Signup Api
    * @Yuan1998
    * @DateTime 2018-01-23T15:06:25+0800
    * @return   Array                   signup success return true&lastId,else return false.
    */
   	public function signup()
   	{

      	if( !$data = $this->signupValidate())
         	return $this->getError();
      	$r = $this->model->create($data);
      	return $r ? suc($r->id) : err('error');

   	}




   /**
    * Signup validator.
    * @Yuan1998
    * @DateTime 2018-01-23T15:07:49+0800
    * @return   Array|false                   On success return validate data. else return false.
    */
   private function signupValidate()
   {
      // get need data
      $data =request()->toArray();
      $data = $this->validator($this->signupRules,$data);
      if(!$data)
         return false;
      $data['password'] = Hash::make($data['password']);
      return $data;
   }




   /**
    * judge is login.
    *
    * @Yuan1998
    * @DateTime 2018-01-23T15:09:35+0800
    * @return   boolean                  [description]
    */
   public function is_login()
   {
      if($a = session('user')){
         $want = request('want');
         return $want ? suc($a->_all($want)) : suc();
      }
      return err(null,200);
   }



   /**
    * get User Data.
    * @Yuan1998
    * @DateTime 2018-01-23T15:10:33+0800
    * @return   Array                   On success return true&&user data. fail return false&&errorMsg.
    */
   public function getUserData(){
      $user =session('user');
      if(!$user )
         return err('not user');
      return suc($user->toArray());
   }




   /**
    * find username exists
    * @Yuan1998
    * @DateTime 2018-01-27T15:17:21+0800
    * @return   array                   data = true|false
    */
   public function usernameExists()
   {
      $key = 'username';
      return $this->find_key_exists($key);
   }




   /**
    * the function is find xxxExists core;
    * @Yuan1998
    * @DateTime 2018-01-27T15:19:03+0800
    * @param    String                   $key key get value in the request.
    * @return   boolean                        find result
    */
   private function find_key_exists($key)
   {
      $value = request($key);
      $r = $this->model->where($key,$value)->exists();
      return suc($r);
   }




    /**
     * The Method is get param id user info , admin Api
     * @Yuan1998
     * @DateTime 2018-02-07T14:58:38+0800
     * @return   [type]                 [description]
     */
   public function getUserInfo()
   {
      $id = request('id');
      $r = $this->model->where('id',$id)->first();
      return $this->resultReturn($r);
   }







}