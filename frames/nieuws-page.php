<?PHP

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
// URL aanpassen als naam map verandert
include("$root/php/brakdag-functions.php");

if (!empty($_POST['dateRange'])) {
    $onderGrensTimestamp = filter_input(INPUT_POST, "dateRange") - 3600;
    $bovenGrensTimestamp = $onderGrensTimestamp + 86400;
    $humanDate = filter_input(INPUT_POST, "humanDate");
}
else
{
    $onderGrensTimestamp = strtotime("today midnight");
    $bovenGrensTimestamp = time() + 7200;
    
    $humanDate = date("j F Y", time() + 7200);
}

$connect = mysqli_connect("brakdag.host", "brakdag.user", "brakdag.password", "brakdag.db_name");

$selectNews = "SELECT n.nieuws_id, n.titel, n.descr, n.link, n.pubdate, n.gevondendate, n.clicks FROM nieuws_distinct AS n WHERE n.pubdate < $bovenGrensTimestamp AND n.pubdate > $onderGrensTimestamp AND titel != '' GROUP BY n.link ORDER BY gevondendate DESC";
$result = $connect->query($selectNews);

$selectNewsClicks   = "SELECT COUNT(nc.artikel_id) as ci, nd.nieuws_id, nd.titel, nd.descr, nd.link, nd.pubdate "
                    . "FROM nieuws_clicks AS nc "
                    . "JOIN nieuws_distinct AS nd " 
                    . "ON nd.nieuws_id = nc.artikel_id "
                    . "WHERE nd.pubdate < ".$bovenGrensTimestamp." "
                    . "AND nd.pubdate > ".$onderGrensTimestamp." "
                    . "GROUP BY nc.artikel_id "
                    . "ORDER BY COUNT(nc.artikel_id) DESC "
                    . "LIMIT 0,5";
$resultClicks = $connect->query($selectNewsClicks);

if($resultClicks->num_rows >= 1 && $result->num_rows >= 25)
{
    echo "<div class='wrap-top-banner'>";
        echo "<div class='container-item'>";
            echo "<ul class='items top-read'>";
                echo "<div class='mid-item'><a>Noemenswaardig</a></div>";
            $i = 0;
            $y = 0;
            $x = 0;
            while ($row = $resultClicks->fetch_assoc()) {
                $link = $row['link'];
                $titel = $row['titel'];
                $descr = $row['descr'];
                $clicks = $row['ci'];
                $titelEncode = urlencode($titel);
                $timestamp = $row['pubdate'];
                $tijdstip = date("G", $timestamp);  
                $dag = date("j", $timestamp);
                $nu = date("G");
                $dagNu = date("j");

                echo "<li class='item cr' data-popi='".$clicks."' id='" . $row['nieuws_id'] . "'>";
                    echo "<ul>";
                        echo "<li>";
                            echo "<img alt='". hostVanLink($link)."' src='img/" . favicon($link) . "'>";
                        echo "</li>";
                        echo "<li>";
                            echo "<a class='item-titel' href='" . $link . "' rel='noopener noreferrer' target='_blank'>";
                            echo "" . $titel . "";
                            echo "</a>";
                            echo "<span id='" . $row['nieuws_id'] . "' class='descr'>";
                                echo maakDescrGereed($descr);
                                echo "<div class='descr-buttons'>";
                                    echo " <a class='descr-link social telegram' href='https://telegram.me/share/url?url=".$link."&text=Gevonden%20via%20https%3A%2F%2Fbrakdag%2Enl'><i class='fa fa-telegram'></i></a>";
                                    echo " <a class='descr-link social whatsapp' href='whatsapp://send?text=".$link."%20Gevonden%20via%20https%3A%2F%2Fbrakdag%2Enl' data-action='share/whatsapp/share'><i class='fa fa-whatsapp'></i></a>";
                                    echo " <a class='descr-link social facebook' href='https://www.facebook.com/sharer/sharer.php?u=".$link."'><i class='fa fa-facebook-official'></i></a>";
                                    echo " <a class='descr-link social twitter' href='https://twitter.com/intent/tweet?text=".$titelEncode."%20".$link."'><i class='fa fa-twitter'></i></a>";
                                    echo " <a class='descr-link social reddit' href='https://www.reddit.com/submit?url=".$link."&title=".$titelEncode."'><i class='fa fa-reddit'></i></a>";
                                    echo " <a class='descr-link social linkedin' href='https://www.linkedin.com/shareArticle?mini=true&url=".$link."&title=".$titelEncode."'><i class='fa fa-linkedin-square'></i></a>";
                                echo "</div>";
                            echo "</span>";
                        echo "</li>";
                        echo "<li id='" . $row['nieuws_id'] . "' class='bron'>";
                            echo "<i class='fa fa-chevron-down'></i>";
                        echo "</li>";
                    echo "</ul>";
                echo "</li>";
            }
            echo "</ul>";
        echo "</div>";
    echo "</div>";
}

