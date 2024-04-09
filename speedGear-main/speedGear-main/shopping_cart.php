<?php include("includes/lib.php"); ?>
<?php
$status = "";
if (isset($_SESSION["shopping_cart"])) {
  $total_price = 0;
}


if (isset($_POST['action']) && $_POST['action'] == "remove") {


  if (!empty($_SESSION["shopping_cart"])) {

    foreach ($_SESSION["shopping_cart"] as $key => $value) {

      if ($_POST["code"] == $key) {
        unset($_SESSION["shopping_cart"][$key]);
        $status = "<div class='box' style='color:red;'>
      Product is removed from your cart!</div>";
      }
      if (empty($_SESSION["shopping_cart"]==0)){
        // unset($_SESSION["shopping_cart"]);
        header('location:pises.php');
      }else{header('location:shopping_cart.php ');}
    }
   
  }
}
else{
  // if (isset($_POST['cart_quantity'])) {
  //   if (!empty($_SESSION["shopping_cart"])) {
  //     foreach ($_SESSION["shopping_cart"] as $key => $value) {
  //       if ($_POST["code"] == $key) {
  //         $_SESSION["shopping_cart"][$key]["quantity"] ++;
  //       }
  
  
  //   }
  
  
  
  // }
  // }


}


if (isset($_POST['action']) && $_POST['action'] == "change") {

  foreach ($_SESSION["shopping_cart"] as $key => $value) {

    if ($_POST["code"] == $key) {
      $_SESSION["shopping_cart"][$key][ "quantity" ] = $_POST["quantity"];
      break;
    }
    
  }
}



foreach ($_SESSION["shopping_cart"] as $row) {

  $total_price += ($row["price"] * $row["quantity"]);
}

$order_num = rand(1, 99999);
date_default_timezone_set("Asia/Aden");
$ord_date = date("Y-n-d H:i:s");



