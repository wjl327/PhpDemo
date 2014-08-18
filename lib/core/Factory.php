<?php

/**
 * 工厂类
 *
 */
class Factory{
	
	private static $instances = array();
	
	private function __construct(){}
	
	/**
	 * 获得类的单例对象
	 */
	public static function getInstance($className){ 
		$ins = null;
		if(@self::$instances[$className] != null){
			$ins = self::$instances[$className];
		}else{
			$ins = new $className;
			self::$instances[$className] = $ins;
		}
		return $ins;
	}
	
	/**
	 * 获取日志操作对象
	 * 
	 */
	public static function getLogger(){
		$conf = array(
				'locking' => Config::get('log_file_locking'),
				'mode' => Config::get('log_file_mode'),
				'timeFormat' => Config::get('log_time_format')
		);
		$level = Config::get('debug') ? PEAR_LOG_DEBUG : PEAR_LOG_INFO;
	
		return Log::singleton("file", Config::get('log_file'), '', $conf, $level);
	}
	
	/**
	 * 获取DB操作对象
	 * 
	 */
	public static function getDBO(){
		$dsn = Config::getDSN();
		$options = array( 'debug' => Config::get('debug'),
				'portability' =>MDB2_PORTABILITY_ALL ^ MDB2_PORTABILITY_EMPTY_TO_NULL   );
	
		$mdb2 =& MDB2::singleton($dsn, $options);
		return $mdb2;
	}
}