<?php
	include_once '../../../core/dbcon.php';
	extract($_REQUEST);
	$func = $_POST['func'];
	
	$sbj=$_POST['sbj'];
	if($func==1){
		$id=$_POST['id'];
		$cat = $con->prepare('DELETE FROM categories WHERE cid=?');
		$cat->execute([$id]);
	}elseif($func==2){
		$name=$_POST['name'];
		$cat = $con->prepare('INSERT INTO categories (cname, sid) VALUES (?,?)');
		$cat->execute([$name,$sbj]);
	}
?>