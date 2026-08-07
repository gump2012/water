<?php

namespace app\validate\order;

use think\Validate;

class OrderLogValidate extends Validate
{
    protected $rule = [
        'description' => 'require|max:100',
    ];

    protected $message = [
        'description.require' => '订单日志名称不能为空',
        'description.max' => '订单日志名称最多100个字符',
    ];
}
