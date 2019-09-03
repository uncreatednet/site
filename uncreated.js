// diversas funções para o site...

var y = 0; // a altura de scroll do menu
var maxy = 370; // a altura maxima do menu
var timer;

// liga funções aos movimentos da rodinha do mouse

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
}

// trata o movimento da rodinha

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

// trata as setinhas de cima e baixo

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
