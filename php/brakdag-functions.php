<?PHP
function controleerOverlap($titel1, $titel2) {
    
    similar_text($titel1, $titel2, $percentageGelijk);
    return $percentageGelijk;
}

function hostVanLink($link) {
    $linkParts = parse_url($link);
    $host = $linkParts['host'];
    $zoekenOp = array('www.', '.nl', '.com', '.eu');
    $host = str_replace($zoekenOp, '', $host);
    return $host;
}

function verwijderRommelUitXml($data) {
    $rommelWatWegMoet = array(  " & ",
                                "<div class='code-block code-block-2'",
                                "style='margin: 8px 0; text-align: left; clear: both;'>",
                                "<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>",
                                "<!-- Banner -->",
                                "<ins class=\"adsbygoogle\"",
                                "style=\"display:inline-block;width:728px;height:90px\"",
                                "data-ad-client=\"ca-pub-1313824599504048\"",
                                "data-ad-slot=\"4601825036\"></ins>",
                                "<script>",
                                "(adsbygoogle = window.adsbygoogle || []).push({});",
                                "</script></div>",
                                "<!-- Banner footer -->",
                                "data-ad-slot=\"4601825036\"></ins>",
                                "<div class='code-block code-block-3' style='margin: 8px auto; text-align: center; clear: both;'>",
                                "data-recalc-dims=\"1\"",
                                );
    $rommelVervangen = array(   " &amp; ",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                ""
                                );
    $data = str_replace($rommelWatWegMoet, $rommelVervangen, $data);
    return $data;
}

function maakDescrGereed($descr) {
    // Lege ruimte weghalen
    $descr = trim($descr);
    
    // Hoeveelheid characters beperken tot 410
    $descrKlaar = (strlen($descr) > 413) ? substr($descr,0,410).'...' : $descr;

    return $descrKlaar;
}

function favicon($link) {
    $linkParts = parse_url($link);
    $img = str_replace(array(
        'www.rtvnoord.nl',
        'www.oogtv.nl',
        'www.gezinsbode.nl',
        'www.gic.nl',
        'www.dichtbij.nl',
        'toerisme.groningen.nl',
        'studentenkrant.org',
        'www.ukrant.nl',
        'www.nu.nl',
        '3voor12.vpro.nl',
        'www.groningenbereikbaar.nl',
        'www.aanpakringzuid.nl',
        'ringgroningen.nl',
        'www.desmaakvanstad.nl',
        'eetbarestadgroningen.nl',
        'www.horecagroningen.nl',
        'www.hanzemag.nl',
        'stadclickt.nl',
        'www.groc.nl',
        'www.groningerondernemerscourant.nl',
        'groningenfietsstad.nl',
        'www.oogstgroningen.nl', /* bestaat niet meer */
        'datmag.nl',
        'www.vera-groningen.nl',
        'www.sikkom.nl',
        'www.rug.nl',
        'www.zernikecampusgroningen.nl', /* is nu campus.groningen */
        'www.stadmagazine.nl',
        'www.dichtbij.nl',
        'os-groningen.nl',
        'stadsgoudgroningen.nl',
        'www.samenwerkingnoord.nl',
        'www.focusgroningen.nl',
        'www.groningenspoorzone.nl',
        'datisgroningen.com',
        'www.filtergroningen.nl',
        'groningerkrant.nl',
        'jouwstad.eu',
        'gemeente.groningen.nl',
        'campus.groningen.nl',
        'brakdag.nl',
        'www.cityoftalent.nl',
        'www.hetgonst.nl'
        ),array(
            'logo_rtvnoord.png',
            'logo_oog.png',
            'logo_gezinsbode.png',
            'logo_gic.png',
            'logo_dichtbij.png',
            'logo_toerisme.png',
            'logo_sk.png',
            'logo_uk.png',
            'logo_nu.png',
            'logo_paal.png',
            'logo_bereikbaar.png',
            'logo_bereikbaar.png',
            'logo_bereikbaar.png',
            'logo_smaak.PNG',
            'logo_eetbare.png',
            'logo_horeca.png',
            'logo_hanzemag.png',
            'logo_clickt.png',
            'logo_groc.png',
            'logo_groc.png',
            'logo_fietsstad.png',
            'logo_oogst.png',
            'logo_datmag.png',
            'logo_vera.png',
            'logo_sikkom.png',
            'logo_rug.png',
            'logo_campus.png',
            'logo_stadmagazine.png',
            'logo_dichtbij.png',
            'logo_os.png',
            'logo_stadsgoud.png',
            'logo_samenwerking.png',
            'logo_focus.png',
            'logo_spoorzone.png',
            'logo_datis.png',
            'logo_filter.png',
            'logo_groninger.png',
            'logo_jouwstad.png',
            'logo_gemeente.png',
            'logo_campus.png',
            'brakdag-logo.png',
            'logo_talent.png',
            'logo_gonst.png'
            ), $linkParts['host']);
    return $img;
}

function tijdsDuiding($timestamp) {
    $tijd = date("H:i",$timestamp); 
    return $tijd;            
}

function labelNieuw($gevonden) {
    $nu = time() + 7200;
    $kwartier = 60*15;
    if(($nu - $gevonden) < $kwartier)
    {
        $addNieuw = true;
    }
    else
    {
        $addNieuw = false;
    }
    return $addNieuw;
}
function labelClicks($clicks) {
    $addClicks = false;
    return $addClicks;
}

?>