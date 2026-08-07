<?php


namespace app\adminapi\controller\print;

use app\adminapi\AdminBaseController;
use app\service\admin\print\PrintService;
use think\App;

/**
 * 打印机控制器
 */
class PrintConfig extends AdminBaseController
{
    protected PrintService $printService;

    /**
     * 构造函数
     *
     * @param App $app
     * @param PrintService $printService
     */
    public function __construct(App $app, PrintService $printService)
    {
        parent::__construct($app);
        $this->printService = $printService;
    }

    public function update()
    {
        $id = $this->request->post('id/d', 0);
        if ($id <= 0) {
            return $this->error('无效的ID');
        }

        $requestData = $this->request->only([
            'template' => [],
        ]);
        $requestData['template'] = camelCase($requestData['template']);
        $result = $this->printService->updateConfigs($id,$requestData);
        return $this->success($result);
    }

    public function print()
    {
        $ids = $this->request->post('ids', []);
        if (empty($ids)) {
            return $this->error('无效的ID');
        }
        $shop_id = request()->shopId;
        $result = $this->printService->printOrder($shop_id,$ids);
        return $this->success($result);

    }


    public function getConfigsByPrintId()
    {
        $id = $this->request->get('print_id/d', 0);
        if ($id <= 0) {
            return $this->error('无效的ID');
        }
        $result = $this->printService->getConfigsByPrintId($id);
        $result['typeDesc'] = $this->printService->getPrintTypeDesc($result['type']);
        return $this->success($result);
    }

}