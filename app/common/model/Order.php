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

class Order extends TimeModel
{

    const STATUS_ARRAY = [-2=>'申请退款', -1 => '已取消',0=>'待付款',1=>'已付款',2=>'已发货', 3=>'已完成'];
    const MERCHANT_STATUS = [-1 => '已取消',1=>'已付款',2=>'已发货', 3=>'已完成'];
    const ORDER_ARRAY = [0=>'无需配送',1=>'快递',2=>'门店自提',3=>'门店配送'];
    const ALLOW_FIELDS = [
//        'status',
        'change_price',
        'change_dispatch_price',
        'merchant_remark',
        'express_code',
        'express_company_name',
        'express_sn',
        'delete_time','price'];

    public function member(){
        return $this->belongsTo('app\common\model\Member', 'uid');
    }

	public function address()
    {
        return $this->hasOne('app\common\model\OrderAddress', 'order_id', 'id');
    }
    public function goods()
    {
        return $this->hasMany('app\common\model\OrderGoods', 'order_id', 'id');
    }
    public function order_refund()
    {
        return $this->hasMany('app\common\model\OrderRefund', 'order_id', 'id');
    }

    public function getISVirtualAttr($value)
    {
        return $value === 0 ? '否' : '是' ;
    }

//    public function getStatusAttr($value)
//    {
//        return self::STATUS_ARRAY[$value];
//    }

    public function getCommentStatusAttr($value)
    {
        return $value === 0 ? '未评论' : '已评论' ;
    }


}