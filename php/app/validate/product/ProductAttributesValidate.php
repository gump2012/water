<?php

namespace app\validate\product;

use think\Validate;

class ProductAttributesValidate extends Validate
{
    protected $rule = [
        'attr_name' => 'require|max:100',
    ];

    protected $message = [
        'attr_name.require' => '商品属性名称不能为空',
        'attr_name.max' => '商品属性名称最多100个字符',
    ];
}