$id_coustomer = $_SESSION['user_id'];
if (!isset($id_coustomer)) {
  header('location:create account.php ');
} else {
  if ($_SERVER['REQUEST_METHOD'] === 'POST'  && !isset( $_POST['action']) ) {
    echo $_POST['up'];
    if (isset($_POST['up'])) {
      $add = $_POST['add'];
      $nameaccount = $_POST['nameaccount'];
      $namerecip = $_POST['namerecip'];
      $checked = $_POST['payment'];
      $params = array($add, $nameaccount, $namerecip, $total_price, $checked, $order_num, $ord_date);
      $query = "INSERT INTO [ORDER] (id_customers,ord_num,total_amount,ord_address,name_recip,id_payment,ord_date) VALUES ($id_coustomer,$order_num,$total_price,'$add','$namerecip','$checked','$ord_date'); select SCOPE_IDENTITY()";
      $result = sqlsrv_query($conn, $query, $params);




      if ($result === false) {

        echo "Error executing query.</br>";
        die(print_r(sqlsrv_errors()));
      } else {



        sqlsrv_next_result($result);

        sqlsrv_fetch($result);
        $id_order = sqlsrv_get_field($result, 0);

        $accunt = "INSERT INTO [PAYMENT DETAILS](id_customers,id_order,amount_paid,name_account) VALUES ($id_coustomer,$id_order,$total_price,'$nameaccount')";


        $kk = sqlsrv_query($conn, $accunt, $params);

        foreach ($_SESSION["shopping_cart"] as $row) {
          $id_pieces = $row['code'];
          $quantity = $row['quantity'];
          $piecesNum = $row['piecesNum'];
          $price = $row["price"];
          $ord = array($quantity, $piecesNum, $price, $id_pieces, $id_order);
          $order_detal = "INSERT INTO [ORDER DETAILS](id_order,id_pieces,quantity,piecesNum,sellprice) VALUES ($id_order,$id_pieces,$quantity,$piecesNum,$price)";
          $oo = sqlsrv_query($conn, $order_detal, $ord);
          unset($_SESSION["shopping_cart"]);
          header('location:pises.php');

     
        }


      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <?php include("template/head.php"); ?>
  <title>السله</title>
  <link rel="stylesheet" href="shopping_cart.css">

  <script src="https://kit.fontawesome.com/92d70a2fd8.js" crossorigin="anonymous"></script>
</head>
<style>
  .message{
   position: sticky;
   top:0; left:0; right:0;
   padding:15px 10px;
   background-color: var(--white);
   text-align: center;
   z-index: 1000;
   box-shadow: var(--box-shadow);
   color:var(--black);
   font-size: 15px;
   text-transform: capitalize;
   cursor: pointer;
 }

/*  
.quantity{
  width: 10%;
  left:  43% ;
  bottom:-60px;
  border: none;
        background-color: #f2f2f2;
        padding: 8px 30px;
        color: white;
        border-radius: 3px;
        cursor: pointer;
        margin-bottom: 15px;

} */ */

</style>

<body>
  <?php include("template/navbar.php"); ?>
 
  <div class="container2">
    <div class="cart">
      <div class="top">
        <h2> سلـة التسـوق</h2>
        <h2 id="itemA"> <?php echo $cart_count . "     قطع  "; ?></h2>
      </div>
      <table cellspacing="0" class="table-head">
        <tr>
          <th width="150" class="head-img">الصورة</th>
          <th width="150"> إسم القطعة </th>
          <th width="150">السعر</th>
          <th width="80">الكمية</th>

          <th width="70">حذف</th>
        </tr>
      </table>
      <table id="root" cellspacing="0">
        <?php foreach ($_SESSION["shopping_cart"] as $key => $row) {      ?>
          <tr>

            <td width="150"> <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" class="img"></td>
            <td width="150" style="text-align: center;"><?php echo $row['name']; ?></td>
            <td width="150"><?php echo $row['price'] . "  YER"; ?></td>
            <td width="80"  style="border: 2px; border-color:black;">
            <form  method='post' action="shopping_cart.php">
            <input style="border: 2px; border-color:black;" type="number" min="1" name="quantity" value="<?php echo $row['quantity']; ?>">
                <input type='hidden' name='code' value="<?php echo $key; ?>" />
                <input type='hidden' name='action' value="change" />
                <button  type="submit" class="icon"> <i  style="color:black;" class='fa-solid fa-add'></i></button>
              </form>
          </td>
            <td width="70" style="left: 70%;">
              <form method='post' action="shopping_cart.php">
                <input type='hidden' name='code' value="<?php echo $key; ?>" />
                <input type='hidden' name='action' value="remove" />
                <button type="submit" class="icon"> <i class='fa-solid fa-trash'></i></button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </table>
      <hr>
    </div>
    <form action=" " method="POST" class="form1">

      <div class="summary">
        <div class="top">
          <h2> تفاصيل الطلب</h2>
        </div>
        <div class="detail">
          <h2 id="itemB"> <?php echo $cart_count . "     قطع  "; ?> </h2>


          <h2 id="totalA"><?php echo $total_price . "  ريال"; ?> </h2>
        </div>

        <div style="margin-top: 10px; padding: 0 30px;">
          <div class="kh">
            <h3> طرق الدفع</h3>
          </div>
          <input type="text" name="add" style="color: black;" placeholder="أضف عنوان التوصيل  (اسم الحي - الشارع)">
          <input type="text" name="namerecip" placeholder="ادخل اسم للفاتورة ">
          <input type="text" name="nameaccount" placeholder="اسم مرسل الحوالة">
        </div>
        <div class="container3">
          <div class="row">

            <div class="col-md-4">

              <input type="radio" name="payment" value="2" id="2">
              <label for="2"> <img src="imegs/2.png" alt="شعار الكريمي"></label></dir>


              <div class="col-md-4">
                <input type="radio" name="payment" value="1" id="1">
                <label for="1"> <img src="imegs/1.jpg" alt="شعار ون کاش"></label>
              </div>

              <div class="col-md-4">
                <input type="radio" name="payment" value="3" id="3">
                <label for="3"><img src="imegs/3.png" alt="شعار التضامن"></label>
              </div>
            </div>
          </div>
          <hr>
          <div class="top">
            <h2>الإجمالي</h2>
            <h2 id="totalB"><?php echo $total_price . "  YER"; ?></h2>
          </div>

          <div style="padding: 0 10px; margin-bottom: 20px;">

            <button name="up" type="submit" a class="checkout">تأكيد</button>
          </div>

        </div>
      </div>
    </form>
  </div>



</body>

</html>