<!DOCTYPE html>

<?php
    // LISTA DE PROJETOS (POR ORDEM NO MENU) - imagens com mesmo nome da página em images/menu
    
    //    página          título                          descrição
    $menu = array(
    array('condominios',  'Condos abertos',               'Ideias para condomínios abertos'),
    array('pirituba',     'Pirituba',                     'Centro comercial de bairro em São Paulo, Brasil'),
    array('itu',          'Itu',                          'Conjunto residencial, comercial e hoteleiro em Itu, Brasil'),
    array('bh',           'Belo Horizonte',               'Centro administrativo da prefeitura de Belo Horizonte, Brasil'),
    array('floripa',      'Florianopolis',                'Proposta para a cobertura do vão central do mercado público de Florianópolis, Brasil'),
    array('yaroslavl',    'Yaroslavl',                    'Projeto para o Spartacus de Yaroslavl, Russia'),
    array('parqueaugusta','Parque Augusta',               'Projeto para o Parque Augusta em São Paulo, Brasil'),
    array('lanxess',      'Lanxess',                      'Fábrica Lanxess em Porto Feliz, Brasil'),
    array('costadoipe',   'Costa do Ipê',                 'Costa do Ipê Parque Shopping em Marília, Brasil'),
    array('gregoire',     'Casa GL',                      'Casa para Greg e Lívia, São Gonçalo dos Campos, Brasil'),
    array('gowanus',      'Gowanus Canal',                'Projeto para o canal Gowanus, Nova Iorque, USA'),
    array('51',           '51',                           'Prédio administrativo em Pirassununga, Brasil'),
    array('pace',         'PACE',                         'ONG PACE, São Gonçalo dos Campos, Brasil'),
    array('indaiatuba',   'Indaiatuba',                   'Open Mall em Indaiatuba, Brasil'),
    array('openfort',     'Fort 400',                     'Prédio de apartamentos em Amsterdam, Holanda'),
    array('sanisidro',    'San Isidro',                   'Prédio de lofts em Lima, Peru'),
    );
    
    ?>

<html>
    <head>

