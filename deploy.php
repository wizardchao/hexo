<?php

$secret = "wanxiaoqian1124";
$shellPath = "/www/vblog";

// 校验发送位置，正确的情况下自动拉取代码，实现自动部署
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
if ($signature) {
	$hash = "sha1=" . hash_hmac('sha1', file_get_contents("php://input"), $secret);
	if (strcmp($signature, $hash) == 0) {
		// sign sucess
		set_time_limit(3 * 60); //最大过期时间3分钟

		$cmd = "cd $shellPath && sudo git pull && sudo hexo clean && sudo hexo d -g";
		$res = $this->doShell($cmd);
		print_r($res); // 主要打印结果给github记录查看，自己测试时查看
	}
}