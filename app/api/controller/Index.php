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
// | DateTime：2020-10-19 14:56:58
// +----------------------------------------------------------------------

namespace app\api\controller;

use app\BaseController;
use app\common\controller\ApiController;
use think\facade\Config;
use think\facade\Event;
use app\common\Plugins;


class Index extends ApiController
{
    
    public function index()
     {
        // 触发UserLogin事件 用于执行用户登录后的一系列操作
       
        event('UserLogin',"6666");

        // 获取插件配置
        //$plugin = new Plugins::GetPluginList();
        print_r("=============<br>");
        print_r("插件列表<br>");
        print_r("=============<br>");
        print_r(Plugins::GetPluginList());
        //print_r(Config::get('plugins_menu'));

        return "-结束";
    }


}