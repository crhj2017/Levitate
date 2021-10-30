<?php
#Session start/user perm validation
session_start();
if(empty($_SESSION['name'])){
	header("location:../index.php");
}
include_once '../core/dbcon.php';
?>
<html>
<header>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Levitate / Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/admin-styles.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/semantic.min.css">
    <link rel="stylesheet" href="../assets/Editor/dist/ui/trumbowyg.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../assets/js/semantic.min.js"></script>
</header>
<body>
<!-- Navbar -->
<?php
	$logo='../assets/img/logo.png';
	$home='../admin/';
	$resources='../resources/';
	$content='../contents/';
	$queue='queue/';
	$sbj='subject/';
	$articles='manage/';
	$create='';
	$logout='../core/auth/Logout.php';
	include_once '../core/nav.php';
?>

<div class="top-box fbox">
    <div class="topbox-wrapper">
        <h1>Create Article.</h1>
        <p>Your article will be subjected to approval, <?php echo $_SESSION['name'];?></p>
    </div>
</div>
<!-- Input fields for article data -->
<div class="create editor-wrapper">
    <div class="ui tablet stackable tiny three steps">
        <div class="active step" id="titlestep">
            <i class="write icon"></i>
            <div class="content">
                <div class="title">Title</div>
                <div class="description">Enter a title for your article</div>
            </div>
        </div>
        <div class="disabled step" id="contentstep">
            <i class="edit icon"></i>
            <div class="content">
                <div class="title">Content</div>
                <div class="description">Enter your main article content</div>
            </div>
        </div>
        <div class="disabled step" id="submitstep">
            <i class="send icon"></i>
            <div class="content">
                <div class="title">Submit</div>
                <div class="description">Verify and submit article for review</div>
            </div>
        </div>
    </div>
    <div class="ui input fluid lg-input">
        <input type="text" placeholder="Article Title" id="article-title">
    </div>
    <br>
	<div>
        <div class="ui grid">
            <div class="eight wide column">
                <select class="ui fluid multiple search normal selection dropdown" id="subject" placeholder="select a subject">
                    <i class="dropdown icon"></i>
                    <div class="default text">Select Subject</div>
                    <div class="menu">
                        <option class="item" value="" disabled selected>Choose A Subject</option>
                        <?php
                        $sbj = $con->prepare('SELECT sid, sbjname FROM sbjcategory');
                        $sbj->execute();
                        while($data = $sbj->fetch(PDO::FETCH_ASSOC)){
                            echo '<option class="item" value="'.$data['sbjname'].'">'.$data['sbjname'].'</option>';
                        }
                        ?>
                    </div>
                </select>
            </div>
            <div class="eight wide column">
                <select class="ui fluid multiple search normal selection dropdown" id="category">
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <option class="item" value="" disabled selected>Choose A Category</option>
                    </div>
                </select>
            </div>
        </div>
	</div>
    <div class="acontent" id="mainacontent" type="text"></div>
	<button type="submit" name="submit" class="ui button positive" onclick='save();'>Submit Article</button>
</div>
</body>
<!-- Loads text editor -->
<script>window.jQuery || document.write('<script src="../../assets/Editor/js/vendor/jquery-3.2.1.min.js"><\/script>')</script>
<script src="../assets/Editor/dist/trumbowyg.min.js"></script>

<script>
	//Creates editor
    $('.acontent').trumbowyg().on('tbwchange', function(){
        if ($('.acontent').trumbowyg('html') == '') {
            $('#contentstep').removeClass('completed');
        } else {
            $('#contentstep').addClass('completed active');
            $('#submitstep').removeClass('disabled');
        }
    });
	
    $('#article-title').on('keyup keydown keypress change paste', function() {
        if ($(this).val() == '') {
            $('#titlestep').removeClass('completed').addClass('active');
            $('#contentstep').removeClass('active');
            $('#submitstep').removeClass('active');
        } else {
            $('#titlestep').addClass('completed');
            $('#contentstep').removeClass('disabled').addClass('active');
        }
    });
	
	$(document).on("change", '#subject', function(e) {
		var sbj = $('#subject').dropdown('get value');
		
		$.ajax({
			type: "post",
			data: 'func=1&sbj='+sbj,
			url: 'dataprocess.php',
			success: function(data){
				var $cat = $("#category");
				$cat.empty(); // remove old options
				$cat.html(data);
				}
		});
	});
	
	function save() {
		//Close editor
		$(".acontent").trumbowyg('destroy');
		
		//Sends data to processing page
		var title = $('#article-title').val();
		var subject = $('#subject').val();
		var content = document.getElementsByClassName('acontent')[0].innerHTML;
		var cat = $('#category').val();
		
		$.ajax({
			type: "post",
			data: 'func=0&name='+title+'&content='+content+'&subject='+subject+'&cat='+cat,
			url: 'dataprocess.php',
			success: function() {
					window.location.href = '../contents/';
				
			}
		});
		return false;
	}

    $('.fluid.search.normal.selection.dropdown')
        .dropdown({
            useLabels: true,
            maxSelections: 1
        })
    ;
</script>
</html>
