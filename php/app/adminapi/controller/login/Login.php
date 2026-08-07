<?php

namespace app\adminapi\controller\login;

use app\BaseController;
use app\service\admin\authority\AccessTokenService;
use app\service\admin\authority\AdminUserService;
use app\service\admin\captcha\CaptchaService;
use app\service\admin\common\sms\SmsService;
use think\App;
use think\facade\Cache;
use think\Response;

/**
 * 品牌控制器
 */
class Login extends BaseController
{
    protected AdminUserService $adminUserService;
    private bool $isAdd = false;

    /**
     * 构造函数
     *
     * @param App $app
     * @param AdminUserService $brandService
     */
    public function __construct(App $app, AdminUserService $adminUserService)
    {
        parent::__construct($app);
        $this->adminUserService = $adminUserService;
    }

    /**
     * 管理员登录操作
     *
     * @return Response
     */
    public function signin(): Response
    {
        \think\facade\Log::info("[Login PHP Debug] Signin API called");
        $login_type =$this->request->all('login_type', 'password');
        //校验csrf
        $csrfToken = request()->header('X-CSRF-Token');
        \think\facade\Log::info("[Login PHP Debug] X-CSRF-Token from header: " . ($csrfToken ?: 'NULL'));
        if ($csrfToken) {
            $cachedCsrf = Cache::get($csrfToken);
            \think\facade\Log::info("[Login PHP Debug] Cached CSRF value for '{$csrfToken}': " . ($cachedCsrf !== null ? var_export($cachedCsrf, true) : 'NULL'));
            if (!$cachedCsrf) {
                \think\facade\Log::error("[Login PHP Debug] CSRF Token not found in Cache or expired");
                return $this->error('页面已过期，请刷新后重试！');
            }
        }
        if ($login_type == 'password') {
            // 密码登录
            $username =$this->request->all('username', '');
            $password =$this->request->all('password', '');
            \think\facade\Log::info("[Login PHP Debug] Username: '{$username}', Password length: " . strlen($password));
            if (empty($username)) {
                \think\facade\Log::error("[Login PHP Debug] Username is empty");
                return $this->error('用户名不能为空');
            }
            $verifyToken = empty($this->request->all('verify_token', '')) ? '' : $this->request->all('verify_token', '');
            \think\facade\Log::info("[Login PHP Debug] Verify token: '{$verifyToken}'");
            // 行为验证码
            try {
                \think\facade\Log::info("[Login PHP Debug] Checking captcha...");
                app(CaptchaService::class)->setTag('adminSignin:' . $username)
                    ->setToken($verifyToken)
                    ->setAllowNoCheckTimes(3) //3次内无需判断
                    ->verification();
                \think\facade\Log::info("[Login PHP Debug] Captcha check passed or not required.");
            } catch (\Exception $e) {
                \think\facade\Log::error("[Login PHP Debug] Captcha verification failed: " . $e->getMessage());
                throw $e;
            }
            try {
                \think\facade\Log::info("[Login PHP Debug] Querying admin user by password...");
                $user = $this->adminUserService->getAdminUserByPassword($username, $password);
                \think\facade\Log::info("[Login PHP Debug] Query result: " . ($user ? "User ID: " . $user->admin_id : "User not found/Password incorrect"));
            } catch (\Exception $e) {
                \think\facade\Log::error("[Login PHP Debug] Error querying user: " . $e->getMessage() . "\n" . $e->getTraceAsString());
                throw $e;
            }

            if ($user && isPasswordTooSimple($password)) {
                Cache::set('password_too_simple:' . $user->admin_id, 1, 60 * 60 * 24);
            } else if ($user) {
                Cache::delete('password_too_simple:' . $user->admin_id);
            }
        } elseif ($login_type == 'mobile') {
            // 手机登录
            $mobile = $username =$this->request->all('mobile', '');
            $mobile_code =$this->request->all('mobile_code', '');
            \think\facade\Log::info("[Login PHP Debug] Mobile login. Mobile: '{$mobile}', Code: '{$mobile_code}'");
            $user = $this->adminUserService->getAdminUserByMobile($mobile, $mobile_code);
            \think\facade\Log::info("[Login PHP Debug] Mobile login query result: " . ($user ? "User ID: " . $user->admin_id : "User not found"));
        }
        if (!$user) {
            \think\facade\Log::error("[Login PHP Debug] User authentication failed");
            return $this->error('账户或密码错误！');
        }
        // CSRF token 仅在登录成功后消费，避免“输错一次密码后 token 被提前删除”导致后续一直提示登录错误
        if ($csrfToken) {
            Cache::delete($csrfToken);
        }
        $this->adminUserService->setLogin($user->admin_id);
        $token = app(AccessTokenService::class)->setApp('admin')->setId($user->admin_id)->createToken();
        \think\facade\Log::info("[Login PHP Debug] Login success. Generated token: " . substr($token, 0, 15) . "...");

        return $this->success([
            'token' => $token,
            'admin_type'=> $user->admin_type
        ]);
    }

    /**
     * 获取验证码
     * @return Response
     * @throws \exceptions\ApiException
     */
    public function sendMobileCode(): Response
    {
        $mobile =$this->request->all('mobile', '');
        if (!$mobile) {
            return $this->error('手机号不能为空');
        }
        // 行为验证码
        app(CaptchaService::class)->setTag('mobileCode:' . $mobile)
            ->setToken($this->request->all('verify_token', ''))
            ->verification();

        try {
            app(SmsService::class)->sendCode($mobile);
            return $this->success();
        } catch (\Exception $e) {
            return $this->error('发送失败！' . $e->getMessage());
        }
    }
}
