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
// | DateTime：2020-10-29 11:33:08
// +----------------------------------------------------------------------

namespace app\admin\middleware;


use app\admin\service\ConfigService;
use app\common\constants\AdminConstant;
use think\App;
use think\facade\Request;
use think\facade\View;

class ViewInit
{

    public function handle($request, \Closure $next)
    {
        list($thisModule, $thisController, $thisAction) = [app('http')->getName(), Request::controller(), $request->action()];
        list($thisControllerArr, $jsPath) = [explode('.', $thisController), null];
        
    	$data = config_plus("acshop");

        View::assign($data);
        return $next($request);
    }


}