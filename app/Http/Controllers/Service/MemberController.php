<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/9
 * Time: 13:08
 */

namespace App\Http\Controllers\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Member;
use App\Api\ApiCode;
use App\Api\Email;
use App\Tool\UUID;
use Mail;


class MemberController extends Controller{

    /**
     *
     *用户注册操作
     *
     *****/

    public function regirsts(Request $request){
        $api = new ApiCode();
        $email    = $request->input('email','');
        $password = $request->input('password','');
        $validate_code= $request->input('validate_code','');
        if($validate_code == "" || strlen($validate_code) != 4){
            return $api->api(411);
        }
        $sessionCode = $request->session()->get('validatecode','');
        if($sessionCode != $validate_code){
            return $api->api(422);
        }
        $member = new Member();
        $result = $member::where('username',$email)->first();
        if($result){
            return $api->api(427);
        }
        $member->username = $email;
        $member->password = md5('bk'+$password);
        $member->save();
        //发送邮件
        $getEmail = new Email();
        $uuid     = UUID::create();

        $getEmail->to = $email;
        $getEmail->cc = '3511477250@qq.com';
        $getEmail->subject = 'XXX书店验证';
        $getEmail->content = '请与24小时内验证  http://www.work.com/';



        Mail::send('email_register', ['getEmail' => $getEmail], function ($m) use ($getEmail) {
            //$m->from('hello@app.com', 'Your Application');
            $m->to($getEmail->to, '尊敬的用户')->cc($getEmail->cc)->subject($getEmail->subject);
        });

        return $api->api(200,'/login');

    }

    public function logins(Request $request){

        $api = new ApiCode();
        $email    = $request->input('email','');
        $password = $request->input('password','');
        $validate_code= $request->input('validate_code','');
        if($validate_code == "" || strlen($validate_code) != 4){
            return $api->api(411);
        }
        $sessionCode = $request->session()->get('validatecode','');
        if($sessionCode != $validate_code){
            return $api->api(422);
        }
        $member = new Member();
        $result = $member::where(['username'=>$email],['password'=>md5('bk'+$password)])->find();
        if($result){
            $request->session()->put('user',$result);
            return $api->api(200,'/index');
        }

    }



}