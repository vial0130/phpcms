<?php
/* ========================================================================
 * 全局函数
 * ======================================================================== */
/**
 * 自定义的数组或变量的展现方式
 */
function dump($var)
{
    if (is_bool($var)) {
        var_dump($var);
    } else if (is_null($var)) {
        var_dump(NULL);
    } else {
        echo "<pre>" . print_r($var, true) . "</pre>";
    }
}

/**
 * 获取get数据
 * @param $str 变量名
 * @param $filter 过滤方式 int为只支持int类型
 * @param $default 默认值 当获取不到值时,所返回的默认值
 * @return
 */
function get($str='false',$filter = '',$default = false)
{
    if($str !== false)
    {
        $return = isset($_GET[$str])?$_GET[$str]:false;
        if($return) {
            switch ($filter) {
                case 'int':
                    if (!is_numeric($return)) {
                        return $default;
                    }
                    break;
                default:
                    $return = htmlspecialchars($return);

            }
            return $return;
        } else {
            return $default;
        }
    } else {
        return $_GET;
    }
}

/**
 * 获取post数据
 * @param $str 变量名
 * @param $filter 过滤方式 int为只支持int类型
 * @param $default 默认值 当获取不到值时,所返回的默认值
 * @return
 */
function post($str=false,$filter = '',$default = false)
{
    if($str !== false)
    {
        $return = isset($_POST[$str])?$_POST[$str]:false;
        if($return) {
            switch ($filter) {
                case 'int':
                    if (!is_numeric($return)) {
                        return $default;
                    }
                    break;
                default:
                    $return = htmlspecialchars($return);

            }
            return $return;
        } else {
            return $default;
        }
    } else {
        return $_POST;
    }
}

