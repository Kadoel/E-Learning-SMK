<html>
<head>
<title>404 | Tersesat</title>
<style>
body{
	background:url(<?php echo base_url();?>assets/images/bg_404.png);
	background-size:100%;
}

#pesan{
	transform: rotate(8deg);
	-webkit-transform: rotate(8deg);
	-moz-transform: rotate(8deg);
	-o-transform: rotate(8deg);
	width:40%;
	float:right;
	margin-top:10%;
	margin-right:5%;
	font:bold 25px courier;
	color:#fff;
	padding:20px;
	border:5px dashed #fff;
}

#pesan a{
	color:#fff;
	border:2px dashed #fff;
	padding:5px;
	text-decoration:none;
}
</style>
</head>
<body>

<div id="pesan">Anda Mungkin Tersesat dan Tak Tau Arah Jalan Pulang<br/>Karena Anda Butiran Debu<br />
<br /><a href="<?= base_url();?>"><?= base_url(); ?></a>
</div>
</body>
</html>
