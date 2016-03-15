<?php
    // mdview.php by Yorik van Havre, GPL license
    // This script generates a nice HTML rendering of a Markdown file that is hosted and
    // shared on an owncloud server, using strapdownjs.com.
    // To use it, simply place this file somewhere on your web space, and call it with the
    // following arguments: http://path/to/mdview.php?file=XXXXXXXX&theme=spacelab
    // the XXXXXXX is the share code from the link you obtain when sharing a file in owncloud.
    // theme is optional, and can be one of the themes described on strapdownjs.com. If not
    // provided, the spacelab theme is used (with a bit of changes I did in the <style> tag below)

    // CONFIG - the following line must be adapted to your site (where your owncloud server lives)
    $owncloudpath = '/cloud';
    // END CONFIG
    $baseurl = $_SERVER['HTTP_HOST'];
    if ($_GET['file'] != '') {
        $text = file_get_contents("http://" . $baseurl . $owncloudpath . '/index.php/s/' . $_GET['file'] . "/download");
        $title = strtok($text, "\n");
        $title = str_replace('#',"",$title);
        if ($_GET['theme'] != '') {
            $theme = $_GET['theme'];
        } else {
            $theme = 'spacelab';
        }
?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title; ?> - Uncreated.net</title>
    <style>
        p, li, footer { font-family:"Open Sans",Arial,sans-serif !important; text-align: justify !important; font-size: 18px !important; } 
        #content { max-width: 840px; } 
        li { margin: 8px 0; line-height: 150%; } 
        h1, h2, h3, h4, h5, h6 { font-family:"Open Sans",Arial,sans-serif !important; color: #222 !important; } 
        .navbar { display: none; }
        /*
        .navbar .navbar-inner { text-align: center !important; color: #ffffff !important; background: #090909 url(/images/background2.jpg) top center no-repeat; !important; }
        .navbar .brand { text-shadow: none !important; color: #ffffff !important; float: inherit !important; } 
        */
        footer table { width: 100% !important; border: 0 !important; text-align: center; margin-top: 50px; font-size: 0.8em; }
        footer td { border: 0 !important; background: #fff !important; }
    </style>
</head>

<xmp theme="<?php echo $theme; ?>" style="display:none;">

<?php echo $text; ?>

<footer>
    <table>
        <tr>
            <td><a href="/"><img src="/images/logo.jpg" style="height:16px;"></a></td>
            <td style="padding-top: 15px;">Voltar para a <a href="/">página principal</a></td>
            <td style="padding-top: 15px; color: #888;">Back to the <a href="/">main page</a></td>
        </tr>
    </table>
</footer>

</xmp>

<script src="http://strapdownjs.com/v/0.2/strapdown.js"></script>

</html>

<?php } else {

die("No file provided");

}

?>
