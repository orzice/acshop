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

class Goods extends TimeModel
{
    protected $deleteTime = 'delete_time';

    public function setIsHotAttr($value){
//        print_r(111111);

//        exit();
        if(!empty($value)){
            return 1;
        }
        return 0;
    }

    public function setIsNewAttr($value){
//        print_r(222222);
//        exit();
        if(!empty($value)){
            return 1;
        }
        return 0;
    }

    public function setIsDiscountAttr($value){
//        print_r(333333);
//        exit();
        if(!empty($value)){
            return 1;
        }
        return 0;
    }



}