<?php

namespace app\validate\promotion;

use think\Validate;

class CouponValidate extends Validate
{
    protected $rule = [
        'coupon_name' => 'require|max:100',
        "coupon_discount" => "check_discount",
    ];

    protected $message = [
        'coupon_name.require' => '优惠券名称不能为空',
        'coupon_name.max' => '优惠券名称最多100个字符',
        'coupon_discount.check_discount' => '请输入0.1-9.9之间的折扣（保留小数点后一位）',
    ];

    protected $scene = [
        'create' => [
            'coupon_name',
            'coupon_discount'
        ],
        'update' => [
            'coupon_name',
            'coupon_discount'
        ],
    ];

    /**
     * 折扣格式验证 -- 取值在0.1 - 9.9 支持整数
     * @param $value
     * @return bool
     */
    public function check_discount($value)
    {
        // 使用正则表达式验证数值格式
        $pattern = '/^[0-9](\.[0-9])?$/';
        if (!preg_match($pattern, $value)) {
            return false; // 数值格式不符合要求
        }
        // 转换为浮点数并检查范围
        $floatNumber = floatval($value);
        if ($floatNumber >= 0.1 && $floatNumber <= 9.9) {
            return true; // 数值在范围内
        } else {
            return false; // 数值不在范围内
        }

    }
}
