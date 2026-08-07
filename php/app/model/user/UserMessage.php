<?php

namespace app\model\user;

use think\Model;
use utils\Time;
use utils\Util;

class UserMessage extends Model
{
    protected $pk = 'message_id';
    protected $table = 'user_message';

    protected $createTime = "add_time";
    protected $autoWriteTimestamp = true;

    public function getAddTimeDateAttr($value, $data)
    {
        return Time::format($data['add_time'], 'Y-m-d');
    }

    public function getAddTimeHmsAttr($value, $data)
    {
        return Time::format($data['add_time'], 'H:i:s');
    }

    public function getTitleAttr($value, $data)
    {

        if (php_sapi_name() != 'cli' && !empty(request()->header('X-Locale-Code'))) {
            $cache = Util::lang($value);
            if ($cache) {
                return $cache;
            } else {

                return $value;
            }
        } else {
            return $value;
        }
    }

    public function getContentAttr($value, $data)
    {
        if (php_sapi_name() != 'cli' && !empty(request()->header('X-Locale-Code'))) {
            $cache = Util::lang($value);
            if ($cache) {
                return $cache;
            } else {

                return $value;
            }
        } else {
            return $value;
        }
    }
}
