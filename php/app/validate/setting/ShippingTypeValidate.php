<?php

namespace app\validate\setting;

use think\Validate;

class ShippingTypeValidate extends Validate
{
    protected $rule = [
        'shipping_type_name' => 'require|max:100',
    ];

    protected $message = [
        'shipping_type_name.require' => '配送类型名称不能为空',
        'shipping_type_name.max' => '配送类型名称最多100个字符',
    ];

    protected $scene = [
        'create' => [
            'shipping_type_name',
        ],
        'update' => [
            'shipping_type_name',
        ],
    ];
}
