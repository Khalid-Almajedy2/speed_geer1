<?php include("includes/lib.php"); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<?php include("template/head.php"); ?>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <!--مكتبة ايقونات-->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> -->
    <!-- css ربط مع صفحة -->
    <!-- <link rel="stylesheet" href="comp.css"> -->
    <title>الرئيسية </title>
    <!--مكتبة خطوط-->
<!-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet"> -->
<style>
    .card_image img {
        width : 158px;
        height : 112px;
    }
    .kk{
            text-decoration:none;
            color: white ;
    }
    .log{
        text-decoration:none;
            color: white ;
    }
</style>
<!--مكتبة خطوط-->
</head>
<body>
    
    <!--يمين الهيدر-->
    <section class="container">
    <main class="navbar">
    <div class="logo">
        <a href="#الرئيسية">
        <img src="./imegs/شعار المشروع.png" alt="speed geer" ></a>
    </div>
    <!--وسط الهيدر-->
    <div class="list">

    <a href="#الرئيسية">الرئيسية </a>
    <a href="#">مشترياتي</a>
    <a href="#">سياسة الاسترجاع</a>
    <a href="#تواصل بنا">تواصل بنا</a>
</div>
<!--يسار الهيدر-->
<div class="left">
    <span class="material-symbols-outlined"><a class="kk" href="shopping_cart.php">shopping_cart</a></span>
    <select class="select">
        <option>العربية</option>
        <option>الإنجليزية</option>
    </select>
    <button><a class="log" href="create account.php">تسجيل دخول </a></button>
</div>
</main>
</section>
    <!--نهاية الهيدر-->
    <!-- الخلفية-->
    <section class="hero" id="الرئيسية">
        <div class="hero-section">
          <div class="content">
            <h4>تســوّق بـأمـــان, تســوّق بسـرعـــة  !</h4>
            <h1>
                إكتشف قطع غيار لسيارتك بأفضل الأسعـار ووفّـر الجهد والوقت ...
            </h1>
            <p>
                <b>سبيد جير</b>  هو موقع لشراء قطع الغيار ..
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
    <h1><b>  إخـتـر شـركـة  سيـارتــك :</h1>
</div>
<br>
<br>
<!--صور الشركات-->
<div class="cards-list">

<?php include("conn.php"); ?>

<?php


    // Fetching data from the database
    $query = "SELECT Id, Name, img FROM Company";
    $result = sqlsrv_query($conn, $query);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }



    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        ?>

    <div class="card">
        <div class="card_image">
            <a href="car-kinds.php?id=<?php echo $row['Id']; ?>">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['img']); ?>" width="158px" height="112px">
        </a>
        </div>
        <div class="card_title">
            <p><?php echo $row['Name']; ?></p>
        </div>
    </div>

    <?php        
    }

    // Closing the connection
    sqlsrv_free_stmt($result);
    sqlsrv_close($conn);
    ?>
    
<br>

</div>
<!-- بداية الفوتر -->
<section class=" contact" id="تواصل بنا">
    <div class="footer">
    <h2>تواصل معنـا</h2>
    <!-- يمين الفوتر  -->
    <div class="contact-wrapper">
        <div class="contact-form">
            <h3>ارسل رسالة</h3>
            <form>
                <div class="form-group">
                    <input type="text" placeholder="your name">
                </div>
                <div class="form-group">
                    <input type="email" placeholder="your email">
                </div>
                <div class="form-group">
                    <textarea name="message" placeholder="your message"></textarea>
                </div>
                <button type="submit">ارسل </button>
            </form>
        </div>
        <!-- يسار الفوتر  -->
        <div class="contact-info">
            <h3>معلوماتنا</h3>
            <p>777777777 967+  <i class="fas fa-phone"></i></p>
            <p>geer@gmail.com<i class="fas fa-envelope"></i></p>
            <p>الجمهورية اليمنية - صنعـاء <i class="fas fa-map-marker-alt"></i></p>
        </div>
    </div>
    
    </div>
    </section>
    <!-- نهاية الفوتر -->
</body>
</html>