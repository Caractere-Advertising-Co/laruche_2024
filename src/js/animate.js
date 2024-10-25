import inView from "in-view";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger.js";

gsap.registerPlugin(ScrollTrigger);

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

  /* ANIMATION NUMBER */
  const counters = document.querySelectorAll(".animate-number");
  const speed = 100;

  inView(".grid_stats").on("enter", (e) => {
    counters.forEach((counter) => {
      const animate = () => {
        const value = +counter.dataset.number;
        const data = +counter.innerText;

        const time = value / speed;
        if (data < value) {
          counter.innerText = Math.ceil(data + time);

          if (value < 100) {
            setTimeout(animate, 40);
          } else {
            setTimeout(animate, 2);
          }
        } else {
          counter.innerTexte = value;
        }
      };

      animate();
    });
  });

  /* Scroll animation */

  if (window.location.pathname == "/") {
    gsap.to(".anim-img-1", {
      y: 300,
      duration: 1.5,
      ease: "power1.out",
      scrollTrigger: {
        trigger: ".galeries-home",
        scrub: true,
      },
    });

    gsap.to(".anim-img-2", {
      y: -500,
      duration: 2.5,
      ease: "power1.out",
      scrollTrigger: {
        trigger: ".galeries-home",
        scrub: true,
      },
    });

    gsap.to(".anim-img-3", {
      y: -300,
      duration: 2.5,
      ease: "power1.out",
      scrollTrigger: {
        trigger: ".galeries-home",
      },
    });
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
