<?php

namespace app\validate\finance;

use think\Validate;

class UserWithdrawApplyValidate extends Validate
{
    protected $rule = [
        'postscript' => 'max:80',
    ];

    protected $message = [
        'postscript.max' => '管理员备注最多80个字符',
    ];

    protected $scene = [
        'create' => [
            'postscript',
        ],
        'update' => [
            'postscript',
        ],
    ];
}
