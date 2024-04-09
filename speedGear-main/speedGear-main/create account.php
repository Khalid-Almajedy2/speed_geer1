<?php
include("includes/lib.php"); 
if(isset( $_SESSION['user_id'])) {
    header('location:index.php ');

  
}



if($_SERVER['REQUEST_METHOD'] == 'POST') { 
    if(isset($_POST['create'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $add = $_POST['add'];
        $email = $_POST['email'];
        
        $params = array($name,$password,$phone,$add,$email); 
        $query ="INSERT INTO CUSTOMERS (name,[E-mail],pass,phoneNum,address) VALUES ('$name','$email','$password','$phone','$add')";
        
        $result = sqlsrv_query($conn, $query, $params);
        
        if($result === false) {
            echo "Error executing query.</br>";
            die(print_r(sqlsrv_errors()));
        }

    }else {
     
        $password = $_POST['password'];
        $email = $_POST['email'];
        $params=array($email,$password);
        $query ="SELECT * FROM  CUSTOMERS WHERE [E-mail]='$email' AND pass = '$password'";
        $result = sqlsrv_query($conn, $query, $params);
        if($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        #Fetching Data by array
        while($row = sqlsrv_fetch_object($result)) {
            $_SESSION['user_id'] = $row->id_customers;
            $_SESSION['name'] = $row->name;
            header('location:index.php ');
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>

     <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <title>account</title>
     <!--مكتبة خطوط-->
     <link href='https://unpkg.com/css.gg@2.0.0/icons/css/arrow-left.css' rel='stylesheet'>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet"> 
 <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


<!--مكتبة خطوط-->
<link rel="stylesheet" href="create account.css">

</head>
<style>
    .kk{
        box-sizing: content-box;
    position: relative;
    display: block;
    transform: scale(var(--ggs, 1));
    width: 20px;
    height: 21px;
    top: 20px;
    left: 20px;
      box-shadow:white;
 border-bottom-color:none;
 background-color: white;

    }


    </style>
<body>

 
    <!--هنا تغيير الخلفية-->
<div class="hero">
    <!--هنا المربع الابيض -->
<div class="form-box">
    <a href="http:index.php"><button  a class="kk" type="button"><i class="gg-arrow-left"></i></button></a> 


    <div class="button-box">
        <div id="btn"></div>
        <button type="button" class="toggle-btn" onclick="login()">تسجيل</button>
        <button type="button" class="toggle-btn" onclick="register() ">إنشاء حساب</button>
    
    </div>
    <form id="login" class="input-group"  action=" "  method="POST">
        <input type="email"   name ="email"  class="input-field" placeholder=" البريد الالكتروني" required="">
        <input type="text"      name="password"  class="input-field" placeholder="كلمة المرور" required="">
        <input name='login'   type="submit"    value="تسجيل الدخول"   class="submit-btn" ></input>
        
        
        <div class="remember">
            <a href="Alter2.html">نسيت كلمة المرور ؟</a>
          </div>
    </form>
    <form  action="create account.php" id="register" class="input-group" method="POST" >
        <input type="text" class="input-field" name="name" placeholder=" الاسم" required>
        <input type="text" class="input-field"   name="password" placeholder="كلمة المرور " required>
        <input type="number" class="input-field" name="phone"  placeholder=" الهاتف" required>
        <input type="text" class="input-field" name="add"  placeholder=" العنوان" required>
        <input type="email" class="input-field"    name="email"  placeholder=" البريد الالكتروني" required>
        
        <!--<input type="email" class="input-field" placeholder="الهاتف" required>
        <input type="text" class="input-field" placeholder="العنوان " required>!-->
        <input type="checkbox" class="chech-box"><span>أوافق على الشروط والأحكام</span>
        <input name='create' type="submit"      value="أنشاء حساب" class="submit-btn"></input>
    </form> 
</div>
</div>
<!--اعدادات تحرك من تسجيل الدخول الى انشاء الحساب-->
 <script>
  var x=document.getElementById("login");
  var y=document.getElementById("register");
  var z=document.getElementById("btn");
   
  function register(){
    x.style.left="-400px";
    y.style.left="50px";
    z.style.left="110px";
  }

  function login(){
    x.style.left="50px";
    y.style.left="450px";
    z.style.left="0";
  }

 </script>
</body>
</html>