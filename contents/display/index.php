<?php
#Starts session
session_start();
#Checks for no login/wrong permission
if(empty($_SESSION['name'])){
	header("location:../");
}
include_once "../../core/dbcon.php";
?>

<html>
	<header>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Levitate / Create</title>
        <link rel="stylesheet" type="text/css" href="../../assets/css/admin-styles.css">
        <link rel="stylesheet" type="text/css" href="../../assets/css/semantic.min.css">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <script src="../assets/js/semantic.min.js"></script>
	</header>
    <body>
	<!-- Nav bar -->
	<?php
		$logo='../../assets/img/logo.png';
		$home='../../admin/';
		$content='../../contents/';
		$queue='../../articles/queue/';
		$sbj='../../articles/subject/';
		$articles='../../articles/manage/';
		$create='../../articles/';
		$logout='../../core/auth/Logout.php';
		include_once '../../core/nav.php';
	?>
	<div class="top-box fbox">
		<div class="topbox-wrapper">
			<h1>View Articles</h1>
			<div>Welcome, <?php echo $_SESSION['name'];?>, See the articles below.</div>
		</div>
	</div>

	<div>
		<?php
			$stmt = $con->prepare("SELECT aid, articleName, sbj, cid, status, authid, articleContent FROM articles WHERE featured=1");
			$stmt->execute();
			while ($umdata = $stmt->fetch(PDO::FETCH_ASSOC)){
				$aid = $umdata['aid'];
				$aname = $umdata['articleName'];
				
				$sbj = $con->prepare('SELECT sbjname FROM sbjcategory WHERE sid=?');
				$sbj->execute([$umdata['sbj']]);
				$sbjname = $sbj->fetch();
				
				$cat = $con->prepare('SELECT cname FROM categories WHERE cid=?');
				$cat->execute([$umdata['cid']]);
				$catname = $cat->fetch();
				
				$authid = $umdata['authid'];
				$authname = $con->prepare("SELECT username FROM usrauth WHERE id=?");
				$authname->execute([$authid]);
				$name = $authname->fetch();
				$username=$name['username'];
				
				echo '<div style="width:95%; margin:3%"><h3>'.$umdata['articleName'].'</h3><br>';
				echo $umdata['articleContent'].'</div>';
			}
		?>
	</div>
	</body>
</html>