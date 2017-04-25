$(document).ready(function(){
  $(".panier").on("click",function() {
    // cliquer sur ajouter panier
      var idp = parseInt($(this).attr("id"));
      console.log(idp);
    $.post("../profil/panier/add.php",{idp:idp},function(data){
    $("#modal_msg").text(data);
    console.log(data);
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


});
