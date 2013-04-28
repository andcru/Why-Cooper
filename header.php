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
        <div id="content" class="container">
<?php include('errors.php'); ?>