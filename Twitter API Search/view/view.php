<?php
function tweet_obj_array2table($records){
	$content = '<table border=1>';
	$content .= '<th>Profile</th><th>Sender</th><th>Time</th><th>Text</th>';
	foreach($records as $r) {
		$content .= '<tr>';
			$content .= '<td><div align=center><img src=' . $r->profile_image .'></div></td>';
			$content .= '<td>' . $r->sender .'</td>';
			$content .= '<td>' . $r->time . '</td>';
			$content .= '<td>'. $r->text.'</td>';
		$content .= '</tr>';
	}
	$content .= '</table>';
	return $content;
}

?>