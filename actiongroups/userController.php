<?php
require_once('./models/folderModel.php');
require_once('./models/userModel.php');

if($action != "show"){
	$result=true;
	if($action == "disconnection"){ // -- deconection -- //
		session_destroy();
	
	}elseif($action == "login"){ // -- conection -- //
		$error_login_return=array();
		$result=false;
		$error_login_return[0]="";
		$error_login_return[1]="";
		$error_login_return[2]="";
		if(!empty($_POST)){
			if(empty($_POST['login'])){
				$error_login_return[0]=ER_001001;
			}
			if(empty($_POST['password'])){
				$error_login_return[1]=ER_001004;
			}
			$result=true;
			foreach($error_login_return as $error){
				if(!empty($error)){
					$result=false;
				}
			}
			if($result){
				$error_login_return[2]=loginUser($_POST);
				if($error_login_return[2] != ""){
					$result=false;
				}
			}
		}
	
	}elseif($action == "register"){ // -- enregistrement -- //
		$error_return=array();
		$result=false;
		$error_return[0]="";
		$error_return[1]="";
		$error_return[2]="";
		$error_return[3]="";	
		if(!empty($_POST)){
			if(empty($_POST['login'])){
				$error_return[0]=ER_001001;
			
			}elseif(!checkStr($_POST['login'],'login')){
				$error_return[0]=ER_001002;
			
			}elseif(!checkBdd($_POST['login'],'login')){
				$error_return[0]=ER_001003;
			}
			if(empty($_POST['password'])){
				$error_return[1]=ER_001004;
			
			}elseif(!checkStr($_POST['password'],'password')){
				$error_return[1]=ER_001005;
			
			}else{
				if($_POST['password'] != $_POST['vpassword']){
					$error_return[2]=ER_001006;
				}
			}
			if(empty($_POST['email'])){
				$error_return[3]=ER_001007;
			
			}elseif(!checkStr($_POST['email'],'email')){
				$error_return[3]=ER_001008;
			
			}elseif(!checkBdd($_POST['email'],'email')){
				$error_return[3]=ER_001009;
			}
			$result=true;
			foreach($error_return as $error)
			{
				if(!empty($error)){
					$result=false;
				}
			}
			if($result){
				registerUser($root,$_POST);
			}
		}
	}
	if($result){
		header("Location: index.php"); die();
	}
}

include('./includes/prepareDisplay.php');
$login='./templates/login.template.php';
$register='./templates/register.template.php';
?>