<!DOCTYPE html>
<html>
    <head>
        <title>Why Cooper Union?</title>
        <script type="text/javascript" src="/js/jquery-1.8.0.min.js"></script>
<?php if($_SESSION['cuid']): ?>
	<script src="/js/tiny_mce/jquery.tinymce.js"></script>
	<script src="/js/tiny_mce/tiny_mce.js"></script>
	<script src="/js/textarea.js"></script>
	<script src="/js/ajaxfileupload.js"></script>
	<script src="/js/admin.js"></script>
<?php endif; ?>
        <script src="/js/google.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/main.css">
    </head>
    <body>
        <div class="wrapper">
        <div class="container" id="header">
            <img src="http://placehold.it/980x194">
            <ul>
                <li><a href="#home"        class="nav-link" id="page_home">       </a></li>
                <li><a href="#statement"   class="nav-link" id="page_statement">  </a></li>
                <li><a href="#features"    class="nav-link" id="page_features">   </a></li>
                <li><a href="#showcase"    class="nav-link" id="page_showcase">   </a></li>
                <li><a href="#experiences" class="nav-link" id="page_experiences"></a></li>
                <li class="short"><a href="#press" class="nav-link" id="page_press"></a></li>
                <li><a href="#support"     class="nav-link" id="page_support">    </a></li>
            </ul>
        </div>
        <div class="container">
<?php include('errors.php'); ?>