<?php
include_once '../../core/dbcon.php';
session_start();
try{
	if($_GET['id']==$_SESSION['authid']){
		#Script to update article with user's edits
		$insert = $con->prepare("UPDATE articles SET articleName=?,articleContent=? WHERE aid=?");
		$insert->setFetchMode(PDO::FETCH_ASSOC);
		$name = $_GET['name'];
		$content = $_GET['content'];
		$id = $_GET['id'];
		$insert->execute([$name,$content,$id]);
	}elseif($_SESSION['permission']==1){
		#Script to update article with user's edits
		$insert = $con->prepare("UPDATE articles SET articleName=?,articleContent=? WHERE aid=?");
		$insert->setFetchMode(PDO::FETCH_ASSOC);
		$name = $_GET['name'];
		$content = $_GET['content'];
		$id = $_GET['id'];
		$insert->execute([$name,$content,$id]);
	}else{
		header("location:../queue/");
	}
}
catch(PDOException $e){
    echo "error".$e->getMessage();
}
header("location:../queue/");