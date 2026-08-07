<?php

namespace app\validate\authority;

use think\Validate;

class AdminLogValidate extends Validate
{
    protected $rule = [
        'log_info' => 'require|max:100',
    ];

    protected $message = [
        'log_info.require' => '管理员日志名称不能为空',
        'log_info.max' => '管理员日志名称最多100个字符',
    ];
}
