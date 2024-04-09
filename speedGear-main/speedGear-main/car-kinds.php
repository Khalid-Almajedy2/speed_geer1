<?php include("includes/lib.php"); ?>
<?php
    $company_id = null;
    if (isset($_GET['company_id'])) {
        $company_id = $_GET['company_id'];
        $all = select("SELECT Id, Name FROM COMPANY WHERE Id= $company_id");
    } else {
        $all = select("SELECT Id, Name FROM COMPANY");
    }
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <?php include("template/head.php"); ?>
    <title>انواع <?php echo $all[0]["Name"]; ?> </title>
</head>

<body>
    <?php include("template/navbar.php"); ?>

    
    <!--جملة اختر نوع سيارتك   -->
    <div class="titlee">
        <?php
        if (!is_null($company_id)) {
            echo "<h1><b>  :فـئـه "  . $all[0]['Name'] . "</h1>";
        } else {
            echo "<h1><b>  كل الفئات  : </h1>";
        }
        ?>

    </div>
    <br>
    <br>
    <!--بداية صور انواع السيارات-->
    <div class="cars-img">
        <?php
        if (!is_null($company_id)) {
            $cars = select("SELECT Id, Name, img FROM CARS WHERE id_company= $company_id");
        }
        else{
            $cars = select("SELECT Id, Name, img FROM CARS");
        }
        
        foreach ($cars as $row ) { ?>

            <div class="card">
                <div class="card_image">
                    <a href="parts.php?company_id=<?php echo $company_id; ?>&car_id=<?php echo $row['Id']; ?>">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['img']); ?>" width="158px" height="112px">
                    </a>
                </div>
                <div class="card_title">
                    <p><?php echo $row['Name']; ?></p>
                </div>
            </div>

        <?php } ?>


    </div>
    <!--نهاية صور انواع السيارات-->