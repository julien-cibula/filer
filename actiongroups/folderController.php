<?php
include('./includes/setupFilerController.php');
require_once('./models/folderModel.php');
require_once('./models/userModel.php');
	

if($action != "show"){
	if($action == "createFolder"){ // -- creation dosier --  //
		if(!empty($_POST)){
			if(checkStr($_POST['name'],'folder')){
				createFolder($path, $_POST['name']);
				userLogs($_SESSION['id_user'],$action,$path."/".$_POST['name'],$_POST['name']);
			}
		}	
	
	}elseif($action == "createFile"){ // -- creation fichier -- //
		if(!empty($_POST)){
			if(checkStr($_POST['name'],'file')){
				createFile($path, $_POST['name']);
				userLogs($_SESSION['id_user'],$action,$path."/".$_POST['name'],$_POST['name']);
			}
		}
	
	}elseif($action == "renameFolder"){ // -- renomer dosier -- //
		if(!empty($_POST)){
			renameFolder($pathFile,$_POST['newName']);
			userLogs($_SESSION['id_user'],$action,$pathFile,$_POST['newName']);
		}
	
	}elseif($action == "copyFolder"){ // -- copier dosier -- //
		getFolderPath($apathFile,$nameFile,'copy');
	
	}elseif($action == "cutFolder"){ // -- copier dosier -- //
		getFolderPath($apathFile,$nameFile,'cut');
	
	}elseif($action == "deleteFolder"){ // -- supresion dosier -- //
		deleteFolder($pathFile);
		userLogs($_SESSION['id_user'],$action,$pathFile);
		
	}elseif($action == "deleteFile"){ // -- supresion fichier -- //
		deleteFile($pathFile);
		userLogs($_SESSION['id_user'],$action,$pathFile);
	
	}elseif($action == "pastFolder"){ // -- le CTRL + V -- //
		if(vFolderPathToCopy($pathFile,$path)){
			$newPathFile=copyFolder($nameFile,$pathFile,$path);
			userLogs($_SESSION['id_user'],$action,$pathFile,$newPathFile);
		}else{
			unset_cut_copy();
		}
	
	}elseif($action == "moveFolder"){ // -- deplaser dosier -- //
		moveFolder($nameFile,$pathFile,$path);
		userLogs($_SESSION['id_user'],$action,$pathFile,$path."/".$nameFile);
	}
	header("Location: index.php?path=".$apath); die();
}

	
include('./includes/prepareDisplay.php');
?>