<?php if ($_GET['phpinfo'] != '') { ?>

     <?php phpinfo(); ?>

<?php } else if ($_GET['page'] != '') { 
     
            if ($_GET['page'] == 'embedded') { ?>
        
                <title>Exemplos - Uncreated.net Architecture Network</title>
                
<?php       } else if ($_GET['page'] == 'publications') { ?>
    
                <title>Publicações - Uncreated.net Architecture Network</title>

<?php       } else { 
                $title = "";
                foreach ($menu as $item) {
                    if ($_GET['page'] == $item[0]) {
                        $title = $item[1]." - ";
                    }
                } ?>

                <title><?php echo $title; ?>Uncreated.net Architecture Network</title>
                
<?php       }

      } else { ?>

        <title>Uncreated.net Architecture Network</title>

<?php } ?>

        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="alternate" type="application/rss+xml" title="Maíra's feed" href="http://maira.uncreated.net/?feed=rss2"/>
        <link rel="alternate" type="application/rss+xml" title="Yorik's feed" href="http://feeds.feedburner.com/yorikvanhavre"/>
        <link type="text/css" href="uncreated.css" rel="stylesheet">
        
        <script>
            
            var step = 0; // a imagem atual do slideshow
            var y = 0; // a altura de scroll do menu
            var maxy = 370; // a altura maxima do menu
            var scroll = [] // imagens e links para o slideshow
            
            function setup(menuitems) {
                // altura maxima do menu
                maxy = menuitems * 50 - 280;
                // mouse scroll
                menudiv = document.getElementById('innermenu');
                // callback para moz
                if(window.addEventListener)
                    menudiv.addEventListener('DOMMouseScroll', mouseMove, false);
                // callback para chrome/opera/ie
                menudiv.onmousewheel = mouseMove;
                // populate the scroller
                <?php for ( $count = 0; $count < count($scroller); $count += 1) { ?>
                    scroll[<?php echo $count; ?>] = ['<?php echo $scroller[$count][0];?>','<?php echo $scroller[$count][1];?>','<?php echo $scroller[$count][2];?>'];
                <?php } ?>
                slideIt()
            }
            
            function slideIt() {
                // atualiza o slideshow
                contentsdiv = document.getElementById('slider');
                if (contentsdiv) {
                    cstr = '<a href=?page=' + scroll[step][0] + ' title="' + scroll[step][2];
                    cstr += '"><img src="images/scroller/' + scroll[step][1];
                    cstr += '"></a>' + scroll[step][2];
                    cstr += ' &bull; ';
                    for (var i=0; i<scroll.length; i++) {
                        if (i == step) {
                            cstr += '<span class="cr">' + (i+1) + '</span> ';
                        } else {
                            cstr += (i+1) + ' ';
                        }
                    }
                    contentsdiv.innerHTML = cstr;
                    step++;
            
                    if (step == scroll.length) {
                        step = 0;
                    }
                    setTimeout('slideIt()',3000)
                }
            }
            
            function mouseMove(event){
                contentdiv = document.getElementById('innermenu');
                var delta = 0; 
                if (!event) event = window.event;
                // impede de rolar a página toda
                event.preventDefault();
                // normalização
                if (event.wheelDelta) {
                    // IE e Opera
                    delta = event.wheelDelta / 5;
                } else if (event.detail) {
                    // W3C
                    delta = -event.detail * 6;
                }
                if (delta > 0) {
                    if ((y + delta) < 0) {
                        y = y + delta;
                    } else {
                        y = 0;
                    }
                } else {
                    if ((y + delta) > -maxy) {
                        y = y + delta;
                    } else {
                        y = -maxy;
                    }
                }
                contentdiv.style.top = y+"px";
            }
            
            function scrollDiv(size) {
                // rola o menu para baixo
                contentdiv = document.getElementById('innermenu');
                if (size > 0) {
                    if ((y + size) < 0) {
                        y = y + size;
                        timer = setTimeout("scrollDiv("+size+")",8)
                    } else {
                        y = 0;
                    }
                } else {
                    if ((y + size) > -maxy) {
                        y = y + size;
                        timer = setTimeout("scrollDiv("+size+")",8)
                    } else {
                        y = -maxy;
                    }
                }
                contentdiv.style.top = y+"px";
            }
            
            function stopScroll() {
                clearTimeout(timer);
            }
            
            function replaceLinks(text) {
                // troca URLs por links nos tweets
                result=text.replace(/(https?:\/\/([-\w\.]+)+(:\d+)?(\/([\w\/_\.]*(\?\S+)?)?)?)/g,'<a href="$1">$1</a>');
                return result;
            }
        </script>
        
    </head>
    
    <body onLoad="setup(<?php echo count($menu); ?>)">
    
        <?php /* <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=416031718430708&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script> */ ?>
        <?php //<script src="https://apis.google.com/js/platform.js" async defer></script> ?>

        <div>
            <?php //<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script> ?>
            <div id="fbouc">
                
                <a href="/cloud" style="float:right; padding-left: 6px;" title="Cloud">
                    <img src="images/owncloud.png">
                </a>
                
                <a href="/project" style="float:right; padding-left: 6px;" title="Project manager">
                    <img src="images/capacete.png">
                </a>
                
                <a href="https://github.com/uncreatednet" style="float:right; padding-left: 6px;" title="Uncreated on Github">
                    <img src="images/github.png">
                </a>
                
                <a href="https://plus.google.com/107821473504234303924" rel="publisher" style="float:right; padding-left: 6px;" title="Uncreated on Google+">
                    <img src="images/googleplus.png">
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
                
                <?php //<fb:like href="http://www.uncreated.net/" layout="button_count" show_faces="true" width="450" font="arial" colorscheme="dark"></fb:like> ?>
                <?php //<div class="fb-like" data-href="http://www.uncreated.net" data-layout="standard" data-action="like" data-show-faces="false" data-share="false" data-colorscheme="dark"></div> ?>
                <?php //<div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300" data-href="http://www.uncreated.net"></div>?>
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
                    <a class="button" href="#" 
                       title="Uma seleção dos nossos projetos de arquitetura">
                        Projetos
                        <div class="trad">Projects</div>
                    </a>
                    
                    <!-- begin php menu -->
                    <ul>
                        <li class="arrow-li" onmouseover="scrollDiv(1)" onmouseout="stopScroll()">
                            <div class="arrow-up"></div>
                        </li>
                        <li id="outermenu">
                            <div id="innermenu">
