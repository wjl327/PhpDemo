<?php

/**
 * 配置文件读取类
 * 
 * @author Administrator
 *
 */
class Config{
	
	public static function get($name){
		global $CONF;
		return $CONF[$name];
	}
	
	public static function getDSN(){
		global $CONF;
		$config = array(
				'phptype'  => $CONF['dbtype'],
				'username' => $CONF['username'],
				'password' => $CONF['password'],
				'hostspec' => $CONF['hostspec'],
				'port' => $CONF['port'],
				'socket' => false,
				'database' => $CONF['db'],
				'charset'  => $CONF['charset']
		);
		return $config;
	}
	
} 