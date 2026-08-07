<?php

namespace app\api\controller\common;

use app\api\IndexBaseController;
use think\App;
use think\Response;

/**
 * 首页控制器
 */
class Index extends IndexBaseController
{
    /**
     * 构造函数
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * 首页
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->success([
        ]);
    }

}
