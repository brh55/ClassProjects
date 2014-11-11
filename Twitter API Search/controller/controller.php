<?php
include 'model/TwitterAPIExchange.php';

$settings = array(
    'oauth_access_token' => "",
    'oauth_access_token_secret' => "",
    'consumer_key' => "",
    'consumer_secret' => ""
);

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();

$tweets = json_decode($response);


$tweet = $tweets->statuses;
include 'model/data_model.php';
$records = tweets2array($tweet);

include 'view/view.php';
echo tweet_obj_array2table($records);

?>