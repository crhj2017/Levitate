<?php
	include_once '../../../core/dbcon.php';
	extract($_REQUEST);
	$func = $_POST['func'];
	
	$sbj=$_POST['sbj'];
	if($func==1){
		$id=$_POST['id'];
		$cat = $con->prepare('UPDATE usrauth SET subject=0 WHERE id=?');
		$cat->execute([$id]);
	}elseif($func==2){
		$name=$_POST['name'];
		$cat = $con->prepare('UPDATE usrauth SET subject=? WHERE username=?');
		$cat->execute([$sbj,$name]);
	}
?>