<?php
// +----------------------------------------------------------------------
// | AcShop (Acgice商城)
// +----------------------------------------------------------------------
// | 团队官网: https://oauth.acgice.com
// +----------------------------------------------------------------------
// | 联系我们: https://oauth.acgice.com/sdk/contact.html
// +----------------------------------------------------------------------
// | gitee开源项目：https://gitee.com/orzice/acshop
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/orzice/acshop
// +----------------------------------------------------------------------
// | Author：Orzice(小涛)  https://gitee.com/orzice
// +----------------------------------------------------------------------
// | DateTime：2020-10-29 11:33:02
// +----------------------------------------------------------------------

namespace app\api\middleware;

use app\common\service\AuthService;
use think\Request;


/**
 * 检测用户登录和节点权限
 * Class CheckAdmin
 * @package app\api\middleware
 */
class CheckAdmin
{

    use \app\common\traits\JumpApi;

    public function handle(Request $request, \Closure $next)
    {
        //Sessions(null,array("id"=>1,"expire_time"=>1634546127));

        $adminConfig = config('admin');
 
        $adminId = Sessions("id");
        $expireTime = Sessions("expire_time");
        $authService = new AuthService($adminId);
        $currentNode = $authService->getCurrentNode();
        $currentController = parse_name($request->controller());

        // print_r($currentNode);
        // print_r($currentController);
        // exit;

        // 验证登录
        if (!in_array($currentController, $adminConfig['no_login_controller']) &&
            !in_array($currentNode, $adminConfig['no_login_node'])) {
            empty($adminId) && $this->error('请先登录账号', 'login','login');

            // 判断是否登录过期
            if ($expireTime !== true && time() > $expireTime) {
                Sessions(null, null);
                $this->error('登录已过期，请重新登录', 'login', 'login');
            }
        }

        // // 验证权限
        // if (!in_array($currentController, $adminConfig['no_auth_controller']) &&
        //     !in_array($currentNode, $adminConfig['no_auth_node'])) {
        //     $check = $authService->checkNode($currentNode);
        //     !$check && $this->error('无权限访问','return','return');

        // }

        return $next($request);
    }

}