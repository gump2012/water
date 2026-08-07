<?php

namespace app\model\authority;

use think\Model;

class Authority extends Model
{
    protected $pk = 'authority_id';
    protected $table = 'authority';
    protected $json = ['child_auth'];
    // 设置JSON数据返回数组
    protected $jsonAssoc = true;


    public function getChildAuthAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }

    public function setChildAuthAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }
}
