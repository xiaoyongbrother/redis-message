# redis-message
Redis应用--消息传递

## 1.安装

composer require xiaoyongbrother/redis-message

## 2.使用
```php
$sender = 'lisi';     #发送者
$to = 'wangwu';         #接收者
$message = 'How are you';    #信息
$time = time();
$arr=array('sender' => $sender, 'message' => $message, 'time' => $time);
<?= \xiaoyongbrother\message\singlePullMessage::sendSingle($to, $arr)?>
```
