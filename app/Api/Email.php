<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/9
 * Time: 15:51
 */

namespace App\Api;


class Email{

    public $from;  // 发件人邮箱
    public $to; // 收件人邮箱
    public $cc; // 抄送
    public $attach; // 附件
    public $subject; // 主题
    public $content; // 内容

}