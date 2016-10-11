<?php
namespace App\Api;


/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/9
 * Time: 10:34
 */
class ApiCode{

      public static $code = array(
          200 => 'success',

          400 => '非法请求',
          401 => '请求参数缺失',
          402 => '请求参数格式不正确',//可能会自定义

          410 => '手机号码不能为空',
          411 => '验证码不能为空',
          412 => '密码不能为空',

          420 => '你输入的手机号码不存在',//手机号码不存在
          421 => '你输入的密码输入不正确',//密码输入不正确
          422 => '你输入的验证码错误',
          423 => '短信发送过于频繁，请1分钟后再试。',//短信发送失败 (发送频繁, 或者短信接口失效)
          424 => '你输入的短信验证码不正确',
          425 => '该手机已经被注册',
          426 => '你输入的手机或者密码输入不正确',//密码输入不正确
          427 => '该邮箱已经被注册',

          430 => '你还没有登陆, 请登陆后继续',

          444 => '',//自定义错误

          500 => '服务器未知错误',
      );


    /**
     * 返回json格式接口数据
     * @param  int $code    号码
     * @param  string $message 信息
     * @param  array  $data    数据
     * @param  string  $redirect_url    跳转的url
     * @return string          返回json字符串
     */
      public function api($code, $redirect_url='', $message='', $data=array()){

          //$obc = ob_get_contents()//得到缓冲区的数据,  可以方便记入错误日志
          //ob_end_clean()

          header('Content-Type:application/json; charset=utf-8');
          $message = ($message?:self::$code[$code])?:'';
          die(json_encode(array(
              'code'   => $code,
              'message'=> $message,
              'data'   => $data?:array(),
              'redirect_url' => $redirect_url
          ), JSON_UNESCAPED_UNICODE));

      }

}