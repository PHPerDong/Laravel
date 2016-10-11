<?php
namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/8
 * Time: 17:25
 */

class LoginController extends Controller{

    public function login(){
        return view('login');
    }


}