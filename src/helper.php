<?php

if (!function_exists('isMobile')) {
    /**
     * 验证手机号是否正确
     * 移动：134、135、136、137、138、139、150、151、152、157、158、159、182、183、184、187、188、178(4G)、147(上网卡)、148、172、198；
     * 联通：130、131、132、155、156、185、186、176(4G)、145(上网卡)；146、166、171、175
     * 电信：133、153、180、181、189 、177(4G)；149、173、174、199
     * 卫星通信：1349
     * 虚拟运营商：170
     * http://www.cnblogs.com/zengxiangzhan/p/phone.html
     * @param $text
     * @return bool
     */
    function isMobile($text)
    {
        return \jliu\helper\Validate::isMobile($text);
    }
}

if (!function_exists('isPassword')) {
    /**
     * 验证密码是否正确
     * 密码由6-16位大小写字母、数字和下划线组成
     * @param string $password
     * @return bool
     */
    function isPassword($password = '')
    {
        return \jliu\helper\Validate::isPassword($password);
    }
}

if (!function_exists('isEmail')) {
    /**
     * 验证邮箱是否正确
     * @param string $email
     * @return bool
     */
    function isEmail($email = '')
    {
        return \jliu\helper\Validate::isEmail($email);
    }
}

if (!function_exists('isIdCard')) {
    /**
     * 验证身份证号码格式是否正确
     * 仅支持二代身份证
     * @param string $idcard 身份证号码
     * @return boolean
     */
    function isIdCard($idcard = '')
    {
        return \jliu\helper\Validate::isIdCard($idcard);
    }
}

if (!function_exists('value')) {
    /**
     * 获取变量 支持默认值
     * @param array         $data 数据源
     * @param string|false  $name 字段名
     * @param mixed         $default 默认值
     * @return mixed
     */
    function value ($data = [], $name = '', $default = null) {
        return \jliu\helper\Common::value($data, $name, $default);
    }
}

if (!function_exists('random')) {
    /**
     * 获取随机字符串
     * @param number $length 字符串长度
     * @param boolean $numeric 是否为纯数字
     * @return string
     */
    function random($length, $numeric = false) {
        return \jliu\helper\Random::random($length, $numeric);
    }
}

if (!function_exists('format_bytes')) {
    /**
     * 格式化字节大小
     * @param  number $size 字节数
     * @param  string $delimiter 数字和单位分隔符
     * @return string            格式化后的带单位的大小
     */
    function format_bytes($size, $delimiter = '')
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
        return round($size, 2) . $delimiter . $units[$i];
    }
}

if (!function_exists('str2arr')) {
    /**
     * 字符串转换为数组，主要用于把分隔符调整到第二个参数
     * @param  string $str 要分割的字符串
     * @param  string $glue 分割符
     * @return array
     */
    function str2arr($str, $glue = ',')
    {
        return explode($glue, $str);
    }
}

if (!function_exists('arr2str')) {
    /**
     * 数组转换为字符串，主要用于把分隔符调整到第二个参数
     * @param  array $arr 要连接的数组
     * @param  string $glue 分割符
     * @return string
     */
    function arr2str($arr, $glue = ',')
    {
        return implode($glue, $arr);
    }
}

if (!function_exists('msubstr')) {
    /**
     * 字符串截取，支持中文和其他编码
     * @static
     * @access public
     * @param string $str 需要转换的字符串
     * @param string $start 开始位置
     * @param string $length 截取长度
     * @param string $charset 编码格式
     * @param string $suffix 截断显示字符
     * @return string
     */
    function msubstr($str, $start, $length, $charset = "utf-8", $suffix = true)
    {
        return \jliu\helper\Common::msubstr($str, $start, $length, $charset, $suffix);
    }
}

if (!function_exists('get_client_ip')) {
    /**
     * 获取客户端IP地址
     * @param int $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @param bool $adv 是否进行高级模式获取（有可能被伪装）
     * @return mixed
     */
    function get_client_ip($type = 0, $adv = false) {
        $type       =  $type ? 1 : 0;
        static $ip  =   NULL;
        if ($ip !== NULL) return $ip[$type];
        if($adv){
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos    =   array_search('unknown',$arr);
                if(false !== $pos) unset($arr[$pos]);
                $ip     =   trim($arr[0]);
            }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip     =   $_SERVER['HTTP_CLIENT_IP'];
            }elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip     =   $_SERVER['REMOTE_ADDR'];
            }
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }
}

if (!function_exists('get_server_ip')) {
    /**
     * 获取服务器端IP地址
     * @return array|false|string
     */
    function get_server_ip(){
        if(isset($_SERVER)){
            if($_SERVER['SERVER_ADDR']){
                $server_ip = $_SERVER['SERVER_ADDR'];
            }else{
                $server_ip = $_SERVER['LOCAL_ADDR'];
            }
        }else{
            $server_ip = getenv('SERVER_ADDR');
        }
        return $server_ip;
    }
}

if (!function_exists('get_browser_type')) {
    /**
     * 获取浏览器类型
     * @return string
     */
    function get_browser_type(){
        $agent = $_SERVER["HTTP_USER_AGENT"];
        if(strpos($agent,'MSIE') !== false || strpos($agent,'rv:11.0')) return "ie";
        if(strpos($agent,'Firefox') !== false) return "firefox";
        if(strpos($agent,'Chrome') !== false) return "chrome";
        if(strpos($agent,'Opera') !== false) return 'opera';
        if((strpos($agent,'Chrome') == false) && strpos($agent,'Safari') !== false) return 'safari';
        if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'360SE')) return '360SE';
        return 'unknown';
    }
}


