<?php
session_start();

date_default_timezone_set("Europe/Paris"); // set date default timezone
@$link=mysqli_connect('127.0.0.1','root','','it_cloud'); // connect to bdd
if(!$link){die(mysqli_connect_error());} // if error while connect to bdd

include ('includes/config.php');
include ('includes/tools.php');


foreach($_GET as $get => $value){
	if (!in_array($get, $config['get']))
		die("bad url !");
}

$action = $config['defaults']['action'];
if (!empty($_GET['action']))
	$action = $_GET['action'];

if (!array_key_exists($action, $config['action']))
	die("bad action !");

$actiongroup_path = './actiongroups/'.$config['action'][$action].'Controller.php';
if (is_readable($actiongroup_path))
	include ($actiongroup_path);
else
	die("bad file : ".$actiongroup_path."!");

include('views/main.view.php');
?>