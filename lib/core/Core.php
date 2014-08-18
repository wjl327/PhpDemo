<?php
function import_path($path){
	if (is_dir(HOME_DIR. DIRECTORY_SEPARATOR. $path)){
		$GLOBALS[AUTO_LOAD_KEY][$path] = 1;
	}
}

function main_auto_load($className){
	if (!class_exists($className) && isset($GLOBALS[AUTO_LOAD_KEY])){
		foreach ( array_keys($GLOBALS[AUTO_LOAD_KEY]) as $path){
			if (is_file(HOME_DIR. DIRECTORY_SEPARATOR. $path. DIRECTORY_SEPARATOR. $className. '.php')){
				include HOME_DIR. DIRECTORY_SEPARATOR. $path. DIRECTORY_SEPARATOR. $className. '.php';
				break;
			}
		}
		
	}
}

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
	header("HTTP/1.1 $status");
	header("Content-Type: text/html; charset=utf-8");
	echo $rtn_str;
}