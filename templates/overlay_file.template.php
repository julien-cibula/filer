<?php if(!empty($_SESSION['content_rewrite'])){ ?>
<h2>Modifier votre fichier</h2>

<form action="index.php?action=rewrite&amp;path=<?php echo $apath; ?>" method="post">
	<textarea name="rewrite-area" class="hide" id="rewrite-area"  rows="40" cols="200">
		<?php echo "<pre contenteditable=\"true\" id=\"rewrite-pre\">".htmlspecialchars($_SESSION['content_rewrite'])."</pre>"; ?>
	</textarea>
	<br>
	<input type="submit" value="Valider"> 
<a href='index.php?action=close-rewrite'>fermer</a>
</form>
<br><br><br>

<?php } ?>