<?PHP
header('Content-Type: application/rss+xml; charset=utf-8');

$connect = mysqli_connect("brakdag.host", "brakdag.user", "brakdag.password", "brakdag.db_name");

$selectNews = "SELECT n.nieuws_id, n.titel, n.descr, n.link, n.pubdate, n.gevondendate, n.clicks "
            . "FROM nieuws_distinct AS n "
            . "WHERE n.titel != '' "
            . "GROUP BY n.link "
            . "ORDER BY n.gevondendate DESC "
            . "LIMIT 0,40";
$result = $connect->query($selectNews);

$feed  = "<?xml version='1.0' encoding='UTF-8' ?>";
$feed .= "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom' xmlns:webfeeds='http://webfeeds.org/rss/1.0'>";
$feed .= "<channel>";
$feed .= "<title>Brakdag</title>";
$feed .= "<link>https://www.brakdag.nl</link>";
$feed .= "<description>Brakdag verzamelt nieuws uit Stad van allerlei internetbronnen.</description>";
$feed .= "<language>NL-nl</language>";
$feed .= "<image>";
$feed .= "<url>https://www.brakdag.nl/img/brakdag-logo.png</url>";
$feed .= "<title>Brakdag</title>";
$feed .= "<link>https://www.brakdag.nl</link>";
$feed .= "</image>";
$feed .= "<webfeeds:icon>https://brakdag.nl/img/brakdag-logo-svg.svg</webfeeds:icon>";
$feed .= "<webfeeds:logo>https://brakdag.nl/img/brakdag-logo-svg.svg</webfeeds:logo>";
$feed .= "<webfeeds:accentColor>16861a</webfeeds:accentColor>";
$feed .= "<atom:link href='https://brakdag.nl/rss/' rel='self' type='application/rss+xml'/>";

while ($row = $result->fetch_assoc()) {
    $link = $row['link'];
    $titel = $row['titel'];
    $descr = $row['descr'];
    $titelEncode = urlencode($titel);
    $timedate = date(DATE_RFC822, $row['pubdate']);
    
    $feed .= "<item>";
    $feed .= "<title>".$titel."</title>";
    $feed .= "<link>".$link."</link>";
    $feed .= "<description>".$descr."</description>";
    $feed .= "<pubDate>".$timedate."</pubDate>";
    $feed .= "</item>";
}

$feed .= "</channel>";
$feed .= "</rss>";

echo $feed;
?>