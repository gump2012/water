<?php

namespace app\model\msg;

use think\Model;

class SmsLog extends Model
{
    protected $pk = 'sms_id';
    protected $table = 'sms_log';
    protected $createTime = "send_time";
    protected $autoWriteTimestamp = true;

}
