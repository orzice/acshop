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
use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;

class WechatPay extends TimeModel
{

    use SoftDelete;
    const ALLOW_FIELDS = [
        'name',
        'app_id',
        'app_secret',
        'merchant_id',
        'merchant_secret',
        'cert_file',
        'key_file',
        'open_status',
        'remark',
        'is_union',
        'is_login',
    ];
    protected $deleteTime = 'delete_time';
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $defaultSoftDelete = null;
    protected $name = 'wechat_pay';


}