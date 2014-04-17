<h2 >Bienvenu utilisateur !</h2>
<h3>Connecter vous</h3>		
<form action="index.php?action=login" method="post">	
	<input placeholder="Login" type="text" name="login" value="<?php if(isset($_POST['login'])){echo $_POST['login'];} ?>">
	<?php if(!empty($error_login_return)){ echo "<p>".$error_login_return[0].$error_login_return[2]."</p>"; } ?>
	<input placeholder="Password" type="password" name="password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>">
	<?php if(!empty($error_login_return[1])){ echo "<p>".$error_login_return[1]."</p>"; } ?>
	<input type="submit" data-translate-text="BECOME_A_MEMBER" value="Valider">
</form>
<p>
	<a href="#">password oublier?</a>
</p>
<h3>ou</h3>
<form action="index.php?action=register" method="post">
	<h3 data-translate-text="POPUP_SIGNUP_TITLE">enregistrer vous</h3>
	<table>
		<tr>
			<td>
				<input class="signup-text has-text" placeholder="Login" type="text" name="login" value="<?php if(isset($_POST['login'])){echo $_POST['login'];} ?>">
				<?php if(!empty($error_return)){ echo "<p class=\"error_register\">".$error_return[0]."</p>"; } ?>
			</td>
			<td>
				<input class="signup-text has-text" placeholder="Email Address" type="text" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
				<?php if(!empty($error_return)){ echo "<p class=\"error_register\">".$error_return[3]."</p>"; } ?>
			</td>
		</tr>
		<tr>
			<td>
				<input class="signup-text has-text" placeholder="Password" type="password" name="password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>">
				<?php if(!empty($error_return)){ echo "<p class=\"error_register\">".$error_return[1]."</p>"; } ?>
			</td>
			<td>
				<input class="signup-text has-text" placeholder="vPassword" type="password" name="vpassword" value="<?php if(isset($_POST['vpassword'])){echo $_POST['vpassword'];} ?>">
				<?php if(!empty($error_return[2])){ echo "<p class=\"error_register\">".$error_return[2]."</p>"; } ?>
			</td>
		</tr>
	</table>
	<input type="submit" class="btn btn-large btn-primary submit" data-translate-text="BECOME_A_MEMBER" value="Sign Up">
</form>
	
