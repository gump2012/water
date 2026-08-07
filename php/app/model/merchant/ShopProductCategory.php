<?php

namespace app\model\merchant;

use app\model\user\User;
use think\Model;
use utils\Time;
use utils\Util;

class ShopProductCategory extends Model
{
    protected $pk = 'category_id';
    protected $table = 'shop_product_category';

    protected $createTime = 'add_time';
    protected $autoWriteTimestamp = 'int';

    // 字段处理
    public function getAddTimeAttr($value): string
    {
        return Time::format($value);
    }


    public function getCategoryNameAttr($value, $data)
    {

        if (php_sapi_name() != 'cli' && !empty(request()->header('X-Locale-Code'))) {
            $cache = Util::lang($value);
            if ($cache) {
                return $cache;
            } else {

                return $value;
            }
        } else {
            return $value;
        }
    }


}
