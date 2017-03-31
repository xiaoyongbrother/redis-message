# redis-message Redis应用--消息传递
------
> 摘要：消息传递这一应用广泛存在于各个网站中，这个功能也是一个网站必不可少的。

#阅读目录
------
 * 1、摘要
 * 2、实现方法
 * 3、一对一消息传递
 * 4、多对多消息传递

## 1.安装

composer require xiaoyongbrother/redis-message

## 2.使用

#发送消息
```php
$sender = 'lisi';            //发送者
$to = 'wangwu';              //接收者
$message = 'How are you';    //信息
$time = time();
$arr=array('sender' => $sender, 'message' => $message, 'time' => $time);
<?= \xiaoyongbrother\message\singlePullMessage::sendSingle($to, $arr)?>
```
