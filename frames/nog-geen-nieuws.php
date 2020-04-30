<?PHP
    echo "<div class='nacht'>";
        date_default_timezone_set('Europe/Amsterdam');
        $huidigeUur = date("G");
        if(($huidigeUur >= 0) && ($huidigeUur < 4)) {
            echo "<p>Goedenacht</p>";
        }
        else
        {
            echo "<p>Goedemorgen</p>";
        }
        echo "<span>";
            echo "Het is nog vroeg en daarom is er nog geen nieuws gevonden vandaag.";
        echo "</span>";
    echo "</div>";
?>