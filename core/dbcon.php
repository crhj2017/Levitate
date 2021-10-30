<?php
$servername = "localhost";
$dbname = "levitateolp";
$username = "root";
$password = "";

	try{
		$con = new PDO ("mysql:host=$servername;dbname=$dbname","root",""); 
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	catch(PDOException $e)
		{
		echo "error:".$e->getMessage();
		}

?>
