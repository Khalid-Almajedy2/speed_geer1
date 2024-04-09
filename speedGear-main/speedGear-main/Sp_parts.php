<?php
include("includes/lib.php");
?>
<?php

$id_pieces = null;
if (isset($_GET['id_pieces'])) {
  $id_pieces = $_GET['id_pieces'];
  $all = select("SELECT id_pieces,piecesNum,img,namePie,sellprice FROM PIECES WHERE id_pieces= $id_pieces");
} else {
  $all = select("SELECT id_pieces,piecesNum FROM PIECES");
}
$modelsQuery = "SELECT MIN(modelFrom) as low, MAX(modelTo) as heigh FROM PIECES where condition =1";
$minAndMax = select($modelsQuery);







$status = "";
if (isset($_POST['code']) && $_POST['code'] != "") {
  $code = $_POST['code'];
  $result = select("SELECT id_pieces,piecesNum,img,namePie,sellprice FROM PIECES WHERE id_pieces= $code");
  $message[] = 'المنتج أضيف بالفعل إلى عربة التسوق!';


  $name = $result[0]['namePie'];
  $code = $result[0]['id_pieces'];
  $price = $result[0]['sellprice'];
  $image = $result[0]['img'];
  $piecesNum = $result[0]['piecesNum'];



  $cartArray = array(
    $code => array(
      'name' => $name,
      'code' => $code,
      'price' => $price,
      'quantity' => 1,
      'image' => $image,
      'piecesNum' => $piecesNum
    )
  );

  if (empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
    $status = "<div class='box'>Product is added to your cart!</div>";
  } else {
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    if (in_array($code, $array_keys)) {
      $status = "<div class='box' style='color:red;'>
	Product is already added to your cart!</div>";
    } else {
      $_SESSION["shopping_cart"] = array_merge(
        $_SESSION["shopping_cart"],
        $cartArray
      );
      $status = "<div class='box'>Product is added to your cart!</div>";
    }
  }
} else {
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("template/head.php"); ?>
  <link href='https://unpkg.com/css.gg@2.0.0/icons/css/arrow-left.css' rel='stylesheet'>
  <title>القطعة المرادة <?php echo $all[0]["namePie"]; ?></title>
  <link rel="stylesheet" href="Sp_parts.css">

</head>
<style>
  /* .flex-box,.img{
    border-top-left-radius: var(--big-img-inner-radius) ;
    border-top-right-radius: var(--big-img-inner-radius) ;
  } */
  .gg-arrow-left {
    box-sizing: border-box;
    position: relative;
    display: block;
    transform: scale(var(--ggs, 1));
    width: 332px;
    right: -5px;
    height: 0px;
  }

  .box {}

  #checkbox {
    display: none;
  }

  .toggle {
    position: relative;
    width: 25px;
    height: 25px;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition-duration: .5s;
    left: -295px;
  }

  .bars {
    width: 100%;
    height: 4px;
    background-color: rgb(195, 83, 9);
    border-radius: 4px;
  }

  #bar2 {
    transition-duration: .8s;
  }

  #bar1,
  #bar3 {
    width: 70%;
  }

  #checkbox:checked+.toggle .bars {
    position: absolute;
    transition-duration: .5s;
  }

  #checkbox:checked+.toggle #bar2 {
    transform: scaleX(0);
    transition-duration: .5s;
  }

  #checkbox:checked+.toggle #bar1 {
    width: 100%;
    transform: rotate(45deg);
    transition-duration: .5s;
  }

  #checkbox:checked+.toggle #bar3 {
    width: 100%;
    transform: rotate(-45deg);
    transition-duration: .5s;
  }

  #checkbox:checked+.toggle {
    transition-duration: .5s;
    transform: rotate(180deg);
  }

  .message {
    position: sticky;
    top: 0;
    left: 0;
    right: 35%;
    padding: 0px 10px;
    background-color: #e26935;
    text-align: center;
    z-index: 1000;
    box-shadow: black;
    color: white;
    font-size: 20px;
    font: bold;
    text-transform: capitalize;
    cursor: pointer;
    width: 30%;

  }

  .big-img img {
    width: 100%;
    height: 160px;
  }

  .ribbon {
    width: 100px;
    font-size: 20px;
    padding: 4px;
    position: absolute;
    right: 0px;
    top: 3px;
    text-align: center;
    border-radius: 35px;
    transform: rotate(20deg);
    background-color: orangered;
    color: white;
  }
</style>

<body>
  <?php include("template/navbar.php"); ?>
  <br>
  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
    }
  }
 
  ?>
   <br>
   <!-- <?php echo  $_SESSION["shopping_cart"][0] ?> -->
   <?php
    if (!is_null($id_pieces)) {
      $cars = select("SELECT id_pieces,piecesNum,img,namePie,sellprice,quality FROM PIECES WHERE id_pieces= $id_pieces");
      $modelsQuery = "SELECT MIN(modelFrom) as low, MAX(modelTo) as heigh FROM PIECES where condition =1 and id_pieces= $id_pieces";
      $minAndMax = select($modelsQuery);
    } else {
      $cars = select("SELECT id_pieces,namePie,img,piecesNum,sellprice,quality FROM PIECES");
    }
    foreach ($cars as $row) { ?>


  <!--  صورة القطعة -->
  <div class="flex-box">
  <span class='ribbon'><?php echo $row['quality']; ?></span>
  
    

   
    
      <center>
   
  <br> 
        
        <div class="left">
          
          <div class="big-img">
            
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['img']); ?>"  onclick="showimg(this.src)">
          </div>
        </div>
        <br>
        <div class="box">
          <div class="text"><?php echo $row['namePie']; ?> </div>
          <br>
          <div class=" right">
            <p>
            <div class="ID"> <?php echo $row['piecesNum']; ?></div>
            </p>
            <br>
          
          </div>
          <!-- <p><div class="">الشـركة</div></p> -->
          <div class="num"> <?php echo $row['sellprice'] . " R.Y"; ?> </div>
          <br>
        </div>
        <!-- <input type="checkbox" id="checkbox" > 
      
    <label for="checkbox" class="toggle">
  
         

        <div class="bars" id="bar1"></div>
        <div class="bars" id="bar2">sdefrgth</div>
        <div class="bars" id="bar3"></div>
    </label> -->
        <!-- اكواد زر اضافة الى السلة -->
        <div class="btn-box">
          <form method='post' action='Sp_parts.php?id_pieces=<?php echo $id_pieces ?>'>
            <input type='hidden' name='code' value="<?php echo $row['id_pieces']; ?>" />
            <button type='submit' class="cart-btn"> إضافه الئ السله</button>
          </form>
        </div>


        <br>
        <center>
          <div class="Model"> تتوافق القطع مع الموديلات التاليه <i class="gg-arrow-left"></i></div> 
          <!-- <i class="fa fa-caret-down" style="font-size: 15px; display: inline;" aria-hidden="true"></i> -->
          <?php
          $c = 1;
          for ($i = $minAndMax[0]['low']; $i <= $minAndMax[0]['heigh']; $i++) {
          ?>
            <div class="ofandto"><?php echo $i; ?> </div>

          <?php } ?>
        </center>

        <br>

      </center>



    <?php } ?>

  </div>

</body>

</html>