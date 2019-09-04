<!DOCTYPE html>

<?php

// fade para imagens de fundo
$fade = 'linear-gradient(0deg,rgba(255,255,255,0.4),rgba(255,255,255,0.4))';

// Lista de projetos - a ordem abaixoé o que aparece no menu
// Deve existir uma imagem .jpg com mesmo nome da página em images/menu

//    página          título              descrição                                     local
$menu = array(
array('wikilab',      'WikiLab',          'WikiLab',                                    'São Bernardo do Campo, Brasil'),
array('casaminmax',   'Casa Max/Min',     'Uma casa minimal e barata',                  ''),
array('casanatureza', 'Casa Natureza',    'Uma casa brasileira',                        'USA'),
array('riachofundo',  'Riacho Fundo',     'UBS Riacho Fundo',                           'Brasília'),
array('condominios',  'Condos abertos',   'Ideias para condomínios abertos',            ''),
array('pirituba',     'Pirituba',         'Centro comercial de bairro',                 'São Paulo, Brasil'),
array('itu',          'Itu',              'Conjunto residencial, comercial e hoteleiro','Itu, Brasil'),
array('bh',           'Belo Horizonte',   'Centro administrativo da Prefeitura',        'Belo Horizonte, Brasil'),
array('floripa',      'Florianopolis',    'Cobertura do mercado público',               'Florianópolis, Brasil'),
array('yaroslavl',    'Yaroslavl',        'Projeto para o Spartacus de Yaroslavl',      'Russia'),
array('parqueaugusta','Parque Augusta',   'Projeto para o Parque Augusta',              'São Paulo, Brasil'),
array('lanxess',      'Lanxess',          'Fábrica Lanxess',                            'Porto Feliz, Brasil'),
array('costadoipe',   'Costa do Ipê',     'Costa do Ipê Parque Shopping',               'Marília, Brasil'),
array('gregoire',     'Casa GL',          'Casa para Greg e Lívia',                     'São Gonçalo dos Campos, Brasil'),
array('gowanus',      'Gowanus Canal',    'Projeto para o canal Gowanus',               'New York, USA'),
array('51',           '51',               'Prédio administrativo',                      'Pirassununga, Brasil'),
array('pace',         'PACE',             'ONG PACE',                                   'São Gonçalo dos Campos, Brasil'),
array('indaiatuba',   'Indaiatuba',       'Open Mall',                                  'Indaiatuba, Brasil'),
array('openfort',     'Fort 400',         'Prédio de apartamentos',                     'Amsterdam, Holanda'),
array('sanisidro',    'San Isidro',       'Prédio de lofts',                            'Lima, Peru'),
);

// Início da página

// Redireção para o blogo do Yorik se tiver 'embedded=' e 'tag=' na URL

if ( ($_GET['page'] == 'embedded') and ($_GET['tag'] != '') ) {
    $redir = 'Location: https://www.uncreated.net/yorik/?blog/'.$_GET['tag'];
    header($redir);
    die();

?>

<html>
    <head>

<?php

// Título especial se tiver 'page=' na URL

} else if ($_GET['page'] != '') {

    if ($_GET['page'] == 'publications') { ?>

        <title>Publicações - Uncreated.net Architecture Network</title>

<?php

    } else {
        $title = "";
        foreach ($menu as $item) {
            if ($_GET['page'] == $item[0]) {
                $title = $item[1]." - ";
            }
        }

?>
        <title><?php echo $title; ?>Uncreated.net Architecture Network</title>

<?php

    }

} else {

// Nenhuma subpágina

?>
        <title>Uncreated.net Architecture Network</title>
<?php

}

