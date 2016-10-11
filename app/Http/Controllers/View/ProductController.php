<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/9
 * Time: 17:46
 */

namespace App\Http\Controllers\View;
use App\Entity\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller{

    public function prductlist($parent_id=""){

        $categorys = Product::where('category_id',$parent_id)->get();
        return view('productlist')->with('categorys',$categorys);

    }

    public function productContent(Request $request, $id=""){
        $categorys = Product::find($id);

        //用户登入状态下的操作



        //用户未登入的操作

        $bk_cart = $request->cookie('bk_cart');
        //return $bk_cart;
        $bk_cart_arr = ($bk_cart!=null ? explode(',', $bk_cart) : array());
        $count = 1;
        foreach ($bk_cart_arr as $value) {
            $index = strpos($value, ':');//
            if(substr($value, 0, $index) == $id) {//得到数量对应的商品ID
                $count = ((int) substr($value, $index+1));//商品的数量
                break;
            }
        }

        return view('product_content')->with('categorys',$categorys)
                                      ->with('count', $count);
    }




}