<?php
#Starts the session/Validates user perm level
session_start();
if(empty($_SESSION['name'])){
    header("location:../../index.php");
}
include_once '../../core/dbcon.php';
include_once '../../core/routing.php';
#Gets the url data
$id = $_GET['id'];
$sql = $con->prepare("SELECT aid, articleName, sbj, cid, articleContent, status, authid FROM articles WHERE aid=?");
$sql->setFetchMode(PDO::FETCH_ASSOC);
$sql->execute([$id]);
$data=$sql->fetch();
$_SESSION['authid']=$data['authid'];
?>
<html>
    <header>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Levitate | Editor</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../assets/css/admin-styles.css">
        <link rel="stylesheet" type="text/css" href="../../assets/css/semantic.min.css">
        <script src="../../assets/js/semantic.min.js"></script>
        <link rel="stylesheet" href="../../assets/Editor/dist/ui/trumbowyg.min.css">
    </header>

    <body>
	<!-- Navbar -->
	<?php
		$logo='../../assets/img/logo.png';
		$home='../../admin/';
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
            <h1>Edit Article</h1>
            <div><p class="title"><?php echo $data['articleName'];?></p></div>

        </div>
    </div>
		<!-- Loads article in text editor -->
        <div class="table-container">
            <?php
			if($data['status']==1){
				if($_SESSION['id']==$_SESSION['authid'] or $_SESSION['permission']==2){
					$sbj = $con->prepare('SELECT sbjname FROM sbjcategory WHERE sid=?');
					$sbj->execute([$data['sbj']]);
					$sbjname = $sbj->fetch();
					
					$cat = $con->prepare('SELECT cname FROM categories WHERE cid=?');
					$cat->execute([$data['cid']]);
					$cname = $cat->fetch();
					
					$auth = $con->prepare('SELECT username FROM usrauth WHERE id=?');
					$auth->execute([$data['authid']]);
					$authname = $auth->fetch();
					
					echo '<div class="id">Id: '.$data['aid'].'</div>';
					echo '<div class="author">Author: '.$authname['username'].'</div>';
					echo '<div class="subject">Subject: '.$sbjname['sbjname'].'</div>';
					echo '<div class="category">Category: '.$cname['cname'].'</div>';
					echo '<div class="content">'.$data['articleContent'].'</div>';
				}else{
					header('LOCATION: ../queue/');
				}
			}else{
				header('LOCATION: ../queue/');
			}
            ?>
            <input value="Save" class="ui button positive" name = "save" type="submit" onclick="save();"/>
        </div>
		
		<!-- Loads text editor -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/Editor/js/vendor/jquery-3.2.1.min.js"><\/script>')</script>
        <script src="../../assets/Editor/dist/trumbowyg.min.js"></script>
        <script>
			//Creates editor
            $(".content").trumbowyg({
                resetCss: true,
                removeformatPasted: true,
                autogrow: true
            });

            function save(){
                $(".content").trumbowyg('destroy');
				
				//Sends data for processing
                var title = document.getElementsByClassName('title')[0].innerHTML;
                var content = document.getElementsByClassName('content')[0].innerHTML;
				var id = document.getElementsByClassName('id')[0].innerHTML;
                window.location.href ="dataprocess.php?name="+title+"&content="+content+"&id="+id;
            }
        </script>
    </body>
</html>