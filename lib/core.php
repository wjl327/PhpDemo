<?php

/**
 * 自动载入类路径
 */
function import_path($path){
	if (is_dir(HOME_DIR. DIRECTORY_SEPARATOR. $path)){
		$GLOBALS[AUTO_LOAD_KEY][$path] = 1;
	}
}

/**
 * 自动载入方法
 */
function main_auto_load($className){
	if (!class_exists($className) && isset($GLOBALS[AUTO_LOAD_KEY])){
		foreach (array_keys($GLOBALS[AUTO_LOAD_KEY]) as $path){
			if (is_file(HOME_DIR. DIRECTORY_SEPARATOR. $path. DIRECTORY_SEPARATOR. $className. '.php')){
				include HOME_DIR. DIRECTORY_SEPARATOR. $path. DIRECTORY_SEPARATOR. $className. '.php';
				break;
			}
		}
		
	}
}

/**
 * Http Client通用方法
 * 
 */
function httpClient($url, $method, $data = null) {
	$curl = curl_init ();
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $curl, CURLOPT_URL, $url );
	curl_setopt ( $curl, CURLOPT_CUSTOMREQUEST, $method );
	if ($data) {
		curl_setopt ( $this->curl, CURLOPT_HTTPHEADER, array (
				'Content-Length: ' . strlen ( $data ) 
		) );
		curl_setopt ( $this->curl, CURLOPT_POSTFIELDS, $data );
	}
	
	$rslt = curl_exec ( $curl );
	
	$res = array (
			'status' => curl_getinfo ( $curl, CURLINFO_HTTP_CODE ),
			'body' => $rslt,
			'error' => curl_error ( $curl ) 
	);
	
	return $res;
} 

/**
 * 获取请求参数
 */
function getVar($name, $method = null, $default = null){
	if ($method == 'get'){
		$var = @$_GET[$name];
	} else if ($method == 'post'){
		$var = @$_POST[$name];
	} else {
		$var = @$_REQUEST[$name];
	}
	// default & type
	if (!$var && isset($default)){
		$var = $default;
	}

	return $var;
}

/**
 * Json返回输出,可以根据业务修改printResp的实现
 */
function resp($rslt){
	//异常的情况
	if (is_a($rslt, 'Error')){
		printResp(null, false, $rslt->getMessage());
		exit(0);
	}

	printResp($rslt, true, "success");
}

function printResp($data, $result = true, $message = "", $append = null, $callback = null, $status = '200'){
	$return = array(
			'success' => $result,
			'message' => $message,
			'data' => $data
	);
	if ($append){
		$return = array_merge($return, $append);
	}
	$rtn_str = json_encode($return);
	//支持jsonp
	if($callback > 0) {
		$callback = htmlspecialchars($callback);
		$rtn_str = $callback . "('". $rtn_str . "')";
	}
	
	header("Content-Type", "text/html; charset=utf-8");
	header("Access-Control-Allow-Origin:*");
	header("Access-Control-Allow-Credentials: true");
	header("HTTP/1.1 $status");
	header("Content-Type: text/html; charset=utf-8");
	echo $rtn_str;
}