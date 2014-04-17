<?php
	echo"<table><tr><th>Name";
	foreach($folderContent as $key => $value)
	{
			if(is_dir($path."/".$value)){
				if(($path != $root."/".$rootUser || $key > 1) && $key > 0){
					echo "<tr>";
						if($key==1){
							echo "<td>";
							echo "<a href='index.php?path=".$back."'>Parent Directory</a></td>";
						}
						else{
							echo "<td colspan='2' ><form method='post' action='index.php?action=renameFolder&amp;pathFile=".$apath."/".$name_content[$value]."&amp;path=".$apath."'><input name='newName' type='text' value='".$value."'></form>";
							echo "<a href='index.php?path=".$apath."/".$name_content[$value]."'>Ouvrire</a></td>";
							echo "<td><a href='index.php?action=copyFolder&amp;path=".$apath."&amp;pathFile=".$apath."/".$name_content[$value]."&amp;nameFile=".$name_content[$value]."'>CTRL+C</a></td>";
							echo "<td><a href='index.php?action=cutFolder&amp;path=".$apath."&amp;pathFile=".$apath."/".$name_content[$value]."&amp;nameFile=".$name_content[$value]."'>CTRL+X</a></td>";
							echo "<td><a class='delete' onClick='return false' href='index.php?action=deleteFolder&amp;pathFile=".$apath."/".$name_content[$value]."&amp;path=".$apath."'>Sup</a></td>";
						}
					echo "</tr>";
				}
			}
			else{
				echo "<tr>";
					echo "<td><form method='post' action='index.php?action=renameFile&amp;pathFile=".$apath."/".$name_content[$value]."&amp;path=".$apath."'><input name='newName' type='text' value='".$value."'></form>";
					
					// if(in_array($ext[$value],$rewrite_tab)){
						echo "<td><a href='index.php?action=rewrite&amp;path=".$apath."&amp;nameFile=".$name_content[$value]."'>modifier</a></td>";
					// }
					// else{
						// echo "<td>coucou</td>";
					// }
					echo "<td><a href='index.php?action=copyFile&amp;path=".$apath."&amp;pathFile=".$apath."/".$name_content[$value]."&amp;nameFile=".$name_content[$value]."'>CTRL+C</a></td>";
					echo "<td><a href='index.php?action=cutFile&amp;path=".$apath."&amp;pathFile=".$apath."/".$name_content[$value]."&amp;nameFile=".$name_content[$value]."'>CTRL+X</a></td>";
					echo "<td><a class='delete' onClick='return false' href='index.php?action=deleteFile&amp;pathFile=".$apath."/".$name_content[$value]."&amp;path=".$apath."'>Sup</a></td>";
					echo "<td><a href='index.php?action=download&amp;path=".$apath."&amp;nameFile=".$name_content[$value]."'>DL</a></td>";
				echo "</tr>";
			}
	}
	echo "</table>";
?>