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

const swiperAbout = new Swiper(".swiper-about", {
  loop: true,
  autoplay: true,

  cssMode: true,

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


const swiperSingleEstate = new Swiper(".swiper-single-bien", {
  slidesPerView: 1,
  spaceBetween: 50,

  navigation: {
    nextEl: ".swiper-single-estate-next",
    prevEl: ".swiper-single-estate-prev",
  }
});