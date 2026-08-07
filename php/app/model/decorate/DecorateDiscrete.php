<?php

namespace app\model\decorate;

use think\Model;

class DecorateDiscrete extends Model
{
    protected $pk = 'id';
    protected $table = 'decorate_discrete';
    protected $json = ['data'];
    protected $jsonAssoc = true;

    public function getDataAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }

    public function setDataAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }
}
