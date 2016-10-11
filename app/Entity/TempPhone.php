<?php
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/9
 * Time: 9:53
 */

class TempPhone extends Model{

    protected $table      = "temp_phone";
    protected $primaryKey = "id";
    public $timestamps    = false;

}