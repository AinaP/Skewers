$(document).ready(function() {
    //$('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    //$('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
 $("#list").click(function(){
    $("#products").css("display","flex");
    $("#products").css("flex-direction","column");
  });

  $("#grid").click(function(){
     $("#products").css("display","flex");
     $("#products").css("flex-direction","");
     $("#products").css("flex-wrap","wrap");
   });

  $("#motcle").change(function(){
    $(".panier").on("click",function() {
      // cliquer sur ajouter panier
        var idp = parseInt($(this).attr("id"));
        //console.log(idp);
      $.post("../profil/panier/add.php",{idp:idp},function(data){
      $("#modal_msg").text(data);
      $("#msg").css("top","250px");
      $("#msg").css("display","block");
      $(".fade").css("opacity",1);
      $(".in").css("opacity",1);
      $("#md").css("top","26px");
      })
      .done(function(){
        $.post("../profil/panier/show.php",{action:"show"},function(data2) {
        $("#panier").text("Panier "+data2);
      })
      })
      .fail(function(){
          $("#modal_msg").text("Erreur");
      });

    });
  });

});

$("#formSearch").submit(function(){
var motcle = $("#motcle").val();
  //console.log(motcle);
  $.post("../rsc/php/search_process.php",{motcle:motcle,r_type:"search"},function(data) {

    if(data.search("aucun")=== -1)
    {
     var pos = data.search("@"); //console.log("position de @ "+pos);
     var result = data.substring(pos+1);// console.log("\n "+result+"\n");
     var nbresult = data.substring(0,pos); //console.log("\nNombre de résultat: "+nbresult);
     $("#reponse").text(nbresult+" pour "+motcle);
     $("#products").html(result);
     }
     else {
      $("#reponse").text(data);
     }
  })
  .fail(function() {
    $("#reponse").text("Une erreur est survenue,veuillez réessayer !");
  });

  return false;
});

$("#motcle").keyup(function(){
 var motcle= $("#motcle").val();
 $.post("../rsc/php/search_process.php",{motcle:motcle,r_type:"search"},function(data) {
   //console.log(data);
  if(data.search("aucun")=== -1)
  {
   var pos = data.search("@"); //console.log("position de @ "+pos);
   var result = data.substring(pos+1);// console.log("\n "+result+"\n");
   var nbresult = data.substring(0,pos); //console.log("\nNombre de résultat: "+nbresult);
   $("#reponse").text(nbresult+" pour "+motcle);
   $("#products").html(result);
   }
   else {
    $("#reponse").text(data);
   }

 })
 .fail(function() {
   $("#reponse").text("Une erreur est survenue,veuillez réessayer !");
 });
});


$(".panier").on("click",function() {
  // cliquer sur ajouter panier
    var idp = parseInt($(this).attr("id"));
    console.log(idp);
  $.post("../profil/panier/add.php",{idp:idp},function(data){
  $("#modal_msg").text(data);
  $("#msg").css("top","250px");
  $("#msg").css("display","block");
  $(".fade").css("opacity",1);
  $(".in").css("opacity",1);
  $("#md").css("top","26px");
  })
  .done(function(){
    $.post("../profil/panier/show.php",{action:"show"},function(data2) {
    $("#panier").text("Panier "+data2);
    })
  })
  .fail(function(){
      $("#modal_msg").text("Erreur");
  });

});





$("#fermer").on("click",function() {

  $("#msg").css("display","none");
  $(".fade").css("opacity",0);
  $(".in").css("opacity",0);
});
