<?php

namespace app\validate\shop;

use think\Validate;

class ShopValidate extends Validate
{
    protected $rule = [
        'shop_title' => 'require|max:100',
    ];

    protected $message = [
        'shop_title.require' => '店铺名称不能为空',
        'shop_title.max' => '店铺名称最多100个字符',
    ];
}
