<?php

namespace app\model\product;

use think\Model;
use utils\Util;

class ProductServices extends Model
{
    protected $pk = 'product_service_id';
    protected $table = 'product_services';

    public function getProductServiceNameAttr($value, $data)
    {
        if (empty($value)) {
            return $value;
        }
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
