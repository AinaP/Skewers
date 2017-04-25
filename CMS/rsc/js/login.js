function foot()
{
  var s_doc = window.innerHeight;

  var s_c = 491;
  var posf = s_doc - 491;
  //console.log("Taille document visible: "+s_doc+"\n"+"Taille container: "+s_c+"\n"+total);
  $("#foot").css("top",posf+"px");
}
