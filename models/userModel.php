<?php
	function loginUser($post)
	{
		$hashPass=hashStr($post['password'],$post['login']);
		$query="SELECT id FROM users WHERE login=\"".myEscapeStr($post['login'])."\" AND password=\"".$hashPass."\"";
		$r=myQuerySelect($query,'assoc');
		if(!empty($r)){
			$_SESSION['id_user']=$r['id'];
			$_SESSION['login']=$post['login'];
		}else{
			return ER_001010;
		}
	}

	function registerUser($root,$post)
	{
		$post['password']=hashStr($post['password'],$post['login']);
		$query="INSERT INTO users (login,password,email) VALUES(\"".myEscapeStr($post['login'])."\",\"".myEscapeStr($post['password'])."\",\"".myEscapeStr($post['email'])."\")";
		myQueryExec($query);
		$lastId=get_last_id('id','users');
		createFolder($root."/".$lastId);
		$_SESSION['id_user']=$lastId;
		$_SESSION['login']=$post['login'];
	}

	function get_last_id($field,$table)
	{
		$query="SELECT MAX(".$field.") last_id FROM ".$table;
		$data=myQuerySelect($query,'assoc');
		return $data['last_id'];
	}


	function userLogs($idUser,$actionName,$affectedElem,$paramAction='null')
	{
		$ipUser=$_SERVER['REMOTE_ADDR']; 
		$query="INSERT INTO logs (id_user,action,affected_elem,param_action,ip_user) VALUES('".$idUser."','".$actionName."','".$affectedElem."','".$paramAction."','".$ipUser."')";	
		myQueryExec($query);
	}
?>