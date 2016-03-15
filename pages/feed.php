<?php

    date_default_timezone_set("America/Sao_Paulo");

    function sortFunction( $a, $b ) {
        return strtotime($b->created_at) - strtotime($a->created_at);
    }

    $response = array();

    //$responseJson1 = file_get_contents('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=yorikvanhavre&include_rts=1&count=15');
    //$responseJson2 = file_get_contents('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=mairocas&include_rts=1&count=15');

    // new twitter API 1.1 requires authentication
    require_once("/home/uncrej5i/public_html/twitteroauth/twitteroauth.php"); //Path to twitteroauth library
    $consumerkey = "KDpF91foLGMYXOgNj42JEg";
    $consumersecret = "DN4HCRadnd7MDgDkTwRtodGkrOtvA0LB0s1DPtKisw";
    $accesstoken = "15258297-h9oNIme7pHUygNQQDPEGQx9Z9AcUY4JZXNgkPFP6f";
    $accesstokensecret = "2GNXGpmM062b4dGlFox1hOKaRkUeGTS10QrEbKVKBU";
    $connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
    $responseJson1 = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=yorikvanhavre&include_rts=1&count=15");
    $responseJson2 = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=mairocas&include_rts=1&count=15");

    //echo json_encode($responseJson1);

    if ($responseJson1) {
        //$response1 = json_decode($responseJson1);
        if ($responseJson2) {
            //$response2 = json_decode($responseJson2);
            $response = array_merge($responseJson1, $responseJson2);
            usort($response, "sortFunction");
        }
    } ?>
        
    <h2>Notícias</h2>
    
<?php foreach ($response as $tweet) {
        $tweet_text = $tweet->text; //get the tweet
        // print_r ($tweet);
        
        // make links link to URL
        $tweet_text = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href='\\2'>\\2</a>", $tweet_text); 
        // make hashtags link to a search for that hashtag
        $tweet_text = preg_replace("/#([a-z_0-9]+)/i", "<a href=\"http://twitter.com/search/$1\">$0</a>", $tweet_text);
        // make mention link to actual twitter page of that person
        $tweet_text = preg_replace("/@([a-z_0-9]+)/i", "<a href=\"http://twitter.com/$1\">$0</a>", $tweet_text);
        
        $author = $tweet->user;
        $owner = $author->name;
        $aurl = "https://twitter.com/".$author->screen_name;
        $iurl = $author->profile_image_url_https;
        $pubdate = $tweet->created_at;

?>

      <div class="tweet">
          <div class="author">
              <a href="<?php echo $aurl; ?>" title="<?php echo $owner; ?>">
                  <img class="icon" src="<?php echo $iurl; ?>"/>
              </a>
          </div>
          <div class="content">
              <div class="date">
                  <?php echo substr($pubdate,0,11).substr($pubdate,-4); ?>
              </div>
              <div class="text">
                  <?php echo $tweet_text; ?>
<?php             if ($tweet->entities->media) { 
                    foreach ($tweet->entities->media as $media) {
?>
                      <img class="twitpic" src="<?php echo $media->media_url; ?>">
<?php               }
                  }
?>
              </div>
          </div>
      </div>
<?php
    }
?>

    <span class="date">
        Fontes: 
        <img src="/images/twitter.png" style="width:8px;"> <a href="https://twitter.com/mairocas">Twitter da Maíra</a> 
        &bull;
        <img src="/images/twitter.png" style="width:8px;"> <a href="https://twitter.com/yorikvanhavre">Twitter do Yorik</a>
    </span>
    <br/><br/>
