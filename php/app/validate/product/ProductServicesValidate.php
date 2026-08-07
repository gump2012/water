<?php

namespace app\validate\product;

use think\Validate;

class ProductServicesValidate extends Validate
{
    protected $rule = [
        'product_service_name' => 'require|max:100',
    ];

    protected $message = [
        'product_service_name.require' => '商品服务名称不能为空',
        'product_service_name.max' => '商品服务名称最多100个字符',
    ];
}
