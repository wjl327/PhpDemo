<?php

class UserService extends DataService{
	
	var $log = null;
	
	function __construct(){
		parent::__construct();
		$this->log = Factory::getLogger(); 
		
		//初始化memcache
        //if(MEMCACHE_USABLE){
        //    $this->mem_server = new Memcache();
        //   $this->mem_server->addServer(MEMCACHE_SERVER, MEMCACHE_PORT);
        //}
	}
	
	function findUserList($page, $size){
		$start = ($page - 1) * $size;
		$sql = "select * from user order by id desc limit ". $this->db->quote($start). "," . $this->db->quote($size, "Integer");
		$res = $this->getList($sql);
		return $res;
	}
	
	function countUserList(){
		$sql = "select count(*) from user";
		return $this->getOne($sql);
	}
	
	function findUserById($id){
		$sql = "select * from user where id = " . $this->db->quote($id);
		return $this->getRow($sql);
	}
		
}