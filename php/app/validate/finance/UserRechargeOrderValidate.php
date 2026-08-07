<?php

namespace app\validate\finance;

use think\Validate;

class UserRechargeOrderValidate extends Validate
{
    protected $rule = [
        'postscript' => 'max:100',
    ];

    protected $message = [
        'postscript.max' => '充值申请名称最多100个字符',
    ];
}
