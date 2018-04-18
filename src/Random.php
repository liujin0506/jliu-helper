<?php

namespace jliu\helper;

class Random
{
    /**
     * 生成随机数
     * @param $length
     * @return string
     */
    public static function number($length = 6)
    {
        return self::random($length, true);
    }

    /**
     * 获取随机字符串
     * @param number $length 字符串长度
     * @param boolean $numeric 是否为纯数字
     * @return string
     */
    public static function random($length, $numeric = false) {
        $seed = base_convert(md5(microtime() . $_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
        $seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
        if ($numeric) {
            $hash = '';
        } else {
            $hash = chr(rand(1, 26) + rand(0, 1) * 32 + 64);
            $length--;
        }
        $max = strlen($seed) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash .= $seed{mt_rand(0, $max)};
        }
        return $hash;
    }

    /**
     * 生成唯一编号
     * @param null $str
     * @return string
     */
    public static function code($str = null)
    {
        $strO = '';
        if ($str) {
            $strO = strlen($str) >= 9 ? substr($str, -9) : substr('000000000', 0, 9 - strlen($str)).$str;
        }
        $orderSn = date('Y').strtoupper(dechex(date('m'))).date('d').substr(time(), -5).substr(microtime(), 2,
                5).sprintf('%02d', rand(0, 99));

        return $orderSn.$strO;
    }
}