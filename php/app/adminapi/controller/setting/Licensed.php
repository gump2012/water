<?php

namespace app\adminapi\controller\setting;

use app\adminapi\AdminBaseController;
use app\service\admin\setting\ConfigService;
use app\service\admin\setting\LicensedService;
use think\App;
use think\Response;
use utils\Config as UtilsConfig;

/**
 * 授权
 */
class Licensed extends AdminBaseController
{
    protected LicensedService $licensedService;
    protected ConfigService $configService;

    /**
     * 构造函数
     *
     * @param App $app
     */
    public function __construct(App $app, LicensedService $licensedService, ConfigService $configService)
    {
        parent::__construct($app);
        $this->licensedService = $licensedService;
        $this->configService = $configService;
    }

    public function saveLicensed()
    {
        $data = $this->request->all();
        $result = $this->configService->save($data);
        if ($result) {
            return $this->success();
        } else {
            return $this->error(/** LANG */ '设置项更新失败');
        }
    }

    /**
     * 详情
     * @return Response
     */
    public function index(): Response
    {
        $item = app(ConfigService::class)->getConfigByBizCode([
            "licensedTypeName",
            "deCopyright",
            "isEnterprise",
            "authorizedDomain",
            "license",
        ]);
//        if ($item) {
//            $item['admin_dark_logo'] = UtilsConfig::get('adminDarkLogo');
//            $item['powered_by_status'] = UtilsConfig::get('poweredByStatus');
//            $item['powered_by'] = UtilsConfig::get('poweredBy', " - powered by tigshop");
//            $item['admin_light_logo'] = UtilsConfig::get('adminLightLogo');
//            $item['version_info_hidden'] = UtilsConfig::get('versionInfoHidden');
//        }
//        $item['version_type'] = config('app.version_type');
//        $item['version'] = config('app.version');
//        $item['shop_company'] = !empty($item['deCopyright']) ? UtilsConfig::get('shopCompany') : config('app.default_company');
        return $this->success(
            $item
        );
    }

    /**
     * 执行更新操作
     * @return Response
     */
    public function update(): Response
    {
        $data = $this->request->only([
            'license' => '',
        ], 'post');

        $result = $this->licensedService->update($data['license']);
        if ($result) {
            return $this->success();
        } else {
            return $this->error('更新失败');
        }
    }
}
