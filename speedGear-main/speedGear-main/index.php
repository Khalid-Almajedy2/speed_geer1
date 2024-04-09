<?php include("includes/lib.php"); ?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title>الرئيسية </title>
    <?php include("template/head.php"); ?>
    <style>
        .card_image img {
            width: 158px;
            height: 112px;
        }
    </style>
</head>

<body>


    <?php include("template/navbar.php"); ?>
    <br>

    <!-- الخلفية-->
    <section class="hero" id="الرئيسية">
        <div class="hero-section">
            <div class="content">
                <h4>تســوّق بـأمـــان, تســوّق بسـرعـــة !</h4>
                <h1>
                    إكتشف قطع غيار لسيارتك بأفضل الأسعـار ووفّـر الجهد والوقت ...
                </h1>
                <p>
                    <b>سبيد جير</b> هو موقع لشراء قطع الغيار ..
                    <span>جودة وسرعة وأمان</span>
                    أثناء تسوقك
                </p>
            </div>

            <div class="hero-image">
                <img src="/imegs/الخلفيه.jpeg">
            </div>
        </div>
    </section>
    <!-- نهاية الخلفية -->
    <!--جملة اختر شركة سيارتك   -->
    <div class="titlee">
        <h1><b> إخـتـر شـركـة سيـارتــك :</h1>
    </div>
    <br>
    <br>
    <!--صور الشركات-->
    <div class="cards-list">

        <?php

        $all = select("SELECT Id, Name, img FROM Company");

        foreach ($all as $row) { ?>

            <div class="card">
                <div class="card_image">
                    <a href="car-kinds.php?company_id=<?php echo $row['Id']; ?>">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['img']); ?>" width="158px" height="112px">
                    </a>
                </div>
                <div class="card_title">
                    <p><?php echo $row['Name']; ?></p>
                </div>
            </div>

        <?php        } ?>

        <br>

    </div>
    <?php include('template/end_of_project.php'); ?>
</body>

</html>