<?php

namespace app\service\front\common;

use app\service\common\BaseService;
use exceptions\ApiException;
use Overtrue\Socialite\SocialiteManager;
use utils\Config as UtilsConfig;

/**
 * 收藏店铺服务类
 */
class SocialiteService extends BaseService
{

    //配置
    public $config = [];

    public $socialite = null;

    public $source = '';

    public function __construct($source, $redirect = '')
    {
        $this->source = $source;
        if ($source == 'google') {
            if (UtilsConfig::get('googleLoginOn') != 1) {
                throw new ApiException('google关联登录未开启');
            }
            $this->config = [
                'client_id' => UtilsConfig::get('googleClientId'),
                'client_secret' => UtilsConfig::get('googleClientSecret'),
                'redirect' => $redirect,
            ];
        } elseif ($source == 'facebook') {
            if (UtilsConfig::get('facebookLoginOn') != 1) {
                throw new ApiException('facebook关联登录未开启');
            }
            $this->config = [
                'client_id' => UtilsConfig::get('facebookClientId'),
                'client_secret' => UtilsConfig::get('facebookClientSecret'),
                'redirect' => $redirect,
            ];
        }
        $this->socialite = new SocialiteManager([$source => $this->config]);
    }

    /**
     * 获取授权地址
     * @return string
     */
    public function getAuthUrl()
    {
        return $this->socialite->create($this->source)->redirect();
    }

    /**
     * 通过code获取用户信息
     * @param $code 授权码
     * @return \Overtrue\Socialite\Contracts\UserInterface
     */
    public function userFromCode($code)
    {
        return $this->socialite->create($this->source)->userFromCode($code);
    }


}
