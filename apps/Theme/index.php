<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>

<title>Lamp</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<style type="text/css">
  html { height:100%; font-size:100%;}
  body {	
	font-family:arial;
	color:#fff;
	background:#000 url(/Theme/img/bg.jpg) no-repeat;
	background-size:100% 100%;
	height:100%;
	margin:0px;
	padding:0px;
	overflow:hidden;
	margin-top:20px;
  }
  #logo {
	padding-top:10px;
       background:url(/Theme/img/logo.png) no-repeat;
	width:166px;
	height:107px;
	margin:0 auto;
  }
 ul {  padding:0px;box-sizing:border-box;list-style:none; margin:20px; margin-bottom:0px;}
 li { 
	font-size:1.3em;
	font-weight:bold;
	box-sizing:border-box;
	position:relative;
	margin-bottom:10px;
	display:inline-block;
	width:100%;
	padding: 20px; 
	border-radius:20px; 
	background: rgba(0,0,0,0.8); 
	border-bottom:1px solid rgba(255,255,255,0.2);
 }
.title {
	font-size:1.3em;
	font-weight:bold;
	box-sizing:border-box;
	position:relative;
	margin-bottom:10px;
	display:inline-block;
	width:100%;
	padding: 20px; 
	border-radius:20px; 
	background: rgba(0,0,0,0.8); 
	border-bottom:1px solid rgba(255,255,255,0.2);
 }
 .pos { padding:2px; background:#000; color:#00ff00!important; }
 .neg { padding:2px; background:#000; color:#ff0000!important; }
 .msg { 
	font-size:1.2em;
	background:#fff;
	color:#000;
	box-sizing:border-box;
	position:relative;
	margin-bottom:30px;
	display:inline-block;
	width:100%;
	padding: 20px; 
	border-radius:20px; 
	box-shadow:0px 0px 25px rgba(0,0,0,0.6);
	border-bottom:1px solid rgba(255,255,255,0.2);
 } 
 .hidden { display:none; }
 .btn {
      
	font-size:1.3em;
	background:green;
	color:#fff;	
	text-align:center;
	text-decoration:none;
	box-sizing:border-box;
	position:relative;
	margin-bottom:0px;
	
	display:inline-block;
	width:100%;
	padding: 20px; 
	border-radius:20px; 

	border-top:1px solid rgba(255,255,255,0.2);
}
 a:active, a:visited, a  { outline:0px; }
 select { border-radius:5px; background:#000; color:#fff; border:0px; padding:15px; outline:0;}
 .alert li { background:green!important; text-align:center; }
 .small { font-size:.8em!important; }
 .grey { color:#d6d6d6; }
 .center { text-align:center; }
 .indicator {
	float:left;
 	display:block;
	background:#fff;
	margin-right:10px;
	height:25px;
	width:24px;
	border-radius:50%;
	border-bottom:1px solid rgba(0,0,0,0.8);
 }
 .purple {
	background:#7e00b5!important; 
 }
 .ltblue {
	background:#0dfff1!important; 
 }
 .yellow {
	background:#ffea00!important;
 }
 .orange{
	background:#ff3b0d!important; 
 }
 .settings { 
	
	position:absolute;
	right:15px;
	height:24px;
	width:24px;
	background:url(/Theme/img/settings.png) no-repeat;
	background-size:cover;
 }
</style>
<script type="text/javascript">
	
	$(window).load( function () {
	 console.log('hi');
  	 window.scrollTo(0,0); 
	});

$(document).ready ( function () {

	$('#lamp').change( function () {
	console.log( $(this).val() );
	 $('.list').hide();
	 $('#' + $(this).val() ).fadeIn();
	});

	setTimeout ( function () {
		$('.alert').fadeOut();
	}, 2200);
});
</script>
</head>
<body>
	<div id="logo"></div>

        <tmpl type="system.messages" />
         <tmpl type="view" />
</body>
</html>