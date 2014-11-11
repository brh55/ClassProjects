<?php
include 'view.php';

echo '<h3>' . count($records) . 'Tweets Found</h3>';
echo tweet_obj_array2table($records);

echo '<hr>';

echo '<a href=show_links.php>Back</a>';

?>