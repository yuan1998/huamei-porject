<?php


/**
 * 返回成功数据模板
 * @Yuan1998
 * @DateTime 2018-01-24T20:17:56+0800
 * @param    All                   $data 可以为任何类型的数据，携带回到发送端.
 * @return   Array                         生成的返回结果.
 */
function suc($data=null)
{
	return response()->json(['success'=>true,'data'=>$data],200);
}



/**
 * 返回错误结果模板
 *
 * @Yuan1998
 * @DateTime 2018-01-24T20:15:54+0800
 * @param    String|Array                   $msg    错误信息，可以为任何类型
 * @param    integer                  $status 错误码
 * @return   Array                           生成的错误结果。
 */
function err($msg=null,$status=403)
{
	return response()->json(['success'=>false,'msg'=>$msg],$status);
}
