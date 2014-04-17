<?php
	function folderContent($path)
	{
		$files=array();
		$dir=array();
		if(false !== ($od = opendir($path))){
			while (false !== ($filename = readdir($od)))
			{
				if(is_dir($path."/".$filename)){
					$dir[]=$filename;
				}else{
					$files[] = $filename;
				}
			}
		}else{
			die('Error during open folder');
		}
		foreach($dir as $key => $value)
		{
				$folderContent[]= $value;
		}
		foreach($files as $key => $value)
		{
				$folderContent[]= $value;
		}
		return $folderContent;
	}
	
	function createFolder($path,$name)
	{
		if(false === mkdir($path."/".$name, 0777)){
			return false;
		}
	}
	
	function deleteFolder($path)
	{
		if(false !== ($od = opendir($path))){
			while(false !== ($filename = readdir($od)))
			{
				if ($filename == '.' || $filename == '..'){
					continue;
				}
				if(is_dir($path."/".$filename)){
					deleteFolder($path."/".$filename);
				}else{
					unlink($path."/".$filename);
				}
			}
		}else{
			die('Error during open folder');
		}
		closedir($od); 
		rmdir($path);
	}
	
	function renameFolder($path,$newname)
	{
		if(checkStr($newname,'folder')){
			$newPath=subLastDir($path);
			$newPath .="/".$newname;
		}else{
			$newPath=$path;
		}
		rename($path,$newPath);
	}
	
	function moveFolder($nameFolder,$oldPath,$path)
	{
		$newPath=$path."/".$nameFolder;
		rename($oldPath,$path."/".$nameFolder);
		unset_cut_copy();
	}
	
	function copyFolder($nameFolder,$pathFolder,$path)
	{
		$newFolderPath=$path."/".$nameFolder;
		if($pathFolder == $newFolderPath){ 
			$i=0;
			while(is_dir($newFolderPath))
			{ 
				$info=pathinfo($newFolderPath);
				if($i == 0){
					$copy="-Copy";
					$num="";
				}elseif($i > 0){
					$copy="";
					$num="(".$i.")";
					$info['filename']=str_replace("(".($i-1).")","",$info['filename']);
				}
				$newFolderPath=$path."/".$info['filename'].$copy.$num;
				$i++;
			}
		}
		mkdir($newFolderPath, 0777);
			if(false !== ($od = opendir($pathFolder))){
				while(false !== ($filename = readdir($od)))
				{
					if ($filename == '.' || $filename == '..') continue;
					if(is_dir($pathFolder."/".$filename)){
						copyFolder($filename,$pathFolder."/".$filename,$newFolderPath);
					}else{
						copy($pathFolder."/".$filename, $newFolderPath."/".$filename);
					}
				}
			}else{
				die('Error during open folder');
			}
		closedir($od);
		unset_cut_copy();
		return $newFolderPath;
	}
	
	function treeFolder($path)
	{
		$result=array();
		if(false !== ($od = opendir($path))){
			while (false !== ($entry = readdir($od)))
			{
				if (is_dir($path.'/'.$entry)) {
					if ($entry != '.' && $entry != '..') {
						$result[] = $path.'/'.$entry ;
						$result2 = treeFolder($path.'/'.$entry);
						$result = array_merge($result,$result2);
					}
				}
			}
		}
		closedir($od);
		return($result);
	}
?>