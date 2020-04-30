var ajaxBezig = false;

if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('https://brakdag.nl/service-worker.js', {
    scope: '/'
  });
}

//$(function() {
//    if (navigator.userAgent.match(/(\(iPod|\(iPhone|\(iPad)/)) {
//        // Doe iets voor iOS devices
//    } 
//    
//});

$(function (){
    $(document).scroll(function() {
        var viewportHeight = $(window).outerHeight();
        var frameHeight = $(document).outerHeight() - viewportHeight;
        var scrollPos = $(document).scrollTop();
        var scrollPerc = Math.round((scrollPos/frameHeight)*100);
        
//        console.log("viewport" + viewportHeight + "totaal " + frameHeight + " en scroll "+ scrollPos + " en percentage " + scrollPerc + "%");
        $('.scroll-footer').css({"width":scrollPerc + "%"});
        if(scrollPerc <= 99)
        {
            $('.scroll-footer').removeClass('scroll-footer-done').addClass('scroll-footer-small');
            $('.scroll-footer').html("").html("<i class='fa fa-check'></i>");
        }
        else
        {
            $('.scroll-footer').removeClass('scroll-footer-small').addClass('scroll-footer-done');
            $('.scroll-footer').on('click', function() {
                $(window).scrollTop(0);
            });

        }

    });
});

$(function () {
    $(document).tooltip({
        tooltipClass: "tooltip-label",
            show: {
                delay: 500
            },
            position: {
                my: 'bottom center',
                at: 'bottom center+35'
            }
    });
});

$(function () {
    if(geefQueryString)
    {
        var queryString = location.search;
        var parameter = queryString.replace("?","").split("=")[0];
        var str = queryString.split("=")[1];
        if(parameter === "s")
        {
            strDecode = decodeURI(str).split('+').join(' ');
            $('#search-page :input').val(strDecode);
            zoek_op_term(strDecode);
        }
        else if(parameter === "t")
        {
            zoek_op_thema(str);
        }
    }
});
        
$(function () {
    $(document).on('click', '.logo-knop', function () {
        window.location.href = "/";
    });
});
        
$(function () {
    setInterval(function () {
        if(document.getElementById('allesUl') !== null) {
            var huidigAantalItems = $('#allesUl').children('li').length;
            if(Number.isInteger(huidigAantalItems) & (huidigAantalItems > 0))
            {
                check_posts(huidigAantalItems);
            }
        }
    }, 10000);
});

function check_posts(huidig) {
    var url = "php/nieuwe-artikelen-check.php";
    $.ajax({
        url: url,
        dataType: "html",
        global: false,
        success: function (text) {
            var aantalNieuw = text - huidig;
            if(Number.isInteger(aantalNieuw) & (aantalNieuw > 0) & (ajaxBezig === false))
            {
                if($("#date-select").children('option:first-child').is(':selected')) {
                    if((cookieBestaanControleren("message") !== null) & (geefQueryString() === false) & ($('#search-page input[type=text]').val() < 1)) {
                        $('#allesContainer').prepend($('.nieuw-notify-red'));
                        $('.nieuw-notify-red').html(aantalNieuw).show();
                        document.title = "(" + aantalNieuw + ") Brakdag";
                    }
                }
            }
            else
            {
                $('.nieuw-notify-red').hide().empty();
                document.title = "Brakdag";
            }
        }
    });
}

$(function () {
    $(document).on('click', '.nieuw-notify-red', function() {
        $('.nieuw-notify-red').hide().empty();
        $('body').prepend($('.nieuw-notify-red'));
        document.title = "Brakdag";
        main_page_load();
    });
    
});
        
$(function () {
    $(document).on('click', '.open-page', function () {
        var page = $(this).attr('id');
        var url = "frames/" + page + ".php";
        $.ajax({
            url: url,
            dataType: "html",
            success: function (html) {
                $('.wrap').fadeOut(100, function () {
                    $('.wrap').html(html).fadeIn(100);
                    $(window).scrollTop(0);
                });
            },
            error: function () {
            }
        });
        return false;
    });
});
        
