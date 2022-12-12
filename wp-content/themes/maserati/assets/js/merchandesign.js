jQuery(document).ready(function ($) {
  //Imagen scroll merchandesign page
  if (window.outerWidth > 768) {
    gsap.registerPlugin(ScrollTrigger);

    const tl = gsap
      .timeline({
        scrollTrigger: {
          trigger: ".img-zoom",
          start: "bottom bottom",
          endTrigger: ".bottom-section",
          end: "bottom bottom",
          scrub: true,
        },
        defaults: { duration: 3 },
      })
      .to(
        ".img-zoom img",
        {
          scale: 1,
        },
        1
      );

    const tl2 = gsap
      .timeline({
        scrollTrigger: {
          trigger: ".banner-middle .fullwidth",
          start: "bottom bottom",
          endTrigger: ".bottom-section",
          end: "bottom bottom",
          scrub: true,
        },
        defaults: { duration: 3 },
      })
      .to(
        ".banner-middle .fullwidth img",
        {
          scale: 1,
        },
        1
      );

    /*TweenMax.set(".banner-middle", { scale: "0.6" });
    TweenMax.to(".banner-middle", 0.2, {
      scaleX: 1,
      scaleY: 1,
    });*/
  }
});
