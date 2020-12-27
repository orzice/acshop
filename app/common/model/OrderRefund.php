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
// | DateTime：2020-10-30 10:13:02
// +----------------------------------------------------------------------

namespace app\common\model;


use app\common\model\TimeModel;

class OrderRefund extends TimeModel
{

    const STATUS_ARRAY = [0 => '待审核', 1 => '成功', 2 => '失败'];
    const ALLOW_FIELDS = [
        'delete_time',
        'status',
        'reason',
        'remark'
    ];

//    protected $name = 'order_refund';


    public function member()
    {
        return $this->belongsTo('app\common\model\Member', 'uid');
    }

    public function orders()
    {
        return $this->belongsTo('app\common\model\Order', 'order_id', 'id');
    }


//    public function getStatusAttr($value)
//    {
//        return self::STATUS_ARRAY[$value];
//    }


}