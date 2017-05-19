<?php

foreach($viewmodel as $row)
{

?>

    <div style="margin: 0 auto;  border:1px solid grey; padding: 2px; float: left;" id="podaci">
        <?php echo $row['Eminent'] . "|" . $row['Simbol'] . " | Promet:" . $row['Promet'];
        echo " | Vrsta_hartije: " . $row['Vrsta_hartije'] . " | Cena_otvaranja: ";
        echo  $row['Cena_otvaranja'] . " | |  Cena_zatvaranja:  " . $row['Cena_zatvaranja'];
        echo " | Cena_max: " . $row['Cena_max'] . " | Cena_min:  " . $row['Cena_min']; ?>
        <br>
        <hr>
<?php

        if (isset($_SESSION['is_logged_in']))
        {
            if (($_SESSION['user_data']['status'] == 3))
            {
                echo "<a href=''><button>Detalji</button></a>";
            }
        }
?>
    </div>

<?php

}
?>