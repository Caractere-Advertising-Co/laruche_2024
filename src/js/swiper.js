/* Home page */

const swiperHero = new Swiper(".swiper-hero", {
  loop: true,
  autoplay: true,
  cssMode: true,
  clickable: true,

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

const swiperRooms = new Swiper(".swiper-chambres", {
  slidesPerView: 3,
  spaceBetween: 50,
  loop: true,

  navigation: {
    nextEl: ".swiper-chambre-button-next",
    prevEl: ".swiper-chambre-button-prev",
  },

  breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 1.2,
      spaceBetween: 20,
    },
    // when window width is >= 640px
    640: {
      slidesPerView: 3,
      spaceBetween: 50,
    },
  },
});

const swiperAcco = new Swiper(".swiper-acco", {
  slidesPerView: 1,
  loop: true,

  navigation: {
    nextEl: ".swiper-acco-button-next",
    prevEl: ".swiper-acco-button-prev",
  },
});
