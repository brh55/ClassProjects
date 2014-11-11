<?php
function tweets2array($tweets){
	$records = array();
	foreach($tweets as $tweet){
		$t = new stdClass();
		$t->sender = $tweet->user->name;
		$t->text = $tweet->text;
		$t->time = $tweet->created_at;
		$t->profile_image = $tweet->user->profile_image_url;
		$records[] = $t;
	}
	return $records;
}
?>