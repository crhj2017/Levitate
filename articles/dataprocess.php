<?php
#Gets session data
session_start();
include_once '../core/dbcon.php';
extract($_REQUEST);
$func = $_POST['func'];

if($func==0){
	try{
		#Gets url data
		$title = $_POST['name'];
		$content = $_POST['content'];
		$authid = $_SESSION['id'];
		
		$sbj = $_POST['subject'];
		$sid = $con->prepare('SELECT sid FROM sbjcategory WHERE sbjname=?');
		$sid->execute([$sbj]);
		$sbjid = $sid->fetch();
		
		$cat = $_POST['cat'];
		$catid = $con->prepare('SELECT cid FROM categories WHERE cname=?');
		$catid->execute([$cat]);
		$cid = $catid->fetch();
		
		$timestamp = gmdate('Y-m-d h:i:s \G\M\T', time());
		$insert = $con->prepare("INSERT INTO articles (articleName,sbj,cid,articleContent,status,authid,timestamp) VALUES(?,?,?,?,?,?,?) ");
		$insert->setFetchMode(PDO::FETCH_ASSOC);
		$insert->execute([$title,$sbjid['sid'],$cid['cid'],$content,1,$authid,$timestamp]);
		$_SESSION["message"]="success";
	}
	catch(PDOException $e){
		echo "error".$e->getMessage();
	}
}else if($func==1){
	try{
		$sbjname = $con->prepare('SELECT sid FROM sbjcategory WHERE sbjname=?');
		$sbjname->execute([$_POST['sbj']]);
		$sbjdata=$sbjname->fetch();

		$cat = $con->prepare('SELECT cname FROM categories WHERE sid=?');
		$cat->execute([$sbjdata['sid']]);
		while($catdata = $cat->fetch(PDO::FETCH_ASSOC)){
            echo '<option class="item" value="'.$catdata['cname'].'">'.$catdata['cname'].'</option>';
		}
	}catch(PDOException $e){
		echo "error".$e->getMessage();
	}
}
?>