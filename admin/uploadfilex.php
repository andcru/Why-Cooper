<head>
<script type="text/javascript" src="/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/tiny_mce/tiny_mce_popup.js"></script>
<script type="text/javascript" src="/js/upload.js"></script>

<?php if(@$_SESSION['uploaded_file']): ?>
<script type="text/javascript">
$(document).ready(function() {
	insertConfig("<?php echo $_SESSION['uploaded_file']; ?>");
});
</script>
<?php unset($_SESSION['uploaded_file']); endif; ?>
<link rel="stylesheet" href="/css/main.css">
</head>
<body>

<ul>
	<li class="inline"><a id="li_upload">Upload File</a></li>
	<li class="inline"><a id="li_select">Select File</a></li>
</ul>

<div id="uploadfile">
	<form method="POST" action="uploadx" method="POST" enctype="multipart/form-data">
	Upload File: <input type="file" name="file">
	<p> <input type="Submit"> </p>
	</form>
</div>

<div id="selectfile" style="display:none"></div>

<div id="ulres" style="display:none"></div>

<div id="fileinsert"></div>