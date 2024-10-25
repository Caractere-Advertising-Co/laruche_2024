$(document).ready(function () {
  $(".views-rooms").on("click", show_ref_popup);

  function show_ref_popup(e) {
    e.preventDefault();
    var ref = $(this).data("index");

    console.log(ref);

    $("#modal-chambre").css("display", "flex");

    console.log($("#modal-chambre"));
    $.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      dataType: "json",
      data: {
        action: "content_popup",
        id: ref,
      },
      success: function (res) {
        if (res.template_content && res.template_content.trim() !== "") {
          $(".container_popup").empty().append(res.template_content);

          // Initialisation du Swiper une fois que le contenu est ajouté
          const swiper_ref = new Swiper(".swiper-reference", {
            cssMode: true,
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
          });
        } else {
          console.log("La réponse est vide ou nulle.");
        }
      },
    });
  }

  $(document).on("click", function (event) {
    if ($(event.target).hasClass("close")) {
      closePopup();
    }
  });

  function closePopup() {
    $(".container_popup").empty();
    $("#modal-chambre").hide();
  }
});
