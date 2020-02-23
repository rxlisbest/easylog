# easylog
## Installation
```
composer require rxlisbest/easylog=~2.0.0
```
## Usage
```
use rxlisbest\easylog\EasyLog;

EasyLog::start();
EasyLog::info("Single line progress log output starts");
$total = 10; // 处理总条数
for($i = 0; $i <= $total; $i ++){
    EasyLog::processLine($i, $total, 'warning');
    sleep(1);
}
EasyLog::info("Single line progress log output end");
EasyLog::info("Multi-line progress log output starts");
for($i = 0; $i <= $total; $i ++){
    EasyLog::process($i, $total);
    sleep(1);
}
EasyLog::info("Multi-line progress log output end");
EasyLog::end();

EasyLog::warning("It is warning");
EasyLog::error("It is error");
EasyLog::primary("It is primary");
```
## Preview
![Priview](./docs/img/preview.gif)
