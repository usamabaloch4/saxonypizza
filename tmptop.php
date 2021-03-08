<?php 
session_start();
require "backer/model.php";
if(!isset($_SESSION['orderid']))
{
	$_SESSION['orderid'] = '';
	$_SESSION['incorder'] = array();
}

$model = new Model();


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sindhi Pizza</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
	

	<div class="navbar navbar-default navbar-static-top">
		<div class="container">
			<a href="#" class="navbar-brand"><img src="img/logonew.png" alt="" class="logo"></a>

			<?php require "nav.php"; ?>
		</div>
	</div>

	<div class="header">
		
	</div>

	<div class="container">
		<div class="content">