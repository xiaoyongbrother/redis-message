<?php
	require_once __DIR__.'/../vendor/autoload.php';
	
	$object = new xiaoyongbrother\message\SinglePullMessage('127.0.0.1');
	$sender = 'lisi';          //发送者
	$to = 'wangwu';            //接收者
	$message = 'How are you';  //信息
	$time = time();
	$arr=array('sender' => $sender, 'message' => $message, 'time' => $time);
	echo $object->sendSingle($to, $arr);
