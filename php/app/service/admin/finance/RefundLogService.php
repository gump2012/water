<?php

namespace app\service\admin\finance;

use app\model\finance\RefundApply;
use app\model\finance\RefundLog;
use app\model\order\Aftersales;
use app\service\common\BaseService;

/**
 * 退款记录服务类
 */
class RefundLogService extends BaseService
{

    public function __construct()
    {
    }

    /**
     * 获取筛选结果
     *
     * @param array $filter
     * @return array
     */
    public function getFilterResult(array $filter): array
    {
        $query = $this->filterQuery($filter)->with(["refund" => ['aftersales']]);
        $result = $query->page($filter['page'], $filter['size'])->select();

        return $result->toArray();
    }

    /**
     * 获取筛选结果数量
     *
     * @param array $filter
     * @return int
     */
    public function getFilterCount(array $filter): int
    {
        $query = $this->filterQuery($filter);
        $count = $query->count();
        return $count;
    }

    /**
     * 筛选查询
     *
     * @param array $filter
     * @return object
     */
    public function filterQuery(array $filter): object
    {
        $query = RefundLog::query();
        // 处理筛选条件

        if(isset($filter['keyword']) && !empty($filter['keyword'])) {
            // 使用子查询优化，只执行一次数据库查询
            $subQuery = RefundLog::alias('rl')
                ->join('refund_apply ra', 'ra.refund_id = rl.refund_apply_id')
                ->join('aftersales a', 'a.aftersale_id = ra.aftersale_id')
                ->where('a.aftersales_sn', 'like', "%{$filter['keyword']}%")
                ->column('rl.log_id');

            if (!empty($subQuery)) {
                $query->whereIn('log_id', $subQuery);
            } else {
                $query->where('log_id', 0); // 没有匹配结果时返回空结果
            }
        }


        if(isset($filter['type']) && $filter['type'] > -1) {
            $query->where('refund_type', $filter['type']);
        }


        if (isset($filter['sort_field'], $filter['sort_order']) && !empty($filter['sort_field']) && !empty($filter['sort_order'])) {
            $query->order($filter['sort_field'], $filter['sort_order']);
        }
        return $query;
    }


}
