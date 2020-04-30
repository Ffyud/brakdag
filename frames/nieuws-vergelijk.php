<?PHP
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    include("$root/php/brakdag-functions.php");
    
    $selectTitels = "";
    $alleTitels = array(); // Alle titels die vergeleken gaan worden
    
    $titel = "Meer hotelovernachtingen in Groningen";
    $restVanDeTitels = array(12331 => "Groei aantal hotelgasten in Groningen blijft achter",
                             11122 => "Aantal hotelovernachtingen in Groningen groeit",
                             22222 => "Asbest aangetroffen na brand in casino Groningen",
                             33333 => "Asbesthoudend materiaal aantroffen bij bluswerkzaamheden Holland Casino");

    echo $titel." vergeleken met: <br>";
    foreach($restVanDeTitels as $andereTitel) {
        
        $percentage = controleerOverlap($titel, $andereTitel);
        if($percentage >= 55) {
            echo "Veel gelijkenis van <b>".$andereTitel. "</b> ";
        }
        else {
            echo "Weinig gelijkenis met <b>".$andereTitel. "</b> ";
        }
        echo $percentage;
        echo "<br>";
    } 
  
?>