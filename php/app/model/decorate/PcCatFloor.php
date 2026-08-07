<?php

namespace app\model\decorate;

use think\Model;
use utils\Util;

class PcCatFloor extends Model
{
    protected $pk = 'cat_floor_id';
    protected $table = 'pc_cat_floor';
    protected $json = ["category_ids", "category_names", "brand_ids"];
    protected $jsonAssoc = true;

    public function getCategoryNamesAttr($value, $data)
    {

        if (php_sapi_name() != 'cli' && !empty(request()->header('X-Locale-Code'))) {
            foreach ($value as &$v) {
                $v = Util::lang($v);
            }
            return $value;
        } else {
            return $value;
        }
    }
}
