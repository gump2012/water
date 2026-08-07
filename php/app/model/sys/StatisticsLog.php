<?php

namespace app\model\sys;

use think\Model;
use utils\Time;

class StatisticsLog extends Model
{
    protected $pk = 'id';
    protected $table = 'statistics_log';
    protected $createTime = "access_time";
    protected $autoWriteTimestamp = true;


}
