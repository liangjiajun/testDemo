<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();

if($_GET["echostr"]){
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}

class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $Event = $postObj->Event;
                $EventKey = $postObj->EventKey;
                $MsgType = $postObj->MsgType;
                $time = time();
                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";       
                if($MsgType=="image"){
                    $MsgType = "text";
                    $Content = "您发送了一个图片信息";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $MsgType, $Content);
                    echo $resultStr;            
                }     
                if($Event == "CLICK" and $EventKey == "V1001_TODAY_MUSIC"){
                    $MsgType = "text";
                    $Content = "点击了今日歌曲菜单";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $MsgType, $Content);
                    echo $resultStr;  
                }              
                if(!empty( $keyword ))
                {
                    switch ($keyword) {
                        case '你好':
                               $msgType = "text";
                               $contentStr = "your send keyword".$keyword;
                               $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                               echo $resultStr;
                            break;
                        case '福利':
                               $textTpl = "<xml>
                                               <ToUserName><![CDATA[%s]]></ToUserName>
                                               <FromUserName><![CDATA[%s]]></FromUserName>
                                               <CreateTime>%s</CreateTime>
                                               <MsgType><![CDATA[news]]></MsgType>
                                               <ArticleCount>1</ArticleCount>
                                               <Articles>
                                               <item>
                                               <Title><![CDATA[有福利推送了]]></Title> 
                                               <Description><![CDATA[精品福利]]></Description>
                                               <PicUrl><![CDATA[http://v3.qzone.cc/pic/201303/31/15/04/5157dffd93295570.jpg!600x600.jpg]]></PicUrl>
                                               <Url><![CDATA[http://www.baidu.com]]></Url>
                                               </item>
                                               </Articles>
                                            </xml>";
                               $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time);
                               echo $resultStr;
                            break;
                        
                    }
                    
                }else{
                    echo "Input something...";
                }

        }else {
            echo "";
            exit;
        }
    }
        
    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
                
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}

?>