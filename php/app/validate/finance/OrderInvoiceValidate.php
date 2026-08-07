<?php

namespace app\validate\finance;

use think\Validate;

class OrderInvoiceValidate extends Validate
{
    protected $rule = [
        'company_name' => 'require|max:100',
        'amount' =>  'regex:/^\d{1,15}(\.\d{1,2})?$/',
    ];

    protected $message = [
        'company_name.require' => '发票申请名称不能为空',
        'company_name.max' => '发票申请名称最多100个字符',
        'amount.regex' => '发票金额格式错误'
    ];

    protected $scene = [
        'update' => ['amount']
    ];
}
