<?php
	function myQueryExec($query) // -- requet spésiale -- //
	{	
		global $link;
		$result=mysqli_query($link,$query);
		if(!$result){
			die("(Error_".mysqli_errno($link).") ".mysqli_error($link));
		}
		return $result;
	}

	function myQuerySelect($query,$type)// -- register Select -- //
	{ 
		global $link;
		$result=myQueryExec($query);
		switch($type)
		{
			case "count":
				return mysqli_num_rows($result);
			break;
			case "assoc":
				if(mysqli_num_rows($result) > 1){
					$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
				}else{
					$data=mysqli_fetch_array($result,MYSQLI_ASSOC);
				}
				return $data;
			break;
		}
	}
	
	function checkBdd($str,$entity) // -- verification de la bdd -- //
	{ 
		switch($entity)
		{
			case "login":
				if(myQuerySelect("SELECT id FROM users WHERE login=\"".myEscapeStr($str)."\"",'count'))
					return false;
			break;
			case "email":
				if(myQuerySelect("SELECT id FROM users WHERE email=\"".myEscapeStr($str)."\"",'count'))
					return false;
			break;
		}
		return true;
	}
	
	// -- liste de fonction pour les 'path' -- //
	function securePath($root,$rootUser,$path)
	{
		$path=realpath($path);
		$root=realpath($root."/".$rootUser);
		$occu=substr_count($path,$root);
		if($occu == 0){
			die("SINON TU PEUX RESTER DANS TON BOX MOFO!!!");
		}
	}
	
	function vFolderPathToCopy($savePath,$path)
	{
		$path=realpath($path);
		$savePath=realpath($savePath);
		$occu=substr_count($path,$savePath);
		return ($occu == 0) ? true : false;
	}
	function getPath($root,$rootUser,$get)
	{
		if(!empty($get['path'])){
			$path=fixpath($root,$rootUser,$get['path'],"decode");
			if(!is_dir($path)){
				$path=subLastDir($path);
			}
		}else{
			$path=$root."/".$rootUser;
		}
		return $path;
	}
	
	function fixpath($root,$rootUser,$path,$type)
	{
		$userRoot=$root."/".$rootUser;
		switch($type)
		{
			case "decode":
				if($path == "/"){
					$path=$root."/".$rootUser;
				}else{
					$path=$userRoot.$path;
				}
			break;
			case "encode":
				$length=strlen($userRoot);
				$path=substr_replace($path,"",0,$length);
				$path=str_replace(" ","%20",$path);
			break;
		}
		return $path;
	}
	function subLastDir($path)
	{
		$pos=strripos($path, "/");
		$newPath=substr($path, 0, $pos);
		return $newPath;
	}
	// -- fin de la liste de fonction pour les 'path' -- //
	
	// -- liste de fonction pour les CTRL C/X/V -- //
	function getFolderPath($pathFolder,$nameFolder,$type)
	{
		unset_cut_copy();
		switch($type)
		{
			case "copy":
				$_SESSION['copyPathFolder']=$pathFolder;
			break;
			case "cut":
				$_SESSION['cutPathFolder']=$pathFolder;
			break;
		}
		$_SESSION['nameFolder']=$nameFolder;
	}
	
	function getFilePath($pathFile,$nameFile,$type)
	{
		unset_cut_copy();
		switch($type)
		{
			case "copy":
				$_SESSION['copyPathFile']=$pathFile;
			break;
			case "cut":
				$_SESSION['cutPathFile']=$pathFile;
			break;
		}
		$_SESSION['nameFile']=$nameFile;
	}
	
	function unset_cut_copy()
	{
		unset($_SESSION['copyPathFolder']);
		unset($_SESSION['cutPathFolder']);
		unset($_SESSION['copyPathFile']);
		unset($_SESSION['cutPathFile']);
		unset($_SESSION['nameFolder']);
		unset($_SESSION['nameFile']);
	}
	// -- fin de la liste de fonction pour les CTRL C/X/V -- //
	
	// -- liste de fonction pour les chaine de caractair -- //
	function myEscapeStr($str)
	{
		global $link;
		$str=mysqli_real_escape_string($link,$str);
		return $str;
	}
	
	function hashStr($password,$login)
	{
		global $hashKey;
		$hashPass=hash("sha256", $hashKey.$password.$login);
		return $hashPass;
	}
	
	function checkStr($str,$entity)
	{
		switch($entity)
		{
			case "folder":
				if(preg_match("#^[\w-_.()\s]+$#",$str)){
					return true;
				}
			break;
			case "file":
				if(preg_match("#^[\w-_.()]+\.[\w]+$#",$str)){
					return true;
				}
			break;
			case "login":
				if(preg_match("#^[\w-_.]{3,}$#",$str)){
					return true;
				}
			break;
			case "password":
				if(preg_match("#^[\w]{6,}$#",$str)){
					return true;
				}
			break;
			case "email":
				if(preg_match("#^[\w.-_]+@[\w]+\.[\w]{2,6}$#",$str)){
					return true;
				}
			break;
		}
		return false;
	}
	// -- fin de la liste de fonction pour les chaine de caractair -- //
	
	function unset_rewrite()
	{
		unset($_SESSION['content_rewrite']);
		unset($_SESSION['nb_line']);
		unset($_SESSION['pathFile']);
	}
?>