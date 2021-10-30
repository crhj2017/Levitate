<?php
#Starts session
session_start();
#Checks for no login/wrong permission
if(empty($_SESSION['name'])){
	header("location:../");
}
?>

<html>
	<header>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Levitate / Create</title>
        <link rel="stylesheet" type="text/css" href="../assets/css/admin-styles.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/semantic.min.css">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <script src="../assets/js/semantic.min.js"></script>
	</header>
    <body>
	<!-- Nav bar -->
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
<div class="top-box fbox">
    <div class="topbox-wrapper">
        <h1>Create Contents</h1>
        <div>Welcome, <?php echo $_SESSION['name'];?>, Click one of the boxes below.</div>
    </div>
</div>
    <div class="pgcontent-wrapper">
        <div class="ui stackable one column grid">
			<div class="column">
                <div class="ui fluid card">
                    <div class="content">
                        <h2 class="ui icon header card-header-menu">
                            <i class="book icon"></i>
                            <div class="content">
                                View Articles
                                <div class="sub header">View current articles on subjects of your choice.</div>
                            </div>
                        </h2>
                    </div>
                    <a class="ui bottom attached button" href="../contents/display/">
                        <i class="magnify icon"></i>
                        View articles
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="ui basic modal success center aligned ssm-modal">
        <div class="ui icon header">
            <i class="checkmark icon"></i>
            Success
        </div>
        <div class="content">
            <p>Your content has been successfully saved. Contents may be subjected to moderation.</p>
        </div>
    </div>
    <div class="ui basic modal fail center aligned ssm-modal">
        <div class="ui icon header">
            <i class="remove icon"></i>
            Failure
        </div>
        <div class="content">
            <p>Your content has not been saved. Please contact support.</p>
        </div>
    </div>
    <?php
    if ( isset($_SESSION["message"]) && $_SESSION["message"] == 'success'){
        echo "<script>$('.ui.basic.modal.success').modal('show');</script>";
        unset($_SESSION["message"]);
    }elseif( isset($_SESSION["message"]) && $_SESSION["message"] == 'fail' ){
        echo "<script>$('.ui.basic.modal.fail').modal('show');</script>";
        unset($_SESSION["message"]);
    }
    ?>
    <script>
        $('.ui.dropdown')
            .dropdown()
        ;
    </script>
    </body>
</html>
