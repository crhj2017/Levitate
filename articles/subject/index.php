<?php
session_start();
if(empty($_SESSION['name'])){
	header("location:../index.php");
}else if($_SESSION['permission']==0){
	header("location:../../user/");
}
include_once '../../core/dbcon.php';
?>
<html>

<header>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Levitate / Subjects</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/admin-styles.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/semantic.min.css">
    <link rel="stylesheet" href="../../assets/Editor/dist/ui/trumbowyg.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../../assets/js/semantic.min.js"></script>
</header>

<body>
<!-- Navbar -->
<?php
	$logo='../../assets/img/logo.png';
	$home='../../admin/';
	$resources='../../resources/';
	$content='../../contents/';
	$queue='../queue/';
	$sbj='';
	$articles='../manage/';
	$create='../';
	$logout='../../core/auth/Logout.php';
	include_once '../../core/nav.php';
?>
<div class="top-box fbox">
    <div class="topbox-wrapper">
        <h1>Edit subjects.</h1>
        <p>Change the subjects and categorys relating to them, <?php echo $_SESSION['name'];?></p>
    </div>
</div>

<div class="table-container">
	<table class="ui celled striped table">
	<thead>
		<tr>
			<th>Subject</th>
			<th>Actions</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$sbj=$con->prepare('SELECT sid, sbjname FROM sbjcategory');
			$sbj->execute();
			
			while ($data = $sbj->fetch(PDO::FETCH_ASSOC)){
				$sbjname=$data['sbjname'];
				$sid=$data['sid'];
								
				echo '<tr><td>'.$sbjname.'</td>';
				echo '<td><button class="ui secondary mini button" onclick="editmodal(1,'.$sid.');">Edit Categories</button>';
				echo '<button class="ui secondary mini button" onclick="editmodal(2,'.$sid.');">Edit Teachers</button></td>';
			}
		?>
</div>

<script>
	function editmodal(func,id){
		if(func==1){
			window.location.assign('categories/index.php?sid='+id);
		}else if(func==2){
			window.location.assign('teachers/index.php?sid='+id);
		}
	}
</script>
</body>

</html>