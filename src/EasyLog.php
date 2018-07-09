<?php
namespace rxlisbest\easylog;
/**
 * Created by PhpStorm.
 * User: ruixinglong
 * Date: 2018/7/9
 * Time: 上午11:24
 */

class EasyLog {
    /**
     * 进度日志
     * @name: processLine
     * @param int $now
     * @param int $total
     * @return void
     * @author: RuiXinglong <ruixl@soocedu.com>
     * @time: 2017-06-19 10:00:00
     */
    public static function processLine($now = 0, $total = 100){
        $max_length = 80;
        $bar_length = floor($now / $total * $max_length);
        $bar_content = str_repeat('#', $bar_length);
        $end = $now == $total? "\n": "";
        printf("\r[%s]%-${max_length}s[%d/%d]${end}", date('Y-m-d H:i:s'), $bar_content, $now, $total);
    }

    /**
     * 单行进度日志
     * @name: process
     * @param int $now
     * @param int $total
     * @return void
     * @author: RuiXinglong <ruixl@soocedu.com>
     * @time: 2017-06-19 10:00:00
     */
    public static function process($now = 0, $total = 100){
        $max_length = 80;
        $bar_length = floor($now / $total * $max_length);
        $bar_content = str_repeat('#', $bar_length);
        printf("[%s]%-${max_length}s[%d/%d]\n", date('Y-m-d H:i:s'), $bar_content, $now, $total);
    }

    /**
     * 文本日志
     * @name: text
     * @param string $text
     * @return void
     * @author: RuiXinglong <ruixl@soocedu.com>
     * @time: 2017-06-19 10:00:00
     */
    public static function text($text = ''){
        printf("[%s]%s\n", date('Y-m-d H:i:s'), $text);
    }

    /**
     * 脚本开始日志
     * @name: start
     * @param string $text
     * @return void
     * @author: RuiXinglong <ruixl@soocedu.com>
     * @time: 2017-06-19 10:00:00
     */
    public static function start($text = 'Start'){
        $stime = microtime(true);
        $GLOBALS["stime"] = $stime;
        printf("[%s]%s\n", date('Y-m-d H:i:s'), $text);
    }

    /**
     * 脚本结束日志
     * @name: end
     * @param string $text
     * @return void
     * @author: RuiXinglong <ruixl@soocedu.com>
     * @time: 2017-06-19 10:00:00
     */
    public static function end($text = 'End'){
        if($GLOBALS["stime"]){
            $stime = $GLOBALS["stime"];
            $etime = microtime(true);//获取程序执行结束的时间
            $second = $etime - $stime;  //计算差值
            printf("[%s]%s\n", date('Y-m-d H:i:s'), $text);
            printf("[%s]Script execution %s seconds\n", date('Y-m-d H:i:s'), $second);
        }
    }
}