<?php

namespace app\model\user;

use think\Model;

class UserGrowthPointsLog extends Model
{
    protected $pk = 'log_id';
    protected $table = 'user_growth_points_log';
    protected $createTime = 'change_time';
    protected $autoWriteTimestamp = true;

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id')->bind(["username"]);
    }
}
