
var btn1 = document.getElementById('chiros_btn');
var btn2 = document.getElementById('crius_btn');
var btn3 = document.getElementById('chimak_btn');

var x1 = document.getElementById("Chiros_options");
var x2 = document.getElementById("Crius_options");
var x3 = document.getElementById("Chimak_options");

btn1.addEventListener("click",show1);
btn2.addEventListener("click",show2);
btn3.addEventListener("click",show3);





function show1()
{
  //var x = document.getElementById("Chiros_options");
    if (x1.style.display === "none") {
        x1.style.display = "flex";
        x2.style.display = "none";
        x3.style.display = "none";
    } else {
        x1.style.display = "none";
    }
}

function show2()
{
  
    if (x2.style.display === "none") {
      x1.style.display = "none";
      x2.style.display = "flex";
      x3.style.display = "none";
    } else {
        x2.style.display = "none";
    }
}
function show3()
{
  
    if (x3.style.display === "none") {
      x1.style.display = "none";
      x2.style.display = "none";
      x3.style.display = "flex";
    } else {
        x3.style.display = "none";
    }
   
}

