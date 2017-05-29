<?php
	session_start();
	
	include ('dbconn.php');
	
	$comment = nl2br(addslashes($_POST['comment']));
	$cid = $_GET['cid'];
	$scid = $_GET['scid'];
	$tid = $_GET['tid'];
	
	$insert = mysqli_query($con, "INSERT INTO replies (`category_id`, `subcategory_id`, `topic_id`, `author`, `comment`, `date_posted`)
								  VALUES ('".$cid."', '".$scid."', '".$tid."', '".$_SESSION['username']."', '".$comment."', NOW());");
	
	$update = mysqli_query($con, "UPDATE topics SET replies = replies+1 where topic_id = '".$tid."';");	
	
	if ($insert && $update) {
		header("Location: /forum/readtopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."");
	} else {
		echo "Error occured";
	}
?>