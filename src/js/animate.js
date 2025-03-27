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
  if (window.location.pathname.includes('/planifier-une-visite')) {
    const idBien = getQueryParam('sujet');

    const formSearch = $('#formulaire-vendre .wpcf7-form'); 

    if ( formSearch.length) {
      if (idBien) {
        setTimeout(function () {
          const typeDeBienField = formSearch.find('input[name="bien-a-visiter"]'); // Remplacez par le name réel du champ

          if (typeDeBienField.length) {
            typeDeBienField.val('Je souhaite planifier une visite pour le bien située à ' + idBien); // Injecte la valeur dans le champconsole.log('Champ "Type de bien" rempli avec :', idBien); // Debug
            typeDeBienField.prop('readonly', true);
          }
        }, 100);
      }
    }
  }

  if (window.location.pathname.includes('/contact')) {
    const typForm = getQueryParam('sujet');

    const formSearch = $('#formulaire-vendre'); // Sélectionnez le formulaire Contact Form 7 approprié ici
    const formWpcf7 = $('#formulaire-vendre .wpcf7');

    formSearch.classList.add('active');

    if (formWpcf7.length) {
        if (typForm) {
            setTimeout(function () {
                const selectField = formSearch.find('select[name="select-142"]'); // Assurez-vous de remplacer par le nom réel du champ

                if (selectField.length) {
                    if (typForm === 'gestion-locative') {
                        selectField.val('gestion-locative'); // Sélectionne l'option correspondante pour gestion-locative
                    } else if (typForm === 'vendre') {
                        selectField.val('vendre-mon-bien'); // Sélectionne l'option correspondante pour vendre mon bien
                    }
                    selectField.prop('readonly', true); // Désactive le champ si nécessaire
                }
            }, 100);
        }
    }
}
});