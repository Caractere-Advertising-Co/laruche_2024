import inView from "in-view";

$(document).ready(function () {
  //IN-VIEW
  if (document.querySelector(".from-left")) {
    document.querySelector(".from-left").classList.add("invisible");
  }
  if (document.querySelector(".from-right")) {
    document.querySelector(".from-right").classList.add("invisible");
  }
  if (document.querySelector(".from-top")) {
    document.querySelector(".from-top").classList.add("invisible");
  }
  if (document.querySelector(".from-bottom")) {
    document.querySelector(".from-bottom").classList.add("invisible");
  }

  function makeMagic(data, direction) {
    data.classList.remove("invisible");
    data.classList.add(direction);
  }

  function removeMagic(data, direction) {
    data.classList.add("invisible");
    data.classList.add(direction);
  }

  inView.offset(150);

  inView(".from-left").on("enter", (el) => {
    makeMagic(el, "fade-in-left");
  });

  inView(".from-right").on("enter", (el) => {
    makeMagic(el, "fade-in-right");
  });

  inView(".from-bottom").on("enter", (el) => {
    makeMagic(el, "fade-in-bottom");
  });

  inView(".from-top").on("enter", (el) => {
    makeMagic(el, "fade-in-top");
  });


  var formVente = $('#formulaire-vendre');
  var formSearch = $('#formulaire-recherche');
  var ctaVente = $('#ctaVente');
  var ctaSearch = $('#ctaSearch');  
  
  ctaVente.on('click',function(){
    $(this).toggleClass('inactif');
    ctaSearch.addClass('inactif');          
  
    formVente.toggleClass('active');
    formSearch.removeClass('active');
  });
  
  ctaSearch.on('click',function(){
    $(this).toggleClass('inactif');
    ctaVente.addClass('inactif');          
    formSearch.toggleClass('active');
    formVente.removeClass('active');
  });

    // Fonction pour obtenir la valeur d'une query string
    function getQueryParam(param) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(param);
  }

  // Vérifiez si on est sur la page Contact
  if (window.location.pathname.includes('/contact')) {
    const idBien = getQueryParam('sujet');

    const ctaSearch = $('#ctaSearch'); 
    const formSearch = $('#formulaire-recherche .wpcf7-form'); 

    if (ctaSearch.length && formSearch.length) {
      ctaSearch.trigger('click'); // Active le formulaire "Recherche"

      if (idBien) {
        setTimeout(function () {
          if (formSearch.length) {
            const selectBien = formSearch.find('select[name="select-420"]'); // Remplacez par le name réel du select
        
            if (selectBien.length) {
              selectBien.val('Acheter').change(); // Changez la valeur du select et déclenchez l'événement "change"
            }

            const groupSearchBien = formSearch.find('[data-id="group-searchBien"]'); // Groupe conditionnel

            if (groupSearchBien.length) {
              groupSearchBien.css('display', 'block'); // Applique le style
            }

            // Remplissez le champ "Type de bien"
            const typeDeBienField = formSearch.find('input[name="type-bien"]'); // Remplacez par le name réel du champ

            if (typeDeBienField.length) {
              typeDeBienField.val('Je souhaite planifier une visite pour le bien : ' + idBien); // Injecte la valeur dans le champconsole.log('Champ "Type de bien" rempli avec :', idBien); // Debug
            }
          } 
        }, 100);
      }
    }
  }
});

/* Accordion animation */

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}