<?php
header("Refresh:15");

?>
<?php

foreach($viewmodel as $row)
{
    ?>

    <div style="margin: 0 auto; width: 420px; border:1px solid grey; padding: 5px; float: left;" id="podaci">
        <?php echo $row['Eminent'] . "|" . $row['Simbol'] . " | <p>Cena_max</p>" . $row['Cena_max'] . " | <p>Cena_min</p> " . $row['Cena_min']; ?>
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