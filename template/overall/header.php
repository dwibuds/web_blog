<?php
session_start();
ob_start();
include 'config.php';
?>
<!DOCTYPE html PUBLIC>
<html>
<head>
    <?php include'template/head.php'; ?>
</head>
<body>

	<div id="container">

        <div id="header">
        	<?php include'template/header.php'; ?>
        </div>

        <div id="menu">
        	<?php include'template/menu.php'; ?>
        </div>

        <?php include'template/widget.php'; ?>

        <div id="content">
