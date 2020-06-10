<?php 
	include_once 'models/db.php';
	$dbInfo = new db();
	print_r($dbInfo);

	echo $_POST['tema'].'<br>';
	echo $_POST['pregunta'].'<br>';
	echo $_POST['opcA'].'<br>';
	echo $_POST['opcB'].'<br>';
	echo $_POST['opcC'].'<br>';
	echo $_POST['opcD'].'<br>';
	echo 'Correcta: '.$_POST['res'].'<br>';

