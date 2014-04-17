<?php
	echo"<div class=\"hide_inputs\" id=\"form_newFolder\"><form method=\"post\" action=\"index.php?action=createFolder&amp;path=".$apath."\">";
	echo "<input type=\"text\" name=\"name\" placeholder=\"Folder Name...\">";
	echo "<input class=\"submit_button\" type=\"submit\" name=\"button\" value=\"New Folder\">";
	echo "</form></div>";
	echo "<div class=\"hide_inputs\" id=\"form_newFile\"><form method=\"post\" action=\"index.php?action=createFile&amp;path=".$apath."\">";
	echo "<input type=\"text\" name=\"name\" placeholder=\"File Name... aaa.ext\">";
	echo "<input class=\"submit_button\" type=\"submit\" name=\"button\" value=\"New File\">";
	echo "</form></div>";
	echo "<div class=\"hide_inputs\" id=\"form_uploadFile\"><form method=\"POST\" action=\"index.php?action=upload&amp;path=".$apath."\" enctype=\"multipart/form-data\">";
	echo "<input type=\"file\" name=\"file\">";
	echo "<input class=\"submit_button\" type=\"submit\" name=\"button\" value=\"Upload File\">";
	echo "<span id=\"limit_file\">(".$max_size_upload." max)</span></form></div>";
?>