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
// | DateTime：2020-10-29 11:32:05
// +----------------------------------------------------------------------

namespace app\admin\controller\order;


use think\App;
use think\facade\Config;
use app\common\model\Order;
use app\common\controller\AdminController;
use app\common\model\OrderGoods;
use app\common\model\OrderAddress;

use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;

/**
 * Class Home
 * @package app\admin\controller\goods
 * @ControllerAnnotation(title="订单管理")
 */
class Home extends AdminController
{

    protected $sort = [
        'id'   => 'desc',
    ];

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new Order();
    }

    /**
     * @NodeAnotation(title="订单列表")
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            if (input('selectFields')) {
                return $this->selectList();
            }
            list($page, $limit, $where) = $this->buildTableParames();
          
            $w1 = false;
            $where1 = array();
            $where2 = array();

            for ($i=0; $i < count($where); $i++) { 
                if(strpos($where[$i][0],'goods')!==false){
                    $where[$i][0] = str_replace("goods.","",$where[$i][0]);
                    $where1[] = $where[$i];
                }else{
                    $where2[] = $where[$i];
                }
            }
            if (count($where1) !== 0) {
                $where1 = OrderGoods::where($where1);
                $w1 = true;
            }

            $count = $this->model;
            if ($w1) {
                $count = $count->hasWhere('goods',$where1);
            }
            $count = $count->with(['goods','address'])
                ->where($where2)
                ->count();

            $list = $this->model;
            if ($w1) {
                $list = $list->hasWhere('goods',$where1);
            }
            $list = $list->with(['goods','address'])
                ->where($where2)
                ->page($page, $limit)
                ->order($this->sort)
                ->select();

            $data = [
                'code'  => 0,
                'msg'   => '',
                'count' => $count,
                'data'  => $list,
            ];
            return json($data);
        }
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="订单详情")
     */
    public function order($id)
    {
        $row = $this->model->with(['goods','address'])->find($id);
        $row->isEmpty() && $this->error('数据不存在');
        event('MemberEditStart',$id);
        
        $plugin = Config::get('memberedit');
        $this->assign('plugin',$plugin);
        $this->assign('row', $row);
        return $this->fetch();
    }

}
