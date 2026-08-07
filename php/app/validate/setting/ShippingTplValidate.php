<?php

namespace app\validate\setting;

use think\Validate;

class ShippingTplValidate extends Validate
{
    protected $rule = [
        'shipping_tpl_name' => 'require|max:100',
    ];

    protected $message = [
        'shipping_tpl_name.require' => '运费模板名称不能为空',
        'shipping_tpl_name.max' => '运费模板名称最多100个字符',
    ];

    protected $scene = [
        'create' => [
            'shipping_tpl_name',
        ],
        'update' => [
            'shipping_tpl_name',
        ],
    ];
}
