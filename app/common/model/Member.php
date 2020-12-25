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
// | DateTime：2020-10-22 14:44:06
// +----------------------------------------------------------------------

namespace app\common\model;


use app\common\model\TimeModel;
use think\model\relation\HasMany;

class Member extends TimeModel
{

    protected $deleteTime = 'delete_time';


    public function orders(){
        return $this->hasMany('app\common\model\Order', 'uid', 'id');
    }

    public function address(){
        return $this->hasMany('app\common\model\MemberAddress', 'uid', 'id');
    }

}