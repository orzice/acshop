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
// | DateTime：2020-10-30 10:13:32
// +----------------------------------------------------------------------

namespace app\common\model;


use app\common\model\TimeModel;

class OrderAddress extends TimeModel
{
	public function order()
    {
		return $this->belongsTo('app\common\model\Order','order_id');
    }
}