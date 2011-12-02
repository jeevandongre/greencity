<?php
function dbconnection($user,$pass,$db)
{
	try
	{
		$dbh = new PDO("mysql:host=localhost;dbname=$db", $user, $pass);
		return $dbh;
	} 
	catch (PDOException $e) 
	{
		print "Error!: " . $e->getMessage() . "<br/>";
	   die();
	}
}
?>