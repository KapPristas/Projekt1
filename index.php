<!doctype html>
<html lang="pl">
<?php require_once("header.php"); ?>

  <body>
    
     <form name="form" action="" method="post">
            <div class="mb-2">
                <label for="km" class="form-label">Szacowana liczba kilometrów do przejechania</label>
                <input type="number" class="form-control" name="km" placeholder="0km">
            </div>
            <div class="mb-2">
                <label for="prawo" class="form-label">Rok uzyskania prawa jazdy</label>
                <input type="number" class="form-control" name="license" >
            </div>
            <div class="mb-1">
                <label for="daty" class="form-label">Od</label>
                <input type="date" class="form-control" name="from" >
                <label for="daty" class="form-label">Do</label>
                <input type="date" class="form-control" name="to" >
            </div>
            <input  type="submit" name="Confirm" class="btn btn-primary" value="Confirm">
            <input  type="submit" name="Anuluj" class="btn btn-danger" value="Anuluj"><br><br>
            <?php

            if(isset($_POST["Confirm"])){
                if (isset($_POST['km'])) {
                    $km = $_POST['km'];
                }
                if (isset($_POST['license'])) {
                    $license = $_POST['license'];
                }
                if (isset($_POST['from'])) {
                    $from = $_POST['from'];
                }
                if (isset($_POST['to'])) {
                    $to = $_POST['to'];
                }
                $price = 0;
                $days = abs(round((strtotime($from) - strtotime($to))/86400));
                $price = $days * $baseCost;
                if($carCategory == "Standard"){
                    $price *= 1.3;
                }
                elseif($carCategory == "Medium"){
                    $price *= 1.6;
                }
                elseif($carCategory == "Premium"){
                    $price *= 2;
                }
                $date = date("Y");
                if ($date-$license<=5){
                    $price *= 1.2;
                }
                if ($date-$license<3 && $carCategory == "Premium"){
                    echo '<script>alert("Nie można wypożyczyć samochodu, kategoria Premium dostępna tylko dla klientów posiadających prawo jazdy dłużej niż 3 lata.")</script>';
                }
                if($modelsQuantity<3){
                    $price *= 1.15;
                }
                    $price = $price + (($petrolCost*$averagePetrolUsage)*($km/100));
                ?>
               Cena netto:  <input type="text" name="txt" value="<?php
                 echo round($price, 2);
                ?>" disabled>
                Cena brutto:  <input type="text" name="txt" value="<?php
                 echo round($price*1.23, 2);
                ?>" disabled> <br><br>
                <?php
                echo "W tym cena paliwa: " . (($petrolCost*$averagePetrolUsage)*($km/100)) . "zł" . "<br>";
                echo "Wynajem na " . $days . " dni: " . $days * $baseCost . "zł" .  "<br>";
                echo "Cena za dzień wypożyczenia wynosi: " . $baseCost . "zł" .  "<br>";  
                if ($date-$license<=5){
                    echo "Informujemy także że z powodu posiadania prawa jazdy nie dłużej niż 5 lat rachunek został podniesiony o 20%".  "<br>";
                }          
                if($modelsQuantity<3){
                    echo "Informujemy także że z powodu małej ilości wybranych modeli rachunek został podniesiony o 15%".  "<br>";
                }
            }
            
            ?>
    </form>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</html>