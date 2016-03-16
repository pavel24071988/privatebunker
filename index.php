<?php
    include_once('connect.php');
    include_once('common_functions.php');
    include 'ajax.php';
?>
﻿<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" media="all" />
        
        <link rel="icon" href="http://privatebunker.ru/favicon.png" type="image/png" />
        <link rel="shortcut icon" href="http://privatebunker.ru/favicon.png" type="image/png" />

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.main.js"></script>
        
        <?php get_sitemetatags($URI, $db); ?>
</head>
<body>

<div class="wrapper">
    <?php include_once('header.php'); ?>
    <?php include_once('content.php'); ?>
    <?php include_once('footer.php'); ?>
</div>

</body>
</html>
