<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/9
 * Time: 17:46
 */

namespace App\Http\Controllers\Service;
use App\Entity\Product;
use App\Http\Controllers\Controller;
use App\Api\ApiCode;
//use App\Http\Requests\Request;
use Illuminate\Http\Request;

class CartController extends Controller{

    public function addCart(Request $request, $product_id=""){
        //$response = new Response();
        $bk_cart = $request->cookie('bk_cart');
        //return $bk_cart;
        $bk_cart_arr = ($bk_cart!=null ? explode(',', $bk_cart) : array());
        $count = 1;
        foreach ($bk_cart_arr as &$value) {   // 一定要传引用
            $index = strpos($value, ':');
            if(substr($value, 0, $index) == $product_id) {
                $count = ((int) substr($value, $index+1)) + 1;
                $value = $product_id . ':' . $count;
                break;
            }
        }
        if($count == 1) {
            array_push($bk_cart_arr, $product_id . ':' . $count);
        }
        //var_dump($bk_cart_arr);
        //$request->session()->push('bk_cart',implode(',', $bk_cart_arr));

         $api = new ApiCode();
        //return response($api->api(200))->withCookie('bk_cart', implode(',', $bk_cart_arr));
         $data['code']=200;
         $data = json_encode($data);
         return response($data)->withCookie(cookie('bk_cart',implode(',', $bk_cart_arr)));
         //return ;

    }


    public function cart(Request $request){


        //用户为登入的操作
        $bk_cart = $request->cookie('bk_cart');
        $bk_cart_arr = $bk_cart != null ? explode(',', $bk_cart) : array();
        if(empty($bk_cart_arr)){
            return "购物车空空如也";
        }
        foreach ($bk_cart_arr as $key => $value){
            $index = strpos($value, ":");
            $count = ((int)substr($value, $index+1));
            $id = substr($value, 0 ,$index);
            $product     = new Product();

            $cart_items[$key]  = $product::find($id);
            $cart_items[$key]['num']  = $count;
        }
        //dd($cart_items);die();
        return view('cart')->with('cart_items',$cart_items);

    }






}