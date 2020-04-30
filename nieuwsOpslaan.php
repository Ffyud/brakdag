<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
// URL aanpassen als naam map verandert
include("$root/php/brakdag-functions.php");
header("Content-type: text/plain");

// Lijst met bronnen
$urlBronnen = array(
    "https://www.oogtv.nl/feed/",
    "https://datmag.nl/feed/rss", // geen inhoud toegevoegd
    "https://www.rtvnoord.nl/rss",
    "https://www.gic.nl/startpagina/rss",
    "http://www.gezinsbode.nl/feed/", // weg
    "https://studentenkrant.org/feed/",
    "https://www.ukrant.nl/feed", // kapot
    "https://www.nu.nl/rss/groningen",
    "https://www.groningenbereikbaar.nl/nieuws/rss",
    "https://eetbarestadgroningen.nl/category/nieuws/feed/rss", //stuk
    "https://www.horecagroningen.nl/feed/",
    "http://www.hanzemag.nl/category/nieuws/feed/rss",
    "https://stadclickt.nl/feed/",
    "https://www.groningerondernemerscourant.nl/nieuws/rss",
    "https://groningenfietsstad.nl/nieuws/feed/",
    "https://www.sikkom.nl/feed/",
    "https://www.desmaakvanstad.nl/feed/",
    "https://3voor12.vpro.nl/rss/?generatorName=3voor12-lokaal-groningen", //stuk
    "http://www.stadmagazine.nl/1/feed",
    "https://os-groningen.nl/feed/",
    "http://www.focusgroningen.nl/feed/",
    "https://www.groningenspoorzone.nl/nieuws/rss",
    "http://datisgroningen.com/content/feed/", // weg
    "https://www.filtergroningen.nl/feed/",
    "https://groningerkrant.nl/stadsnieuws/feed/rss", //stuk soms
    "https://jouwstad.eu/feed/",
    "https://gemeente.groningen.nl/rss-news.xml",
    "https://campus.groningen.nl/nieuws/rss",
    "http://www.hetgonst.nl/wordpress/feed/",
    "https://popgroningen.nl/nieuws/rss" // stuk
);

// Lijst met bronnen zonder fouten
$urlBronnenGoed = array();
// Lijst met items
$bronNieuwsitems = array();

// Elke bron controleren op fouten 

$i = 0;
$j = 0;
$k = 0;
foreach($urlBronnen as $bron)
{
    $ch = curl_init();
    curl_setopt_array($ch, Array(
        CURLOPT_URL => $bron,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_USERAGENT => 'Brakdag'   
    ));
    
    if(curl_exec($ch) === false)
    {
        // Er gaat iets fout
        echo "\n\nFout voor ".$bron.": ".curl_error($ch)."\n";
//         $regel = "Iets fout gegaan: ".$bron;
//         error_log($regel, 1, "info@brakdag.nl", "From: info@brakdag.nl");
        $j++;        
    }
    else
    {
        $data = curl_exec($ch);
        $i++;   
        libxml_use_internal_errors(true);
        trim($data);
        rtrim($data);
        
        $data = verwijderRommelUitXml($data);
        
        $xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
        
        if ($xml === false) {
            foreach(libxml_get_errors() as $error) {
                echo "\t\n".$bron.": simplexml_load mislukt!\n";
                    $regel = "simplexml_load mislukt: ".$bron;
                break;
            }
        }
        else
        {
//            echo "\n".$bron.": simplexml_load succesvol!\n";
            
            $xml_item = $xml->channel->item;
            
            foreach($xml_item as $item)
            {
                $titel = htmlspecialchars(trim($item->title));
                $link = htmlspecialchars(trim($item->link));

                // Beschrijving strippen van HTML en tags
                $descriptionRuw     = $item->description;
                $descriptionRep     = str_replace("&#133;", " ", $descriptionRuw);
                $descriptionSchoon  = htmlspecialchars(strip_tags(html_entity_decode(trim($descriptionRep)))); 

                // Publicatiedatum omvormen tot timestamp
                $publicatie         = htmlspecialchars($item->pubDate);  
                list($dagNaam, $dag, $maand, $jaar, $tijd, $gmt) = explode(' ', $publicatie);     
                $pubdate            = strtotime("".$dagNaam." ".$dag." ".$maand." ".$jaar." ".$tijd."");  

                // Onderdelen in array duwen
                $perItem = array("titel"=>$titel, "descr"=>$descriptionSchoon,"link"=>$link,"pubdate"=>$pubdate);
                array_push($bronNieuwsitems, $perItem);
                
            }           
        }
    }
    $k++;    
}
curl_close($ch);

echo "\n\ncurl_exec: ".$k." (". $j . " fout, ". $i . " goed)\n\n";

$jaarGeleden = time() - 42140800;
$connect = mysqli_connect("brakdag.host", "brakdag.user", "brakdag.password", "brakdag.db_name");

$insertItem = "INSERT INTO nieuws_distinct (titel, descr, link, pubdate, gevondendate) VALUES (?, ?, ?, ?, ?)";
$stmt = $connect->prepare($insertItem);
$stmt->bind_param(sssii, $titel, $descr, $link, $timestamp, $timestampNu);

$checkBestaan = "SELECT nieuws_id FROM nieuws_distinct WHERE titel = ?";
$stmtBestaan = $connect->prepare($checkBestaan);
$stmtBestaan->bind_param(s, $titel);

foreach($bronNieuwsitems as $item)
{
        $titel = $item['titel']; 
        $link = $item['link'];
        $descr = $item['descr']; 
        if($item['pubdate'] < $jaarGeleden)
        {
            $timestamp = time() + 3600;
        }
        else
        {
            $timestamp = $item['pubdate']; 
        }   
        $timestampNu = time() + 3600; 
        
        $stmtBestaan->execute();
        $stmtBestaan->store_result();
        if($stmtBestaan->num_rows == 0)
        {
            $stmt->execute();   
        }

}
?>