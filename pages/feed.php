    <h2>Notícias</h2>

<?php

function geturls($input) {
    // make links link to URL
    $output = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href='\\2'>\\2</a>", $input); 
    // make hashtags link to a search for that hashtag
    $output = preg_replace("/#([a-z_0-9]+)/i", "<a href=\"http://twitter.com/search/$1\">$0</a>", $output);
    return $output; 
}

$token= "EAACEdEose0cBAAEbd6qTmBcsN4ZC6C9W63oZCZBdmvR6tiSZC1HZA9pC6ZB5rYFQRMgO48CCZCZAEl7wFJM6DJq4sF03dvXl9nOKxle58l5GKFdZAGY0Vjb6CF8PGjcB40sGs26CFBF3Qzr6zl5qOyh7GHypn5WbN9oFdH0cyeJuxBwZDZD";
$pageposts = json_decode(file_get_contents("https://graph.facebook.com/v2.6/me/feed?access_token=".$token)); 

//var_dump($pageposts);

foreach ($pageposts->data as $fppost) {
?>
    <div class="tweet">
        <div class="author"></div>
        <div class="content">
            <div class="date">
<?php
                if (property_exists($fppost, 'created_time'))
                    echo substr($fppost->created_time,0,10).", ".substr($fppost->created_time,11,8);
?>
            </div>
            <div class="text">
<?php
                $fpimage = json_decode(file_get_contents("https://graph.facebook.com/v2.6/".$fppost->id."?fields=full_picture&access_token=".$token)); 
                $fplink = json_decode(file_get_contents("https://graph.facebook.com/v2.6/".$fppost->id."?fields=link&access_token=".$token));
                if (property_exists($fpimage, 'full_picture'))
                    echo "<img src=\"".$fpimage->full_picture."\"/><br/><br/>";
                if (property_exists($fppost, 'message')) // Some posts don't have message property
                    echo geturls($fppost->message); 
                else if (property_exists($fppost, 'story'))
                    echo geturls($fppost->story); 
                if (property_exists($fplink, 'link'))
                    echo "<br/><br/><small>".geturls($fplink->link)."</small>"; 
?>
            </div>
        </div>
    </div>
<?php
}
?>
