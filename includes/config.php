<?php
if(isset($_SESSION['id_user'])){
$rootUser=$_SESSION['id_user'];
	$config['action']=array(
		"show" => "folder",
		"createFolder" => "folder",
		"deleteFolder" => "folder",
		"renameFolder" => "folder",
		"cutFolder" => "folder",
		"moveFolder" => "folder",
		"copyFolder" => "folder",
		"pastFolder" => "folder",
		"createFile" => "folder",
		"deleteFile" => "folder",
		
		"renameFile" => "file",
		"download" => "file",
		"upload" => "file",
		"cutFile" => "file",
		"moveFile" => "file",
		"copyFile" => "file",
		"pastFile" => "file",
		"rewrite" => "file",
		"close-rewrite" => "file",
		
		"disconnection" => "user",
	);
	$config['get']=array('action','pathFile','nameFile','path');
}else{
	$config['action']=array(
		"show" => "user",
		"login" => "user",
		"register" => "user",
	);
	$config['get']=array('action');
}
$rewrite_tab=array("txt","html","php","css","js");
$config['defaults']['action']= "show";
$root='files';
$max_size_upload="30 Mo";
$hashKey="Monkey_D._Luffy";

// -- registe erreur -- //
define("ER_001001","votre login ne peux pas aitre vide !");
define("ER_001002","votre login dois conporter au minimum 3 caracter !");
define("ER_001003","ce login est deja utiliser !");
define("ER_001004","votre password ne peux pas aitre vide !");
define("ER_001005","votre password dois conporter au minimum 6 caracter !");
define("ER_001006","votre vPassword dois aitre idantique au password !");
define("ER_001007","votre email ne peux pas aitre vide !");
define("ER_001008","format email invalide ! <br> ex : EatSomeFiles@gmail.com");
define("ER_001009","cette email est deja utiliser !");

define("ER_001010","votre login/password est incorrect !");
// -- registe erreur -- //
$config['theIT']=array(
		"1" => "Roy: [picking up the phone] Hello, IT. Have you tried turning it off and on again? Uh... okay, well, the button on the side, is it glowing? Yeah, you need to turn it on... uh, the button turns it on... yeah, you do know how a button works don't you? No, not on clothes.",
		"2" => "Moss: [watching the ad] Well that's easy to remember. [singing in a similar style to the advert] 0118 999 88199 9119 725! [pauses] 3!",
		"3" => "Moss: [dialing] 0115... no... 0118... no... 0118 999 – 3. Hello? Is this the emergency services? Then which country am I speaking to? Hello? Hello? [pauses for thought] I know... [sits down in front of the computer] Subject: Fire. 'Dear Sir stroke Madam, I am writing to inform you of a fire which has broken out at the premises of...' no, that's too formal. [deletes] 'Dear Sir stroke Madam. Fire, exclamation mark. Fire, exclamation mark. Help me, exclamation mark. 123 Carrendon Road. Looking forward to hearing from you. All the best, Maurice Moss.'",
		"4" => "Jen: Why are you doing this? <br> Roy: Same reason I do everything: to have sex with a lady. " ,
		"5" => "Roy: Don't Google the question, Moss!" ,
		"6" => "Moss: [snorts] Memory is RAM!" ,
		"7" => "Jen: With all due respect John, I am the head of IT and I have it on good authority that if you type 'Google' into Google, you can break the Internet" ,
		"8" => "Jen: What is it? <br>  Moss: This, Jen, is the Internet."
	);
?>
