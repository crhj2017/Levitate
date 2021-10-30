<?php
session_start();
if(empty($_SESSION['name'])){
	header("location:../index.php");
}else if($_SESSION['permission']==0){
	header("location:../../user/");
}
include_once '../../../core/dbcon.php';
?>
<html>

<header>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Levitate / Subjects</title>
    <link rel="stylesheet" type="text/css" href="../../../assets/css/admin-styles.css">
    <link rel="stylesheet" type="text/css" href="../../../assets/css/semantic.min.css">
    <link rel="stylesheet" href="../../../assets/Editor/dist/ui/trumbowyg.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../../../assets/js/semantic.min.js"></script>
</header>

<body>
<!-- Navbar -->
<?php
	$logo='../../../assets/img/logo.png';
	$home='../../../admin/';
	$resources='../../../resources/';
	$content='../../../contents/';
	$queue='../../queue/';
	$sbj='../';
	$articles='../../manage/';
	$create='../../';
	$logout='../../../core/auth/Logout.php';
	include_once '../../../core/nav.php';
?>
<div class="top-box fbox">
    <div class="topbox-wrapper">
        <h1>Edit categories.</h1>
        <p>Change the categories relating to 
		<?php
			$sid=$_GET['sid'];
			$sbj=$con->prepare('SELECT sbjname FROM sbjcategory WHERE sid=?');
			$sbj->execute([$sid]);
			$sbjname=$sbj->fetch();
			echo $sbjname['sbjname'].', '.$_SESSION['name'];
		?></p>
    </div>
</div>

<div class="ui modal" id="addmodal">
	<div class="header negative">
		<i class="write icon"></i> New Category
	</div>
	<div>
		<p>Enter the name of the new category</p>
		<div class="ui input fluid lg-input">
			<input id="name" type="text" placeholder="name">
		</div>
		<button id="sbj" class="" onclick="process();">Add</button>
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
			$cat=$con->prepare('SELECT cid, cname FROM categories WHERE sid=?');
			$cat->execute([$sid]);
			while ($data = $cat->fetch(PDO::FETCH_ASSOC)){
				echo '<tr><td>'.$data['cname'].'</td>';
				echo '<td><button class="ui negative mini button" onclick="remove('.$data['cid'].','.$sid.');">Remove category</button></td></tr>';
			}
			echo '<tr><td><button class="ui positive button" onclick="addmodal('.$sid.');">Add a new category</button></td></tr>';
		?>
</div>

<script>
	function addmodal(id){
		$('#addmodal').modal({blurring: true}).modal('show');
		var sbj = document.getElementById('sbj').className = id;
	}
	
	function remove(id,sbj){
		$.ajax({
			type: "post",
			data: 'func=1&id='+id+'&sbj='+sbj,
			url: 'dataprocess.php',
			success: function(){
				window.location.reload();
			}
		});
	}
	
	function process(){
		var sbj = $('#sbj').attr('class');
		var name = document.getElementById('name').value;
		$.ajax({
			type: "post",
			data: 'func=2&name='+name+'&sbj='+sbj,
			url: 'dataprocess.php',
			success: function(){
				window.location.reload();
			}
		});
	}
</script>

</body>
</html>