<?php

namespace app\service\admin\finance;

use app\model\finance\UserBalanceLog;
use app\model\finance\UserRechargeOrder;
use app\model\finance\UserWithdrawApply;
use app\model\order\Order;
use app\service\common\BaseService;

/**
 * 账户资金
 */
class AccountPanelService extends BaseService
{

    public function __construct()
    {
    }

    /**
     * 资金统计
     * @param array $filter
     * @return array
     */
    public function getFilterResult(array $filter): array
    {
        $search_date = [];
        if (isset($filter['search_start_date'], $filter['search_end_date']) && !empty($filter["search_start_date"]) && !empty($filter["search_end_date"])) {
            $search_date = [$filter["search_start_date"], $filter["search_end_date"]];
        }
        // 获取充值总额
        $account = [];
        $account['voucher_amount'] = UserRechargeOrder::where(["status" => UserRechargeOrder::STATUS_SUCCESS])
            ->paidTime($search_date)
            ->sum("amount");
        // 提现总额
        $account['to_cash_amount'] = UserWithdrawApply::where(["status" => UserWithdrawApply::STATUS_FINISHED])
            ->finishedTime($search_date)
            ->sum("amount");
        //会员余额变化金额
        $account['balance'] = UserBalanceLog::changeTime($search_date)
            ->sum("balance");
        //会员冻结金额
        $account['frozen_money'] = UserBalanceLog::changeTime($search_date)
            ->sum("frozen_balance");
        //交易使用余额
        $account['surplus'] = Order::addTime($search_date)
            ->sum("balance");
        //积分使用余额
        $account['use_points'] = Order::addTime($search_date)
            ->sum("use_points");
        return $account;
    }
}
