<?php


namespace app\admin\controller\finace;
use app\common\model\FinaceIncome as Incomes;
use app\common\controller\AdminController;
use think\App;

use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
/**
 * Class Test
 * @package app\admin\controller\page
 * @ControllerAnnotation(title="收入明细")
 */
class Income extends AdminController
{
    use \app\admin\traits\Curd;

    protected $sort = [
        'id'   => 'desc',
    ];

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new Incomes();
    }
    /**
     * @NodeAnotation(title="列表")
     */
    public function index()
    {
        if ($this->request->isAjax()){
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
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data' => $list,
        ];
        return json($data);
    }
        return $this->fetch();
    }
}