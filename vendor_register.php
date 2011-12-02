<?php
include("common.inc");
$fields= setfields($vendor_form_fields,$_REQUEST);
$sql="insert into vender (VENDER_ID,";
$fields['Pass']='yahoo';
$fields['CST_NUMBER']=substr($fields['company'],0,4).'111';
$values='null,';
foreach($fields as $field=>$fieldvalue)
{
	$sql .=$field.',';
	$values .="'".$fieldvalue."',";
}
$sql=substr($sql,0,-1).')values ('.substr($values,0,-1);
$sql.=")";
insert_record($conn,$sql);
$sql="select vender_id from vender where email='".$_REQUEST['email']."'";
foreach ($conn->query($sql) as $row) 
{
	$list=$row;
}	
$_SESSION['loggedin']=1;
$_SESSION['VENDER_ID']=$list['vender_id'];
$insql="insert into vender_routes values('null','".$list['vender_id']."','1','2','0')";
insert_record($conn,$insql);
header('Location:vendors.php');
?>