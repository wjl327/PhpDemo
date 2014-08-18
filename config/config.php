<?php

$CONF = array(
		'debug' => true,
		//================数据库
		'dbtype' => 'mysql',
		'username' => 'root',
		'password' => '123456',
		'hostspec' => 'localhost',
		'port' 		=> '3306',
		'db' 		=> 'test',
		'charset'	=> 'utf8',
		//================LOG
		'log_file' 	=> LOG_DIR . DIRECTORY_SEPARATOR . date('Ymd', time()).'.log',
		'log_file_mode' 	=> '0666',
		'log_file_locking' 	=> 0,
		'log_time_format' => '%Y%m/%d %H:%M:%S'
 );