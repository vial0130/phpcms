<?php
/* ========================================================================
 * 数据库相关配置
 * ======================================================================== */
return array
    (
        'DNS'=>'mysql:host=localhost;dbname=ppphp',
        'TYPE' => 'mysql',
        'SERVER' => 'localhost',
	    'DATABASE' => 'ppphp',
        'USERNAME'=>'root',
        'PASSWORD'=>'123456',
        'CHARSET' => 'utf8',
        //medoo 对表前缀的支持有BUG,所以暂时不推荐设置表前缀
	    'PREFIX' => '',
        //sqlite示例配置
        //'database_type' => 'sqlite',
        //'database_file' => 'db/phpcms.rdb'
    );
?>