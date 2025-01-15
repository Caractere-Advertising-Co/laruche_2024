/* Home page */

const swiperHero = new Swiper(".swiper-hero", {
  loop: true,
  autoplay: false,
  cssMode: true,

  navigation: {
    nextEl: ".swiper-button-hero-next",
    prevEl: ".swiper-button-hero-prev",
  },

  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

const swiperFrontPage = new Swiper(".swiper-resp", {
  cssMode: true,
  loop: true,
  slidesPerView: 3,
  spaceBetween: 30,

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const swiperCard = new Swiper(".swiper-card", {
  cssMode: true,
  slidesPerView: 1.2,
  loop: true,
  spaceBetween: 50,
  autoplay: false,
});

/* Commun */

const swiperExtra = new Swiper(".swiper-extra", {
  loop: true,

  navigation: {
    nextEl: ".swiper-button-next",
  },

  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 1.2,
      spaceBetween: 20,
    },
    // when window width is >= 640px
    640: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
  },
});

/* Page Gites */

const swiperSingleEstate = new Swiper(".swiper-single-bien", {
  slidesPerView: 1,
  spaceBetween: 50,

  navigation: {
    nextEl: ".swiper-single-estate-next",
    prevEl: ".swiper-single-estate-prev",
  }
});