<?php foreach ($menu as $item) { ?>
                                <a class="item" href="?page=<?php echo $item[0]; ?>" title="<?php echo $item[2]; ?>">
                                    <img src="images/menu/<?php echo $item[0]; ?>.jpg">
                                    <div class="trad overlay2">
                                        <?php echo $item[1]; ?>
                                    </div>
                                </a>
<?php } ?>
                            </div>
                        </li>
                        <li class="arrow-li" onmouseover="scrollDiv(-1)" onmouseout="stopScroll()">
                            <div class="arrow-down"></div>
                        </li>
                    </ul>
                    <!-- end php menu -->
                    
                </li>
                <li>
                    <a class="button" href="?page=embedded&tag=works" title="Todos os nossos trabalhos">
                        Outros
                        <div class="trad">Other works</div>
                    </a>
                    
                    <ul>
                        <li>
                            <a class="item" href="?page=embed&tag=3d" title="imagens 3D">
                                3D
                                <div class="trad">3D</div>
                            </a>
                        </li>
                        <li>
                            <a class="item" href="?page=embed&tag=detail" title="projetos executivos">
                                Executivos
                                <div class="trad">Construction docs</div>
                            </a>
                        </li>
                        <li>
                            <a class="item" href="?page=embed&tag=animations" title="animations">
                                Animações
                                <div class="trad">Animations</div>
                            </a>
                        </li>
                        <li>
                            <a class="item" href="?page=textos" title="Textos e artigos">
                                Textos
                                <div class="trad">Texts</div>
                            </a>
                        </li>
                        <li>
                            <a class="item" href="?page=publications" title="Publicações sobre o uncreated">
                                Publicações
                                <div class="trad">Publications</div>
                            </a>
                        </li>
                    </ul>
                    
                    <?php /*
                    <ul>
                        <li>
                            <a class="item" href="http://maira.uncreated.net" title="Maíra Zasso, arquiteta">
                                <img src="images/menu/maira.jpg">
                                <div class="trad overlay2">Maíra Zasso</div>
                                <?php //<div class="trad">Arquiteta</div> ?>
                            </a>
                        </li>
                        <li>
                            <a class="item" href="http://yorik.uncreated.net" title="Yorik van Havre, arquiteto">
                                <img src="images/menu/yorik.jpg">
                                <div class="trad overlay2">Yorik van Havre</div>
                                <?php //<div class="trad">Arquiteto</div> ?>
                            </a>
                        </li>
                        <li>
                            <a class="item" title="Mop, mascote">
                                <img src="images/menu/mop.jpg">
                                <div class="trad overlay2">Mop</div>
                                <?php //<div class="trad">Mascote</div> ?>
                            </a>
                        </li>
                    </ul>
                    */ ?>
                    
                </li>
                <li>
                    <a class="button" 
                       href="?page=sobre" 
                       title="Sobre o nosso trabalho de arquitetos">
                        Sobre nós
                        <div class="trad">About us</div>
                    </a>
                </li>
                <li>
                    <a class="button" href="?page=feed" 
                       title="O que acontece por aqui...">
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
                if ($_GET['tag'] != '') { ?>
     
            <h2>Todos os trabalhos</h2>
            
            <div class="portugues">
            
                <p>Abaixo estão exemplos do nosso trabalho, incluindo os nossos
                próprios projetos bem como trabalhos que fizemos em parceria ou
                para outros escritórios.</p>
                
                <p>Isso inclui projetos de arquitetura, imagens 3D feitas com
                computação gráfica, animações, desenhos de arquitetura, webdesign
                entre outras coisas...</p>
            
            </div>
            
            <div class="ingles">
            
                <p>Below are examples of our work, including our own projects,
                but also works we have done in collaboration or for other
                offices.</p>
                
                <p>This includes architecture projects, 3D images made with
                computer graphics, animations, architectural drawings,
                webdesign among other things...</p>
            
            </div>
                    
<?php               $_GET['complete'] = 3;
                    $_GET['embedded'] = 1;
                    include('yorik/guestblog.php');
                } else if ( ($_GET['post'] != '') and ($_GET['year'] != '') ) {
                    $_GET[$_GET['year']] = $_GET['post'];
                    $_GET['embedded'] = 1;
                    include('yorik/guestblog.php');
                } else {
                    echo('<div class="portugues">Página não encontrada!</div><div class="ingles">Page not found!</div>');
                }
            } else {
                $pagename = 'pages/' . $_GET['page'] . '.html';
                if (file_exists($pagename)) {
                    include($pagename);
                } else {
                    echo('<div class="portugues">Página ainda não disponível, volte em breve!</div><div class="ingles">Page not available yet, come back soon!</div>');
                }
            } ?>

            </div>

<?php } else { ?>

<?php //    <div id="slider"></div> ?>

<?php       include('pages/home.html'); ?>

<?php } ?> 

            <div id="footer">
                   uncreated.net &bull;
                   <a href="http://maira.uncreated.net">Maíra Zasso</a> & 
                   <a href="http://yorik.uncreated.net">Yorik van Havre</a> 
                   architects &bull; São Paulo, Brasil &bull;
                   <a id="contact" href="http://www.uncreated.net">
                       <img align="absbottom" src="images/info.png">
                       <?php //<div id="contactinfo"><img src="images/contactinfo.jpg"></div> ?>
                   </a>

                   <!-- Start 1FreeCounter.com code -->
                   <script language="JavaScript">
                           var data = '&r=' + escape(document.referrer)
                                    + '&n=' + escape(navigator.userAgent)
                                    + '&p=' + escape(navigator.userAgent)
                                    + '&g=' + escape(document.location.href);

                           if (navigator.userAgent.substring(0,1)>'3')
                                   data = data + '&sd=' + screen.colorDepth 
                                        + '&sw=' + escape(screen.width+'x'+screen.height);

                           document.write('<a href="http://www.1freecounter.com/stats.php?i=85889" target=\"_blank\" >');
                           document.write('<img alt="Free Counter" border=0 hspace=0 '+'vspace=0 src="http://www.1freecounter.com/counter.php?i=85889' + data + '">');
                           document.write('</a>');
                   </script>
                   <!-- End 1FreeCounter.com code -->

            </div>
        </div>
    </body>
</html>