?>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="alternate" type="application/rss+xml" title="Maíra's feed" href="http://maira.uncreated.net/?feed=rss2"/>
        <link rel="alternate" type="application/rss+xml" title="Yorik's feed" href="http://feeds.feedburner.com/yorikvanhavre"/>
        <link type="text/css" href="uncreated.css" rel="stylesheet">
        <script type="text/javascript" src="uncreated.js" ></script>

    </head>

    <body onLoad="setup(<?php echo count($menu); ?>)">

        <div>

            <div id="fbouc">

                &nbsp;&nbsp;

                <a href="https://github.com/uncreatednet" style="float:right; padding-left: 6px;" title="Uncreated on Github">
                    <img src="images/github.png">
                </a>

                <a href="https://www.facebook.com/uncreated.net" style="float:right; padding-left: 6px;" title="Uncreated on Facebook">
                    <img src="images/facebook.png">
                </a>

                <a href="https://www.linkedin.com/company/uncreated" style="float:right; padding-left: 6px;" title="Uncreated on LinkedIn">
                    <img src="images/linkedin.png">
                </a>

                <a href="http://architizer.com/firms/uncreatednet/" style="float:right; padding-left: 6px;" title="Uncreated on Architizer">
                    <img src="images/architizer.png">
                </a>

                <a href="#" style="float:right; padding-left: 6px;" title="Yorik: @yorikvanhavre&#10;Maíra: @mairocas">
                    <img src="images/twitter.png">
                </a>

            </div>
        </div>

        <div id="wrapper">

            <h1>
                <a href="http://www.uncreated.net"
                   title="Uncreated.net - Yorik van Havre & Ma&iacute;ra Zasso architects">
                    Uncreated.net - Yorik van Havre & Ma&iacute;ra Zasso architects
                </a>
            </h1>

            <div class="motto">architecture for human beings</div>

            <ul id="menu">

                <li>
                    <a class="button" href="/"
                       title="Uma seleção dos nossos projetos de arquitetura">
                        Projetos
                        <div class="trad">Projects</div>
                    </a>

                    <ul>
                        <li class="arrow-li" onmouseover="scrollDiv(1)" onmouseout="stopScroll()">
                            <div class="arrow-up"></div>
                        </li>
                        <li id="outermenu">
                            <div id="innermenu">

<?php                           // preenche o menu automaticamente para os projetos

                                foreach ($menu as $item) {
?>
                                <a class="item menu2" href="?page=<?php echo $item[0]; ?>"
                                   title="<?php echo $item[2]; ?>, <?php echo $item[3]; ?>"
                                   style="background:<?php echo $fade; ?> , url(images/menu/<?php echo $item[0]; ?>.jpg);">
                                    <?php echo $item[1]; ?>
                                    <div class="trad"><?php echo $item[3]; ?></div>
                                </a>

<?php                           }

                                // fim do menu automático
?>
                            </div>
                        </li>
                        <li class="arrow-li" onmouseover="scrollDiv(-1)" onmouseout="stopScroll()">
                            <div class="arrow-down"></div>
                        </li>
                    </ul>

                </li>

                <li>
                    <a class="item" href="works" title="Todos os nossos trabalhos">
                        Últimos trabalhos
                        <div class="trad">Latest works</div>
                    </a>

                    <ul>
                        <li>
                            <a class="item menu2 menu_imagens" href="3d" title="Imagens">
                                Imagens 3D
                                <div class="trad">3D images</div>
                            </a>
                        </li>
                        <li>
                            <a class="item menu2 menu_cad" href="cad" title="Projetos executivos e desenhos CAD e BIM">
                                Desenhos CAD
                                <div class="trad">CAD drawings</div>
                            </a>
                        </li>
                        <li>
                            <a class="item menu2 menu_anim" href="anim" title="Animações">
                                Animações
                                <div class="trad">Animations</div>
                            </a>
                        </li>
                    </ul>

                </li>

                <li>
                    <a class="button" href="sobre" title="Sobre o nosso trabalho de arquitetos">
                        Sobre nós
                        <div class="trad">About us</div>
                    </a>
                </li>

                <li>
                    <a class="button" href="?page=feed" title="O que acontece por aqui...">
                        Notícias
                        <div class="trad">Newsfeed</div>
                    </a>
                </li>

            </ul>

<?php if ($_GET['page'] != '') { ?>

            <div id="content">

<?php       if ($_GET['page'] == 'feed') {

                include('pages/feed.php');

            } else if ($_GET['page'] == 'projects') {

                foreach ($menu as $item) {
                    $pagename = 'pages/' . $item[0] . '.html';
                    if (file_exists($pagename)) {
                        include($pagename);
                    }
                }

            } else if ($_GET['page'] == 'embedded') {

                if ( ($_GET['post'] != '') and ($_GET['year'] != '') ) {

                    $_GET[$_GET['year']] = $_GET['post'];
                    $_GET['embedded'] = 1;
                    include('yorik/guestblog.php');

                } else {
?>
                    <div class="portugues">Página não encontrada!</div><div class="ingles">Page not found!</div>

<?php           }

            } else {

                $pagename = 'pages/' . $_GET['page'] . '.html';
                $phpname = 'pages/' . $_GET['page'] . '.php';
                if (file_exists($pagename)) {
                    include($pagename);
                } else if (file_exists($phpname)) {
                    include($phpname);
                } else {
?>
                    <div class="portugues">Página ainda não disponível, volte em breve!</div>
                    <div class="ingles">Page not available yet, come back soon!</div>

<?php           }
            }
?>
            </div>

<?php } else {

            include('pages/home.html');

      }
?>
            <div id="footer">
                   uncreated.net &bull; São Paulo, Brasil &bull;
                   <a id="contact" href="http://www.uncreated.net">
                       <img align="absbottom" src="images/info.png">
                   </a>

            </div>

        </div>

    </body>

</html>
