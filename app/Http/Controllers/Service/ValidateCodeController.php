<?php
namespace App\Http\Controllers\Service;

use App\Entity\TempPhone;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//引用对应的命名空间
use App\Tool\Validate\ValidateCode;



/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/8
 * Time: 16:13
 */
class ValidateCodeController extends Controller{

     public function create(Request $request){

         $ValidateCode = new ValidateCode();
         $request->session()->put('validatecode',$ValidateCode->getCode());
         return $ValidateCode->doimg();

     }

     /**
      *发送短信
      *@param  string
      *
      ***/
     public function sendSMS(Request $request){

         $phone = $request->input('phone','');//获取手机号这个值，没有就为空
         if($phone == ""){
             return false;
         }
         $code = "";
         $charset = "1234567890";
         $len = strlen($charset)-1;
         for($i=0;$i<6;$i++){
              $code .= $charset[mt_rand(0,$len)];
         }

         //这里调用手机发送短信接口

         $tempPhone = new TempPhone();
         $tempPhone->phone = $phone;
         $tempPhone->code  = $code;
         $tempPhone->deadline = date('Y-m-d H:i:s', time()+60*60);
         $tempPhone->save();


     }

}