function initializeSwiper(t, e) {
  if (t.swiper) {
    console.warn("Swiper instance already exists for:", t.id);
    return;
  }

  let i = t.getAttribute("slides-per-view");
  const id = t.getAttribute("data-id");
  const slidePerGroup = t.getAttribute("data-slide-per-group");

  let nextBtn = document.querySelector(".custom-button-next-" + id);
  let prevBtn = document.querySelector(".custom-button-prev-" + id);

  let navigation =
    nextBtn && prevBtn ? { nextEl: nextBtn, prevEl: prevBtn } : false;

  a = {
    navigation: navigation,
    autoplay: "true" === t.getAttribute("data-autoplay") && {
      delay: parseInt(t.getAttribute("data-autoplay-delay")),
      disableOnInteraction: !1,
    },
    breakpoints:
      i > 1
        ? {
            0: { slidesPerView: 1, slidesPerGroup: 1 },
            768: {
              slidesPerView: 2,
              slidesPerGroup: slidePerGroup == 0 ? 1 : 2,
            },
            1020: {
              slidesPerView: parseInt(i),
              slidesPerGroup: slidePerGroup == 0 ? 1 : i,
            },
          }
        : void 0,
    on: { init() {} },
  };

  Object.assign(t, a);
  t.initialize();
}

window.addEventListener("load", () => {
  document.querySelectorAll("swiper-container").forEach((t) => {
    let e = document.getElementById(t.id);
    e && initializeSwiper(e, 0);
  });
});
