<?php
/* ========================================================================
 * 模型基类,当前继承于medoo
 * 主要用于连接数据库,并封装了四个常用操作
 * ======================================================================== */
namespace phpcms;

class model extends \PDO
{
    protected $DB;

    public function __construct()
    {
        //连接数据库配置
        $dataBase = conf::all('database');

        try{
          $this->DB =  parent::__construct($dataBase['DNS'],$dataBase['USERNAME'],$dataBase['PASSWORD']);
        }catch(\PDOException $e){
            dump($e->getMessage());
        }
    }

    /**
     * 断开连接
     * @return void
     */
    public function disConnect()
    {
        $this->DB = null;
    }

}
?>