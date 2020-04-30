<?php
$artikel = filter_input(INPUT_POST, "clicks");
$connect = mysqli_connect("brakdag.host", "brakdag.user", "brakdag.password", "brakdag.db_name");

//$insertMail = "UPDATE nieuws_distinct SET clicks=clicks+1 WHERE nieuws_id = $artikel";
//$query = $connect->query($insertMail);  

$ip = $_SERVER['REMOTE_ADDR'];
$timestamp = time();
$artikel_id = $artikel;
$user_agent = $_SERVER['HTTP_USER_AGENT'];

$insertClick = "INSERT INTO nieuws_clicks (ip_adres, timestamp, artikel_id, user_agent) "
            . "VALUES ('".$ip."', '".$timestamp."', '".$artikel_id."', '".$user_agent."')";
$query = $connect->query($insertClick); 
?>