$(function () {
    var options     = $("#date-select");
    var today       = Date.today().toString('yyyy-MM-dd');
    var today_1     = Date.parse('yesterday').toString('yyyy-MM-dd');
    var today_2     = Date.parse('today - 2 days').toString('yyyy-MM-dd');
    var today_3     = Date.parse('today - 3 days').toString('yyyy-MM-dd');
    var today_4     = Date.parse('today - 4 days').toString('yyyy-MM-dd');
    var today_5     = Date.parse('today - 5 days').toString('yyyy-MM-dd');
    var today_6     = Date.parse('today - 6 days').toString('yyyy-MM-dd');
    var today_7     = Date.parse('today - 7 days').toString('yyyy-MM-dd');
    var today_8     = Date.parse('today - 8 days').toString('yyyy-MM-dd');
    var today_9     = Date.parse('today - 9 days').toString('yyyy-MM-dd');
    var today_10    = Date.parse('today - 10 days').toString('yyyy-MM-dd');
    var today_11    = Date.parse('today - 11 days').toString('yyyy-MM-dd');
    var today_12    = Date.parse('today - 12 days').toString('yyyy-MM-dd');
    var today_13    = Date.parse('today - 13 days').toString('yyyy-MM-dd');
    var today_14    = Date.parse('today - 14 days').toString('yyyy-MM-dd');
    var today_15    = Date.parse('today - 15 days').toString('yyyy-MM-dd');
    var result      = new Array(today, today_1, today_2, today_3, today_4, today_5, today_6, today_7, today_8, today_9, today_10, today_11, today_12, today_13, today_14, today_15);
    for (var i = 0; i < result.length; i++) {
        var correctTime = (new Date(result[i])).getTime() / 1000 + 3600;
        var humanRead = (new Date(result[i])).toString('dddd d MMMM');
        options.append($("<option />").attr("data-humandate", humanRead).val(correctTime).text(humanRead));
    }
});
        
$(function () {
    if(!geefQueryString())
    {
        var optionSelected = $("#date-select").find("option:first");
        var dateRange = optionSelected.val();
        var humanDate = optionSelected.data("humandate");
        var url = "frames/nieuws-page.php";
        console.log(dateRange);
        if(dateRange !== undefined) {
        $.ajax({
            type: "POST",
            url: url,
            data: {dateRange: dateRange, humanDate: humanDate},
            dataType: "html",
            success: function (html) {
                $('.wrap').html(html);
                $(window).scrollTop(0);
            }
        });
        return false;
        }
    }
});
    
$(function () {

        $("#date-select").on('change', function () {
            var optionSelected = $(this).find("option:selected");

                var dateRange = optionSelected.val();
                var humanDate = optionSelected.data("humandate");
                var url = "frames/nieuws-page.php";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {dateRange: dateRange, humanDate: humanDate},
                    dataType: "html",
                    success: function (html) {
                        console.log("" + dateRange + " geselecteerd als datum.");
                        $('.wrap').fadeOut(100, function () {
                            $('.wrap').html(html).fadeIn('fast');
                            $(window).scrollTop(0);
                        });
                    }
                });
                return false;

        });
});

/* Ajax load animatie */        
$(document).on({
    ajaxStart: function () {
        ajaxBezig = true;
        $('.loading').show();        
    },
    ajaxStop: function () {
        ajaxBezig = false;
        $('.loading').hide();
        $('.ui-tooltip').hide().removeClass();
    }
});
 
$(function(){
    if(window.showAds === undefined)
    {
        $('.brakdag-social').hide();
    }
}); 

$(function () {
    $(document).on('click', 'ul.thema-menu li', function () {
//        var pakId = $(this).attr('id');
        var naamItem = $(this).text();
        zoek_op_thema(naamItem);
        
    });
});
   
//$(function () {
//    $(document).on('click', '.bron', function () {
//        var id = $(this).attr('id');
//        var descr = $('#' + id + '.descr');
//        var parentItem = $(descr).closest('.item');
//        if(descr.is(':visible'))
//        {
//            $(this).html("<i class='fa fa-chevron-down'></i>");
//            descr.css({"display": "none"});
//            $(parentItem).removeClass('focus');
//        } 
//        else
//        {
//            $(this).html("<i class='fa fa-chevron-up'></i>");
//            descr.css({"display": "block"});
//           
//            var elementOffset = descr.offset().top;
//            var elementHeight = descr.outerHeight();
//            var frameHeightBody = $(window).outerHeight();
//            
//            offset = elementOffset - ((frameHeightBody/2) - (elementHeight/2));
//            console.log("dit" + offset);
//            $('.item').removeClass('focus');
//            $(parentItem).addClass('focus');
//            $('html, body').animate({
//                scrollTop: offset
//            },300);
//            
//        }
//    });
//});

$(function () {
    $(document).on('click', '.item', function () {
        var id = $(this).attr('id');
        var descr = $('#' + id + '.descr');
        var parentItem = $(descr).closest(this);
        var pijl = $('#' + id + '.bron');
        if(descr.is(':visible'))
        {
            pijl.html("<i class='fa fa-chevron-down'></i>");
            descr.css({"display": "none"});
            $(parentItem).removeClass('focus');
        } 
        else
        {
            pijl.html("<i class='fa fa-chevron-up'></i>");
            descr.css({"display": "block"});

            var elementOffset = descr.offset().top;
            var elementHeight = descr.outerHeight();
            var frameHeightBody = $(window).outerHeight();
            
            offset = elementOffset - ((frameHeightBody/2) - (elementHeight/2));
            console.log("dit" + offset);
            $('.item').removeClass('focus');
            $(parentItem).addClass('focus');
            $('html, body').animate({
                scrollTop: offset
            },500);
            
        }
    });
});





