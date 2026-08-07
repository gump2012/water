<?php

namespace app\adminapi\controller\finance;

use app\adminapi\AdminBaseController;
use app\service\admin\finance\AccountPanelService;
use think\App;
use think\response\Json;

/**
 * 账户资金面板控制器
 */
class AccountPanel extends AdminBaseController
{
    protected AccountPanelService $accountPanelService;

    /**
     * 构造函数
     *
     * @param App $app
     * @param AccountPanelService $accountPanelService
     */
    public function __construct(App $app, AccountPanelService $accountPanelService)
    {
        parent::__construct($app);
        $this->accountPanelService = $accountPanelService;
        $this->checkAuthor('accountPanel'); //权限检查
    }

    /**
     * 列表页面
     *
     * @return Json
     */
    public function list(): Json
    {
        $filter = $this->request->only([
            'search_start_date' => "",
            'search_end_date' => "",
        ], 'get');

        $filterResult = $this->accountPanelService->getFilterResult($filter);

        return $this->success(
            $filterResult
        );
    }

}
