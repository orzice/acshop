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
// | DateTime：2020-10-19 14:57:41
// +----------------------------------------------------------------------

namespace app\common;

use think\facade\Config;
use think\facade\Route;
use app\common\model\PluginsData;

class PluginsOld 
{
    /**
     * 初始化方法 【旧】
     */
    static public function init_old()
    {
        //==================================
        //      插件注入
        //==================================
        $root = root_path();
        $arr = array();
        $dir = $root.'plugin/';

        $str = opendir($dir);
        while( ($filename = readdir($str)) !== false ){
            if($filename != "." && $filename != ".."){
                if (is_file($filename)){
                    $file_array[]=$filename;
                }else{
                    $dir_array[]=$filename;
                }
            }
        }
        closedir($str);
        //print_r($file_array);
        //print_r($dir_array);
        for ($i=0; $i < count($dir_array); $i++) { 
            $file = $dir.$dir_array[$i]."/package.php";
            if (is_file($file)){
               $hook = include $file;
               $hook();
            }
        }
    }
    /**
     * 获取插件列表信息【旧】
     */
    static public function  GetPluginList()
    {
    	$data = array();
    	$arr = Config::get('plugins_menu');
    	$arr_name = array_keys($arr);
    	for ($i=0; $i < count($arr_name); $i++) { 
    		$data["num"][$i] = $arr[$arr_name[$i]];
    		if ($data["num"][$i] == false) {
    			$data["num"][$i] = array("plugins_name" => $arr_name[$i]);
    		}else{
    			$data["num"][$i]["plugins_name"] = $arr_name[$i];
    		}
    	}
    	$data["name"] = $arr;
    	return $data;
    }

}