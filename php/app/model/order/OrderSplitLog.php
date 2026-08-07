<?php

namespace app\model\order;

use think\Model;

class OrderSplitLog extends Model
{
    protected $pk = 'log_id';
    protected $table = 'order_split_log';
    protected $json = ['parent_order_data'];

    public function getParentOrderDataAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }

    public function setParentOrderDataAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }

}
