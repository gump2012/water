<?php

namespace app\model\setting;

use think\Model;

class ShippingTplInfo extends Model
{
    protected $pk = 'id';
    protected $table = 'shipping_tpl_info';

    protected $json = ['region_data'];
    protected $jsonAssoc = true;

    public function shippingType()
    {
        return $this->hasOne(ShippingType::class, 'shipping_type_id', 'shipping_type_id')->bind(["shipping_type_name"]);
    }

    public function getRegionDataAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }

    public function setRegionDataAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }
}
