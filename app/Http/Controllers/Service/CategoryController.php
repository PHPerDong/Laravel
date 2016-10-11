<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/9
 * Time: 17:46
 */

namespace App\Http\Controllers\Service;
use App\Entity\Category;
use App\Http\Controllers\Controller;
use App\Api\ApiCode;

class CategoryController extends Controller{

    public function getCategoryByParentId($parent_id=""){

        $categorys = Category::where('parent_id', $parent_id)->get();
        $api = new ApiCode();
        return $api->api(200,'','',$categorys);

    }




}