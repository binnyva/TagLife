<?php
require("./common.php");

$date = i($QUERY, 'date', date('Y-m-d'));

$all_tags = $sql->getCol("SELECT name FROM Tag WHERE user_id=$_SESSION[user_id]");
$todays_tags = $sql->getCol("SELECT T.name FROM Tag T 
	INNER JOIN EntryTag ET ON ET.tag_id=T.id
	INNER JOIN Entry E ON E.id=ET.entry_id 
	WHERE E.date='$date' AND E.user_id=$_SESSION[user_id]");


$template->addResource("bower_components/jquery-ui/jquery-ui.min.js");
$template->addResource("bower_components/jquery-ui/themes/flick/jquery-ui.min.css");
$template->addResource("bower_components/jquery-ui/themes/flick/theme.css");

$template->addResource("bower_components/tag-it/css/jquery.tagit.css");
$template->addResource("bower_components/tag-it/js/tag-it.min.js");

$template->addResource("bower_components/moment/min/moment.min.js");
$template->addResource("bower_components/jquery-touchswipe/jquery.touchSwipe.min.js");


render();