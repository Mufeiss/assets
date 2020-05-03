<?php
// 屏蔽大陆及香港,澳门,台湾开始
$verification1 = '中国'; //需要屏蔽国家名称1
$verification2 = '澳门'; //需要屏蔽的国家名称2。这里可以类似的方式，定义多个国家。
function get_visitor_ip() {
         $ip = $_SERVER['REMOTE_ADDR'];
         if (isset($_SERVER['HTTP_X_REAL_FORWARDED_FOR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_FORWARDED_FOR'])) {
         $ip = $_SERVER['HTTP_X_REAL_FORWARDED_FOR'];       
         }          
         elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_FORWARDED_FOR'])) {
         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
         }
         elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
         $ip = $_SERVER['HTTP_CLIENT_IP'];
         }
         return $ip;
         }
$ip = get_visitor_ip();  //获取访客IP
@$result = file_get_contents("http://ip.taobao.com/service/getIpInfo2.php?ip=".$ip);  //IP数据库来自淘宝。你也可以换成 IP138 的。建议默认。
$address = json_decode($result,true);
//判断访客的IP是否来自国家1或国家2
if($address['data']['country'] == $verification1 || $address['data']['country'] == $verification2){ //如果只需要屏蔽国家名称1，这里无需修改，把开头的国家名称2'摩洛哥'改成某个不存在的名称即可，如'奥利给'。
header("location: http://ss-r.me/404.php");//检测国家1和国家2则跳转其他页面
exit();
}else {
// 	//如果代理访问,则访问其他页面
// 	header("location: http://hao123.com");javascript:;
}
// 屏蔽大陆及香港,澳门,台湾结束
?>