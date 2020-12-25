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

    public function province()
    {
        return $this->belongsTo('app\common\model\Area','province_id');
    }

    public function city()
    {
        return $this->belongsTo('app\common\model\Area','city_id');
    }

    public function district()
    {
        return $this->belongsTo('app\common\model\Area','district_id');
    }

    public function street()
    {
        return $this->belongsTo('app\common\model\Area','street_id');
    }






//    public function getProvinceIdAttr($value)
//    {
//        $area = Area::where('id', $value)->findOrEmpty();
//        $province = !empty($area)?$area->name: '暂无';
//        print_r($province);die();
//        return $province;
//    }
//
//    public function getCityIdAttr($value)
//    {
//        $area = Area::where('id', $value)->findOrEmpty();
//        $city = !empty($area)?$area->name: '暂无';
//        return $city;
//    }
//
//    public function getDistrictIdAttr($value)
//    {
//        $area = Area::where('id', $value)->findOrEmpty();
//        $district = !empty($area)?$area->name: '暂无';
//        return $district;
//    }
//
//    public function getStreetIdAttr($value)
//    {
//        $area = Area::where('id', $value)->findOrEmpty();
//        $street = !empty($area)?$area->name: '暂无';
//        return $street;
//    }


}