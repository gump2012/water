<?php

namespace app\validate\decorate;

use think\Validate;

class DecorateValidate extends Validate
{
    protected $rule = [
        'decorate_title' => 'require|max:100',
    ];

    protected $message = [
        'decorate_title.require' => '装修名称不能为空',
        'decorate_title.max' => '装修名称最多100个字符',
    ];

    protected $scene = [
        'create' => [
            'decorate_title',
        ],
        'update' => [
            'decorate_title',
        ],
    ];
}
