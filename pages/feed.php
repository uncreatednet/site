<h2>Notícias</h2>

<?php

function geturls($input) {
    // make links link to URL
    $output = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href='\\2'>\\2</a>", $input); 
    // make hashtags link to a search for that hashtag
    $output = preg_replace("/#([a-z_0-9]+)/i", "<a href=\"http://twitter.com/search/$1\">$0</a>", $output);
    return $output; 
}

// get a token for you on https://developers.facebook.com/tools/explorer/
// and make it permanent http://stackoverflow.com/questions/12168452/long-lasting-fb-access-token-for-server-to-pull-fb-page-info
$token= "1723029887975925|qLiPZMCTlZIuouw53lBiXJzY3OU";
$expiry="1474322354";
$pageposts = json_decode(file_get_contents("https://graph.facebook.com/v2.7/me/feed?fields=id,story,link,message,created_time,full_picture&access_token=".$token)); 

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
                if (property_exists($fppost, 'full_picture'))
                    echo "<img src=\"".$fppost->full_picture."\"/><br/><br/>";
                if (property_exists($fppost, 'message')) // Some posts don't have message property
                    echo geturls($fppost->message); 
                else if (property_exists($fppost, 'story'))
                    echo geturls($fppost->story); 
                if (property_exists($fppost, 'link'))
                    echo "<br/><br/><small>".geturls($fppost->link)."</small>"; 
?>
            </div>
        </div>
    </div>
<?php
}
?>

<div class="portugues">
    
    As notícias abaixos provêm da nossa <a href="https://www.facebook.com/uncreated.net/">página Facebook</a>. Siga 
    também <a href="http://www.twitter.com/mairocas">Maíra</a> e <a href="http://www.twitter.com/yorikvanhavre">Yorik</a> no Twitter.
    
</div>

<div class="ingles">
    
    The news below come from our <a href="https://www.facebook.com/uncreated.net/">Facebook page</a>. Also follow
     <a href="http://www.twitter.com/mairocas">Maíra</a> and <a href="http://www.twitter.com/yorikvanhavre">Yorik</a> on Twitter.
    
</div>
