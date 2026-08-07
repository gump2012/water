<?php

namespace app\model\setting;

use think\Model;

class MessageType extends Model
{
    protected $pk = 'message_id';
    protected $table = 'message_type';
    protected $createTime = "add_time";
    protected $autoWriteTimestamp = true;

    public function templateMessage()
    {
        return $this->hasMany(MessageTemplate::class, 'message_id', 'message_id')->append(["type_name"]);
    }
}
