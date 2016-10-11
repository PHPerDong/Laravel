<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/9
 * Time: 17:46
 */

namespace App\Http\Controllers\View;
use App\Entity\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller{

    public function category(){

        $categorys = Category::where('parent_id',0)->get();
        return view('category')->with('categorys',$categorys);

    }




}