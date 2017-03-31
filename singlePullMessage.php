<?php
namespace xiaoyongbrother\message;

/**
 * 一对一消息传递
 **/
class SinglePullMessage
{
    private $redis = '';

    public function __construct($host, $port=7379)
    {/*{{{*/
        $this->redis = new Redis();
        $this->redis->connect($host, $port);
    } /*}}}*/

	//发送消息
    public function sendSingle($toUser, $messageArr)
    {/*{{{*/
        $jsonMessage = json_encode($messageArr);
        return $this->redis->lpush($toUser, $jsonMessage);
    }/*}}}*/

	//用户获取新消息
    public function getNewMessage($user)
    {/*{{{*/
        //接收新信息数据，并且将数据推入旧信息数据链表中，并且在原链表中删除
        $messageArr = [];
        while($jsonMessage = $this->redis->rpoplpush($user, 'preMessage_' . $user))
        {
            $temp = json_decode($jsonMessage);
            $messageArr[$temp->sender][] = $temp;
        }
        if($messageArr)
        {
            $arr['count'] = count($messageArr);  //统计有多少个用户发来信息
            $arr['messageArr'] = $messageArr;
            return $arr;
        }
        return false;
    }/*}}}*/

	//取出旧消息
    public function getPreMessage($user)
    {/*{{{*/
        $messageArr = [];
        $jsonPre = $this->redis->lrange('preMessage_' . $user, 0, -1);  //一次性将全部旧消息取出来
        foreach($jsonPre as $k => $v){
            $temp = json_decode($v);
            $timeout = $temp->time+60*60*24*7;  //数据过期时间  七天过期
            if($timeout<time()){ //判断数据是否过期
                if($k==0){ //若是最迟插入的数据都过期了，则将所有数据删除
                    $this->redis->del('preMessage_' . $user);
                    break;
                }
                $this->redis->ltrim('preMessage_' . $user, 0, $k);  //若检测出有过期的，则将比它之前插入的所有数据删除
                break;
            }
            $messageArr[$temp->sender][] = $temp;
        }
        return $messageArr;
    }/*}}}*/

	//返回打印输出
    public function dealArr($arr)
    {/*{{{*/
        foreach ($arr as $k => $v){
            foreach ($v as $kk => $vv){
                echo '发送人:' . $vv->sender . ' 发送时间:' . date('Y-m-d h:i:s', $vv->time) . PHP_EOL;
                echo '消息内容:' . $vv->message . PHP_EOL;
            }
            echo "<hr/>";
        }
    }/*}}}*/

}
