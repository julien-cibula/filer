<?php
if(isset($_SESSION['id_user'])){
// -- (start) control data //
$folderContent=folderContent($path);
foreach($folderContent as $key => $value){
	if($key == 1){
		$back = dirname($apath);
		if($back =="\\"){$back="/";}
	}
	$name_content[$value]=str_replace(" ","%20",$value);
	if(is_file($path."/".$value)){
		$info=pathinfo($path."/".$value);
		$ext[$value]=$info['extension'];
		if(!is_file("./images/icons/16px/".$ext[$value].".png")){
			$ext[$value]="_blank";
		}
	}
}

$tree=treeFolder($root."/".$rootUser);
foreach($tree as $key => $value){
	$info=pathinfo($value);
	$name_tree[$value]=$info['filename'];
	$lvl[$value]=substr_count($value, "/")-1;
	$atree[$key]=fixpath($root,$rootUser,$value,"encode");
}
// -- (end) control data //

// -- (start) control template //
$templateMain=array(
		"./templates/createBar.template.php",
		"./templates/createInputs.template.php",
		"./templates/showFolderContent.template.php",
);
$templateTree='./templates/treeDir.template.php';
$overlay_file='./templates/overlay_file.template.php';
}

// -- (end) control template //

?>