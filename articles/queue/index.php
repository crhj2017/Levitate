<?php
#Starts session/Validates user perm level
session_start();
if(empty($_SESSION['name'])){
	header("location:../../index.php");
}else if($_SESSION['permission']==0){
	header("location:../../user/");
}
include_once '../../core/dbcon.php';
?>

<html>
	<header>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Levitate / Article</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../assets/css/admin-styles.css">
        <link rel="stylesheet" type="text/css" href="../../assets/css/semantic.min.css">
        <script src="../../assets/js/semantic.min.js"></script>
        <link rel="stylesheet" href="../../assets/Editor/dist/ui/trumbowyg.min.css">
	</header>

	<body>
	<!-- Nav bar -->
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
    <div class="top-box fbox">
        <div class="topbox-wrapper">
            <h1>Submission Queue.</h1>
            <p>Here is a list of all articles submitted pending for actions, <?php echo $_SESSION['name'];?></p>
        </div>
    </div>
	<div class="pgcontent-wrapper">
		<div class="ui pointing secondary menu">
			<a class="item active" data-tab="first"><i class="wait icon"></i> Awaiting Moderation</a>
			<a class="item" data-tab="second"><i class="checkmark icon"></i> Approved</a>
		</div>
		<!-- Table of queued articles -->
		<div class="ui tab segment active" data-tab="first">
            <table class="ui celled striped table">
                <thead>
					<tr>
						<th>Article ID</th>
						<th>Title</th>
						<th>Author</th>
						<th>Subject</th>
						<th>Category</th>
						<th>Submission Time</th>
						<th>Actions</th>
					</tr>
                </thead>
				<tbody>
					<?php
					#Populates the table
					try{
						if($_SESSION['permission']==2){
							$stmt = $con->prepare("SELECT aid, articleName, sbj, cid, status, authid, timestamp FROM articles");
							$stmt->execute();
						}elseif($_SESSION['permission']==1){
							$data = $con->prepare("SELECT subject FROM usrauth WHERE id=?");
							$id = $_SESSION['id'];
							$data->execute([$id]);
							$sbj = $data->fetch();
							
							$stmt = $con->prepare("SELECT aid, articleName, sbj, cid, status, authid, timestamp FROM articles WHERE sbj=?");
							$stmt->execute([$sbj['subject']]);
						}
						while ($umdata = $stmt->fetch(PDO::FETCH_ASSOC)){
							if($umdata['status']==1){
								$aid = $umdata['aid'];
								$aname = $umdata['articleName'];
								$time = $umdata['timestamp'];
								
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
								
								echo '<tr><td>'.$aid.'</td>';
								echo '<td>'.$aname.'</td>';
								echo '<td>'.$username.'</td>';
								echo '<td>'.$sbjname['sbjname'].'</td>';
								echo '<td>'.$catname['cname'].'</td>';
								echo '<td>'.$time.'</td>';
								echo '<td><button class="ui button mini positive" onclick="approve('.$aid.');"><i class="checkmark icon"></i> Approve</button><a class="ui secondary mini button" href="../edit/?id='.$aid.'"><i class="write icon"></i> View/Edit</a><button class="ui button mini negative" onclick="reason('.$aid.')"><i class="remove icon"></i> Deny</button></div></td></tr>';
							}
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
			<table class="ui celled striped table">
				<thead>
					<tr>
						<th>Article ID</th>
						<th>Article Name</th>
						<th>Subject</th>
						<th>Category</th>
						<th>Submission Time</th>
						<th>Approved by:</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					try{
						if($_SESSION['permission']==2){
							$stmt = $con->prepare("SELECT aid, articleName, sbj, cid, status, authid, adminid, featured, timestamp FROM articles");
							$stmt->execute();
						}elseif($_SESSION['permission']==1){
							$data = $con->prepare("SELECT subject FROM usrauth WHERE id=?");
							$id = $_SESSION['id'];
							$data->execute([$id]);
							$sbj = $data->fetch();
							
							$stmt = $con->prepare("SELECT aid, articleName, sbj, cid, status, authid, adminid, featured, timestamp FROM articles WHERE sbj=?");
							$stmt->execute([$sbj['subject']]);
						}
						while ($umdata = $stmt->fetch(PDO::FETCH_ASSOC)){
							if($umdata['status']==2){
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
								if ($umdata['featured']==0){
									echo '<td><button class="ui button mini positive" onclick="feature('.$aid.');"><i class="checkmark icon"></i> Feature</button>';
								}else{
									echo'<td><button class="ui button mini negative" onclick="unfeature('.$aid.');"><i class="ban icon"></i> Unfeature</button>';
								}
								echo'<button class="ui secondary mini button" onclick="archive('.$aid.');"><i class="archive icon"></i> Archive</button><button class="ui button mini negative" onclick="unpublish('.$aid.')"><i class="ban icon"></i> Unpublish</button></div></td></tr>';
							}
						}
					}
					catch(PDOException $e){
						echo "error".$e->getMessage();
					}
					?>
				</tbody>
			</table>
		</div>	
		<div class="ui modal" id="reasonmodal">
			<div class="header negative">
				<i class="write icon"></i> Reason for denial
			</div>
			<div>
				<p>Enter your reason for denying this article</p>
				<div class="ui input fluid lg-input">
					<input id="reason" type="text" placeholder="Reason">
				</div>
				<button id="link" class="" onclick="process()">Deny</button>
			</div>
		</div>
		<script>
			function reason(id) {
				$('#reasonmodal').modal({blurring: true}).modal('show');
				var link = document.getElementById('link').className = id;
			}
			
			function deny(){
				var id = $('#link').attr('class');
				var reason = document.getElementById('reason').value;
				$.ajax({
					type: "post",
					data: 'func=1&id='+id+'&reason='+reason,
					url: 'dataprocess.php',
					success: function(){
						window.location.reload();
					}
				});					
			}
			
			function approve(id){
				$.ajax({
					type: "post",
					data: 'func=0&id='+id,
					url: 'dataprocess.php',
					success: function(){
						window.location.reload();
					}
				});
			}
			
			function feature(id){
				$.ajax({
					type: "post",
					data: 'func=2&id='+id,
					url: 'dataprocess.php',
					success: function(){
						window.location.reload();
					}
				});	
			}
			
			function unfeature(id){
				$.ajax({
					type: "post",
					data: 'func=5&id='+id,
					url: 'dataprocess.php',
					success: function(){
						window.location.reload();
					}
				});
			}
			
			function archive(id){
				$.ajax({
					type: "post",
					data: 'func=3&id='+id,
					url: 'dataprocess.php',
					success: function(){
						window.location.reload();
					}
				});	
			}
			
			function unpublish(id){
				$.ajax({
					type: "post",
					data: 'func=4&id='+id,
					url: 'dataprocess.php',
					success: function(){
						window.location.reload();
					}
				});	
			}
			
			$('.menu .item').tab();
		</script>
	</body>
</html>