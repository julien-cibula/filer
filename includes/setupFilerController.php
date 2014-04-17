<?php
// -- preparation de la variable $path -- //
if(isset($_GET['nameFile']))
	$nameFile=$_GET['nameFile'];
	
if(isset($_GET['pathFile'])){
	$pathFile=$_GET['pathFile'];
	$pathFile=fixpath($root,$rootUser,$pathFile,"decode");
	$apathFile=fixpath($root,$rootUser,$pathFile,"encode");
}

$path=getPath($root,$rootUser,$_GET);
$apath=fixpath($root,$rootUser,$path,"encode");
securePath($root,$rootUser,$path);

?>