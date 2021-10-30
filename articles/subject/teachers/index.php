<?php
session_start();
if(empty($_SESSION['name'])){
	header("location:../../index.php");
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
        <h1>Edit teachers.</h1>
        <p>Change the teachers relating to 
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
		<i class="write icon"></i> New Teacher
	</div>
	<div>
		<p>Select a new teacher to add: </p>
		<?php
			echo'<select id="name">';
			$teachers = $con->prepare('SELECT username FROM usrauth WHERE permLevel=1');
			$teachers->execute();
			while($tname = $teachers->fetch(PDO::FETCH_ASSOC)){
				echo'<option>'.$tname['username'].'</option>';
			}
			echo '</select>';
		?>
		<button id="sbj" class="" onclick="process();">Add</button>
	</div>
</div>

<div class="table-container">
	<table class="ui celled striped table">
	<thead>
		<tr>
			<th>Teacher</th>
			<th>Actions</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$teacher=$con->prepare('SELECT username, id FROM usrauth WHERE subject=?');
			$teacher->execute([$sid]);
			while ($tname = $teacher->fetch(PDO::FETCH_ASSOC)){
				echo '<tr><td>'.$tname['username'].'</td>';
				echo '<td><button class="ui negative mini button" onclick="remove('.$tname['id'].','.$sid.');">Remove teacher</button></td></tr>';
			}
			echo '<tr><td><button class="ui positive button" onclick="addmodal('.$sid.');">Add a new teacher</button></td></tr>';
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