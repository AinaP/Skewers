$(document).ready(function(){auto_size();}

//setInterval("data.refresh()",2000);

);

function auto_size()
{
var s_doc = 0;
var body_sx = window.innerWidth;
var main_sx = 0;
var nvg = t.n.value;

if (nvg ==="f" )
{
 s_doc = document.documentElement.scrollHeight
 console.log("Firefox");
}
else
{
s_doc = document.body.scrollHeight ;
}


console.log(pos_user);
var s_h = $("#head").height() ;//+ $("#menu").height();
var s_f = 20;
var s_c = s_doc - (s_h+s_f);

try {
  $("#corps").css("width",body_sx+"px");
  $("#corps").css("height",s_c +"px");
  $("#side").css("height",s_c +"px");
  $("#main").css("width",body_sx - $("#side").width() +"px");
  $("#main").css("height",s_c-50 +"px");
  $("#MenuH").css("width",$("#main").width() );
  var pos_user = $("#MenuH").width()- ( $("#section_search").width() + $("#section_profil").width() );
    $("#section_profil").css("left",pos_user+"px");
}
catch(error) {console.log(error);}
}

var data = {
  refresh :  function()
  {

  }
}


function show_menu(x,anim)
{
  var elem = $(x); var anim = anim;
  if (elem.css("display")=== "none" )
  {
    if(anim===true)
    elem.show(200);
    else
    {
    elem.css("display","block");
    }
  }
  else
  {
    if(anim===true)
    elem.hide(200);
    else
    {
    elem.css("display","none");
    }
  }
}
