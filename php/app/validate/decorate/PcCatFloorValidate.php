<?php

namespace app\validate\decorate;

use think\Validate;

class PcCatFloorValidate extends Validate
{
    protected $rule = [
        'category_ids' => "require",
    ];

    protected $message = [
        'category_ids.require' => '分类不能为空',
    ];

    protected $scene = [
        'create' => [
            'category_ids',
        ],
        'update' => [
            'category_ids',
        ],
    ];
}
