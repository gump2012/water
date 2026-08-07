<?php

namespace app\validate\shipping;

use think\Validate;

class ShippingTplValidate extends Validate
{
    protected $rule = [
        'shipping_tpl_name' => 'require|max:100',
    ];

    protected $message = [
        'shipping_tpl_name.require' => '商品规格名称不能为空',
        'shipping_tpl_name.max' => '商品规格名称最多100个字符',
    ];
}
