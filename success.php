<?php
	include("common.inc");
	display_header();
	$code=empty($_REQUEST['msg'])?'GEN':$_REQUEST['msg'];
	$msg=array('SRG'=>'You are success fully registered.Please check your email for your account authentication details.','GEN'=>'Your action is successful.','LGT'=>'You are successfully logged out.','RSB'=>'Your request has been submitted to respective travel vendors.<br/> Shortly they will be in touch with you to provide the pooled commute service.','SQT'=>'Your commute solution details are sent to commuters.If they are interested they will be in touch with you.');
	echo "<div style='font-size:12px;color:#20941c'><B>".$msg[$code]."</B></div>";
	display_footer();
?>