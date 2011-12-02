<?php
	include("common.inc");
	session_destroy();
	unset($_SESSION);
	header('Location:index.php?msg=LGT');
?>