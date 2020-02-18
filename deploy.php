<?php

$secret = "wanxiaoqian1124";
$shellPath = "/www/vblog";
set_time_limit(3 * 60); //最大过期时间3分钟

// 校验发送位置，正确的情况下自动拉取代码，实现自动部署
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
if ($signature) {
	$hash = "sha1=" . hash_hmac('sha1', file_get_contents("php://input"), $secret);
	if (strcmp($signature, $hash) == 0) {
		// sign sucess
		set_time_limit(3 * 60); //最大过期时间3分钟

		$re = system($shellPath);
		if ($re) {
			$param = array(
				'code' => 0,
				'message' => 'Success!',
				're' => $re,
			);
		} else {
			$param = array(
				'code' => 111,
				'message' => 'failed',
			);
		}

	} else {
		$parm = array(
			'code' => 112,
			'message' => '验签错误！',
		);
	}
} else {
	$parm = array(
		'code' => 113,
		'message' => '签名为空！',
	);
}

echo json_encode($param);exit;