<!doctype html>
<html lang="en">
<?php require_once("header.php"); ?>

  <body>
    
     <form name="form" action="" method="post">
            <div class="mb-2">
                <label for="km" class="form-label">Szacowana liczba kilometrów do przejechania</label>
                <input type="number" class="form-control" name="km" placeholder="0km">
            </div>
            <div class="mb-2">
                <label for="prawo" class="form-label">Rok uzyskania prawa jazdy</label>
                <input type="number" class="form-control" name="prawo" ></input>
            </div>
            <div class="mb-1">
                <label for="daty" class="form-label">Od</label>
                <input type="date" class="form-control" name="od" ></input>
                <label for="daty" class="form-label">Do</label>
                <input type="date" class="form-control" name="do" ></input>
            </div>
            <input  type="submit" name="Zatwierdź" class="btn btn-primary" value="Zatwierdź"></input>
            <input  type="submit" name="Anuluj" class="btn btn-danger" value="Anuluj"></input><br><br>
            <?php

            if(isset($_POST["Zatwierdź"])){
                if (isset($_POST['km'])) {
                    $km = $_POST['km'];
                }
                if (isset($_POST['prawo'])) {
                    $prawo = $_POST['prawo'];
                }
                if (isset($_POST['od'])) {
                    $od = $_POST['od'];
                }
                if (isset($_POST['do'])) {
                    $do = $_POST['do'];
                }
                $cena = 0;
                $dni = abs(round((strtotime($od) - strtotime($do))/86400));
                $cena = $dni * $bazcen;
                if($katsam == "Standard"){
                    $cena *= 1.3;
                }
                elseif($katsam == "Medium"){
                    $cena *= 1.6;
                }
                elseif($katsam == "Premium"){
                    $cena *= 2;
                }
                $date = date("Y");
                if ($date-$prawo<=5){
                    $cena *= 1.2;
                }
                if ($date-$prawo<3 && $katsam == "Premium"){
                    echo '<script>alert("Nie można wypożyczyć samochodu")</script>';
                }
                if($ilomod<3){
                    $cena *= 1.15;
                }
                    $cena = $cena + (($cenpal*$śrespal)*($km/100));
                ?>
               Cena netto:  <input type="text" name="txt" value="<?php
                 echo round($cena, 2);
                ?>" disabled>
                Cena brutto:  <input type="text" name="txt" value="<?php
                 echo round($cena*1.23, 2);
                ?>" disabled> <br><br>
                <?php
                echo "W tym cena paliwa: " . (($cenpal*$śrespal)*($km/100)) . "zł" . "<br>";
                echo "Wynajem na " . $dni . " dni: " . $dni * $bazcen . "zł" .  "<br>";
                echo "Cena za dzień wypożyczenia wynosi: " . $bazcen . "zł" .  "<br>";  
                if ($date-$prawo<=5){
                    echo "Informujemy także że z powodu posiadania prawa jazdy nie dłużej niż 5 lat rachunek został podniesiony o 20%".  "<br>";
                }          
                if($ilomod<3){
                    echo "Informujemy także że z powodu małej ilości wybranych modeli rachunek został podniesiony o 15%".  "<br>";
                }
            }
            
            ?>
    </form>

  </body>
  
</html>