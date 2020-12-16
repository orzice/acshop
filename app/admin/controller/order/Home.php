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

    public function edit($id){
        $order = Order::where('id', $id)->findOrEmpty();
        if($this->request->isPost()){
            $post = $this->request->post();
            $rule = [
                'name|名称' => 'require',
                'app_id|app_id' => 'require',
                'app_secret|app_secret' => 'require',
                'merchant_id|商户号id' => 'require',
                'merchant_secret|商户号支付秘钥' => 'require',
                'cert_file|cert证书文件' => 'require',
                'key_file|key秘钥文件' => 'require',
                'open_status|标准微信支付' => 'require',
            ];
            // 上级分类是否存在 并且存入id
            $this->validate($post, $rule);
            $is_exists = $this->model->whereExists(['name', '=', $post['name']]);
            !$is_exists && $this->error('保存失败,名称已存在');
            try {
                $save = $this->model->find($id)->allowField($this->model::ALLOW_FIELDS)->save($post);
            }
            catch (\Exception $e) {
                $this->error('保存失败' . $e);
            }
            if ($save) {
                Uploadfile($post['cert_file']);
                Uploadfile($post['key_file']);
                $this->success('保存成功');
            }
            $this->error('保存失败');
        }
        $this->assign('status_array', Order::STATUS_ARRAY);
        $this->assign('plugin', []);
        $order->goods;
        $this->assign('row', $order);
//        print_r($order);die();
        return $this->fetch();

    }


}
