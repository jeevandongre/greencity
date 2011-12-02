<?php
	include("common.inc");
	if($_REQUEST['mode']=='exist')
	{
		$arr= explode('_',$_REQUEST['vendorid_routeid']);
		$sql="insert into commuter_route (commuter_id,route_id,vender_id,package_id,f_roundtrip) values ('".$_SESSION['COMMUTER_ID']."','".$arr[1]."','".$arr[0]."','".$_REQUEST['package']."','".$_REQUEST['f_round']."')";
		insert_record($conn,$sql);

		$upsql="update commuter set source='".$_REQUEST['source']."',destination='".$_REQUEST['destination']."' where commuter_id='".$_SESSION['COMMUTER_ID']."'";
		$conn->query($upsql);
	}
	else
	{
		$upsql="update commuter set source='".$_REQUEST['source']."',destination='".$_REQUEST['destination']."' where commuter_id='".$_SESSION['COMMUTER_ID']."'";
		$conn->query($upsql);
	}
	header('Location:success.php?msg=RSB');
?>