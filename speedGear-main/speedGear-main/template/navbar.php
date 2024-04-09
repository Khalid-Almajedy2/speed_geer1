
    
    <!--يمين الهيدر-->
    <section class="container">
    <main class="navbar">
    <div class="logo">
        <a href="#الرئيسية">
        <img src="./imegs/شعار المشروع.png" alt="speed geer" ></a>
    </div>
    <!--وسط الهيدر-->
    <div class="list">

    <a href="index.php">الرئيسية </a>
    <a href="#">مشترياتي</a>
    <a href="#">سياسة الاسترجاع</a>
    <a href="#تواصل بنا">تواصل بنا</a>
</div>
<!--يسار الهيدر-->
<div class="left">
<?php

if(!empty($_SESSION["shopping_cart"])) {
    $cart_count = count(array_keys($_SESSION["shopping_cart"]));

?>
 <a href="http:shopping_cart.php"><span class="material-symbols-outlined">shopping_cart <div class="count-cart"> <?php echo $cart_count; ?></div> </span></a> <?php }?>  
    <select class="select">
        <option>العربية</option>
        <option>الإنجليزية</option>
    </select>
   <?php    if(!empty($_SESSION["user_id"])){ ?> 
   <a href="http:logout.php"><button>تسجيل خروج</button></a> 
   <?php }else {?>
    <a href="http:create account.php"><button>تسجيل دخول</button></a> 
    <?php }?>
</div>
</main>
</section>
    <!--نهاية الهيدر-->