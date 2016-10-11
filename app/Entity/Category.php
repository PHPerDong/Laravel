<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/8
 * Time: 12:39
 */

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;


class Category extends Model{

      protected $table      = "category";//指定数据库表
      protected $primaryKey = "id";//指定数据库主键
      public $timestamps    = false;//时间

}