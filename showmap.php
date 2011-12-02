<?php
include('connection.php');
$dbh=dbconnection('root','','commute');
$sql="select cid,fname from commuters";
foreach ($dbh->query($sql) as $row) 
{
	   	
}
echo $catlist;
?>