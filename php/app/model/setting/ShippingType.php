<?php

namespace app\model\setting;

use think\Model;
use utils\Util;

class ShippingType extends Model
{
    protected $pk = 'shipping_type_id';
    protected $table = 'shipping_type';
    public function logisticsCompany()
    {
        return $this->hasOne(LogisticsCompany::class, 'logistics_id', 'shipping_default_id')->bind(["logistics_name"]);
    }

    public function getShippingTypeNameAttr($value, $data)
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


    public function getShippingTimeDescAttr($value, $data)
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
