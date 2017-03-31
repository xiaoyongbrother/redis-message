## Redis应用--消息传递1

## 阅读目录

 * 1、摘要
 * 2、实现方法
 * 3、一对一消息传递
 * 4、多对多消息传递

## 1、摘要

	消息传递这一应用广泛存在于各个网站中，这个功能也是一个网站必不可少的。常见的消息传递应用有，新浪微博中的@我呀、给你评论然后的提示呀、赞赞赞提示、私信呀、甚至是发微博分享的新鲜事；知乎中的私信呀、live发送过来的消息、知乎团队消息呀等等。

## 2、实现方法
	1.消息传递即两个或者多个客户端在相互发送和接收消息。
	2.通常有两种方法实现


## 安装

```
composer require xiaoyongbrother/redis-message
```

## 使用

### 发送消息
```php
$sender = 'lisi';            //发送者
$to = 'wangwu';              //接收者
$message = 'How are you';    //信息
$time = time();
$arr=array('sender' => $sender, 'message' => $message, 'time' => $time);
<?= \xiaoyongbrother\message\singlePullMessage::sendSingle($to, $arr)?>
```
