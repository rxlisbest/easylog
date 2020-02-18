<?php

namespace rxlisbest\easylog;
/**
 * Created by PhpStorm.
 * User: ruixinglong
 * Date: 2018/7/9
 * Time: 上午11:24
 */
class EasyLog
{
    const TYPE_ERROR = 'error';
    const TYPE_WARNING = 'warning';
    const TYPE_INFO = 'info';

    public static function processLine($now = 0, $total = 100, $type = 'info')
    {
        if (!preg_match("/cli/i", php_sapi_name())) {
            self::export('This method can only be used in cli mode!', 'error');
            return;
        }
        $max_length = 80;
        $bar_length = floor($now / $total * $max_length);
        $bar_content = str_repeat('#', $bar_length);
        $end = $now == $total ? "\n" : "";
        echo self::getColorContent(sprintf("\r[%s]%-${max_length}s[%d/%d]${end}", date('Y-m-d H:i:s'), $bar_content, $now, $total), $type);
    }

    public static function process($now = 0, $total = 100, $type = 'info')
    {
        $max_length = 80;
        $bar_length = floor($now / $total * $max_length);
        $bar_content = str_repeat('#', $bar_length);
        self::export(sprintf("[%s]%-${max_length}s[%d/%d]", date('Y-m-d H:i:s'), $bar_content, $now, $total), $type);
    }

    protected static function text($text = '', $type = 'info')
    {
        self::export(sprintf("[%s]%s", date('Y-m-d H:i:s'), $text), $type);
    }

    public static function start($text = 'Start', $type = 'info')
    {
        $stime = microtime(true);
        $GLOBALS["stime"] = $stime;
        self::export(sprintf("[%s]%s", date('Y-m-d H:i:s'), $text), $type);
    }

    public static function end($text = 'End', $type = 'info')
    {
        if ($GLOBALS["stime"]) {
            $stime = $GLOBALS["stime"];
            $etime = microtime(true);//获取程序执行结束的时间
            $second = $etime - $stime;  //计算差值
            self::export(sprintf("[%s]%s", date('Y-m-d H:i:s'), $text), $type);
            self::export(sprintf("[%s]Script execution %s seconds", date('Y-m-d H:i:s'), $second), $type);
        }
    }

    protected static function export($content, $type = 'info')
    {
        echo self::getExportContent(self::getColorContent($content, $type));
    }

    protected static function getExportContent($content)
    {
        if (preg_match("/cli/i", php_sapi_name())) {
            $break = PHP_EOL;
        } else {
            $break = '<br />';
        }
        return $content . $break;
    }

    protected static function getColorContent($content, $type)
    {
        if (preg_match("/cli/i", php_sapi_name())) {
            $start = [
                'info' => "\033[0m",
                'error' => "\033[31m",
                'warning' => "\033[33m",
            ];
            $end = "\033[0m";
        } else {
            $start = [
                'info' => '<font>',
                'error' => '<font color="red">',
                'warning' => '<font color="yellow">',
            ];
            $end = '</font>';
        }
        return $start[$type] . $content . $end;
    }

    public static function info($text = '')
    {
        self::text($text, self::TYPE_INFO);
    }

    public static function warning($text)
    {
        self::text($text, self::TYPE_WARNING);
    }

    public static function error($text)
    {
        self::text($text, self::TYPE_ERROR);
    }
}