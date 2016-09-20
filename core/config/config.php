<?php
/* ========================================================================
 * 普通的配置文件示例
 * ======================================================================== */
return array(
    'PASSWORDKEY'=>'ppphp.kphcdr.com',
     /**
      * 翻页默认显示数量
      */
    'ADMIN_PAGE'=>7,
     /**
      * 图片上传默认设置
      */
    'PICPATH'=>ASSIGN.'upload/picture',
    'PICSIZE'=>1048576, //大小1M
    'PICRANDOM'=>'true',
    'PICTYPE'=> [
        '0'=>'jpg',
        '1'=>'gif',
        '2'=>'png',
        '3'=>'jpeg'
    ],
    /**
     * 缩略图默认设置
     */
     'THUMADDRESS'=>ASSIGN.'thumbnail/',
);