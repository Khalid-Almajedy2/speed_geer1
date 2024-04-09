<?php include("includes/lib.php"); ?>
<?php
$company_id = null;
$car_id = null;
$section_id = null;
$title = "";
$id_pieces= null;

if (isset($_GET['company_id'])) {
    $company_id = $_GET['company_id'];
}
if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];
    $cars = select("SELECT Id, Name FROM CARS WHERE Id= $car_id");
    $title .=  $cars[0]["Name"];
} else {
    $cars = select("SELECT Id, Name FROM CARS");
}
if (isset($_GET['section_id'])) {
    $section_id = $_GET['section_id'];
    $sections = select("SELECT Id, Name FROM SECTIONS WHERE Id=$section_id");
    $title .= " - " . $sections[0]["Name"];
} else {
    $sections = select("SELECT Id, Name FROM CARS");
}

$modelsQuery = "SELECT MIN(modelFrom) as low, MAX(modelTo) as heigh FROM PIECES where condition =1 ";
// $all = select("SELECT id_pieces, namePie, img,sellprice FROM PIECES where condition =1");
$query = "SELECT PIECES.piecesNum, PIECES.quality FROM PIECES where condition =1 ";
// foreach($query){
//     $piess="SELECT * FROM PIECES WHERE condition=1";
// }
if (!is_null($company_id)) {
    $query .= " AND id_company=$company_id";
    $modelsQuery .= " AND id_company=$company_id";
}
if (!is_null($car_id)) {
    $query .= " AND id_car=$car_id";
    $modelsQuery .= " AND id_car=$car_id";
}
if (!is_null($section_id)) {
    $query .= " AND id_section=$section_id";
    $modelsQuery .= " AND id_section=$section_id";
}


$query .= "  group by  PIECES.quality ,PIECES.piecesNum";



$all = select($query);
$minAndMax = select($modelsQuery);

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title> <?php echo $title; ?> </title>
    <?php include("template/head.php"); ?>
    <link rel="stylesheet" href="assets/css/pises.css">
</head>
<style>
    .ribbon{
    width: 60px;
    font-size: 14px;
    padding: 4px;
    position: absolute;
    right: -25px;
    top: -12px;
    text-align: center;
    border-radius:25px ;
    transform: rotate(20deg);
    background-color: orangered;
    color: white;
}
</style>

<body>

    <?php include("template/navbar.php"); ?>
    <input type="radio" name="photos" id="check1" checked>
    <?php
    if (!is_null($id_pieces)) {

        $modelsQuery = "SELECT MIN(modelFrom) as low, MAX(modelTo) as heigh FROM PIECES where condition =1 ";
        $minAndMax = select($modelsQuery);}
    $c = 1;
    for ($i = $minAndMax[0]['low']; $i <= $minAndMax[0]['heigh']; $i++) {
    ?>
        <input type="radio" name="photos" id="check<?php echo ++$c; ?>">
    <?php } ?>

    <div class="titlee">
    </div>
    <div class="container2">
        <?php
        if (!is_null($section_id)) {
            $row = $sections[0];
            echo "<h1><b> قسم - " . $row['Name'] . "</h1>";
        } else {
            // echo "<h1><b>  كل الفئات  : </h1>";
        }
        ?>



        <!--
        <a href="parts1.html">أخطأت في تحديد نوع القطعه الخاصه بك ؟ </a>
        -->
        <div class="top-content">

            <h4>إختر موديل سيارتك : </h4>
            <label for="check1"> كل الموديلات </label>

            <?php
              if (!is_null($id_pieces)) {

        $modelsQuery = "SELECT MIN(modelFrom) as low, MAX(modelTo) as heigh FROM PIECES where condition =1 ";
        $minAndMax = select($modelsQuery);}
            $c = 1;
            for ($i = $minAndMax[0]['low']; $i <= $minAndMax[0]['heigh']; $i++) {
            ?>
                <label for="check<?php echo ++$c; ?>"> <?php echo $i; ?></label>
            <?php } ?>


        </div>

        <div class="photo-gallery">
            <?php

            foreach ($all as $row) { 
                
                $query = "SELECT TOP 1 * FROM PIECES where condition =1 AND PIECES.piecesNum   = $row[piecesNum] AND PIECES.quality ='$row[quality]'";
                
        
               
                $data = select($query);
                ?>
                <a href="Sp_parts.php?id_pieces=<?php echo $data[0]['id_pieces']; ?> "  target="_blank">
               
 
                    <div class="pic b">
                        
                        <img src="data:image/jpeg;base64,<?php echo base64_encode( $data[0]['img']); ?>" alt="">
                        <span class='ribbon'><?php echo  $data[0]['quality']; ?></span>

                        <h3 class="title"> <?php echo  $data[0]['namePie']; ?> </h3>
                        <span class="post"> <?php echo  $data[0]['sellprice'] ."  R.Y "; ?> </span>
                    </div>
                </a>

            <?php  } ?>
            <?php foreach ($all as $row) {
                continue; ?>

                <div class="pic a">
                    <div class="card">
                        <div class="card_image">
                            <a href="pises.php?id=<?php echo $row['piecesNum']; ?>">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['img']); ?>" width="170px" height="200px">
                            </a>
                        </div>
                        <div class="card_title">
                            <h3 class="title">
                                <p><?php echo $row['namePie']; ?></p>
                            </h3>
                        </div>

                        <span class="post">
                            <p><?php echo $row['sellprice'] . "R.Y"; ?></p>
                        </span>
                        <input type="buttom" href="">

                    </div>


                </div>
            <?php  } ?>
        </div>
    </div><br><br>
    <?php include('template/end_of_project.php'); ?>
</body>

</html>