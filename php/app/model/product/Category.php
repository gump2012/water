<?php

namespace app\model\product;

use think\Model;
use utils\Util;

class Category extends Model
{
    protected $pk = 'category_id';
    protected $table = 'category';

//    public function getCategoryNameAttr($value, $data)
//    {
//
//        if (php_sapi_name() != 'cli' && !empty(request()->header('X-Locale-Code'))) {
//            $cache = Util::lang($value, '', [], 3);
//            if ($cache) {
//                return $cache;
//            } else {
//
//                return $value;
//            }
//        } else {
//            return $value;
//        }
//    }
}
