<?php
header('Content-Type: text/xml; charset=utf-8', true);
$xml = new DOMDocument("1.0", "UTF-8");
//create "RSS" element
$rss = $xml->createElement("rss"); 
$rss_node = $xml->appendChild($rss);
$rss_node->setAttribute("version","2.0");

$rss_node->setAttribute("xmlns:dc","http://purl.org/dc/elements/1.1/");
$rss_node->setAttribute("xmlns:content","http://purl.org/rss/1.0/modules/content/");
$rss_node->setAttribute("xmlns:atom","http://www.w3.org/2005/Atom");

$date_f = date("D, d M Y H:i:s T", time());
$build_date = gmdate(DATE_RFC2822, strtotime($date_f));

$channel = $xml->createElement("channel");  
$channel_node = $rss_node->appendChild($channel);

$channel_atom_link = $xml->createElement("atom:link");  
$channel_atom_link->setAttribute("href","http://brakdag.nl/news-mock");
$channel_atom_link->setAttribute("rel","self");
$channel_atom_link->setAttribute("type","application/rss+xml");
$channel_node->appendChild($channel_atom_link); 

$channel_node->appendChild($xml->createElement("title", "Brakdag News Mock"));
$channel_node->appendChild($xml->createElement("description", "Mock om Brakdag nieuws opslag te testen."));
$channel_node->appendChild($xml->createElement("link", "http://brakdag.nl")); 
$channel_node->appendChild($xml->createElement("language", "en-us"));
$channel_node->appendChild($xml->createElement("lastBuildDate", $build_date));
$channel_node->appendChild($xml->createElement("generator", "PHP DOMDocument"));


$article = array(
    //array(id, title, content, published)
    array(1, "Test item 1", "bladiebladieb bladie bla", rand(1262055681,1262055681)),
    array(2, "Test item 2", "blablabla bblblbal bla", rand(1262055681,1262055681)),
    array(3, "Test item 3 met 'gekke' tekens\"", "blablabla `\"bblblbal\" bla", rand(1262055681,1262055681)),
    array(4, "Test item 4 metk kleiner dan tekens\"<", "blablabla `\"bblblbal\" bla<", rand(1262055681,1262055681)),
    array(5, "Test item 3 met 'gekke' tekens\"", "blablabla `\"bblblbal\" bla<", rand(1262055681,1262055681)),
    array(6, "Test item 3 met 'gekke' tekens\"", "blablabla `\"bblblbal\" bla<", rand(1262055681,1262055681))
);
foreach($article as $inner => $value) {
    $id         = $value[0];
    $title      = $value[1];
    $content    = $value[2];
    $timestamp  = $value[3];
        
    $item_node = $channel_node->appendChild($xml->createElement("item"));
    $title_node = $item_node->appendChild($xml->createElement("title", $title));
    $link_node = $item_node->appendChild($xml->createElement("link", "http://een-website-link.gaat/hier/"));

    //Unique identifier for the item (GUID)
    $guid_link = $xml->createElement("guid", "http://een-website-link.gaat/hier/". $id);  
    $guid_link->setAttribute("isPermaLink","false");
    $guid_node = $item_node->appendChild($guid_link); 

    //create "description" node under "item"
    $description_node = $item_node->appendChild($xml->createElement("description"));  

    //fill description node with CDATA content
    $description_contents = $xml->createCDATASection(htmlentities($content));  
    $description_node->appendChild($description_contents); 

    //Published date
    $date_rfc = gmdate(DATE_RFC2822, strtotime($timestamp));
    $pub_date = $xml->createElement("pubDate", $date_rfc);  
    $pub_date_node = $item_node->appendChild($pub_date);
}


echo $xml->saveXML();

?>