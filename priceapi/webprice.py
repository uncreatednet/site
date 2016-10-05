#!/usr/bin/env python
# -*- coding: UTF-8 -*-

# enable debugging
import cgitb
cgitb.enable()

# import main web lib
import cgi

# set mime type
print "Content-Type: text/html;charset=utf-8\n"

# load the price API
import priceapi


# define the main functions and templates


def translate(text):
    # use any translation system you would like here
    return text


def getFavicon():
    # change here to adapt to your own website
    return '        <link rel="shortcut icon" href="/images/favicon.ico">'
    

def getStylesheet():
    # change here to adapt to your own website
    return '        <link type="text/css" href="/uncreated.css" rel="stylesheet">'


def getContentsSource():
    result = '    <div class="webprice-source-item"><b>Fontes</b></div>'
    for s in priceapi.sources:
        l = " ".join([s.Name,s.Description,s.City+",",s.Country,str(s.Month).zfill(2)+"/"+str(s.Year)," - CUB: R$ ",str(s.CUB)])
        result += '\n    <div class="webprice-source-item"><a href="'+s.refURL+'">'+l+'</a></div>'
    return result


def getContentsSourcesSelect():
    result = '                <option value="All">'+translate("Todas")+'</option>'
    for s in priceapi.sources:
        result += '\n                <option value="'+s.Name+'">'+s.Name+'</option>'
    return result


def getContentsResults(terms,location,source):
    searchresults = priceapi.search(terms,location,source)
    result = ''
    if searchresults:
        result += '    <table class="webprice-results-table">\n'
        for res1 in searchresults:
            for res2 in res1[1]:
                result += '        <tr class="webprice-result-item">\n'
                result += '            <td class="webprice-result-source">'+res1[0].Name+'</td>\n'
                result += '            <td class="webprice-result-code">'+res2[0]+'</td>\n'
                result += '            <td class="webprice-result-text">'+res2[1]+'</td>\n'
                result += '            <td class="webprice-result-price">'+res2[2]+'</td>\n'
                result += '            <td class="webprice-result-unit">'+res2[3]+'</td>\n'
                result += '        </tr>\n'
        result += '    </table>'
    return result


htmltemplate = """<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>"""+translate("Price search")+"""</title>
        <meta content="Yorik van Havre" name="author">
%favicon%
%stylesheet%
    </head>

    <body>

        <div>
            <div id="fbouc">
                
                <a href="/project" style="float:right; padding-left: 6px;" title="Project manager">
                    <img src="/images/capacete.png">
                </a>
                
                <a href="/priceapi/webprice.py" style="float:right; padding-left: 6px;" title="Busca de preços da construção civil">
                    <img src="/images/price.png">
                </a>
                
                <a href="/cloud" style="float:right; padding-left: 6px;" title="Cloud">
                    <img src="/images/owncloud.png">
                </a>
                
                &nbsp;&nbsp;
                
                <a href="/inventario" style="float:right; padding-left: 6px;" title="Inventário de receitas">
                    <img src="/images/inventario.png">
                </a>
                
                <a href="https://github.com/uncreatednet" style="float:right; padding-left: 6px;" title="Uncreated on Github">
                    <img src="/images/github.png">
                </a>
                
                <a href="https://plus.google.com/107821473504234303924" rel="publisher" style="float:right; padding-left: 6px;" title="Uncreated on Google+">
                    <img src="/images/googleplus.png">
                </a>
                
                <a href="https://www.facebook.com/uncreated.net" style="float:right; padding-left: 6px;" title="Uncreated on Facebook">
                    <img src="/images/facebook.png">
                </a>
                
                <a href="https://www.linkedin.com/company/uncreated" style="float:right; padding-left: 6px;" title="Uncreated on LinkedIn">
                    <img src="/images/linkedin.png">
                </a>
                
                <a href="http://architizer.com/firms/uncreatednet/" style="float:right; padding-left: 6px;" title="Uncreated on Architizer">
                    <img src="/images/architizer.png">
                </a>
                
                <a href="#" style="float:right; padding-left: 6px;" title="Yorik: @yorikvanhavre&#10;Maíra: @mairocas">
                    <img src="/images/twitter.png">
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
            <div id="content">
%contents%
            <div>
        </div>        
        <div id="footer">
            <div>The source code of this application is open and freely available on <a href="https://github.com/yorikvanhavre/priceAPI">github</a><br/></div>
            <hr/>
            uncreated.net &bull;
            <a href="http://maira.uncreated.net">Maíra Zasso</a> & 
            <a href="http://yorik.uncreated.net">Yorik van Havre</a> 
            architects &bull; São Paulo, Brasil &bull;
            <a id="contact" href="http://www.uncreated.net">
                <img align="absbottom" src="/images/info.png">
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
    </body>
</html>
"""


contentstemplate = """
<h2>"""+translate("Busca de preços de insumos da construção civil")+"""</h2>

<div class="webprice-sources">
%contents-sources%
</div>

<form id="priceapi" action="webprice.py" class="webprice-form" method="POST">
    <fieldset>
        <div class="webprice-help">"""+translate("Separe cada termo por um espaço para obter somente ítens que contem toda sas palavras. Use um | entre termos alternativos (obterá ítens contendo um OU outro termo).")+"""</div>
        <div>
            <label for="webprice-terms">"""+translate("Termos")+"""</label>
            <input name="webprice-terms" type="text" required autofocus>
            <label for="webprice-location">"""+translate("Cidade (opcional)")+"""</label>
            <input name="webprice-location" type="text" value="São Paulo">
            <label for="webprice-sources-select">"""+translate("Fonte")+"""</label>
            <select id="webprice-sources-select">
%contents-sources-select%
            </select>
            <input type="submit" value="Buscar">
        </div>
    </fieldset>
</form>

%contents-results%
"""


# build the HTML output


contentsresults = ''
data = cgi.FieldStorage()
if data.length > 0:
    if data.has_key('webprice-terms'):
        contentsresults += "<h2>"+translate("Resultados")+"</h2>\n"
        contentsresults += '<div class="webprice-results">\n'
        terms = data['webprice-terms'].value
        location = None
        if data.has_key('webprice-location'):
            if data['webprice-location']:
                location = data['webprice-location'].value
        source = None
        if data.has_key('webprice-sources-select'):
            if data['webprice-sources-select']:
                if data['webprice-sources-select'] != 'All':
                    source = data['webprice-sources-select'].value
        contentsresults += getContentsResults(terms,location,source)
        contentsresults += '</div>\n'

contents = contentstemplate.replace("%contents-sources%",getContentsSource())
contents = contents.replace("%contents-sources-select%",getContentsSourcesSelect())
contents = contents.replace("%contents-results%",contentsresults)

# tabulate
contents = "\n".join(["                "+l for l in contents.split("\n")])

# build html
page = htmltemplate.replace("%favicon%",getFavicon())
page = page.replace("%stylesheet%",getStylesheet())
page = page.replace("%contents%",contents)
print page
    
