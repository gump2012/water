<?php

namespace app\adminapi\controller\order;

use app\adminapi\AdminBaseController;
use app\service\admin\order\OrderLogService;
use think\App;

/**
 * 订单日志控制器
 */
class OrderLog extends AdminBaseController
{
    protected OrderLogService $orderLogService;

    /**
     * 构造函数
     *
     * @param App $app
     * @param OrderLogService $orderLogService
     */
    public function __construct(App $app, OrderLogService $orderLogService)
    {
        parent::__construct($app);
        $this->orderLogService = $orderLogService;
        $this->checkAuthor('orderLogManage'); //权限检查
    }

    /**
     * 列表页面
     *
     * @return \think\Response
     */
    public function list(): \think\Response
    {
        $filter = $this->request->only([
            'keyword' => '',
            'order_id/d' => 0,
            'page/d' => 1,
            'size/d' => 15,
            'sort_field' => 'log_id',
            'sort_order' => 'desc',
        ], 'get');

        $filterResult = $this->orderLogService->getFilterResult($filter);
        $total = $this->orderLogService->getFilterCount($filter);

        return $this->success([
            'records' => $filterResult,
            'total' => $total,
        ]);
    }

    /**
     * 执行添加操作
     *
     * @return \think\Response
     */
    public function create(): \think\Response
    {
        $data = $this->request->only([
            'description' => '',
            'order_id/d' => 0,
            'order_sn' => ''
        ], 'post');

        $result = $this->orderLogService->addOrderLog($data);
        if ($result) {
            return $this->success();
        } else {
            return $this->error('订单日志添加失败');
        }
    }
}
