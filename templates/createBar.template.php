<?php
	echo"<nav><ul>";
	
	if(!empty($_SESSION['copyPathFile'])){
		echo "<li><a class=\"right\" href=\"index.php?action=pastFile&amp;pathFile=".$_SESSION['copyPathFile']."&amp;nameFile=".$_SESSION['nameFile']."&amp;path=".$apath."\">Paste File</a></li>";
	}
	if(!empty($_SESSION['cutPathFile'])){
		echo "<li><a class=\"right\" href=\"index.php?action=moveFile&amp;pathFile=".$_SESSION['cutPathFile']."&amp;nameFile=".$_SESSION['nameFile']."&amp;path=".$apath."\">Paste File</a></li>";
	}
	if(!empty($_SESSION['copyPathFolder'])){
		echo "<li><a class=\"right\" href=\"index.php?action=pastFolder&amp;pathFile=".$_SESSION['copyPathFolder']."&amp;nameFile=".$_SESSION['nameFolder']."&amp;path=".$apath."\">Paste Folder</a></li>";
	}
	if(!empty($_SESSION['cutPathFolder'])){
		echo "<li><a class=\"right\" href=\"index.php?action=moveFolder&amp;pathFile=".$_SESSION['cutPathFolder']."&amp;nameFile=".$_SESSION['nameFolder']."&amp;path=".$apath."\">Paste Folder</a></li>";
	}
	echo "</ul></nav>";
?>