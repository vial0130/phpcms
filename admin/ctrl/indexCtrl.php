<?php
namespace admin\ctrl;
class indexCtrl extends \phpcms
{
    public function index()
    {
        $model = new \phpcms\model;
        $sessions = new \phpcms\session;
        $cache = new \phpcms\cache();
        $data = $cache->get('Lists8s');
        $sessions->set('id','123');
        $sql = 'select * from conf';
        $ret = $model->query($sql);
        if(!$data){
            $data = $ret->fetchAll();
            $cache->set('Lists8s',$data);
        }
        $datacookie =$sessions->get('id');
        if( isset( $datacookie ) ){
            $this->assign('sessions',$datacookie);
        }
        $get = $_GET;
        $this->assign('title','视图文件');
        $this->assign('data',$data);
        $this->assign('get',$get);
        $this->display('index/index.php');
    }
}

?>