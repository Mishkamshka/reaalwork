document.addEventListener('DOMContentLoaded', () => {
  if (!document.body.classList.contains('home')) return;
window.scrollTo(0, 0);

  const innerWords = gsap.utils.toArray('.ellipse-word');
  const allImg     = gsap.utils.toArray('.ellipse-word img');

  if (!innerWords.length) return;

  // mm re-runs the matching branch (and reverts the other) whenever the
  // device is rotated between landscape and portrait.
  const mm = gsap.matchMedia();

  // ── HOME HERO PIN ──────────────────────────────────────────────────────────
  // Pins the .home-holder section (the hero area) in place while the
  // content below it scrolls up and over it.
  ScrollTrigger.create({
    trigger: '.home-holder',
    start: 'top top',
    end: 'bottom -=150vh',
    pin: true,
    pinSpacing: false,
  });

  // ── LANDSCAPE: words sit in the flow layout and size up ───────────────────
  mm.add('(orientation: landscape)', () => {
    smoother.paused(true);

    let hasReleased = false;

    innerWords.forEach(el => { el.style.position = 'relative'; });
    gsap.set(allImg, { marginBottom: '0vw' });

    const sizedUp = gsap.timeline({ delay: 0.3 })
      .to(allImg, {
        opacity:  1,
        height:   '7vw',
        duration: 0.45,
        ease:     'expo.inOut',
        stagger:  { each: 0.1, from: 'random' },
        marginBottom: 'inherit',
        onComplete() {
          hasReleased = true;
          smoother.paused(false);
        },
      })
      .add(scrollOnDude);

    const projectsTrigger = ScrollTrigger.create({
      trigger: '.projects',
      start:   'top center',
      end:     'top center',
      onEnter: () => {
        gsap.to(allImg, { visibility: 'hidden', ease: 'steps(1)', stagger: { from: 'random', each: 0.08 } });
      },
      onLeaveBack: () => {
        gsap.to(allImg, { visibility: 'visible', overwrite: true, ease: 'steps(1)', stagger: { from: 'random', each: 0.08 } });
      },
    });

    function jumpToEnd() {
      sizedUp.kill();
      hasReleased = true;
      smoother.paused(false);

      gsap.set(allImg, { opacity: 1, height: '7vw', marginBottom: 'inherit' });
      ScrollTrigger.refresh();

      const projectsEl = document.querySelector('.projects');
      if (projectsEl) {
        const isPast = projectsEl.getBoundingClientRect().top < window.innerHeight * 0.5;
        gsap.set(allImg, { visibility: isPast ? 'hidden' : 'visible' });
      }
    }

    let resizeTimer;
    function onResize() {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(jumpToEnd, 0);
    }
    window.addEventListener('resize', onResize);

    return () => {
      clearTimeout(resizeTimer);
      window.removeEventListener('resize', onResize);
      projectsTrigger.kill();
      sizedUp.kill();
      innerWords.forEach(el => { el.style.position = ''; });
      gsap.set(allImg, { clearProps: 'height,opacity,marginBottom,visibility' });
      if (!hasReleased) smoother.paused(false);
    };
  });

  // ── PORTRAIT: pin the hero and shrink it as the content below scrolls over it ─
  mm.add('(orientation: portrait)', () => {
    gsap.set('.home-holder', { scaleY: 1, transformOrigin: 'top center' });


    // gsap.to('.home-holder', {
    //   scaleY: 0,
    //   ease:   'none',
    //   scrollTrigger: {
    //     trigger:    '.home-holder',
    //     start:      'top top',
    //     end:        '+=100%',
    //     pin:        true,
    //     pinSpacing: false,
    //     scrub:      true,
    //   },
    // });
const mobileHero = gsap.timeline();

mobileHero.from(allImg, {
    delay: 0.3,
    height: 0,
    duration: 0.45,
    ease: 'expo.inOut',
    stagger: {
      from: 'random',
      each: 0.1,
    },
  })
  mobileHero.to(allImg, {
    clearProps: 'height',
    onComplete() {
      smoother.paused(false);
    },
  })
  .add(scrollOnDude);


const projectsTrigger = ScrollTrigger.create({
  trigger: ".projects",
  start: "top center",
  end: "top center",
  onEnter: () => {
    gsap.to(allImg, {
      visibility: "hidden",
      ease: "steps(1)",
      stagger: { from: "random", each: 0.08 },
    });
  },
  onLeaveBack: () => {
    gsap.to(allImg, {
      visibility: "visible",
      overwrite: true,
      ease: "steps(1)",
      stagger: { from: "random", each: 0.08 },
    });
  },
});

    let resizeTimer;
    function onResize() {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        mobileHero.kill();
        gsap.set(allImg, { clearProps: 'height' });
        smoother.paused(false);
        ScrollTrigger.refresh();

        const projectsEl = document.querySelector('.projects');
        if (projectsEl) {
          const isPast = projectsEl.getBoundingClientRect().top < window.innerHeight * 0.5;
          gsap.set(allImg, { visibility: isPast ? 'hidden' : 'visible' });
        }
      }, 0);
    }
    window.addEventListener('resize', onResize);

    return () => {
      clearTimeout(resizeTimer);
      window.removeEventListener('resize', onResize);
      projectsTrigger.kill();
      mobileHero.kill();
      gsap.set(allImg, { clearProps: 'height,visibility' });
      smoother.paused(false);
    };
  });
});


function scrollOnDude(){
  gsap.to(window, {
    duration: 1,
    ease: 'power4.inOut',
    scrollTo: {
      y() {
        const el = document.querySelector('.projects');

        return el
          ? (el.getBoundingClientRect().top + smoother.scrollTop()) / 4
          : window.innerHeight * 0.25;
      },
    },
  });
}