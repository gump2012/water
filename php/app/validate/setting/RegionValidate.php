<?php

namespace app\validate\setting;

use app\model\setting\Region;
use think\Validate;

class RegionValidate extends Validate
{
    protected $rule = [
        'region_name' => 'require|checkUnique|max:100',
        'parent_id' => 'require',
    ];

    protected $message = [
        'region_name.require' => '地区名称不能为空',
        'region_name.max' => '地区名称最多100个字符',
        'parent_id.require' => '上级地区不能为空',
        'region_name.checkUnique' => '地区名称已存在',
    ];

    protected $scene = [
        'create' => [
            'region_name',
            'parent_id'
        ],
        'update' => [
            'region_name',
            'parent_id'
        ],
    ];

    //验证唯一
    protected function checkUnique($value, $rule, $data = [], $field = '')
    {
        $id = isset($data['region_id']) ? $data['region_id'] : 0;
        $query = Region::where('region_name', $value)->where('region_id', '<>', $id);
        return $query->count() === 0;
    }
}
