<?php include("includes/lib.php"); ?>
<?php
$company_id = null;
$car_id = null;
$title = "الاقسام الاساسيه لقطع السيارة ";
if (isset($_GET['company_id'])) {
    $company_id = $_GET['company_id'];
}
if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];
    $cars = select("SELECT Id, Name FROM CARS WHERE Id= $car_id");
    $title = "الاقسام الاساسيه لقطع " . $cars[0]["Name"];
} else {
    $cars = select("SELECT Id, Name FROM CARS");
}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title> <?php echo $title; ?> </title>
    <?php include("template/head.php"); ?>
</head>

<body>

    <?php include("template/navbar.php"); ?>
    <!--نهاية الهيدر-->
    <div class="titlee">
        <?php
        if (!is_null($car_id)) {
            $row = $cars[0];
            echo "<h1><b>  :فـئـه " . $row['Name'] . "</h1>";
        } else {
            echo "<h1><b>  كل الفئات  : </h1>";
        }
        ?>

    </div>




    <br>
    <br>



    <!--صور القطع العامة-->
    <div class="cards-list">

        <?php
        $all = select("SELECT Id, Name, img FROM SECTIONS");
        foreach ($all as $row) { ?>

            <div class="card">
                <div class="card_image">
                    <a href="pises.php?company_id=<?php echo $company_id; ?>&car_id=<?php echo $car_id; ?>&section_id=<?php echo $row['Id']; ?>">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['img']); ?>" width="170px" height="120px">
                    </a>
                </div>
                <div class="card_title">
                    <p><?php echo $row['Name']; ?></p>
                </div>
            </div>

        <?php } ?>

        <br>

    </div>
    <!-- بداية الفوتر -->
    <?php include('template/end_of_project.php'); ?>
    <!-- نهاية الفوتر -->
</body>

</html>