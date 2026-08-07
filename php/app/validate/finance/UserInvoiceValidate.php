<?php

namespace app\validate\finance;

use think\Validate;

class UserInvoiceValidate extends Validate
{
    protected $rule = [
        'company_name' => 'require|max:100',
    ];

    protected $message = [
        'company_name.require' => '增票资质申请名称不能为空',
        'company_name.max' => '增票资质申请名称最多100个字符',
    ];
}
