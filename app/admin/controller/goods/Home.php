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

namespace app\admin\controller\goods;


use think\App;
use think\facade\Config;
use app\common\model\Goods;
use app\common\model\Dispatch;
use app\common\controller\AdminController;

use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;

/**
 * Class Home
 * @package app\admin\controller\goods
 * @ControllerAnnotation(title="商品管理")
 */
class Home extends AdminController
{

    use \app\admin\traits\Curd;

    protected $sort = [
        'id'   => 'desc',
    ];

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new Goods();
    }

    /**
     * @NodeAnotation(title="列表")
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            if (input('selectFields')) {
                return $this->selectList();
            }
            list($page, $limit, $where) = $this->buildTableParames();
            $count = $this->model
                ->where($where)
                ->count();
            $list = $this->model
                ->where($where)
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
     * @NodeAnotation(title="添加")
     */
    public function add()
    {
        event('GoodsAdd');
        if ($this->request->isAjax()) {
            $post = $this->request->post();
            $rule = [
                'goods.title|商品名称' => 'require',
                'goods.type|商品类型' => 'require|number|in:0,1',
                'goods.sku|商品单位' => 'require|chs',

                'goods.market_price|原价' => 'require|float',
                'goods.price|现价' => 'require|float',
                'goods.cost_price|成本' => 'require|float',
                'goods.virtual_sales|虚拟销量' => 'require|number',
                'goods.weight|重量' => 'require|number',
                'goods.stock|库存' => 'require|number',
                'goods.reduce_stock_method|减库存方式' => 'require|number|in:0,1,2',

                'goods.no_refund|不可退货退款' => 'require|number|in:0,1',
                'goods.status|是否上架' => 'require|number|in:0,1',

                'goods.dispatch|配送模板' => 'require|number',

                'thumb|商品图片' => 'require|url',
                'thumb_url|其他图片' => 'require|url',

                'goods.dt|商品属性' => 'array',
                'goods.dv|商品属性' => 'array',
            ];
            $this->validate($post, $rule);
            $post['goods']['thumb'] = $post['thumb'];
            $post['goods']['thumb_url'] = $post['thumb_url'];
            $post['goods']['content'] = $post['describe'];
            if(count($post['goods']['dt']) !== count($post['goods']['dv'])){
                $this->error('商品属性格式错误');
            }
            $post['goods']['descriptions'] = array();
            for ($i=0; $i < count($post['goods']['dt']); $i++) { 
                if($post['goods']['dt'] == '' || $post['goods']['dv'] == ''){
                    $this->error('商品属性不能为空！');
                }
                $post['goods']['descriptions'][] = array(
                    'title' => $post['goods']['dt'][$i],
                    'value' => $post['goods']['dv'][$i],
                    );
            }
            $post['goods']['description'] = json_encode($post['goods']['descriptions']);

            event('GoodsAddPost',$post);
            try {
                $save = $this->model->save($post['goods']);
            } catch (\Exception $e) {
                $this->error('保存失败:'.$e->getMessage());
            }
            $save ? $this->success('保存成功') : $this->error('保存失败');
        }
        $goodsadd = Config::get('goodsadd');
        $dispatch = Dispatch::where('state',1)->select();

        $this->assign('dispatch',$dispatch);
        $this->assign('goodsadd',$goodsadd);
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="添加")
     */
    public function edit($id)
    {
        $row = $this->model->find($id);
        $row->isEmpty() && $this->error('数据不存在');
        event('GoodsEdit',$id);

        if ($this->request->isAjax()) {
            $post = $this->request->post();
            $rule = [
                'goods.title|商品名称' => 'require',
                'goods.type|商品类型' => 'require|number|in:0,1',
                'goods.sku|商品单位' => 'require|chs',

                'goods.market_price|原价' => 'require|float',
                'goods.price|现价' => 'require|float',
                'goods.cost_price|成本' => 'require|float',
                'goods.virtual_sales|虚拟销量' => 'require|number',
                'goods.weight|重量' => 'require|number',
                'goods.stock|库存' => 'require|number',
                'goods.reduce_stock_method|减库存方式' => 'require|number|in:0,1,2',

                'goods.no_refund|不可退货退款' => 'require|number|in:0,1',
                'goods.status|是否上架' => 'require|number|in:0,1',

                'goods.dispatch|配送模板' => 'require|number',

                'thumb|商品图片' => 'require|url',
                'thumb_url|其他图片' => 'require|url',

                'goods.dt|商品属性' => 'array',
                'goods.dv|商品属性' => 'array',
            ];
            $this->validate($post, $rule);
            $post['goods']['thumb'] = $post['thumb'];
            $post['goods']['thumb_url'] = $post['thumb_url'];
            $post['goods']['content'] = $post['describe'];
            if(count($post['goods']['dt']) !== count($post['goods']['dv'])){
                $this->error('商品属性格式错误');
            }
            $post['goods']['descriptions'] = array();
            for ($i=0; $i < count($post['goods']['dt']); $i++) { 
                if($post['goods']['dt'] == '' || $post['goods']['dv'] == ''){
                    $this->error('商品属性不能为空！');
                }
                $post['goods']['descriptions'][] = array(
                    'title' => $post['goods']['dt'][$i],
                    'value' => $post['goods']['dv'][$i],
                    );
            }
            $post['goods']['description'] = json_encode($post['goods']['descriptions']);

            event('GoodsEditPost',$post);
            try {
                unset($post['goods']['descriptions']);
                unset($post['goods']['dt']);
                unset($post['goods']['dv']);
                $save = $this->model->where('id', $id)->update($post['goods']);
            } catch (\Exception $e) {
                $this->error('保存失败:'.$e->getMessage());
            }
            $save ? $this->success('保存成功') : $this->error('保存失败');
        }
        $goodsadd = Config::get('goodsedit');
        $dispatch = Dispatch::where('state',1)->select();
        $row['descriptions'] = json_decode($row['description'],true);
        if(!$row['descriptions']){
            $row['descriptions'] = array();
        }

        $this->assign('dispatch',$dispatch);
        $this->assign('goodsadd',$goodsadd);
        $this->assign('row', $row);
        return $this->fetch();
    }
}
