<?php
include("common.inc");
$fields= setfields($commuter_form_fields,$_REQUEST);
$sql="insert into commuter (COMMUTER_ID,";
$fields['Pass']='yahoo';
$values='null,';
foreach($fields as $field=>$fieldvalue)
{
	$sql .=$field.',';
	$values .="'".$fieldvalue."',";
}
$sql=substr($sql,0,-1).')values ('.substr($values,0,-1);
$sql.=")";
insert_record($conn,$sql);
$sql="select COMMUTER_ID from commuter where email='".$_REQUEST['email']."'";
foreach ($conn->query($sql) as $row) 
{
	$list=$row;
}	
$_SESSION['loggedin']=1;
$_SESSION['COMMUTER_ID']=$list['COMMUTER_ID'];
header('Location:commuters.php?msg=SRG');
?>