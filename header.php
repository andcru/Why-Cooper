<!DOCTYPE html>
<html>
    <head>
        <title>Why Cooper Union?</title>
        <script src="/js/jquery-1.8.0.min.js"></script>
        <script src="/js/isotope/jquery.isotope.min.js"></script>
        <script src="/js/jquery.anythingslider.min.js"></script>
        <script src="/js/jquery.dotdotdot-1.5.7-packed.js"></script>
        <script src="/js/messi.js"></script>
<?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/js/'.$_GET['p'].'.js')) echo sprintf("\t<script src=\"/js/%s.js\"></script>\n",$_GET['p']) ?>
        <script src="//use.typekit.net/xcq2zay.js"></script>
        <script>try{Typekit.load();}catch(e){}</script>
<?php if($_SESSION['cuid']): ?>
	<script src="/js/tiny_mce/jquery.tinymce.js"></script>
	<script src="/js/tiny_mce/tiny_mce.js"></script>
	<script src="/js/textarea.js"></script>
	<script src="/js/ajaxfileupload.js"></script>
	<script src="/js/admin.js"></script>
<?php endif; ?>
        <script src="/js/google.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/isotope.css">
        <link rel="stylesheet" type="text/css" href="/css/theme-minimalist-round.css">
        <link rel="stylesheet" type="text/css" href="/css/messi.min.css" />
    </head>
    <body>
        <div class="wrapper">
        <div class="container" id="header">
            <img src="/img/head.png">
            <ul>
                <li><a href="/home"        class="nav-link">Home</a></li>
                <li><a href="/statement"   class="nav-link">Statement</a></li>
                <li><a href="/projects"    class="nav-link">Projects</a></li>
                <li><a href="/featured"    class="nav-link">Featured</a></li>
                <li><a href="/experiences" class="nav-link">Experiences</a></li>
                <li><a href="/support"     class="nav-link">Support Us</a></li>
            </ul>
        </div>
        <div class="container">
<?php include('errors.php'); ?>