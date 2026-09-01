<?php

namespace utils;

use app\service\admin\setting\ConfigService;
use think\facade\Log;

class Config
{

    protected static array $config = [];

    /**
     * 获取参数
     *
     * @param string $name
     * @param string $code
     * @param $default
     * @return int|string|array|null
     */
    public static function get(string $name = '', $default = null, string $field = null): int|string|array|null|float
    {
        $code = 'base';
        $config = self::getConfig($code);
        $val = null;
        if (isset($config[$name]) && is_array($config[$name])) {
            if (!empty($field)) {
                $val = isset($config[$name][$field]) ? $config[$name][$field] : $default;
            } else {
                $val = isset($config[$name]) ? $config[$name] : $default;
            }
        } else {
            $val = isset($config[$name]) ? $config[$name] : $default;
        }

        if ($name === 'wechatMiniProgramAppId' && empty($val)) {
            Log::warning('【Config::get 排查】获取 wechatMiniProgramAppId 为空', [
                'name' => $name,
                'default' => $default,
                'key_exists_in_cached_config' => isset($config[$name]),
                'cached_config_val' => $config[$name] ?? 'KEY_NOT_EXISTS',
                'final_returned_val' => $val,
            ]);
        }

        return $val;
    }

    /**
     * 获取配置
     *
     * @param string $code
     * @return int|string|array
     */
    public static function getConfig(string $code = ''): int|string|array|null
    {
        $code = 'base';
        if (!isset(self::$config[$code])) {
            self::$config[$code] = app(ConfigService::class)->getAllConfig();
            Log::info('【Config::getConfig】从数据库初始化全局配置静态缓存 static::$config[\'base\']');
        }
        return self::$config[$code];
    }

    public static function getStorageUrl(): string
    {
        $storage_type = self::get('storageType');
        $storage_url = '';
        switch ($storage_type) {
            case 0:
                $storage_url = self::get('storageLocalUrl');
                $storage_url = $storage_url ?? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/";
                break;
            case 1:
                $storage_url = self::get('storageOssUrl');
                break;
            case 2:
                $storage_url = self::get('storageCosUrl');
                break;
            default:
                $storage_url = '';
        }
        return $storage_url;
    }

}
