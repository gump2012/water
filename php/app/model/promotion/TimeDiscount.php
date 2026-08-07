<?php

namespace app\model\promotion;

use think\Model;
use utils\Time;

class TimeDiscount extends Model
{
    protected $pk = 'discount_id';
    protected $table = 'time_discount';

    protected $createTime = 'add_time';

    protected $autoWriteTimestamp = 'int';

    protected $append = ['status_name'];


    // 活动状态
    const PROMOTION_STATUS_ON = 1;
    const PROMOTION_STATUS_OFF = 2;
    const PROMOTION_STATUS_FORTHCOMING = 3;
    const PROMOTION_STATUS_NAME = [
        self::PROMOTION_STATUS_ON => '活动进行中',
        self::PROMOTION_STATUS_OFF => '活动已结束',
        self::PROMOTION_STATUS_FORTHCOMING => '活动未开始',
    ];

    public function getStatusNameAttr($value, $data)
    {
        if (!empty($data['start_time']) || !empty($data['end_time'])) {
            if (Time::now() < $data['start_time']) {
                return self::PROMOTION_STATUS_NAME[self::PROMOTION_STATUS_FORTHCOMING];
            } elseif (Time::now() > $data['end_time']) {
                return self::PROMOTION_STATUS_NAME[self::PROMOTION_STATUS_OFF];
            } else {
                return self::PROMOTION_STATUS_NAME[self::PROMOTION_STATUS_ON];
            }
        }
        return "--";
    }

    // 秒杀时间
    public function getStartTimeAttr($value)
    {
        return Time::format($value);
    }

    public function getEndTimeAttr($value)
    {
        return Time::format($value);
    }

    public function item()
    {
        return $this->hasMany(TimeDiscountItem::class, 'discount_id', 'discount_id');
    }

    public function promotion()
    {
        return $this->morphOne(Promotion::class, 'type');
    }
}
