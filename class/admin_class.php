<?php
include_once("../function.php");
class admin_class{
	var $_tab="to_admin";
	function getadminbynamepass($_loginname,$_loginpass){
		$sql="select * from `".$this->_tab."` where loginname='".$_loginname."' AND loginpass='".$_loginpass."'";
		$query=mysql_query($sql);
		return mysql_fetch_array($query);
	}
	
	function getadminbyname($_loginname){
		$sql="select * from `".$this->_tab."` where loginname='".$_loginname."'";
		$query=mysql_query($sql);
		return mysql_fetch_array($query);
	}
	
	function getadminbyid($_id){
		$sql="select * from `".$this->_tab."` where id=".$_id."";
		$query=mysql_query($sql);
		return mysql_fetch_array($query);
	}
	
	function admin_update($err,$id){
		edit_update_cl($this->_tab,$err,$id);
	}
	
	function admin_insert($err){
		add_insert_cl($this->_tab,$err);
	}
	
	function admin_delete($id){
		edit_delete_cl($this->_tab,$id);
	}
	
}
?>