
function loading_pv()
{

  //$("form").after("<br>"+nb+"<br>"+nom_p);
  //var fpv = $("#pv tr:first").val();
  //console.log(fpv);
    $.post('access/loading_products.php',{load_type:"pv"},function(pv){$("#pv").append(pv);})
    .fail(function(){$("#pv").html("<tr>Impossible d'afficher le contenu des produits en ligne! Nouvel essai...</tr>");});

}

function loading_pnv()
{
  var fpnv = $("#pnv tr:first");
  $.post('access/loading_products.php',{load_type:"pnv"},function(pnv){$("#pnv").append(pnv);})
  //.done(loading())
  .fail(function(){$("#pnv").html("Impossible d'afficher le contenu des produits non validés! Nouvel essai...");});

}
