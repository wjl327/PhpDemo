<?php

class UserService extends DataService{
	
	var $log = null;
	
	function __construct(){
		parent::__construct();
		$this->log = Factory::getLogger(); 
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