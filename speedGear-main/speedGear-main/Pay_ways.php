<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>طــرق الدفع</title>
  <link rel="stylesheet" href="Pay_ways.css">
  
</head>
<body>
  <div class="container">
    
    <h1>طرق الدفع</h1>
<div class="row ">

      <div class="col-md-4 ">
         <button type="submit" class="img">   <img src="imegs/2.png"  id="myImage" alt="شعار الكريمي"></button>
          
      </div>

      <div class="col-md-4">

      <img src="imegs/1.jpg" id="myImage"  alt="شعار ون کاش">
      <!-- alt="شعار ون کاش"> -->
  
      </div> 

      <div class="col-md-4">
        
      <img src="imegs/3.png" alt="شعار التضامن"> 
      </div> 

      <div class="f1">
      
        <form class="needs-validation" novalidate>
          <div class="col g-3 ">
                  <div class="col-sm-4 ">
                    <p>  <label for="firstName" class="form-label ">ادخل اسم للفاتورة </label></p>
                    <input type="text" id="myInput" disabled>
                
                  </div>
                
                  <div class="col-sm-4">
                    <p>  <label for="firstName" class="form-label "> اسم مرسل الحوالة</label></p>
                    <input type="text" id="myInput" disabled>
                  </div>  
      
                  <div class="col-sm-4">
                    <p>  <label for="firstName" class="form-label"> تحديد موقع التوصيل </label></p>
                    <input type="text" id="myInput" disabled>
                  </div>
      
                <br>
                  <div class="col-sm-4 ">
                    <button  class="btn-success"  type="submit"> تاكيد</button><br>
      
                  </div>
      
          
  </div>  
  </form>
      </div>
      <script src="pay_ways.js"></script>
</div>
</body>
</html>