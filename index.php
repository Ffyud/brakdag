<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-71076573-1', 'auto');
          ga('send', 'pageview');
          ga('send', 'pageview', '/?s=keyword');
        </script> 
        
        <title>Brakdag</title>
        <meta name="description" content="Brakdag verzamelt nieuws uit Stad van allerlei internetbronnen.">
        <meta name="keywords" content="groningen, nieuws, stad, rtvnoord, oogtv, rijksuniversiteit, brakdag, noorden">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, viewport-fit=cover">
        <meta name="application-name" content="Brakdag" />
        
        <meta property="og:title" content="Brakdag"/>
        <meta property="og:url" content="https://brakdag.nl"/>
        <meta property="og:image" content="https://brakdag.nl/img/brakdag-logo.png"/>
        <meta property="og:site_name" content="Brakdag"/>
        <meta property="og:description" content="Brakdag verzamelt nieuws uit Stad van allerlei internetbronnen."/>
        <meta property="og:locale" content="nl_NL"/>
        
        <meta name="twitter:card" content="summary">
        <meta name="twitter:url" content="https://brakdag.nl">
        <meta name="twitter:title" content="Brakdag">
        <meta name="twitter:description" content="Brakdag verzamelt nieuws uit Stad van allerlei internetbronnen.">
        <meta name="twitter:image" content="https://brakdag.nl/img/brakdag-logo.png">
        <meta name="twitter:site" content="@BrakdagStad">
        
        <link type="application/opensearchdescription+xml" rel="search" href="open_search.xml"/>
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "WebSite",
                "url":"https://brakdag.nl",
                "text":"Brakdag verzamelt al het nieuws uit Stad van allerlei internetbronnen.",
                "name":"Brakdag",
                "datePublished":"02/04/2015 GMT",
                "thumbnailUrl":"https://brakdag.nl/img/brakdag-logo.png",
                "potentialAction": {
                    "@type": "SearchAction",
                    "target": "https://brakdag.nl/s?q={search_term_string}",
                    "query-input": "required name=search_term_string"
                  },
                "sameAs": [
                    "https://www.twitter.com/brakdagstad"
                  ]
            }
        </script>
        
        <link rel="apple-touch-icon" href="/brakdag-logo-ios.png">
        <meta name="apple-mobile-web-app-capable" content="yes">
        
        <link rel=”alternate” hreflang=”nl-nl” href=”https://www.brakdag.nl/” />
        <link rel="manifest" href="/manifest.webmanifest">        
        <meta name="theme-color" content="#01592a">
        <link rel="shortcut icon" href="img/brakdag-logo.png" />
        <link rel="icon" href="img/brakdag-logo.png">
        
        <link rel="alternate" href="https://brakdag.nl/rss/" type="application/rss+xml" title="Brakdag">
        
        <link href='https://fonts.googleapis.com/css?family=Open+Sans|Lobster' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="style/design.css" type="text/css" media="all"/>  
        <link rel="stylesheet" href="style/font-awesome.min.css" type="text/css" media="all"/> 
        <link rel="stylesheet" href="style/weather-icons.min.css" type="text/css" media="all"/>
    </head>
    <body>
        <!--<div class="scroll-footer"></div>-->
        <a href="https://brakdag.nl/rss/" class="feed"><i class="fa fa-rss"></i></a>
        <?PHP
            include("frames/main-message.php");
            echo "<div class='nieuw-notify-red'></div>";
        ?>
        <div class="head-wrap">        
            <div class="head">
                <!--<a href="https://brakdag.nl/?t=Bommen%20Berend" class="bommen-berend"><img src="img/Bommen-Berend.png"/></a>-->
                <ul class="head-menu"><li id="nieuws-page" class="logo-knop">
                    <a class="logo-small">bd</a>    
                    <a class="logo">brakdag</a>
                    </li>
                    <li id="search-page">
                        <a id="search-icon"><i class="fa fa-search"></i></a>
                        <form id="search-form">
                            <input placeholder="Zoeken" aria-label="Zoekveld" type="text" onClick="this.setSelectionRange(0, this.value.length)">
                        </form>
                    </li>
                    <li id="info-page" class="menu-knop"><a href="info.php" class="knop" ><i class="fa fa-info-circle fa-fw"></i></a>
                    </li>
                </ul>                   
            </div>
            <div class="sub-head">
                <ul class="sub-head-menu">                    
                    <li>
                        <select aria-label="Datumselectie" id="date-select" class="sub-menu-select">
                        </select>
                    </li><li> 
                    </li>
                </ul>
            </div>
            <div class="loading"><div class="gif"></div></div>
        </div>
        <div class="wrap">
        </div>
<!--        <div class="footer">
            <a class="logo-footer">brakdag</a>
        </div>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/countUp.js"></script>        
        <script type="text/javascript" src="js/date.js"></script>
        <script type="text/javascript" src="js/date-nl-NL.js"></script>
        <script type="text/javascript" src="js/showads.js"></script>
        <script type="text/javascript" src="js/brakdag.js"></script>
    </body>
</html>
