<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
// URL aanpassen als naam map verandert
include("$root/php/brakdag-functions.php");

$term = filter_input(INPUT_POST, "zoekterm");

$connect = mysqli_connect("brakdag.host", "brakdag.user", "brakdag.password", "brakdag.db_name");

$term = mysqli_real_escape_string($connect, $term);
$selectNews = "SELECT n.nieuws_id, n.titel, n.descr, n.link, n.pubdate "
            . "FROM nieuws_distinct AS n "
            . "WHERE MATCH(n.titel, n.descr) AGAINST('".addslashes($term)."' IN BOOLEAN MODE) "
            . "GROUP BY n.titel "
            . "ORDER BY n.pubdate DESC "
            . "LIMIT 250";
$result = $connect->query($selectNews);
echo "<div class='container-item'>";

echo "<p>".stripslashes($term)."</p>";
if($result->num_rows == 1)
{
    echo "<span>Er is ".$result->num_rows. " zoekresultaat gevonden.";
    echo "<br><i class='fa fa-info-circle'></i> Vind meer variaties van woorden met een asterisk, zoals student*.";
    echo "</span>";
}
elseif($result->num_rows >= 250)
{
    echo "<span>Er zijn meer dan 250 artikelen gevonden. <br><i class='fa fa-info-circle'></i> Met specifiekere woorden vind je betere resultaten.";
    if (strpos($term, ' ') > 0 && preg_match('/"/', $term) == 0)
    {
        echo "<br><i class='fa fa-info-circle'></i> Woorden kan je combineren met aanhalingstekens, zoals \"Grote Markt\".";
    }
    echo "</span>";
}
else
{   
    echo "<span>";
        echo "Er zijn ".$result->num_rows. " zoekresultaten gevonden.";
        if (strpos($term, ' ') > 0 && preg_match('/"/', $term) == 0)
        {
            echo "<br><i class='fa fa-info-circle'></i> Woorden kan je combineren met aanhalingstekens, zoals \"Grote Markt\".";
        }
        if($result->num_rows <= 10)
        {
            echo "<br><i class='fa fa-info-circle'></i> Vind meer variaties van woorden met een asterisk, zoals student*.";
        }
    echo "</span>";
}
    echo "<ul class='items'>";
$jaarArray = array();        
        while($row = $result->fetch_assoc())
        {
            $link = $row['link'];
            $timestamp = $row['pubdate'];
            $titel = $row['titel'];
            $descr = $row['descr'];
            $titelEncode = urlencode($titel);
            
            $jaar = date("Y", $timestamp);
            if(!in_array($jaar, $jaarArray))
            {
                echo "<div class='mid-item'><a>".$jaar."</a></div>";
                array_push($jaarArray, $jaar);
            }

            echo "<li class='item' id='".$row['nieuws_id']."'>";
                echo "<ul>";
                    echo "<li>";
                        echo "<img alt='". hostVanLink($link)."' src='img/" . favicon($link) . "'>";
                    echo "</li>";
                    echo "<li>";
                        echo "<a class='item-titel' href='" . $link . "' rel='noopener noreferrer' target='_blank'>";
                        echo "".$titel."";
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
