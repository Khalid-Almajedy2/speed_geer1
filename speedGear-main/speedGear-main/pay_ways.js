var input = document.getElementById("myInput");
var input = document.getElementById("myImage");
image.addEventListener("click ", function(){
input.disabled = false;
});

$(document).ready(function(){
$("#myImage").click(function()
{
  $("myInput").prop("disabled" , false);
});
});