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
	public function address()
    {
        return $this->hasOne('app\common\model\OrderAddress', 'order_id', 'id');
    }
    public function goods()
    {
        return $this->hasMany('app\common\model\OrderGoods', 'order_id', 'id');
    }

}