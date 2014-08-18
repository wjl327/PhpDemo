<?php

class DataService {
	var $db = null;
	var $log = null;
	
	function __construct(){
		$this->db = Factory::getDBO();
		$this->log = Factory::getLogger();
	}
	
	function getList($sql, $fetchMode = MDB2_FETCHMODE_OBJECT){
		$res = $this->db->queryAll($sql, null, $fetchMode);
		$this->log->debug("Query list sql is : " . $sql);
		if (PEAR::isError($res)){
			return null;
		}
		return $res;
	}
	
	function getRow($sql, $fetchMode = MDB2_FETCHMODE_OBJECT){
		$res = $this->db->queryRow($sql, null, $fetchMode);
		$this->log->debug("Query list sql is : " . $sql);
		if (PEAR::isError($res)){
			return null;
		}
		return $res;
	}
	
	function getOne($sql, $fetchMode = MDB2_FETCHMODE_OBJECT){
		$res = $this->db->queryOne($sql);
		$this->log->debug("Query list sql is : " . $sql);
		if (PEAR::isError($res)){
			return null;
		}
		return $res;
	}
	
	function query($sql){
		$res = $this->db->query($sql);
		$this->log->debug("Query list sql is : " . $sql);
		if (PEAR::isError($res)){
			return null;
		}
		return $res;
	}
	
	function exec($sql){
		$res = $this->db->exec($sql);
		if (PEAR::isError($res)){
			return null;
		}
		return $res;
	}
	
	function lastInsertID($table, $id = "id"){
		$res = $this->db->lastInsertID($table, $id);
		if (PEAR::isError($res)){
			return null;
		}
		return $res;
	}
	
	function affectedRows(){
		return $this->db->_affectedRows(null);
	}
	
	function quote($var, $type = "text", $default = true){
		return $this->db->quote($var, $type, $default);
	}
	
	// 事务操作
	function beginTransaction($savepoint = null){
		$result = $this->db->beginTransaction($savepoint);
		if (PEAR::isError($result)){
			return new Error(DBERROR, $result->getMessage());
		}
		return true;
	}
	
	function commit($savepoint = null){
		$result = $this->db->commit($savepoint);
		if (PEAR::isError($result)){
			return new Error(DBERROR, $result->getMessage());
		}
		return true;
	}
	
	function rollback($savepoint = null){
		$result = $this->db->rollback($savepoint);
		if (PEAR::isError($result)){
			return new Error(DBERROR, $result->getMessage());
		}
		return true;
	}
	
}

?>