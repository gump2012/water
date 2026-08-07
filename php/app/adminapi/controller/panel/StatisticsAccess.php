<?php

namespace app\adminapi\controller\panel;

use app\adminapi\AdminBaseController;
use app\service\admin\panel\StatisticsAccessService;
use think\App;
use think\Response;

/**
 * 新增会员统计控制器
 */
class StatisticsAccess extends AdminBaseController
{
    protected StatisticsAccessService $statisticsAccessService;

    /**
     * 构造函数
     *
     * @param App $app
     */
    public function __construct(App $app, StatisticsAccessService $statisticsAccessService)
    {
        parent::__construct($app);
        $this->statisticsAccessService = $statisticsAccessService;
        $this->checkAuthor('statisticsAccessManage'); //权限检查
    }

    /**
     * 访问统计
     * @return Response
     * @throws \exceptions\ApiException
     */
    public function accessStatistics(): Response
    {
        $filter = $this->request->only([
            "is_hits/d" => 1,
            "start_time" => "",
            "end_time" => "",
        ], 'get');
        $filter["shop_id"] = $this->shopId;

        $filterResult = $this->statisticsAccessService->getAccessStatistics($filter);

        return $this->success(
           $filterResult
        );
    }
}
