<?php

namespace app\api\controller\common;

use app\api\IndexBaseController;
use app\service\admin\sys\StatisticsService;
use app\service\api\admin\common\TranslationsService;
use think\App;
use think\Response;

/**
 * log控制器
 */
class Log extends IndexBaseController
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
     *
     *
     * @return Response
     */
    public function index(): Response
    {
        $data = request()->all();
        $data['user'] = request()->userId ? request()->userId : request()->ip();

        app(StatisticsService::class)->log($data);
        return $this->success();
    }

}
