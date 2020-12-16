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
// | DateTime：2020-10-19 14:57:48
// +----------------------------------------------------------------------

namespace app\home\controller;

use app\HomeController;


class Index extends HomeController
{
    protected $view;

    public function GetView()
    {
      $dic  = public_path();
      $file = $dic .'view.json';
      if(!file_exists($file)){
        return false;
      }
      $handle = fopen($file, 'r');
      if (!$handle) {
        return false;
      }
      $buffer = fread($handle, filesize($file));
      fclose($handle);
      $json = json_decode($buffer,true);
      if (!$json) {
        return false;
      }

      $this->view = $json;
      return true;
    }
    public function SetView($dir)
    {
      $handle = fopen($dir, 'r');
      if (!$handle) {
        return abort(404, '文件不存在');
      }
      $buffer = fread($handle, filesize($dir));
      fclose($handle);
      
      return response($buffer, 200, ['Content-Length' => strlen($buffer)])->contentType('text/html');
    }
    public function SetDownload($dir)
    {
      return download($dir, 'file')->force(false);
    }
    public function index()
    {
      if (!$this->GetView()) {
        $this->error('失败');
      }
      $pathinfo = $this->request->pathinfo();
      $ext = $this->request->ext();
      $file = root_path().'plugin\\'.$this->view['namespace'].'\page\\';

      if ($ext == '') {
        $pathinfo .= '\index.html';
        $ext = 'html';
      }
      $dir = $file.$pathinfo;
      $dir = str_replace(["/\\","\\\\",'/'],"\\",$dir);

      if(!file_exists($dir)){
        return abort(404, '文件不存在');
      }
      if(filesize($dir) <= 0){
        return abort(404, '文件不存在');
      }

      switch ($ext) {
        case 'html'://前端核心就是html页面
            return $this->SetView($dir);
          break;
        default://其他附件均下载方式
            return $this->SetDownload($dir);
          break;
      }

    }
}