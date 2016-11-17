<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26
 * Time: 15:29
 */

namespace app\components;


class Util {

    /**
     * 系统当前时间
     */
    private static function  _curTimeMillis() {
        list($usec,  $sec)  =  explode(" ", microtime());
        return  $sec.substr($usec,  2,  3);
    }

    /**
     * 客户端相关信息
     */
    private static function  _getHost() {
        $name = empty($_SERVER["HTTP_USER_AGENT"]) ? 'localhost' : $_SERVER["HTTP_USER_AGENT"];
        return strtolower($name . '/' . self::_clientIp());
    }

    /**
     * 客户端IP
     */
    private static function _clientIp() {
        $ip = isset($_SERVER['HTTP_REALIP'])
            ? $_SERVER['HTTP_REALIP']
            : (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
                ? $_SERVER['HTTP_X_FORWARDED_FOR']
                : isset($_SERVER['REMOTE_ADDR']));

        if (empty($ip))    $ip = '0.0.0.0';
        return $ip;
    }

    /**
     * 随机数
     */
    private static function  _random() {
        $tmp  =  rand(0,1) ? '-' : '';
        return  $tmp.rand(1000,  9999).rand(1000,  9999).rand(1000,  9999).rand(100,  999).rand(100,  999);
    }

    /**
     * 生成GUID字符串
     * (长度：32 + 4)
     * 三段：一段是微秒,  一段是地址,  一段是随机数
     */
    public static function  toString() {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            $string = md5(self::_getHost() . ':' . self::_curTimeMillis() . ':' . self::_random());
            $raw  =  strtoupper($string);
            return  substr($raw,0,8).'-'.substr($raw,8,4).'-'.substr($raw,12,4).'-'.substr($raw,16,4).'-'.substr($raw,20);
        }
    }

    // 字符截取函数
    public static function truncate_utf8_string($string, $length, $etc = '...')
    {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++)
        {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0'))
            {
                if ($length < 1.0)
                {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            }
            else
            {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen)
        {
            $result .= $etc;
        }
        return $result;
    }

    public static function saveLog($module,$controller,$action,$content){
        $rtime = time();
        $admin_id = \Yii::$app->session['adminid'];
        $ip = \Yii::$app->request->userIP;
        $content = serialize($content);
        $sql = "INSERT INTO {{%tbl_logs}} (module,controller,action,content,admin_id,rtime,ip) VALUES (:module,:controller,:action,:content,:admin_id,:rtime,:ip)";
        $cmd = \Yii::$app->db->createCommand($sql);
        $cmd->bindParam(":module", $module);
        $cmd->bindParam(":controller", $controller);
        $cmd->bindParam(":action", $action);
        $cmd->bindParam(":content", $content);
        $cmd->bindParam(":admin_id", $admin_id);
        $cmd->bindParam(":rtime", $rtime);
        $cmd->bindParam(":ip", $ip);
        $cmd->execute();
    }

    static function getOperatorIdByName($sSearch){
        $sql = "SELECT id FROM {{%tbl_operator}} WHERE name=:name";
        $cmd = \Yii::$app->db->createCommand($sql);
        $cmd->bindParam(":name", $sSearch);
        $id = $cmd->queryScalar();
        return $id;
    }

    static function getOperatorNameById($id){
        $name = "";
        $sql = "SELECT name FROM {{%tbl_operator}} WHERE id=:id";
        $cmd = \Yii::$app->db->createCommand($sql);
        $cmd->bindParam(":id", $id);
        $name = $cmd->queryScalar();
        return $name;
    }



}