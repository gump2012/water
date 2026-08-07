<?php
namespace app\adminapi\controller\common;

use app\BaseController;
use think\facade\Cache;
use tig\CacheManager;
use utils\Config as UtilsConfig;

class TipsManage extends BaseController
{

    public function __construct()
    {
    }

    public function list()
    {
        $url = request()->get('url');
        $pcDomain = UtilsConfig::get('pcDomain');
        if ($url && str_contains($url, $pcDomain)) {
            $domainBindStatus = true;
        } else {
            $domainBindStatus = false;
        }
        //密码过于简单
        $result = [];
        if (Cache::get('password_too_simple:' . request()->adminUid)) {
            $passwordTooSimpleStatus = true;
        } else {
            $passwordTooSimpleStatus = false;
        }
        $result[] = [
            'code' => 'passwordTooSimple',
            'status' => $passwordTooSimpleStatus
        ];
        $result[] = [
            'code' => 'domainBind',
            'status' => $domainBindStatus
        ];
        return $this->success($result);
    }
}
