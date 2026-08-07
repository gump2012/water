<?php

namespace app\model\finance;

use think\Model;

class PaylogRefund extends Model
{
    protected $pk = 'refund_id';
    protected $table = 'paylog_refund';
    protected $createTime = "add_time";
    protected $autoWriteTimestamp = true;
}
