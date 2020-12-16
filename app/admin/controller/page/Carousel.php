<?php
namespace app\admin\controller\page;

use app\common\controller\AdminController;
use app\common\model\Carousel as Carousels;
use think\App;

use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;

/**
 * Class Test
 * @package app\admin\controller\page
 * @ControllerAnnotation(title="轮播图管理")
 */
class Carousel extends AdminController
{
    use \app\admin\traits\Curd;

    protected $sort = [
        'create_time'   => 'desc',
    ];

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new Carousels();
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
        if ($this->request->isAjax()) {
            $post = $this->request->post();
            $rule = [
                'weight|权重' => 'require|number',
                'thumb|轮播图片' => 'require|url',
                'link|链接' => 'require|url',
                'state|状态' => 'require|number|in:0,1',
            ];
            $this->validate($post, $rule);
            $post['picture'] = $post['thumb'];
            unset($post['thumb']);
            try {
                $save = $this->model->save($post);
            } catch (\Exception $e) {
                $this->error('保存失败:'.$e->getMessage());
            }
            $save ? $this->success('保存成功') : $this->error('保存失败');

        }
        return $this->fetch();
    }
    /**
     * @NodeAnotation(title="修改")
     */
    public function edit($id)
    {
        $row = $this->model->find($id);
        $row->isEmpty() && $this->error('数据不存在');
        if ($this->request->isAjax()){
            $post = $this->request->post();
            $rule = [
                'weight|权重' => 'require|number',
                'thumb|轮播图片' => 'require|url',
                'link|链接' => 'require|url',
                'state|状态' => 'require|number|in:0,1',
            ];
            $this->validate($post, $rule);
            $post['picture'] = $post['thumb'];
//            print_r($post);die;
            unset($post['thumb']);
            unset($post['file']);
//            print_r($post['id']);die;
            try {
                $save = $this->model->where('id', $post['id'])->update($post);
            } catch (\Exception $e) {
                $this->error('保存失败:'.$e->getMessage());
            }
            $save ? $this->success('保存成功') : $this->error('保存失败');
        }
        $this->assign('row', $row);
        return $this->fetch();
    }

    public function preview(){
        $row = $this->model->where('state',1)->order('weight','desc')->select()->toArray();
        $this->assign('row',$row);
        return $this->fetch();
    }

}