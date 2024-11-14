var offset = 9; // Nombre d'articles déjà affichés
var total_biens = null; // Variable pour stocker le nombre total de biens

$(document).ready(function() {
  $("#load-more-biens").click(function (e) {
    e.preventDefault();

    var type = $(this).data('type');

    $.ajax({
      url: ajax_object.ajax_url, // Utilisation de la variable définie par wp_localize_script()
      type: "POST",
      data: {
        action: "load_more_biens",
        offset: offset,
        type: type,
      },
      success: function (response) {
        $(".grid-biens").append(response);

        // Mettre à jour le décalage pour charger les prochains articles
        offset += 9;

        // Vérifier si tous les biens sont affichés
        if (total_biens && offset >= total_biens) {
          $("#load-more-biens").hide(); // Cacher le bouton "Charger plus"
        }
      },
    });
  });
});
