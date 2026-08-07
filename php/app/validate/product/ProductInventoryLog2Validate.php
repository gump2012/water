<?php

namespace app\validate\product;

use think\Validate;

class ProductInventoryLog2Validate extends Validate
{
    protected $rule = [
    ];

    protected $message = [
        'inventory_log_name.require' => '商品库存日志名称不能为空',
        'inventory_log_name.max' => '商品库存日志名称最多100个字符',
    ];
}
