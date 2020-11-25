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
// | DateTime：2020-10-19 14:56:05
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\facade\Config;
use app\common\Plugins;

use app\admin\model\SystemAdmin;
use app\admin\model\SystemQuick;

class Index extends AdminController
{
    /**
     * 后台主页
     * @return string
     * @throws \Exception
     */
    public function index()
     {
        // 触发UserLogin事件 用于执行用户登录后的一系列操作
        event('AdminHome');



        return $this->fetch();
        //return "-结束";
    }
    /**
     * 后台欢迎页
     * @return string
     * @throws \Exception
     */
    public function home()
     {
        // 触发UserLogin事件 用于执行用户登录后的一系列操作
        event('AdminHome');

        $serverinfo = PHP_OS.' / PHP v'.PHP_VERSION;
        $serverinfo .= @ini_get('safe_mode') ? ' Safe Mode' : NULL;
        $serversoft = $_SERVER['SERVER_SOFTWARE'];

        $mysqlinfo = \think\facade\Db::query("select VERSION()");
        $dbversion = $mysqlinfo[0]['VERSION()'];

        $this->assign('serverinfo', $serverinfo);
        $this->assign('serversoft', $serversoft);
        $this->assign('dbversion', $dbversion);
        return $this->fetch();
    }

    /**
     * 修改管理员信息
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function editAdmin()
    {
        $id = Sessions('id');
        $row = (new SystemAdmin())
            ->withoutField('password')
            ->find($id);
        empty($row) && $this->error('用户信息不存在');
        if ($this->request->isAjax()) {
            $post = $this->request->post();
            $rule = [];
            $this->validate($post, $rule);
            try {
                $save = $row
                    ->allowField(['phone', 'remark', 'update_time'])
                    ->save($post);
            } catch (\Exception $e) {
                $this->error('保存失败');
            }
            $save ? $this->success('保存成功') : $this->error('保存失败');
        }
        $this->assign('row', $row);
        return $this->fetch();
    }

    /**
     * 修改密码
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function editPassword()
    {
        $id = Sessions('id');
        $row = (new SystemAdmin())
            ->withoutField('password')
            ->find($id);
        if (!$row) {
            $this->error('用户信息不存在');
        }
        if ($this->request->isAjax()) {
            $post = $this->request->post();
            $rule = [
                'password|登录密码'       => 'require',
                'password_again|确认密码' => 'require',
            ];
            $this->validate($post, $rule);
            if ($post['password'] != $post['password_again']) {
                $this->error('两次密码输入不一致');
            }

            try {
                $save = $row->save([
                    'password' => password($post['password']),
                ]);
            } catch (\Exception $e) {
                $this->error('保存失败');
            }
            if ($save) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
        $this->assign('row', $row);
        return $this->fetch();
    }
}