$(function () {
    $(document).on('click', '.cr', function () {
        var artikel = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "newsClicks.php",
            global: false,
            data: {clicks: artikel},
            dataType: "html",
            success: function (html) {
                console.log("Geklikt op " + artikel + "");
                $('#' + artikel + '').removeClass('cr');
            }
        });
    });
});
       
function zoek_op_thema(thema) {
    if (thema !== "")
    {
        var zoekOpdracht = $.ajax({
            type: "POST",
            url: "frames/thema-page.php",
            data: {zoekterm: thema},
            dateType: "html",
            success: function (html) {
                $('.wrap').fadeOut(100, function () {
                    $('.wrap').html(html).fadeIn(100);
                });
            }
        });
    }
}
function zoek_op_term(term) {
    if (term !== '')
    {
        var zoekOpdracht = $.ajax({
            type: "POST",
            url: "frames/search-page.php",
            data: {zoekterm: term},
            dateType: "html",
            success: function (html) {
                $('.wrap').fadeOut(100, function () {
                    $('.wrap').html(html).fadeIn(100);
                    $(window).scrollTop(0);
                    zoek_in_url(term);
                });
                
            }
        });
    } else
    {
        var url = "frames/nieuws-page.php";
        var zoekOpdracht = $.ajax({
            url: url,
            dataType: "html",
            success: function (html) {
                $('.wrap').fadeOut(100, function () {
                    $('.wrap').html(html).fadeIn(100);
                    $(window).scrollTop(0);
                    zoek_in_url(term);
                });
            }
        });
        return false;
    }
}
function zoek_in_url(term) {
    if(term !== '')
    {
        termEncode = decodeURI(term).split(/\"/g).join('%22');
        var urlParameter = "?s=" + termEncode + "";
    }
    else
    {
        var urlParameter = "";
    }
    history.pushState(null, null, urlParameter);
}

$(function () {
    $('#search-page').on('click', function () {
        $('#search-page input[type=text]').focus();
    });
});
$(function () {
    $('#search-page input[type=text]').keyup(function (e) {   
        $("#search-form").submit(function(e) {
            return false;
        });
            
        if (e.keyCode === 13) {
            var term = $(this).val();
            zoek_op_term(term);
            return false;
        }
    });
});

$(function() {
    $('.message').on('click', function () {
        var message_id = $(this).attr('id');
        var naam = "message";
        cookieMakenVoorGelezen(message_id, naam);
        
        $(this).css({"display":"none"});
    });
});

$(function() {
    var cookieMetNaamMessage = cookieBestaanControleren("message");
    var messageId = "intro";
    if(cookieMetNaamMessage !== messageId)
    {    
        $('#' + messageId).closest('.message')
                .delay(2000)
                .show()
                .animate({bottom:"10px"});
    }
});

function cookieBestaanControleren(naam_cookie) {
    var naamZoek = naam_cookie + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(naamZoek) == 0) return c.substring(naamZoek.length,c.length);
    }
    return null;
}

function cookieMakenVoorGelezen(message_id, naam) {
    var datumtijd = new Date();
    datumtijd.setTime(datumtijd.getTime() + (365*24*60*60*1000));
    var verloopt = "expires=" + datumtijd.toUTCString(); // expires=Thu, 18 Dec 2013 12:00:00 UTC
    document.cookie = naam + "=" + message_id + ";" + verloopt + ";path=/";
}

function geefQueryString()
{
    var queryString = location.search;
    if(!queryString.trim())
    {
        return false;
    }
    else
    {
        return true;
    }
}

 

function main_page_load() {
    if(!geefQueryString())
    {
        var optionSelected = $("#date-select").find("option:first");
        if (optionSelected !== undefined) {
            var dateRange = optionSelected.val();
            var humanDate = optionSelected.data("humandate");
            var url = "frames/nieuws-page.php";
            $.ajax({
            type: "POST",
                    url: url,
                    data: {dateRange: dateRange, humanDate: humanDate},
                    dataType: "html",
                    success: function (html) {
                    console.log("" + dateRange + " geselecteerd als datum.");
                            $('.wrap').html(html);
                    }
            });
            return false;
        }
    }
}

//$(function() {
//       var counterElement = $(".artikelCount");
//       var maxCount = counterElement.html();
//       counterElement.html("0");
//
//    var numAnim = new CountUp(counterElement, 0, 210);
//    if (!numAnim.error) {
//       numAnim.start();
//    } else {
//       console.error(numAnim.error);
//    }   
//
//    
//});

// Elementen met dezelfde bron clusteren
//$(function() {
//    if(document.getElementById('allesUl') !== null) 
//    {
//        $('.item').each(function() {
//            var $this = $(this);
//            var bron = $(this).attr('data-bron');
//            console.log("jaaja" + bron);
//
//        });
//    }
//    else
//    {
//        console.log("bestaat niet");
//    }
//});


    
