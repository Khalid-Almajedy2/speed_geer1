
const product =[
   {
       image: 'imegs/بلف بخاخ المكينة.png',
       title: 'بلف تبخير زيت المكينة',
       price: 120 
   },
   {
       image: 'imegs/بلف بخاخ المكينة.png',
       title: 'شداد سير المكينة',
       price: 150
   },
   {
       image: 'imegs/بلف بخاخ المكينة.png',
       title: 'كرسي قير',
       price: 230
   },
   {
       image: 'image/aa-1.jpg',
       title: 'ترمستات مكيف',
       price: 100
   },
]

const categories = [...new Set(product.map((item)=>
   {return item}))];
/*حذف القطعة  */
   function delElement(a){
       categories.splice(a, 1);
       displaycart();
   }

   function promo(){
       let promocode=document.getElementById('promocode').value;
       if(promocode==1234){
           displaycart(50);
       }
       else(
           prompt("Enter correct promo code")
       )
   }

function displaycart(c){
   let j=0, total=0;
   document.getElementById("itemA").innerHTML = categories.length + "  قطع ";
   document.getElementById("itemB").innerHTML = categories.length + "  قطع ";
   if(categories.length==0){
       document.getElementById("root").innerHTML="السلة فارغة";

       document.getElementById("totalA").innerHTML = "YER 00.00";
       document.getElementById("totalB").innerHTML = "YER 00.00";
   }
   else{
       document.getElementById("root").innerHTML = categories.map((items)=>{
           let {image, title, price} = items;
           total = total+price;
           document.getElementById("totalA").innerHTML = "YER "+ total +".00";

           if(c==50){
               document.getElementById("totalB").innerHTML="YER "+(total-c)+".00";
           }else{
               document.getElementById("totalB").innerHTML="YER "+total+ ".00";
           }

           return(
               `<tr>
                   <td width="150"><div class="img-box"><img class="img" src=${image}></div></td>
                   <td width="360"><p style='font-size:15px;'>${title}</p></td>
                   <td width="150"><h2 style='font-size:15px; color:red; '>YER  ${price}.00</h2></td>
                   <td width="70">`+"<i class='fa-solid fa-trash' onclick='delElement("+ (j++) +")'></i></td>"+
               `</tr>`
           );
       }).join('');
   }
}
displaycart();
