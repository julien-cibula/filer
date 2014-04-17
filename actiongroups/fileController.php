<?php
include('./includes/setupFilerController.php');
require_once('./models/fileModel.php');
require_once('./models/folderModel.php');
require_once('./models/userModel.php');


if($action != "show"){// -- disposition --  //
	$header=true;
	if($action == "renameFile"){
		if(!empty($_POST)){
			renameFile($pathFile,$_POST['newName']);
			userLogs($_SESSION['id_user'],$action,$pathFile,$_POST['newName']);
		}
		
	}elseif($action == "copyFile"){ // -- memorisation du chemin pour la copy --  //
		getFilePath($apathFile,$nameFile,'copy');
		
	}elseif($action == "cutFile"){ // -- memorisation du chemin pour la copy --  //
		getFilePath($apathFile,$nameFile,'cut');
		
	}elseif($action == "pastFile"){ // -- le CTRL + v --  //
		$newPathFile=copyFile($nameFile,$pathFile,$path);
		userLogs($_SESSION['id_user'],$action,$pathFile,$newPathFile);
		
	}elseif($action == "moveFile"){ // -- deplasement --  //
		moveFile($nameFile,$pathFile,$path);
		userLogs($_SESSION['id_user'],$action,$pathFile,$path."/".$nameFile);
		
	}elseif($action == "upload"){ // -- televersement (^_^) --  //
		if(!empty($_FILES)){
			$result=upload($path,$_FILES);
			userLogs($_SESSION['id_user'],$action,$path."/".$_FILES['file']['name']);
		}
		
	}elseif($action == "download"){
		download($path,$nameFile);
		userLogs($_SESSION['id_user'],$action,$path."/".$nameFile);
		$header=false;
		
	}elseif($action == "rewrite"){ // -- début de l'édision --  //
		if(!empty($_POST)){
			rewriteFile($_POST);
			userLogs($_SESSION['id_user'],$action,$_SESSION['pathFile']);
		}else{
			get_content($path,$nameFile);
		}
		
	}elseif($action == "close-rewrite"){ // -- fin de l'edision --  //
		unset_rewrite();
	}
	
	if($header){
		header("Location: index.php?path=".$apath); die();
	}
}
include('./includes/prepareDisplay.php');
?>