<?php

namespace app\validate\setting;

use think\Validate;

class LogisticsCompanyValidate extends Validate
{
    protected $rule = [
        'logistics_name' => 'require|max:100',
    ];

    protected $message = [
        'logistics_name.require' => '物流公司名称不能为空',
        'logistics_name.max' => '物流公司名称最多100个字符',
    ];

    protected $scene = [
        'create' => [
            'logistics_name',
        ],
        'update' => [
            'logistics_name',
        ],
    ];
}
