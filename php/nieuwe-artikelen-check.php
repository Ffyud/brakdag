<?PHP
$onderGrensTimestamp = strtotime("today midnight");
$bovenGrensTimestamp = $onderGrensTimestamp + 86400;

$connect = mysqli_connect("brakdag.host", "brakdag.user", "brakdag.password", "brakdag.db_name");

$selectNews = "SELECT n.nieuws_id,"
        . " n.titel,"
        . " n.descr,"
        . " n.link,"
        . " n.pubdate,"
        . " n.clicks"
        . " FROM nieuws_distinct AS n"
        . " WHERE n.pubdate < $bovenGrensTimestamp "
        . "AND n.pubdate > $onderGrensTimestamp "
        . "AND titel != '' "
        . "GROUP BY n.link "
        . "ORDER BY pubdate DESC";
$result = $connect->query($selectNews);
$aantalRijen = $result->num_rows;
echo $aantalRijen;

?>

