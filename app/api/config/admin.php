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
// | DateTime：2020-10-29 11:31:45
// +----------------------------------------------------------------------

return [

    // 不需要验证登录的控制器
    'no_login_controller' => [
        'login',
        'area',
        'index',
        'plugin',

    ],

    // 不需要验证登录的节点
    'no_login_node'       => [
        'login/index',
        'login/out',
        '/',
    ],

    // // 不需要验证权限的控制器
    // 'no_auth_controller'  => [
    //     'login',
    //     'index',
    // ],

    // // 不需要验证权限的节点
    // 'no_auth_node'        => [
    //     'login/index',
    //     'login/out',
    // ],

];