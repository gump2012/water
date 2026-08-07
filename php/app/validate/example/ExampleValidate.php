<?php

namespace app\validate\example;

use think\Validate;

class ExampleValidate extends Validate
{
    protected $rule = [
        'example_id' => 'require',
        'example_name' => 'require|max:10',
        'example_others' => 'checkOther',
    ];

    protected $message = [
        'example_id.require' => 'id不能为空',
        'example_name.require' => '示例模板名称不能为空',
        'example_name.max' => '示例模板名称最多100个字符',
    ];

    protected $scene = [
        'create' => [
            'example_name',
            'example_others',
        ],
        'update' => [
            'example_id',
            'example_name',
            'example_others',
        ],
        'delete' => [
            'example_id',
        ],
    ];

    protected function checkOther($vale, $rule, $data = []): bool
    {
        //特殊要求的校验

        return true;
    }
}
