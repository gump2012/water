<?php

namespace app\validate\setting;

use think\Validate;

class MessageTypeValidate extends Validate
{
    protected $rule = [
//        'name' => 'require|max:100',
    ];

    protected $message = [
        'name.require' => '消息设置名称不能为空',
        'name.max' => '消息设置名称最多100个字符',
    ];
}
