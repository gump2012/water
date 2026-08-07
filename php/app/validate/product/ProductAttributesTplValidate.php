<?php

namespace app\validate\product;

use think\Validate;

class ProductAttributesTplValidate extends Validate
{
    protected $rule = [
        'tpl_name' => 'require|max:100',
    ];

    protected $message = [
        'tpl_name.require' => '商品属性模板名称不能为空',
        'tpl_name.max' => '商品属性模板名称最多100个字符',
    ];
}
