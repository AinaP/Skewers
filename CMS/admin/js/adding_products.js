$(document).ready(function(){
  console.log("loaded");

  $("#formAdding").submit(function (){

    console.log("adding");

    var productName = $("#productName").val();
    var productCategory = $("#productCategory").val();
    var productStock = $("#productStock").val();
    var productPrice = $("#productPrice").val();
    var productDesc = $("#productDesc").val();

    //$("#formAdd").after("<p>Veuillez patientez...</p>");

    //$("form").after("<br>"+nb+"<br>"+nom_p);
    $.post('add_process.php',{
      productName:productName,
      productCategory:productCategory,
      productStock:productStock,
      productPrice:productPrice,
      productDesc:productDesc
      },
      function(donnee){
      $(".modal").css("top",100);
      $(".modal").css("display","block");
      $(".fade").css("opacity",1);
      $(".in").css("opacity",1);
      $("#msg").text(donnee);
      if(donnee.search("correct")!= -1)
      {
        $(".modal-title").text("Effectuée");
      }
      else {
        $(".modal-title").text("Echec");
      }
    });
  return false;
});

});

$(".closeme").on("click",function(){
  $(".modal").css("display","none");
  $(".fade").css("opacity",0);
  $(".in").css("opacity",0);
});
//$("#new_product").on('click',adding() );
