$(function() {

});



////////////////////////////////////
//$("#account").on("click",(alert("test")) ) ;


function menu_fix()
{
var nvg = t.n.value;
var y = 0; var pos = null;
pos = document.getElementById("menu") ;
if (nvg ==="f" )
{
 y = document.documentElement.scrollTop;
 console.log("Firefox");

}
else
{
y = document.body.scrollTop;

}


function pos_foot()
{
  var s_doc = document.body.scrollHeight;
  var head = $("#head").height();
  var sh = $("#sh").height();
  var sld = $("#sld").height();
  var vdm = $("#vdm").height();
  var cdp = $("#cdp").height();
  var bb = $("#bb").height();

  var total = head + sh + sld + vdm + cdp + bb;
  var posf = s_doc - total;
  $("#foot").css("top",posf+"px");
}

//console.log(pos);
console.log(y);
 if( $("#menu").css("position")==="fixed" )
 {
    console.log("Menu is fixed");

    if(y<=40)
    {
      try
      {
      $("#menu").css("position","initial");
      $("#menu").css("top","0");
      console.log("Menu is initial");
      }
      catch (e)
      {
        console.log("test");
        pos.style.position = "initial";
        pos.style.top = "0";
      }
    }


 }

 else
 {
    //console.log("Menu is initial");

    if(y>=64 )
    {
       try
      {
      $("#menu").css("position","fixed");
      $("#menu").css("top","0");
      //console.log("Chrome,Safari,opera test ok");
      }
      catch (e)
      {
        console.log("Firefox test ok");
       document.getElementById("menu").style.position = "fixed";
       document.getElementById("menu").style.top = "0";
      }
    }

 }

}







function dropdown()
{
  var dp = $("#dropdown");
  var dpf = document.getElementById("dropdown");
 if( $("#dropdown").css("display") === "flex"  )
  {

  try {$("#dropdown").css("display","none");}
  catch(me){document.getElementById("dropdown").style.display = "none"}
  }

  else
  {
   try {$("#dropdown").css("display","flex"); }
  catch(me){document.getElementById("dropdown").style.display = "flex"}
  }
}


function distance(a,b)
{
	var elem1 = document.getElementById(a);
	var elem2 = document.getElementById(b);

	var dis = 0; // distance à 0 d'abord
	var h_doc = document.body.scrollHeight; // hauteur du DOCUMENT
	var h_a = $(elem1).height(); // hauteur de a

	var c_a = $(elem1).offset(); //coordonées de a (top et left)
	var c_b = $(elem2).offset(); // pareil pour b

    var pos_a = c_a.top + h_a; // y de a + sa hauteur
    var pos_b = c_b.top ; // y de b ,pas besoin de sa hauteur

    dis = pos_a - pos_b;
    if(dis<0)
    {dis*= -1;}
	console.log("\nLa distance entre les 2 éléments est de "+dis +"px") ;
}
