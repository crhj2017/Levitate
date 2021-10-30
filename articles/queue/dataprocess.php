<?php
session_start();
include_once '../../core/dbcon.php';
extract($_REQUEST);

$func=$_POST['func'];
$id=$_POST['id'];
try{
	if($func==0){
		$approve = $con->prepare("UPDATE articles SET status=?, adminid=? WHERE aid=?");
		$approve->setFetchMode(PDO::FETCH_ASSOC);
		$approve->execute(['2',$_SESSION['id'],$id]);
	}elseif($func==1){
		$reason=$_POST['reason'];
		$deny = $con->prepare("UPDATE articles SET status=?, adminid=?, adminnote=? WHERE aid=?");
		$deny->setFetchMode(PDO::FETCH_ASSOC);
		$deny->execute(['0',$_SESSION['id'],$reason,$id]);
	}else if($func==2){
		$feature = $con->prepare("UPDATE articles SET featured=? WHERE aid=?");
		$feature->setFetchMode(PDO::FETCH_ASSOC);
		$feature->execute([1,$id]);
	}else if($func==3){
		$archive = $con->prepare("UPDATE articles SET status=?, featured=? WHERE aid=?");
		$archive->setFetchMode(PDO::FETCH_ASSOC);
		$archive->execute([4,0,$id]);
	}else if($func==4){
		$unpublish = $con->prepare("UPDATE articles SET status=?, featured=? WHERE aid=?");
		$unpublish->setFetchMode(PDO::FETCH_ASSOC);
		$unpublish->execute([1,0,$id]);
	}else if($func==5){
		$unfeature = $con->prepare("UPDATE articles SET featured=? WHERE aid=?");
		$unfeature->setFetchMode(PDO::FETCH_ASSOC);
		$unfeature->execute([0,$id]);
	}
}catch(PDOException $e){
       echo "error".$e->getMessage();
   }
header('LOCATION: ../queue/');
?>