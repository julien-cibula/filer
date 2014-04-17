<?php
	function get_content($path,$nameFile)
	{
		$fp=fopen($path."/".$nameFile,'r+');
		$content='';
		while(!feof($fp))
		{
			$content .= fread($fp, 8192);
		}
		$nb = substr_count($content,"\n")+2;
		$_SESSION['content_rewrite']=$content;
		$_SESSION['nb_line']=$nb;
		$_SESSION['pathFile']=$path."/".$nameFile;
	}

		function createFile($path,$name)
	{
		if(false === fopen($path."/".$name,"c")){
			return false;
		}
	}
	
	function deleteFile($path)
	{
		if(is_file($path)){
			if(false === unlink($path)){
				return false;
			}
		}
	}
	
	function renameFile($path,$newname)
	{
		if(checkStr($newname,'file')){
			$newPath=subLastDir($path);
			$newPath .="/".$newname;
		}else{
			$newPath=$path;
		}
		rename($path,$newPath);
	}
	
	function copyFile($nameFile,$pathFile,$path)
	{
		$newFilePath=$path."/".$nameFile;
		if($pathFile == $newFilePath){ 
			$i=0;
			while(is_file($newFilePath))
			{ 
				$info=pathinfo($newFilePath);
				if($i == 0){
					$copy="-Copy";
					$num="";
				}elseif($i > 0){
					$copy="";
					$num="(".$i.")";
					$info['filename']=str_replace("(".($i-1).")","",$info['filename']);
				}
				$newFilePath=$path."/".$info['filename'].$copy.$num.".".$info['extension'];
				$i++;
			}
		}
		copy($pathFile,$newFilePath);
		unset_cut_copy();
		return $newFilePath;
	}
	function moveFile($nameFile,$oldPath,$path)
	{
		$newPath=$path."/".$nameFile;
		rename($oldPath,$path."/".$nameFile);
		unset_cut_copy();
	}
	
	function upload($path,$file)
	{
		global $max_size_upload;
		$name=$file['file']['name'];
		$temp_file=$file['file']['tmp_name'];
		$size_o=filesize($file['file']['tmp_name']);
		$size_info=explode(" ",$max_size_upload);
		if($size_info[1] == "Go"){
			$size=($size_o/1024/1024/1024);
		}elseif($size_info[1] == "Mo"){
			$size=($size_o/1024/1024);
		}
		if($size > $size_info[0]){
			return;
		}
		if(is_uploaded_file($temp_file)){
			$result = move_uploaded_file($temp_file, $path."/".$name);
			if ($result) {
				return $valid="Transsfert réussi";
			}
		}
	}
	
	function download($path,$nameFile)
	{
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($path."/".$nameFile));
		header('Content-Length: ' . filesize($path."/".$nameFile));
		$flux=fopen($path."/".$nameFile,"rb"); // rb(read/binary)
		$contents = '';
		while (!feof($flux))
		{
		  $contents .= fread($flux, 8192);
		}
		fclose($flux);
		echo $contents; 
		ob_flush(); // clean client buffer
		flush(); // clean server buffer
	}
	
	function rewriteFile($post)
	{
		if (is_writable($_SESSION['pathFile'])) {
			$fp=fopen($_SESSION['pathFile'], "w");
			fwrite($fp, $post['rewrite-area']);
			fclose($fp);
			$info=pathinfo($_SESSION['pathFile']);
			get_content($info['dirname'],$info['basename']);
		}	
	}
?>