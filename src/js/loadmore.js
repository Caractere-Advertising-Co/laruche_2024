-(
  // scripts.js (ou tout autre nom que vous avez donné à votre fichier JavaScript)
  $(document).ready(function () {
    var offset = 9; // Nombre d'articles déjà affichés

    $("#load-more-posts").click(function (e) {
      e.preventDefault();

      $.ajax({
        url: ajax_object.ajax_url, // Utilisation de la variable définie par wp_localize_script()
        type: "POST",
        data: {
          action: "load_more_posts",
          offset: offset,
        },
        success: function (response) {
          $(".grid_articles").append(response);
          offset += 9; // Mettre à jour le décalage pour charger les prochains articles
        },
      });
    });

    $("#load-more-refs").click(function (e) {
      e.preventDefault();

      $.ajax({
        url: ajax_object.ajax_url, // Utilisation de la variable définie par wp_localize_script()
        type: "POST",
        data: {
          action: "load_more_refs",
          offset: offset,
        },
        success: function (response) {
          console.warn(response);
          $(".grid-references").append(response);
          offset += 9; // Mettre à jour le décalage pour charger les prochains articles
        },
      });
    });
  })
);

$(document).ready(function () {
  $(".galerie-grid a").slice(0, 9).show();

  var items = $(".galerie-grid a").length;
  var shown = 9;

  $(".more").click(function () {
    shown = $(".galerie-grid a:visible").length + 9;
    if (shown < items) {
      $(".galerie-grid a").slice(0, parseInt(shown)).show(300);
    } else {
      $(".galerie-grid a").slice(0, parseInt(shown)).show(300);
      $(".more").hide();
    }
  });
});
