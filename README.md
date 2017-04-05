## Redis应用--消息传递1

## 阅读目录

 * 1、摘要
 * 2、实现方法
 * 3、一对一消息传递
 * 4、多对多消息传递

## 1、摘要

	消息传递这一应用广泛存在于各个网站中，这个功能也是一个网站必不可少的。常见的消息传递应用有，新浪微博中的@我呀、给你评论然后的提示呀、赞赞赞提示、私信呀、甚至是发微博分享的新鲜事；知乎中的私信呀、live发送过来的消息、知乎团队消息呀等等。

## 2、实现方法
	消息传递即两个或者多个客户端在相互发送和接收消息。
	通常有两种方法实现
	第一种为消息推送。Redis内置有这种机制，publish往频道推送消息、subscribe订阅频道。这种方法有一个缺点就是必须保证接收者时刻在线（即是此时程序不能停下来，一直保持监控状态，假若断线后就会出现客户端丢失信息）
	第二种为消息拉取。所谓消息拉取，就是客户端自主去获取存储在服务器中的数据。Redis内部没有实现消息拉取这种机制。因此我们需要自己手动编写代码去实现这个功能。
	在这里我们，我们进一步将消息传递再细分为一对一的消息传递，多对多的消息传递（群组消息传递）。


## 安装

```
composer require xiaoyongbrother/redis-message
```

## 使用

### 3、一对一发送消息
```php
require_once __DIR__.'/../vendor/autoload.php';

$object = new xiaoyongbrother\message\SinglePullMessage('127.0.0.1');
$sender = 'lisi';          //发送者
$to = 'wangwu';            //接收者
$message = 'How are you';  //信息
$time = time();
$arr = array('sender' => $sender, 'message' => $message, 'time' => $time);
echo $object->sendSingle($to, $arr);
```
