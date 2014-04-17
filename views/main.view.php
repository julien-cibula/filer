<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>IT Cloud</title>
	<meta name="description" content="project fileur">
	<meta name="author" content="Julien Cibula">
</head>
	<body>
	<div class="band"><div id="logo"><img src="./images/logoIT.png" height="100" alt="logo"/></div></div>
	<?php 
	echo "<p>".$config['theIT'][rand(1,8)]."</p>";
	if(!empty($login)){include($login);} ?>
	<?php if(isset($_SESSION['id_user'])){
		echo "<a href=\"#\">".$_SESSION['login']."</a>"; ?>&nbsp;&nbsp;
		<a href="index.php?action=disconnection">Disconnection</a>
	<?php } ?>
	<?php if(!empty($overlay_file)){include($overlay_file);} ?>
	<?php if(isset($_SESSION['login'])){ ?>
		<div id="content">
			<div style="float:left; margin:0px 100px 0px 0px;">
				<?php
				if(!empty($templateMain)){
					foreach($templateMain as $template)
					{
						include($template);
					}
				}
				?>
			</div>
			<div style="display:inline;">
				<?php if(!empty($templateTree)){include($templateTree);} ?>
			</div>
		</div>
	<?php } ?>
	<script type="text/javascript" src="js/script.js"></script>	
	</body>
</html>