echo "<div class='container-item' id='allesContainer'>";
    if($result->num_rows == 0)
    {
        include("nog-geen-nieuws.php");
    }

echo "<ul class='items' id='allesUl'>";

$i = 0;
$y = 0;
$x = 0;
$titelsArray = array();
while ($row = $result->fetch_assoc()) {
    $clicks = $row['clicks'];
    $link = $row['link'];
    $id = $row['nieuws_id'];
    $titel = $row['titel'];
    $descr = $row['descr'];
    $titelEncode = urlencode($titel);
    $timestamp = $row['pubdate'];
    $gevonden = $row['gevondendate'];
    $tijdstip = date("G", $gevonden);  
    $dag = date("j", $gevonden);
    $nu = date("G");
    $dagNu = date("j");
    
        if(($tijdstip > "18" && $tijdstip <= "23") && $y === 0)
        {
            echo "<div class='mid-item'><a>Avond</a></div>";
            $y++;
        }
        elseif(($tijdstip > "11" && $tijdstip <= "18") && $i === 0)
        {
            echo "<div class='mid-item'><a>Middag</a></div>";
            $i++;
        }
        elseif(($tijdstip > "4" && $tijdstip <= "11") && $x === 0)
        {
            echo "<div class='mid-item'><a>Ochtend</a></div>";
            $x++;
        }
        
    
    echo "<li class='item cr' data-bron='".hostVanLink($link)."' data-popi='".$clicks."' id='" . $row['nieuws_id'] . "'>";
        if(labelNieuw($gevonden) == true)
        {
            echo "<span title='Nieuw' class='item-nieuw-tag'><i class='fa fa-circle'></i></span>";
        }
        echo "<ul>";
            echo "<li>";
                echo "<img alt='". hostVanLink($link)."' src='img/" . favicon($link) . "'>";
            echo "</li>";
            echo "<li>";
                echo "<a class='item-titel' href='" . $link . "' rel='noopener noreferrer' target='_blank'>";
                echo "" . $titel . "";
                echo "</a>";
                echo "<span id='" . $row['nieuws_id'] . "' class='descr'>";
                    echo maakDescrGereed($descr);
                        echo "<div class='descr-buttons'>";
                            echo " <a class='descr-link social telegram' href='https://telegram.me/share/url?url=".$link."&text=Gevonden%20via%20https%3A%2F%2Fbrakdag%2Enl'><i class='fa fa-telegram'></i></a>";
                            echo " <a class='descr-link social whatsapp' href='whatsapp://send?text=".$link."%20Gevonden%20via%20https%3A%2F%2Fbrakdag%2Enl' data-action='share/whatsapp/share'><i class='fa fa-whatsapp'></i></a>";
                            echo " <a class='descr-link social facebook' href='https://www.facebook.com/sharer/sharer.php?u=".$link."'><i class='fa fa-facebook-official'></i></a>";
                            echo " <a class='descr-link social twitter' href='https://twitter.com/intent/tweet?text=".$titelEncode."%20".$link."'><i class='fa fa-twitter'></i></a>";
                            echo " <a class='descr-link social reddit' href='https://www.reddit.com/submit?url=".$link."&title=".$titelEncode."'><i class='fa fa-reddit'></i></a>";
                            echo " <a class='descr-link social linkedin' href='https://www.linkedin.com/shareArticle?mini=true&url=".$link."&title=".$titelEncode."'><i class='fa fa-linkedin-square'></i></a>";
                        echo "</div>";
                echo "</span>";
            echo "</li>";
            echo "<li id='" . $row['nieuws_id'] . "' class='bron'>";
                echo "<i class='fa fa-chevron-down'></i>";
            echo "</li>";
        echo "</ul>";
    echo "</li>";
}
echo "</ul>";
echo "</div>";

mysqli_close($connect);
?>
         