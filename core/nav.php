<?php
	echo '
	<div class="ui stackable menu">
		<div class="item brand">
			<img src="';
			echo $logo;
			echo '" class="sm-logo"> Levitate Educational Suite
		</div>
		<a class="item" href="';
		echo $home;
		echo '">Home</a>
		<a class="item" href="';
		echo $resources;
		echo '">Resources</a>
		<a class="item" href="#">Support & Faq</a>
		<div class="right menu">
			<a class="item" href="';
			echo $content;
			echo '">Create Content</a>';
		
	if($_SESSION['permission']==1 or $_SESSION['permission']==2){
		echo '
				<div class="ui simple dropdown item">Moderation
					<i class="dropdown icon"></i>
					<div class="menu">
						<div class="header">Content Moderation</div>
						<div class="divider"></div>
						<a class="item" href="';
						echo $queue;
						echo '">Articles Submission Queue</a>
						<div class="item">Resources Management</div>
						<a class="item" href="';
						echo $sbj;
						echo '">Subject Management</a>
						<div class="header">Teaching</div>
						<div class="divider"></div>
						<div class="item">View/ Edit Classes</div>
						<div class="item">Homework</div>';
						if($_SESSION['permission']==2){
							echo'
								<div class="item">Global Announcement</div>
								<div class="header">Administration</div>
								<div class="divider"></div>
								<div class="item">User Management</div>
								<div class="item">Global Settings</div>';
						}
						echo'</div></div>';
	}
	echo '
	<div class="ui simple dropdown item">Your Contents
		<i class="dropdown icon"></i>
		<div class="menu">
			<div class="header">Manage</div>
			<div class="divider"></div>
			<a class="item" href="';
			echo $articles;
			echo '">Your Articles</a>
			<a class="item" href="#">Your Flashcards</a>
			<div class="header">Create</div>
			<div class="divider"></div>
			<a class="item" href="';
			echo $create;
			echo '">New Article</a>
			<a class="item" href="#">New Flashcard</a>
		</div>
	</div>
	<a class="item" href="#">
		<div class="user-notification">
			<i class="alarm outline icon"></i>
			<div class="mini ui teal label circular">0</div>
		</div>
	</a>
	<a class="item" href="#">
		<div class="user-notification2">
			<i class="comment outline icon"></i>
			<div class="mini ui teal label circular">0</div>
		</div>
	</a>
	<div class="item">
		<a class="ui button" href="';
		echo $logout;
		echo '">Sign Out</a>
	</div>
	</div>
	</div>';
?>