<?php
#Starts session and loads JQuery
session_start();
echo '<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>';
#Checks for no login/wrong permission
if(empty($_SESSION['name'])){
	header("location:../");
}elseif($_SESSION['permission']==0){
	header('LOCATION:../user');
}
?>

<html>
	<header>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Levitate / Dashboard</title>
        <link rel="stylesheet" type="text/css" href="../assets/css/admin-styles.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/semantic.min.css">
        <script src="../assets/js/semantic.min.js"></script>
	</header>
    <body>
	<!-- Nav bar -->
	<?php
		$logo='../assets/img/logo.png';
		$home='../admin/';
		$resources='../resources/';
		$content='../contents/';
		$queue='../articles/queue/';
		$sbj='../articles/subject/';
		$articles='../articles/manage/';
		$create='../articles/';
		$logout='../core/auth/Logout.php';
		include_once '../core/nav.php';
	?>
<div class="top-box fbox">
    <div class="topbox-wrapper">
        <h1>DASHBOARD</h1>
        <div>Welcome,<?php echo $_SESSION['name'];?></div>
    </div>
</div>
    <script>
        $('.ui.dropdown')
            .dropdown()
        ;
    </script>
    </body>
</html>
