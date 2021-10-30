<?php
session_start();
if(empty($_SESSION['name'])){
	header("location:index.php");
}
include_once '../../core/dbcon.php';
?>

<html>
<header>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Levitate / Contents</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/admin-styles.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="../../assets/js/semantic.min.js"></script>
</header>
<body>
<?php
	$logo='../../assets/img/logo.png';
	$home='../../admin/';
	$resources='../../resources/';
	$content='../../contents/';
	$queue='../queue/';
	$sbj='../subject/';
	$articles='../manage/';
	$create='../';
	$logout='../../core/auth/Logout.php';
	include_once '../../core/nav.php';
?>
<!-- Welcome -->
<div class="top-box fbox">
    <div class="topbox-wrapper">
        <h1>Your Articles</h1>
        <p>You can view the status of all articles you have created, <?php echo $_SESSION['name'];?></p>
    </div>
</div>
<div class="pgcontent-wrapper">
    <div class="ui pointing secondary menu">
        <a class="item active" data-tab="first"><i class="checkmark icon"></i> Approved</a>
        <a class="item" data-tab="second"><i class="wait icon"></i> Awaiting Moderation</a>
        <a class="item" data-tab="third"><i class="remove icon"></i> Denied</a>
    </div>
    <div class="ui tab segment active" data-tab="first">
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Article ID</th>
                <th>Article Name</th>
                <th>Subject</th>
                <th>Category</th>
                <th>Submission Time</th>
                <th>Approved by:</th>
                <th>Note</th>
            </tr>
            </thead>
            <tbody>
				<?php
				try{
					$stmt = $con->prepare("SELECT aid, articleName, sbj, cid, status, authid, timestamp, adminid FROM articles WHERE status = ? AND authid= ?");
					$stmt->execute(['2', $_SESSION['id']]);
					while ($umdata = $stmt->fetch(PDO::FETCH_ASSOC))
					{
						$aid = $umdata['aid'];
						$aname = $umdata['articleName'];
						$timestamp = $umdata['timestamp'];
						
						$sbj = $con->prepare('SELECT sbjname FROM sbjcategory WHERE sid=?');
						$sbj->execute([$umdata['sbj']]);
						$sbjname = $sbj->fetch();
						
						$cat = $con->prepare('SELECT cname FROM categories WHERE cid=?');
						$cat->execute([$umdata['cid']]);
						$cname = $cat->fetch();
						
						$authname = $con->prepare("SELECT username FROM usrauth WHERE id=?");
						$authname->execute([$umdata['adminid']]);
						$name = $authname->fetch();
						$adminname = $name['username'];
						
						echo '<tr><td>'.$aid.'</td>';
						echo '<td>'.$aname.'</td>';
						echo '<td>'.$sbjname['sbjname'].'</td>';
						echo '<td>'.$cname['cname'].'</td>';
						echo '<td>'.$timestamp.'</td>';
						echo '<td>'.$adminname.'</td>';
						echo '<td></td>';
					}
				}
				catch(PDOException $e){
					echo "error".$e->getMessage();
				}
				?>
            </tbody>
        </table>
    </div>
    <div class="ui tab segment" data-tab="second">
        <table class="ui celled table">
            <thead>
				<tr>
					<th>Article ID</th>
					<th>Article Name</th>
					<th>Subject</th>
					<th>Category</th>
					<th>Submission Time</th>
				</tr>
            </thead>
            <tbody>
				<?php
				try{
					$stmt = $con->prepare("SELECT aid, articleName, sbj, cid, status, authid, timestamp FROM articles WHERE status = ? AND authid= ?");
					$stmt->execute(['1', $_SESSION['id']]);
					while ($umdata = $stmt->fetch(PDO::FETCH_ASSOC))
					{
						$aid = $umdata['aid'];
						$aname = $umdata['articleName'];
						$timestamp = $umdata['timestamp'];
						
						$sbj = $con->prepare('SELECT sbjname FROM sbjcategory WHERE sid=?');
						$sbj->execute([$umdata['sbj']]);
						$sbjname = $sbj->fetch();
						
						$cat = $con->prepare('SELECT cname FROM categories WHERE cid=?');
						$cat->execute([$umdata['cid']]);
						$cname = $cat->fetch();
						
						echo '<tr><td>'.$aid.'</td>';
						echo '<td>'.$aname.'</td>';
						echo '<td>'.$sbjname['sbjname'].'</td>';
						echo '<td>'.$cname['cname'].'</td>';
						echo '<td>'.$timestamp.'</td>';
					}
				}
				catch(PDOException $e){
					echo "error".$e->getMessage();
				}
				?>
            </tbody>
        </table>
    </div>
    <div class="ui tab segment" data-tab="third">
        <table class="ui celled table">
            <thead>
				<tr>
					<th>Article ID</th>
					<th>Article Name</th>
					<th>Subject</th>
					<th>Category</th>
					<th>Denied By:</th>
					<th>Note</th>
					<th>Actions:</th>
				</tr>
            </thead>
            <tbody>
				<?php
				try{
					$stmt = $con->prepare("SELECT aid, articleName, sbj, cid, status, authid, timestamp, adminid, adminnote FROM articles WHERE status = ? AND authid= ?");
					$stmt->execute(['0', $_SESSION['id']]);
					while ($umdata = $stmt->fetch(PDO::FETCH_ASSOC))
					{
						$aid = $umdata['aid'];
						$aname = $umdata['articleName'];
						$anote = $umdata['adminnote'];
						
						$authname = $con->prepare("SELECT username FROM usrauth WHERE id=?");
						$authname->execute([$umdata['adminid']]);
						$name = $authname->fetch();
						$adminname = $name['username'];
						
						$sbj = $con->prepare('SELECT sbjname FROM sbjcategory WHERE sid=?');
						$sbj->execute([$umdata['sbj']]);
						$sbjname = $sbj->fetch();
						
						$cat = $con->prepare('SELECT cname FROM categories WHERE cid=?');
						$cat->execute([$umdata['cid']]);
						$cname = $cat->fetch();
						
						echo '<tr><td>'.$aid.'</td>';
						echo '<td>'.$aname.'</td>';
						echo '<td>'.$sbjname['sbjname'].'</td>';
						echo '<td>'.$cname['cname'].'</td>';
						echo '<td>'.$adminname.'</td>';
						echo '<td>'.$anote.'</td>';
						echo '<td></td>';
					}
				}
				catch(PDOException $e){
					echo "error".$e->getMessage();
				}
				?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('.menu .item').tab();
</script>
</body>
</html>