<?php

namespace app\model\order;

use think\Model;

class AftersalesLog extends Model
{
    protected $pk = 'log_id';
    protected $table = 'aftersales_log';
    protected $createTime = "add_time";
    protected $autoWriteTimestamp = true;
    protected $json = ['return_pic'];
    protected $jsonAssoc = true;

    public function getReturnPicAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }

    public function setReturnPicAttr($value)
    {
        if (empty($value)) {
            return $value;
        }
        return camelCase($value);
    }
}
