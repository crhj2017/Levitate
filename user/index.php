<?php
#Starts session
session_start();
#Checks permissions
if(empty($_SESSION['name'])){
	header("location:index.php");
}
?>

<html>
<header>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Levitate / Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/admin-styles.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="../assets/js/semantic.min.js"></script>
</header>
<!-- Navbar -->
<?php
	$logo='../assets/img/logo.png';
	$home='../admin/';
	$content='../contents/';
	$queue='../articles/queue/';
	$sbj='../articles/subject/';
	$articles='../articles/manage/';
	$create='../articles/';
	$logout='../core/auth/Logout.php';
	include_once '../core/nav.php';
?>
<!-- Welcome -->
<div class="top-box fbox">
    <div class="topbox-wrapper">
        <h1>DASHBOARD</h1>
        <p>Welcome, <?php echo $_SESSION['name'];?></p>
    </div>
</div>
</html>
