<?php
/*
 *获取微信token
*/
$appid="wxf81aa2139bd583a1";
$secret="d37b93a99a353cf7b6eb296eefd71188";
$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."";

// $token=(array)json_decode(file_get_contents($url));

echo $url;
echo '<br>';
echo $output;
echo '<br>';

$output=gettoken($url);

$token=(array)json_decode($output);

echo $token['access_token'];
print_r($token);
//echo $token['access_token'];


function gettoken($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22");
	curl_setopt($ch, CURLOPT_ENCODING ,'gzip'); //加入gzip解析
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}
