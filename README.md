# easylog
- 安装
```
composer require rxlisbest/easylog=~2.0.0
```
- 用法
```
use rxlisbest\easylog\EasyLog;

EasyLog::start();
EasyLog::text("Single line progress log output starts", 'info');
$total = 10; // 处理总条数
for($i = 0; $i <= $total; $i ++){
    EasyLog::processLine($i, $total, 'warning');
    sleep(1);
}
EasyLog::text("Single line progress log output end", 'error');
EasyLog::text("Multi-line progress log output starts");
for($i = 0; $i <= $total; $i ++){
    EasyLog::process($i, $total);
    sleep(1);
}
EasyLog::text("Multi-line progress log output end");
EasyLog::end();
```
