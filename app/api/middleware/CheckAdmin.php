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

        $MemberConfig = config('member');
 
        $member_id = Sessions("member_id");
        $currentController = parse_name($request->controller());

        // 插件不需要验证登录
        $name = 'plugin.';
        $info = $request->pathinfo();
        if (substr ($info, 0,strlen($name)) == $name) {
            return $next($request);
        }

        // 其他的验证登录
        if (!in_array($currentController, $MemberConfig['no_login_controller'])) {
            empty($member_id) && $this->error('请先登录账号', 'login','login');
        }

        return $next($request);
    }

}