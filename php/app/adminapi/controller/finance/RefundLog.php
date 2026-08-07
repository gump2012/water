<?php

namespace app\adminapi\controller\finance;

use app\adminapi\AdminBaseController;
use app\service\admin\finance\RefundLogService;
use think\App;
use think\Response;

/**
 * 退款申请控制器
 */
class RefundLog extends AdminBaseController
{
    protected RefundLogService $refundLogService;

    /**
     * 构造函数
     *
     * @param App $app
     * @param RefundLogService $refundLogService
     */
    public function __construct(App $app, RefundLogService $refundLogService)
    {
        parent::__construct($app);
        $this->refundLogService = $refundLogService;
        $this->checkAuthor('refundApplyManage'); //权限检查
    }

    /**
     * 列表页面
     *
     * @return Response
     */
    public function list(): Response
    {
        $filter = $this->request->only([
            'page/d' => 1,
            'size/d' => 15,
            'keyword' => '',
            'type/d' => -1,
            'sort_field' => 'log_id',
            'sort_order' => 'desc',
        ], 'get');

        $filterResult = $this->refundLogService->getFilterResult($filter);
        $total = $this->refundLogService->getFilterCount($filter);

        return $this->success([
            'records' => $filterResult,
            'total' => $total,
        ]);
    }


}
