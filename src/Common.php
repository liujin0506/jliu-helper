<?php

namespace jliu\helper;

class Common
{
    /**
     * 获取变量 支持默认值
     * @param array         $data 数据源
     * @param string|false  $name 字段名
     * @param mixed         $default 默认值
     * @return mixed
     */
    public static function value($data = [], $name = '', $default = null)
    {
        if (false === $name) {
            // 获取原始数据
            return $data;
        }
        $name = (string) $name;
        if ('' != $name) {
            // 解析name
            if (strpos($name, '/')) {
                list($name, $type) = explode('/', $name);
            } else {
                $type = 's';
            }
            // 按.拆分成多维数组进行判断
            foreach (explode('.', $name) as $val) {
                if (isset($data[$val])) {
                    $data = $data[$val];
                } else {
                    // 无输入数据，返回默认值
                    return $default;
                }
            }
            if (is_object($data)) {
                return $data;
            }
        }

        if (isset($type) && $data !== $default) {
            // 强制类型转换
            self::typeCast($data, $type);
        }
        return $data;
    }

    /**
     * 强制类型转换
     * @param string $data
     * @param string $type
     * @return mixed
     */
    public static function typeCast(&$data, $type)
    {
        switch (strtolower($type)) {
            // 数组
            case 'a':
                $data = (array) $data;
                break;
            // 数字
            case 'd':
                $data = (int) $data;
                break;
            // 浮点
            case 'f':
                $data = (float) $data;
                break;
            // 布尔
            case 'b':
                $data = (boolean) $data;
                break;
            // 字符串
            case 's':
            default:
                if (is_scalar($data)) {
                    $data = (string) $data;
                } else {
                    throw new \InvalidArgumentException('variable type error：' . gettype($data));
                }
        }
    }

}