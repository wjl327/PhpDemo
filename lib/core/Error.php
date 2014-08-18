<?php

/**
 * 异常封装类
 * 
 * @author Administrator
 *
 */
class Error {
	var $errorNo = 0;
	var $message = null;
	
	function __construct($errorNo, $message){
		$this->errorNo = $errorNo;
		$this->message = $message;
	}
	
	function getErrorNo(){
		return $this->errorNo;
	}
	function getMessage(){
		return $this->message;
	}
}

?>