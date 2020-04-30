<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
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
        
        <link rel="apple-touch-icon" href="/brakdag-logo-ios.png">
        <meta name="apple-mobile-web-app-capable" content="yes">
        
        <link rel=”alternate” hreflang=”nl-nl” href=”https://www.brakdag.nl/” />
        <link rel="manifest" href="/manifest.json">        
        <meta name="theme-color" content="rgb(40, 123, 20)">
        <link rel="shortcut icon" href="img/brakdag-logo.png" />
        <link rel="icon" href="img/brakdag-logo.png">
        
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Lobster" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="style/design.css" type="text/css" media="all"/>  
        <link rel="stylesheet" href="style/font-awesome.min.css" type="text/css" media="all"/> 

        
        <style>
            body { 
                min-width: 350px; 
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none; 
            }
            @media screen and (max-width: 720px) {
                .content { max-width: 450px !important;}
                .column { margin: 5px !important; padding: 10px !important; height: auto !important;min-width: 0px !important;
                         width: calc(100% - 50px) !important; }
            }
            @media screen and (max-width: 680px) {
                .column { margin: 10px !important;
                         padding: 15px !important;
                         min-width: 0px !important;
                         width: calc(100% - 50px) !important; 
                }
                .uitleg-phone { height: 250px !important;}
            }
            .content { position: relative; display: table; position: relative; padding: 10px; max-width: 800px; margin: 0px auto;}
            
            .intro-wrap {
                background: rgb(22, 134, 26);
            }
            .intro-content {
                
            }
            .intro-content {
                text-shadow: 0px 1px 0px rgba(16, 95, 19, 0.5),
                        0px -1px 0px rgba(16, 95, 19, 0.5),
                        -1px 0px 0px rgba(16, 95, 19, 0.5),
                        1px 0px 0px rgba(16, 95, 19, 0.5);
                color: #FFF;
                font-weight: 800;
                font-size: 1.6em;
                text-align: center;
                padding: 15px;
                max-width: 600px;
                margin: 0px auto;
            }
            .column { 
                position: relative;
                display: inline-block;
                overflow: hidden;
                background: red;
                height: 130px;
                width: calc(50% - 52px);
                min-width: 300px;
                background: #FFF;
                margin: 10px;
                padding: 15px;
                border-radius: 4px;
                box-shadow: 0px 1px 1px 0px rgb(216, 216, 216);
            }
            a {
                text-decoration: underline;
                color: rgb(22, 134, 26);
                font-weight: 800;
            }
            .top-img {
                height: 100px;
                display: relative;
                padding: 10px;
                display: block;
                margin: 0px auto;
            }
            .uitleg-logo { border-radius: 20px; float: left;}
            .uitleg-social { font-size: 3em;
    color: #3b5998;}
            .uitleg-bronnen {
                width: calc(100% - 40px);
                height: auto;
                position: relative;
                margin: 0px;
                padding: 0px;
            }
            .uitleg-selectdag {
                bottom: -10px;
                float: left;
                left: -10px;
                height: auto;
                position: relative;
                width: 170px;
            }
            .uitleg-realtime { 
                padding: 10px 5px 10px 5px;
                border-radius: 10px;
                background: rgb(222, 90, 90);
                text-shadow: 0px 1px rgba(0, 0, 0, 0.05);
                color: rgb(255, 255, 255);
                padding: 10px 15px 10px 15px;
                text-align: center;
                max-width: 215px;
            }
            .uitleg-rss { font-size: 4em; float: right; color: #ff9d00; padding: 0px 0px 10px 10px;}
            .uitleg-twitter { color: #1da1f2; font-size: 3.5em; float: left; padding: 10px 0px 0px 0px; }
            .uitleg-phone { height: 400px; float: right;}
            .uitleg-x-artikelen {     
                background: rgb(22, 134, 26);
                color: #FFF;
                margin: 0px auto;
                padding: 10px 5px 10px 5px;
                font-weight: 800;
                border-radius: 30px;
                width: 200px;
                text-align: center;
                font-size: 1.3em;
            }
            .uitleg-text { padding: 10px 0px 0px 0px;}
            .uitleg-text-phone { text-align: right;}
            
            .uitleg-terug { 
                background: none;
                box-shadow: none;
                padding: 10px 15px 10px 15px;
                font-size: 1em;
                color: #777;
                text-align: left;
                text-decoration: none;
                display: block;
                font-weight: 800;
            }
            .uitleg-terug:hover {
                color: #000;
            }

        </style>
    </head>
    <body>
        <a href='https://brakdag.nl' class="uitleg-terug"><i class="fa fa-arrow-left"></i> terug naar brakdag.nl</a>
        <div class="intro-wrap">
            <p class="intro-content">Over brakdag</p>
        </div>
        <div class="content">
            <div class="column">
                <img class="top-img uitleg-logo" src="img/info/brakdag-logo.png">
                <div class="uitleg-text">Brakdag weet wat er speelt: het verzamelt elke dag het nieuws uit Groningen Stad.</div>
            </div>
            
            
            <div class="column">
                <img class="top-img uitleg-phone" src="img/info/brakdag-iphone.png">
                <div class="uitleg-text uitleg-text-phone">Werkt goed op je smartphone, tablet of computer.</div>
            </div>
            <div class="column">
                <div class="uitleg-realtime">6 nieuwe artikelen gevonden</div>
                <div class="uitleg-text">Brakdag scant voortdurend, dus de artikelen verschijnen bijna realtime.</div>
            </div>
            <div class="column">
                <div class="uitleg-x-artikelen"><i class="fa fa-fw fa-search"></i> +120.000 artikelen</div>
                <div class="uitleg-text">Al het nieuws uit Stad is terug te vinden met de zoekfunctie.</div>
            </div>
            <div class="column">
                <img class="top-img uitleg-selectdag" src="img/info/select-dag.png">
                <div class="uitleg-text uitleg-text">Naast het nieuws van vandaag kan je ook terug bladeren in de afgelopen dagen.</div>
            </div>
            <div class="column">
                <img class="top-img uitleg-bronnen" src="img/info/bronnen-sample.png">
                <div class="uitleg-text uitleg-text">Brakdag volgt meer dan 30 nieuwsbronnen en probeert altijd nieuwe te vinden.</div>
            </div>
            <div class="column">
                <i class="uitleg-rss fa fa-rss-square"></i>
                <div class="uitleg-text uitleg-text">Gebruik de Brakdag <a href="https://brakdag.nl/rss/">feed</a> om het nieuws met een RSS-app (zoals <a href="https://feedly.com/i/subscription/feed%2Fhttps%3A%2F%2Fbrakdag.nl%2Frss%2F">Feedly</a>) te consumeren.</div>
            </div>
            <div class="column twitter">
                <div class="uitleg-text uitleg-text">Updates komen ook nog wel eens op <a href="https://twitter.nl/brakdagStad/">Twitter</a> terecht.</div>
                <i class="uitleg-twitter fa fa-twitter"></i>
            </div>
        </div>
    </body>
</html>
