<?php
namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/8
 * Time: 17:41
 */

class RegisterController extends Controller{

    public function register(){

        return view("register");

    }

}