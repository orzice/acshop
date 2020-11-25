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
// | DateTime：2020-10-29 11:34:46
// +----------------------------------------------------------------------

namespace app\common\taglib;

use think\template\TagLib;
use think\Template;

class Plugins extends TagLib{
    protected $tags   =  [
        'include'     => ['attr' => 'file', 'close' => 0], 
    ];

    public function tagInclude($tag, string $content): string
    {
        $name = $tag["file"];
        $parse = '<?php ';
        $parse .= '\think\facade\View::engine()->layout(false);';
        //$parse .= 'echo  \think\facade\View::display(file_get_contents(root_path()."'.$name.'"));';
        $parse .= 'echo  \think\facade\View::fetch(root_path()."plugin/".'.$name.'.".html");';
        $parse .= ' ?>';
        return $parse;
    }
    
   
}