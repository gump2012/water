<?php

namespace app\validate\order;

use think\Validate;

class AftersalesValidate extends Validate
{
    protected $rule = [
        'aftersales_name' => 'require|max:100',
    ];

    protected $message = [
        'aftersales_name.require' => '退换货名称不能为空',
        'aftersales_name.max' => '退换货名称最多100个字符',
    ];
}
