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
        l = " ".join([s.Name,s.Description,s.City+",",s.Country,str(s.Month).zfill(2)+"/"+str(s.Year)])
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
        <hr/>
        <div>The source code of this application freely available on <a href="https://github.com/yorikvanhavre/priceAPI">github</a><br/></div>
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
            <input name="webprice-location" type="text">
            <label for="webprice-sources-select">"""+translate("Fonte")+"""</label>
            <select id="webprice-sources-select">
%contents-sources-select%
            </select>
            <input type="submit" value="Buscar">
        </div>
    </fieldset>
</form>

<h2>"""+translate("Resultados")+"""</h2>
<div class="webprice-results">
%contents-results%
</div>
"""


# build the HTML output


contentsresults = ''
data = cgi.FieldStorage()
if data.length > 0:
    contentsresults += "got data\n"
    if data.has_key('webprice-terms'):
        contentsresults += "got terms\n"
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
        contentsresults = getContentsResults(terms,location,source)

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
    
