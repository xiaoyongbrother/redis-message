<?php
require_once __DIR__.'/../vendor/autoload.php';

$object = new xiaoyongbrother\message\SinglePullMessage('127.0.0.1');

//消息传递
$sender = 'lisi';          //发送者
$to = 'wangwu';            //接收者
$message = 'How are you';  //信息
$time = time();
$arr = array('sender' => $sender, 'message' => $message, 'time' => $time);
echo $object->sendSingle($to, $arr) . PHP_EOL;


//获取新消息
$arr = $object->getNewMessage('wangwu');
if($arr){
	echo $arr['count'] . '个联系人发来新消息' . PHP_EOL;
	echo '---新消息---' . PHP_EOL;
	$object->dealArr($arr['messageArr']); 
	echo '---新消息---' . PHP_EOL;
}


//获取旧消息
$arr = $object->getPreMessage('wangwu');
if($arr){
	echo '---旧消息---' . PHP_EOL;
	$object->dealArr($arr);
	echo '---旧消息---' . PHP_EOL;
}else{
	echo '无旧数据';
}
