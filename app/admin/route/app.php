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
// | DateTime：2020-10-19 14:56:20
// +----------------------------------------------------------------------
use think\facade\Route;


//  BUG 因为不判断登录，所以可能被攻击！所以需要中继！
/**
 * /admin/plugins.a-index-index-index
 */
// Route::rule('plugins.<p1>-<p2>-<p3>-<p4>','AcShop\plugin\<p1>\admin\<p2>\<p3>@<p4>');

Route::rule('plugins.<p1>-<p2>-<p3>-<p4>','Plugin/call');

/**
 * /admin/plugins.a-index-index/index
 */
// Route::rule('plugins.<p1>-<p2>-<p3>/<p4>','AcShop\plugin\<p1>\admin\<p2>\<p3>@<p4>');

Route::rule('plugins.<p1>-<p2>-<p3>/<p4>','Plugin/call');


