function initializeSwiper(t, e) {
  let i = t.getAttribute("data-slides-per-view"),
    a = {
      navigation: "true" === t.getAttribute("data-navigation") && {
        nextEl: ".custom-button-next",
        prevEl: ".custom-button-prev",
      },
      autoplay: "true" === t.getAttribute("data-autoplay") && {
        delay: parseInt(t.getAttribute("data-autoplay-delay")),
        disableOnInteraction: !1,
      },
      breakpoints:
        i > 1
          ? {
              0: { slidesPerView: 1 },
              768: { slidesPerView: 2 },
              1020: { slidesPerView: parseInt(i) },
            }
          : void 0,
      on: { init() {} },
    };
  Object.assign(t, a), t.initialize();
}
window.addEventListener("load", () => {
  document.querySelectorAll("swiper-container").forEach((t) => {
    let e = document.getElementById(t.id);
    e && initializeSwiper(e, 0);
  });
});
