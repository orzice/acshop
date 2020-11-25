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
// | DateTime：2020-10-19 14:58:56
// +----------------------------------------------------------------------
namespace AcShop\plugin\a\admin\index;


use app\common\controller\AdminController;
use app\common\Plugins;

use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;


/**
 * @ControllerAnnotation(title="管理后台")
 * Class Node
 * @package app\admin\controller\system
 */
class Index extends AdminController
{
	
    /**
     * @NodeAnotation(title="首页")
     */
	public function index()
	{
        print_r("=============<br>");
        print_r("[管理员界面]插件列表<br>");
        print_r("=============<br>");
        print_r(Plugins::GetPluginList());
		return 111;
	}


}