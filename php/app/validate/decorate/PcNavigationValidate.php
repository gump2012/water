<?php

namespace app\validate\decorate;

use app\model\decorate\PcNavigation;
use think\Validate;

class PcNavigationValidate extends Validate
{
    protected $rule = [
        'title' => 'require|max:100',
        'url' => 'require',
    ];

    protected $message = [
        'title.require' => '名称不能为空',
        'title.max' => '名称最多100个字符',
        'url.require' => '链接地址不能为空',
    ];

    protected $scene = [
        'create' => [
            'title',
        ],
        'update' => [
            'title',
        ],
    ];


    // 验证唯一
    public function checkUnique($value, $rule, $data = [], $field = '')
    {
        $id = isset($data['id']) ? $data['id'] : 0;
		$query = PcNavigation::where($field, $value)->where('id', '<>', $id);
        return $query->count() === 0;
    }
}
