    <h2>Notícias</h2>

<?php

$page_id = "Uncreated.net";
$token = "EAACEdEose0cBAAEbd6qTmBcsN4ZC6C9W63oZCZBdmvR6tiSZC1HZA9pC6ZB5rYFQRMgO48CCZCZAEl7wFJM6DJq4sF03dvXl9nOKxle58l5GKFdZAGY0Vjb6CF8PGjcB40sGs26CFBF3Qzr6zl5qOyh7GHypn5WbN9oFdH0cyeJuxBwZDZD";
$page_posts = file_get_contents('https://graph.facebook.com/'.$page_id.'/me/feed&access_token='.$token); // > fields=message < since you want to get only 'message' property (make your call faster in milliseconds) you can remove it
$pageposts = json_decode($page_posts); 

foreach ($pageposts->data as $fppost) {
    if (property_exists($fppost, 'message')) { // Some posts doesn't have message property (like photos set posts), errors-free ;)
        //print $fppost->message.'</br>';
?>
        <div class="tweet">
            <div class="author"></div>
            <div class="content">
                <div class="date">
                    <?php echo $fpost->created_time; ?>
                </div>
                <div class="text">
                    <?php echo $fppost->message; ?>
                </div>
            </div>
        </div>
<?php
    }
}
?>



    
