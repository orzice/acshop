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
// | DateTime：2020-12-24 16:10:18
// +----------------------------------------------------------------------

namespace app\api\controller;

use app\common\controller\ApiController;

use think\facade\Request;
use app\common\Plugins;

class Plugin extends ApiController
{
    public function call()
    {
        //plugin.b_2-index-index-index
        $name = 'plugin.';
        $info = Request::pathinfo();
        if (substr ($info, 0,strlen($name)) !== $name) {
            return $this->error('未知请求', '','');
        }
        $plugin = str_replace($name, '', $info);
        $call = explode('-', $plugin);
        if(count($call) !== 4){
            return $this->error('未知请求', '','');
        }
        $data = Plugins::GetPluginState($call[0]);
        // print_r($data);
        if (!$data) {
            return $this->error('未知请求', '','');
        }
        // AcShop\plugin\<p1>\api\<p2>\<p3>@<p4>
        try {
            $dic = 'AcShop\plugin\\'.$call[0].'\api\\'.$call[1].'\\'.$call[2];
            $dic2 = $call[3];
            $test = new $dic($this->app);
            $test->$dic2();
        }  catch (\Throwable $e) {
            return $this->error('未知请求', '','');
        }

    }
}