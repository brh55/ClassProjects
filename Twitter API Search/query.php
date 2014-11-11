<?php
$keyword = $_POST['keyword'];
$type = $_POST['type'];
$plus = '%20'; //used to conform with URL rules
$keywords = explode(" ", $keyword);
$query = implode($plus, $keywords); //join the word with %20 to conform with rules
$q = str_replace(':', '%3A', $query); //replaces : with the correct URL rules
$requestMethod = 'GET';
if ($type == "Keywords") {
	$qtype = '?q=%40';
} else {
	$qtype ='?q=#';
}

$getfield = $qtype . $q;
echo $getfield;
$url = 'https://api.twitter.com/1.1/search/tweets.json';

echo '<h3>URL for the Query</h3>';
echo '<p>You are searching: ' . $keyword . ' with ' . $type . '</p>';
echo '<a href="' . $url . '"">' . $url . '</a>';
echo '<hr>';


include 'controller/controller.php';

?>