<?php
echo "<div id=\"tree\"><ul><li><a class=\" "; if($root."/".$rootUser == $path){echo "active";} echo "\" href=\"index.php?path=/\">/</a></li>";
foreach($tree as $key => $value){
	echo '<li><a class=\'treeElem'; if($value == $path){echo " active";} echo'\' data-lvl=\''.$lvl[$value].'\' href=\'index.php?path='.$atree[$key].'\'>'.$name_tree[$value].'</a></li>';
}
echo "</ul></div>";
?>