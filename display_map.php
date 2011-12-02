<?php
$q=empty($_REQUEST['q'])?'Bangalore':$_REQUEST['q'];
$url="http://in.maps.yahoo.com/#?z=14&addr=".urlencode($q);
?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>Green City Route Map</title>
<meta name="generator" content="editplus">
<meta name="author" content="">
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body >
<iframe id='mapid' src="<?php echo $url;?>" width="100%" height='100%' frameborder='0'></iframe>
</body>
</html>
