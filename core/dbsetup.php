<?php
$servername = "localhost";
$username = "root";
$password = "";

try{
    $initialCon = new PDO("mysql:host=$servername", $username, $password);
    $initialCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    #Creates the DB
	$db = "CREATE DATABASE levitateolp";

    $initialCon->exec($db);
	
	$con = new PDO("mysql:host=$servername;dbname=levitateolp", $username, $password);
	
	#Creates user auth table
    $usrauth = "CREATE TABLE usrauth (
    id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(30) NOT NULL,
    password CHAR(128) NOT NULL,
    permLevel int(1),
	subject VARCHAR(100)
    )";
 
    $con->exec($usrauth);
    echo 'user auth created<br>';
	
	#Creates user info table
    $usrinfo = "CREATE TABLE usrinfo (
    id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL
    )";

    $con->exec($usrinfo);
    echo 'user info created<br>';
	
	#Creates category table
	$category = "CREATE TABLE categories (
    cid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    cname VARCHAR(30) NOT NULL,
	sid INT(6) NOT NULL
    )";
	
	$con->exec($category);
    echo 'categories created<br>';
	
	#Creates subject category table
    $sbjcategory = "CREATE TABLE sbjcategory (
    sid INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    sbjname VARCHAR(30) NOT NULL
    )";

    $con->exec($sbjcategory);
    echo 'sbj category created<br>';
	
	#Creates articles table
    $articles = "CREATE TABLE articles (
    aid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    articleName VARCHAR(100) NOT NULL,
	sbj VARCHAR(100) NOT NULL,
    sid INT(6) NOT NULL,
    cid INT(6) NOT NULL,
	status INT(1) NOT NULL,
	authid INT(6) NOT NULL,
	adminid INT(6) NOT NULL,
	adminnote TEXT NOT NULL,
    articleContent TEXT NOT NULL,
    timestamp TEXT NOT NULL
    )";
	
	$con->exec($articles);
    echo 'articles created<br>';
    }
catch(PDOException $e)
    {
    echo "Errors:".$e->getMessage();
    }
?>