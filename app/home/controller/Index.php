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
// | DateTime：2020-10-19 14:57:48
// +----------------------------------------------------------------------

namespace app\home\controller;

use app\common\controller\HomeController;
use think\facade\Config;
use app\common\Plugins;
use EasyAdmin\auth\Node as NodeService;


class Index extends HomeController
{
    public function index()
     {
      //触发
      //\think\facade\Queue::push('common/Job1','6666');

       event('Home');
       $nodeList = (new NodeService())->getNodelist();
       print_r($nodeList);
       exit;

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