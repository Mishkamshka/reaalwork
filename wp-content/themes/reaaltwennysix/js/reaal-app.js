// ─── GSAP SETUP ──────────────────────────────────────────────────────────────
// Register all GSAP plugins used across the site
gsap.registerPlugin(
  ScrollTrigger,
  ScrollSmoother,
  ScrollToPlugin,
);
gsap.config({ nullTargetWarn: false });

// ─── SCROLL SMOOTHER ─────────────────────────────────────────────────────────


smoother = ScrollSmoother.create({
  smooth: 2,
  effects: true,
  ignoreMobileResize: true,
  normalizeScroll: true,
  smoothTouch: 1,
});


// ─── SMOOTH SCROLL TO ANCHOR LINKS ───────────────────────────────────────────
// Intercepts clicks on <a href="#section"> links and scrolls smoothly instead
// of jumping. Also handles page-load when the URL already has a hash.

function scrollToHash(hash, e) {
  const elem = hash ? document.querySelector(hash) : false;
  if (elem) {
    if (e) e.preventDefault();
    gsap.to(window, { duration: 0.5, scrollTo: { y: elem }, ease: 'power4.out' });
  }
}

function getSamePageAnchor(link) {
  if (
    link.protocol !== window.location.protocol ||
    link.host     !== window.location.host     ||
    link.pathname !== window.location.pathname ||
    link.search   !== window.location.search
  ) return false;
  return link.hash;
}

document.querySelectorAll('a[href]').forEach((a) => {
  a.addEventListener('click', (e) => scrollToHash(getSamePageAnchor(a), e));
});

document.querySelectorAll("a[href^='#']").forEach((a) => {
  a.addEventListener('click', (e) => {
    e.preventDefault();
    scrollToHash(a.hash);
    window.history.pushState({}, '', a.hash);
  });
});

window.addEventListener('load', () => {
  if (window.location.hash) {
    setTimeout(() => scrollToHash(window.location.hash), 100);
  }
});


if (document.body.classList.contains('home')) {

window.scrollTo(0, 0);
}

// ─── DOM READY ───────────────────────────────────────────────────────────────
// Everything below needs the DOM to be fully parsed before it runs.

document.addEventListener('DOMContentLoaded', () => {



  // ── MENU HEIGHT & PAGE PADDING ─────────────────────────────────────────────
  // Measures the sticky header height so we can offset page-top sections and
  // the orbit hero area to sit flush below the nav bar.
  const mainNavigation = document.querySelector('.site-header');
  const pageTop        = document.querySelectorAll('.page-top');
  const homeIntro      = document.querySelectorAll('.orbit-mama');
  const strch      = document.querySelectorAll('.stretched-text');
  const centreText      = document.querySelectorAll('.center-text');
  let totalHeightMenu  = 0;

  if (mainNavigation) {
    const remInPx = parseFloat(getComputedStyle(document.documentElement).fontSize);
    totalHeightMenu = mainNavigation.offsetHeight + 0.01 * remInPx;

    pageTop.forEach((el) => {
      el.style.paddingTop = `${1.5 * totalHeightMenu}px`;
    });
    homeIntro.forEach((el) => {
      el.style.paddingTop = `${2 * totalHeightMenu}px`;
    });
    strch.forEach((el) => {
       el.style.marginTop = `${1 * totalHeightMenu}px`;
      el.style.height = `calc(100% - ${totalHeightMenu}px)`;
    });
    centreText.forEach((el) => {
      el.style.paddingTop = `${ totalHeightMenu}px`;
      el.style.paddingBottom = `${ totalHeightMenu}px`;
    });
    
  }

  // mm = gsap media query helper, used throughout to branch desktop vs mobile
  const mm = gsap.matchMedia();

  // Unhides the body once fonts/layout are ready (body starts visibility:hidden)
  gsap.to('body', { visibility: 'visible' });

  // ── SHARED VARS ────────────────────────────────────────────────────────────
  // allImg is the small word images inside the orbit centre — needed both in
  // orbit.js (hide on scroll) and here (show/hide when grid toggle fires).
  const allImg = gsap.utils.toArray('.ellipse-word img');

  // ── STRETCH-MAMA SECTION HEADERS ──────────────────────────────────────────
  // On scroll, these headers grow from 0 height as they enter the viewport
  // and shrink back to 0 as they leave — pinned while shrinking.
  // Used on sections that have the .stretch-mama + .stretch-baby class combo.
  function animateSectionInfo({ header, i }) {
    if (!header) return;
    gsap.set(header, { scaleY: 0, transformOrigin: 'top center' });
    gsap.to(header, {
      scaleY: 1,
      ease: 'none',
      scrollTrigger: {
        trigger: header,
        start: 'top bottom',
        end: `top+=${totalHeightMenu} top+=${totalHeightMenu}`,
        scrub: true,
        id: `grow-${i}`,
        invalidateOnRefresh: true,
      },
    });
    gsap.fromTo(header, { scaleY: 1 }, {
      scaleY: 0,
      ease: 'none',
      scrollTrigger: {
        trigger: header,
        start: `top+=${totalHeightMenu} top+=${totalHeightMenu}`,
        end:   () => `+=${window.innerHeight}`,
        scrub: true,
        pin: true,
        pinSpacing: false,
        id: `shrink-${i}`,
        invalidateOnRefresh: true,
      },
    });
  }
  gsap.utils.toArray('.stretch-mama').forEach((section, i) => {
    animateSectionInfo({ header: section.querySelector('.stretch-baby'), i });
  });


  // ── PROJECT SECTION HEADER ANIMATION ──────────────────────────────────────
  // Same grow/shrink scroll animation as stretch-mama above but used on
  // individual .project-sections headers. Lives in its own GSAP context so
  // it can be fully killed and re-run when the grid toggle switches layouts.
  function animateSection({ header, i }) {
    if (!header) return;
    gsap.set(header, { scaleY: 0, transformOrigin: 'top center' });
    gsap.to(header, {
      scaleY: 1,
      ease: 'none',
      scrollTrigger: {
        trigger: header,
        start: 'top bottom',
        end: `top+=${totalHeightMenu} top+=${totalHeightMenu}`,
        scrub: true,
        id: `grow-${i}`,
        invalidateOnRefresh: true,
      },
    });
    gsap.fromTo(header, { scaleY: 1 }, {
      scaleY: 0,
      ease: 'none',
      scrollTrigger: {
        trigger: header,
        start: `top+=${totalHeightMenu} top+=${totalHeightMenu}`,
        end:   () => `+=${window.innerHeight}`,
        scrub: true,
        pin: true,
        pinSpacing: false,
        id: `shrink-${i}`,
        invalidateOnRefresh: true,

      },
    });
  }

/* =============================================================================
   PROJECTS VIEW TOGGLE  ·  list ⇄ grid
   -----------------------------------------------------------------------------
   State (setView) is kept separate from choreography (toGrid / toList). The two
   views are structurally different — different DOM order, parents and scroll
   triggers — so we never morph between them. Instead:

     · list → grid : the first card's image glides from its list spot,
                     through the centre, into its grid slot in one continuous
                     move; the cards on screen fade in around it as it lands.
     · grid → list : a clean dissolve — everything fades out, the layout is
                     swapped while invisible, the list rises back in.

   REPLACES everything from your old `// ── OG LAYOUT` comment down — i.e. this
   now owns initOgLayout + initProjectSections too, so delete those upstream.

   Expects to already exist in the outer scope (defined elsewhere in the theme):
     · mm              — a gsap.matchMedia() instance
     · totalHeightMenu — number, the fixed menu height offset
     · animateSection  — fn({ header, i }), your per-section list animation
     · allImg          — cached node list of the list-view project images

   GSAP core + ScrollTrigger + ScrollToPlugin must be loaded first.
   ScrollSmoother is optional (handled gracefully if absent).
   ========================================================================== */

(() => {
  'use strict';

  const projectsEl           = document.querySelector('.projects');
  const gridBtn              = document.querySelector('.grid-switch-btn');
  const gridBtnLabels        = gridBtn ? Array.from(gridBtn.children).filter((el) => el.id !== 'grid-switch-btn-bk') : [];
  const projectSectionEls    = Array.from(document.querySelectorAll('.project-sections'));
  const projectHeaderEls     = Array.from(document.querySelectorAll('.project-sections .stretch-baby'));
  const originalSectionOrder = [...projectSectionEls];

  // No grid on this page → nothing to wire up.
  if (!projectsEl || !projectSectionEls.length) return;

  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  let currentView = 'list';
  let isToggling  = false;

  /* ── LIST VIEW · setup ───────────────────────────────────────────────────
     Stored in contexts so they can be fully reverted before switching views. */

  let ogLayoutCtx = null;

  function initOgLayout() {
    ogLayoutCtx = gsap.context(() => {

      mm.add('(min-width: 769px)', () => {
        gsap.set('.og-layout .project-info h2, .og-layout .project-info-cats p', { visibility: 'hidden' });
        gsap.utils.toArray('.og-layout').forEach((section) => {
          gsap.to(section.querySelectorAll('.project-info h2, .project-info-cats p'), {
            scrollTrigger: { trigger: section, start: 'top center', end: 'top center', invalidateOnRefresh: true },
            duration: 1,
            visibility: 'visible',
            ease: 'steps(1)',
            stagger: 0.1,
          });
        });
      });




      gsap.set('.page-work .og-layout:nth-of-type(1) .single-project', { opacity:0, scale: 0.5, transformOrigin: 'bottom center' });
      gsap.to('.page-work .og-layout:nth-of-type(1) .single-project', {
        opacity:1, 
        scale: 1,
        ease: 'power4.inOut',
        duration:1,
      });

      gsap.set('.og-layout:nth-of-type(1) .single-project', { scaleX: 0, transformOrigin: 'bottom center' });
      gsap.to('.og-layout:nth-of-type(1) .single-project', {
        scaleX: 1,
        ease: 'none',
        scrollTrigger: {
          trigger: '.projects',
          start: 'top bottom',
          end: `top top+=${totalHeightMenu}`,
          scrub: true,
        },
      });
    });
  }

  let projectSectionsCtx = null;

  function initProjectSections() {
    projectSectionsCtx = gsap.context(() => {
      gsap.utils.toArray('.project-sections').forEach((section, i) => {
        animateSection({ header: section.querySelector('.stretch-baby'), i });
      });
    });
  }

  function killProjectSections() {
    if (projectSectionsCtx) { projectSectionsCtx.revert(); projectSectionsCtx = null; }
    if (ogLayoutCtx)        { ogLayoutCtx.revert();        ogLayoutCtx = null; }
    gsap.set('.project-sections .project-img', { clearProps: 'scaleX,transformOrigin' });
    gsap.set('.project-sections .project-info h2, .project-sections .project-info-cats p', { clearProps: 'visibility' });
  }

  /* ── GRID VIEW · setup ───────────────────────────────────────────────────
     Groups sections by data-category, wraps each group with a sticky title,
     and pins those titles. Pins live in a context so they revert cleanly. */

  function buildCategoryGroups() {
    const groups = new Map();
    originalSectionOrder.forEach((section) => {
      const slug = section.dataset.category     || 'uncategorized';
      const name = section.dataset.categoryName || 'Uncategorized';
      if (!groups.has(slug)) groups.set(slug, { name, sections: [] });
      groups.get(slug).sections.push(section);
    });
    groups.forEach(({ name, sections }, slug) => {
      const wrapper = document.createElement('div');
      wrapper.className = 'project-cats row px-1';
      wrapper.id        = slug;
      wrapper.innerHTML = `<div class="project-cats-title"><h1>${name}</h1></div>`;
      sections.forEach((section) => wrapper.appendChild(section));
      projectsEl.appendChild(wrapper);
    });
  }

  function restoreFlatOrder() {
    originalSectionOrder.forEach((section) => projectsEl.appendChild(section));
    projectsEl.querySelectorAll('.project-cats').forEach((el) => el.remove());
  }

  let gridLayoutCtx = null;

  function initGridLayout() {
    gridLayoutCtx = gsap.context(() => {
      const catTitles = gsap.utils.toArray('.project-cats-title');
      gsap.set(catTitles, { opacity:0});

      catTitles.forEach((title) => {
        ScrollTrigger.create({
          trigger: title,
          start: `top top+=${totalHeightMenu}`,
          // Release when the pinned title's bottom meets the group's bottom.
          end: () => `bottom top+=${totalHeightMenu + title.offsetHeight}`,
          invalidateOnRefresh: true,
          endTrigger: title.closest('.project-cats'),
          pin: true,
          pinSpacing: false,
        });

      });

      // gsap.utils.toArray('.project-cats').forEach((group) => {
      //   gsap.to(group.querySelector('.project-cats-title'), {
      //     scrollTrigger: { trigger: group, start: 'bottom center', scrub: true,  },
      //   });
      // });
    });
  }

  function killGridLayout() {
    if (gridLayoutCtx) { gridLayoutCtx.revert(); gridLayoutCtx = null; }
  }

  /* ── STATE ────────────────────────────────────────────────────────────────
     Synchronous and instant. Owns everything that *defines* a view: classes,
     DOM order, scroll animations, static styles. Only ever called while the
     cards are hidden, so it's allowed to be blunt. */

  function setSwitchLabel(view) {
    const isList = view === 'list';
    gridBtnLabels.forEach((el, i) => el.classList.toggle('switch-on', isList ? i === 0 : i === 1));
  }

  function setView(view) {
    const isList = view === 'list';

    projectSectionEls.forEach((s) => {
      s.classList.toggle('og-layout', isList);
      s.classList.toggle('grid',     !isList);
      s.classList.toggle('gx-2',     !isList);
    });
    projectHeaderEls.forEach((h) => h.classList.toggle('stretch-baby', isList));

    if (isList) {
      killGridLayout();                 // revert pins before their wrappers go
      restoreFlatOrder();
      gsap.set('.projects', { clearProps: 'position' });
      initOgLayout();
      initProjectSections();
      gsap.to(allImg, {
        visibility: 'visible',
        ease: 'steps(1)',
        overwrite: true,
        stagger: { from: 'random', each: 0.08 },
      });
    } else {
      killProjectSections();            // reverts og + per-section contexts
      buildCategoryGroups();
      initGridLayout();
      gsap.set('.projects', { position: 'relative' });
      gsap.set(allImg, { visibility: 'hidden' });  // ← remove this line if the grid should SHOW images
    }

    currentView = view;
  }

  /* ── HELPERS ─────────────────────────────────────────────────────────────── */

  // Scroll to the top of .projects and actually arrive: tweening the smoother's
  // own scrollTop means the *visual* position lands exactly when the tween ends.
  function scrollHome(tl) {
    const sm = (typeof ScrollSmoother !== 'undefined') ? ScrollSmoother.get() : null;
    if (sm) {
      tl.to(sm, { scrollTop: sm.offset(projectsEl, 'top top'), duration: 0.6, ease: 'power2.inOut' }, 0);
    } else {
      tl.to(window, { scrollTo: { y: projectsEl }, duration: 0.6, ease: 'power2.inOut' }, 0);
    }
  }

  /* ── FLIGHT · list → grid ─────────────────────────────────────────────────
     The hero's image is lifted out of its card into a fixed "flight layer" and
     glided from its list spot, through the centre, into its grid slot in one
     continuous move. The layer's real width/height animate (not a scale), so
     the image stays crisp and object-fit: cover re-crops it smoothly from the
     list's crop to the grid's full frame, without re-laying out the grid on
     every frame. */

  const GLIDE_DURATION = 1.2;   // seconds, list → centre → slot
  const GLIDE_SLOW     = 0.6;   // slow-down passing the centre: 0 = none, 1 = stops dead
  const CENTRE_FIT     = 0.265;  // size at the centre, as a share of the visible band

  // Starts and ends at rest; eases off as it passes the centre (halfway) but
  // never stops. A blend of a single and a double sine ease-in-out.
  function glideEase(t) {
    const TAU = Math.PI * 2;
    return t
      - GLIDE_SLOW       * Math.sin(2 * TAU * t) / (2 * TAU)
      - (1 - GLIDE_SLOW) * Math.sin(TAU * t) / TAU;
  }

  // Smooth curve through a (u = 0), m (u = 0.5) and b (u = 1). Monotone, so a
  // value that barely changes over one half (e.g. position while the image
  // shrinks in place) holds still instead of wobbling or overshooting.
  function through(a, m, b, u) {
    const d0 = (m - a) * 2;
    const d1 = (b - m) * 2;
    const dm = d0 * d1 > 0 ? (2 * d0 * d1) / (d0 + d1) : 0;
    const [p0, p1, t0, t1, s] = u < 0.5 ? [a, m, d0, dm, u * 2] : [m, b, dm, d1, u * 2 - 1];
    const s2 = s * s;
    const s3 = s2 * s;
    return (2 * s3 - 3 * s2 + 1) * p0 + (s3 - 2 * s2 + s) * 0.5 * t0
         + (3 * s2 - 2 * s3) * p1     + (s3 - s2) * 0.5 * t1;
  }

  // Centre point + size of a rect.
  const box = (r) => ({ x: r.left + r.width / 2, y: r.top + r.height / 2, w: r.width, h: r.height });

  // Grid cards fade in pink first: holdMedia() hides a hidden card's image/video
  // so the card fades in as just its .pink-bg, then releaseMedia() fades the
  // media in over it. Media pinkReveal hasn't revealed yet (opacity 0) is left
  // for pinkReveal to bring in once it loads.
  function holdMedia(card) {
    const media = card.querySelector('.project-cats .project-gradient img, .project-cats .project-gradient video');
    if (!media || gsap.getProperty(card, 'opacity') !== 0 || gsap.getProperty(media, 'opacity') === 0) return null;
    gsap.killTweensOf(media);
    gsap.set(media, { opacity: 0 });
    return media;
  }

  function releaseMedia(media) {
    if (media) gsap.to(media, { opacity: 1, duration: 0.6, ease: 'power2.out' });
  }

  // Moves the card's image/video into a fixed layer. The card keeps its size
  // (with its empty box hidden) until land() puts the image back.
  function liftIntoFlight(wrap, image) {
    const home = image && { parent: image.parentNode, next: image.nextSibling, style: image.getAttribute('style') };

    const layer = document.createElement('div');
    layer.className = 'flight-layer';
    Object.assign(layer.style, {
      position: 'fixed', left: '0', top: '0', zIndex: '1',
      overflow: 'hidden', pointerEvents: 'none',
      backgroundColor: getComputedStyle(wrap).backgroundColor,
    });

    gsap.set(wrap, { width: wrap.offsetWidth, height: wrap.offsetHeight, visibility: 'hidden' });
    wrap.classList.add('in-flight');   // hides its .pink-bg too (the grid forces it visible)
    if (image) {
      Object.assign(image.style, { width: '100%', height: '100%', maxWidth: 'none', objectFit: 'cover', display: 'block' });
      layer.appendChild(image);   // same task, so a playing video keeps playing
    }
    // Inside the smooth-wrapper so it stacks with the page, under the fixed menu.
    (document.getElementById('smooth-wrapper') || document.body).appendChild(layer);

    let landed = false;
    return {
      place({ x, y, w, h }) {
        layer.style.width     = `${w}px`;
        layer.style.height    = `${h}px`;
        layer.style.transform = `translate(${x - w / 2}px, ${y - h / 2}px)`;
      },
      land() {
        if (landed) return;
        landed = true;
        if (image) {
          if (home.style === null) image.removeAttribute('style');
          else                     image.setAttribute('style', home.style);
          home.parent.insertBefore(image, home.next);
        }
        gsap.set(wrap, { clearProps: 'width,height,visibility' });
        wrap.classList.remove('in-flight');
        layer.remove();
      },
    };
  }

  /* ── CHOREOGRAPHY · list → grid (the hero journey) ───────────────────────── */

  async function toGrid(hero) {
    const rest        = projectSectionEls.filter((c) => c !== hero);
    const heroInfo    = hero.querySelector('.project-info');
    const heroStretch = hero.querySelector('.stretch-baby');
    const heroWrap    = hero.querySelector('.project-gradient');
    const heroImage   = heroWrap.querySelector('img, video');

    // Freeze the hero's own grow/shrink scroll animation at its settled state.
    // Otherwise scrollHome() below re-scrubs its scaleY and the image we
    // measure is squished. (Assumes animateSection triggers off .stretch-baby.)
    if (heroStretch) {
      ScrollTrigger.getAll().forEach((st) => { if (st.trigger === heroStretch) st.kill(); });
      gsap.set(heroStretch, { scaleY: 1 });
    }

    let flight = null;
    try {
      // 1 — leave: scroll home, fade everything except the hero, drop its caption.
      const leave = gsap.timeline();
      scrollHome(leave);
      leave.to(rest, { autoAlpha: 0, duration: 0.35, ease: 'power1.in', stagger: { amount: 0.2 } }, 0);
      leave.to(heroInfo, { autoAlpha: 0, duration: 0.25 }, 0);
      await leave;

      // 2 — measure the image in the list, swap to the grid underneath (all
      //     else is hidden), and lift the image into the flight layer exactly
      //     where it was, so nothing visibly changes.
      const from = (heroImage || heroWrap).getBoundingClientRect();
      setView('grid');
      ScrollTrigger.refresh();
      flight = liftIntoFlight(heroWrap, heroImage);

      // Centre pose: the list image scaled to fit CENTRE_FIT of the visible
      // band below the menu, centred over .projects.
      const band  = projectsEl.getBoundingClientRect();
      const bandH = window.innerHeight - totalHeightMenu;
      const fit   = from.width && from.height
        ? Math.min((band.width * CENTRE_FIT) / from.width, (bandH * CENTRE_FIT) / from.height)
        : 1;
      const a = box(from);
      const m = { x: band.left + band.width / 2, y: totalHeightMenu + bandH / 2, w: a.w * fit, h: a.h * fit };

      // The slot is read live, so it still lands true if the page scrolls mid-flight.
      const pose = (u) => {
        const b = box(heroWrap.getBoundingClientRect());
        return {
          x: through(a.x, m.x, b.x, u),
          y: through(a.y, m.y, b.y, u),
          w: through(a.w, m.w, b.w, u),
          h: through(a.h, m.h, b.h, u),
        };
      };
      flight.place(pose(0));

      // Cards already on screen, nearest the hero's slot first.
      const slot     = box(heroWrap.getBoundingClientRect());
      const onScreen = rest
        .map((card) => ({ card, r: box(card.getBoundingClientRect()) }))
        .filter(({ r }) => r.y - r.h / 2 < window.innerHeight * 0.75)
        .sort((p, q) => Math.hypot(p.r.x - slot.x, p.r.y - slot.y) - Math.hypot(q.r.x - slot.x, q.r.y - slot.y))
        .map(({ card }) => card);

      // 3 — one continuous glide into the slot; the grid assembles around it.
      const progress = { u: 0 };
      const glide = gsap.timeline();
      glide.to(progress, {
        u: 1, duration: GLIDE_DURATION, ease: glideEase,
        onUpdate: () => flight.place(pose(progress.u)),
      }, 0);
      glide.call(() => flight.land(), null, GLIDE_DURATION);
      glide.fromTo('.project-cats-title',
        { autoAlpha: 0 },
        { autoAlpha: 1, duration: 0.3, clearProps: 'opacity,visibility' }, GLIDE_DURATION - 0.3);
      glide.to(heroInfo, { autoAlpha: 1, duration: 0.3, clearProps: 'opacity,visibility' }, GLIDE_DURATION);
      const held = new Map(onScreen.map((card) => [card, holdMedia(card)]));
      glide.to(onScreen, {
        autoAlpha: 1, duration: 0.5, ease: 'power1.out',
        stagger: { each: 0.06, onComplete() { releaseMedia(held.get(this.targets()[0])); } },
        clearProps: 'opacity,visibility,transform',
      }, GLIDE_DURATION - 0.15);
      await glide;

      // 4 — cards further down materialise one at a time as they scroll in.
      gridLayoutCtx.add(() => {
        rest.forEach((card) => {
          ScrollTrigger.create({
            trigger: card,
            start: 'top 75%',
            invalidateOnRefresh: true,
            onEnter: () => {
              const media = holdMedia(card);
              gsap.to(card, {
                autoAlpha: 1,  duration: .6, ease: 'power1.inOut',
                clearProps: 'opacity,visibility,transform,scale',
                onComplete: () => releaseMedia(media),
              });
            },
            onLeaveBack: () => gsap.to(card, {
              autoAlpha: 0,  duration: .3, ease: 'power1.inOut',
            }),
          });
        });
      });
    } finally {
      if (flight) flight.land();   // never leave the image stranded in the flight layer
    }
  }

  /* ── CHOREOGRAPHY · grid → list (the dissolve) ───────────────────────────── */

  async function toList() {
    const cards = projectSectionEls;

    // 1 — leave: scroll home while the whole grid fades out (hero included).
    const leave = gsap.timeline();
    scrollHome(leave);
    leave.to(cards, { autoAlpha: 0, duration: 0.35, ease: 'power1.in', stagger: { amount: 0.2 } }, 0);
    leave.to('.project-cats-title', { autoAlpha: 0, duration: 0.25 }, 0);
    await leave;

    // 2 — swap to the list while everything is invisible.
    setView('list');
    ScrollTrigger.refresh();

    // 3 — the list rises back in (over the native image flicker from setView).
    await gsap.fromTo(cards,
      { autoAlpha: 0, y: 24 },
      { autoAlpha: 1, y: 0, duration: 0.5, ease: 'power3.out',
        stagger: { amount: 0.35 }, clearProps: 'opacity,visibility,transform' });
  }

  /* ── ROUTER ──────────────────────────────────────────────────────────────── */

  async function toggleView() {
    if (isToggling) return;

    const nextView = currentView === 'list' ? 'grid' : 'list';
    setSwitchLabel(nextView); // instant feedback — don't wait on the choreography below

    // Reduced motion: swap instantly, no choreography.
    if (reduceMotion) {
      setView(nextView);
      ScrollTrigger.refresh();
      return;
    }

    isToggling = true;
    // Hold the page height so the swap reflow can't pull the footer in or shift scroll.
    gsap.set(projectsEl, { minHeight: projectsEl.offsetHeight });

    try {
      if (currentView === 'list') await toGrid(originalSectionOrder[0]);
      else                        await toList();
    } catch (err) {
      console.error('[view toggle] failed:', err);
    } finally {
      gsap.set(projectsEl, { clearProps: 'minHeight' });
      ScrollTrigger.refresh();
      isToggling = false;
    }
  }

  if (gridBtn) gridBtn.addEventListener('click', toggleView);

  /* ── INITIAL STATE ─────────────────────────────────────────────────────────
     The /work page opens in grid view; everywhere else (home) opens in list. */

  if (document.body.classList.contains('page-work')) {
    setView('grid');
    setSwitchLabel('grid');
    gsap.fromTo('.project-cats-title',
      { autoAlpha: 0},
      { autoAlpha: 1, duration: 0.3, clearProps: 'opacity,visibility' });
  } else {
    initOgLayout();
    initProjectSections();
  }
})();

  // Floats the grid-switch button up from below when the projects section is in view
    gsap.from('.grid-switch', {
      opacity: 0, y: 100,
      scrollTrigger: {
        trigger: '.projects',
        start: 'top 25%',
        end: 'bottom center',
        endTrigger: '.projects',
        toggleActions: 'play reverse play reverse',
      },
    });




  // ── CREATE PINK BG ────────────────────────────────────
  document.querySelectorAll('figure.wp-block-image img, .project-gradient img, .project-gradient video').forEach((img) => {
    const pinkBg = document.createElement('div');
    pinkBg.className = 'pink-bg';
    img.after(pinkBg);
  });

  // ── PINK REVEAL ON SCROLL ────────────────────────────────────
  // When the wrapper scrolls into view (and the media is ready), the media
  // fades in over its .pink-bg, then the pink fades out behind it.
  // Videos with a .video-poster: pink → poster (while the video is still
  // loading) → video. If the video is ready in time, the poster is skipped.
  // In the list (.og-layout) the pink is only a loading placeholder: media
  // that's already loaded shows straight away, and the rest fades in as soon
  // as it loads, without waiting to be scrolled to.
  function pinkReveal(wrap, selector) {
    const media = wrap.querySelector(selector);
    if (!media) return;
    const pinkBg = wrap.querySelector('.pink-bg');
    const poster = wrap.querySelector('.video-poster');
    const behind = [pinkBg, poster].filter(Boolean);
    const isVideo = media.tagName === 'VIDEO';
    const inList = () => !!wrap.closest('.og-layout');

    let loaded = isVideo ? media.readyState >= 3 : media.complete && media.naturalWidth > 0;
    let posterLoaded = false;
    let inView = false;
    let posterShown = false;
    let played = false;

    if (loaded && inList()) {
      gsap.set(media, { opacity: 1 });
      gsap.set(behind, { autoAlpha: 0 });
      return;
    }

    gsap.set(media, { opacity: 0 });

    function showPoster() {
      if (!poster || !posterLoaded || !inView || loaded || posterShown) return;
      posterShown = true;
      gsap.to(poster, { autoAlpha: 1, duration: 0.6, ease: 'power2.out' });
    }

    function reveal() {
      if (!loaded || !(inView || inList()) || played) return;
      played = true;
      gsap.killTweensOf(behind);
      const tl = gsap.timeline();
      tl.to(media, { opacity: 1, duration: 0.6, ease: 'power2.out' });
      if (behind.length) tl.to(behind, { autoAlpha: 0, duration: 0.4, ease: 'power1.inOut' });
    }

    if (!loaded) {
      media.addEventListener(isVideo ? 'canplay' : 'load', () => { loaded = true; reveal(); }, { once: true });
    }

    if (poster) {
      const url = (poster.style.backgroundImage.match(/url\(["']?(.*?)["']?\)/) || [])[1];
      if (url) {
        const img = new Image();
        img.onload = () => { posterLoaded = true; showPoster(); };
        img.src = url;
      }
    }

    ScrollTrigger.create({
      trigger: wrap,
      start: 'top 60%',
      once: true,
      invalidateOnRefresh: true,
      onEnter: () => { inView = true; showPoster(); reveal(); },
    });
  }

  document.querySelectorAll('.project-gradient').forEach((wrap) => pinkReveal(wrap, 'img, video'));
  document.querySelectorAll('.wp-block-image').forEach((wrap) => pinkReveal(wrap, 'img'));



  gsap.from(".stretch-mama:nth-of-type(1) .stretched-text, .horsey", {duration:1, yPercent:5, autoAlpha:0, ease: 'power3.out' });






gsap.fromTo(".archive .project-sections",  { autoAlpha: 0, y: 24 }, { autoAlpha: 1, y: 0, duration: .5, ease: 'power3.out', stagger:{from:"random", amount:0.35}});



    
});////END OF DOUCMENT

// ─── LAZY VIDEO ───────────────────────────────────────────────────────────────
// Videos below the fold use data-src on their <source> to avoid competing
// network requests on load. This observer swaps data-src → src when the
// video enters the viewport, then starts playback.
const lazyVideoObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (!entry.isIntersecting) return;
    const video = entry.target;
    video.querySelectorAll('source[data-src]').forEach((source) => {
      source.src = source.dataset.src;
      delete source.dataset.src;
    });
    video.load();
    video.play().catch(() => {});
    lazyVideoObserver.unobserve(video);
  });
}, { rootMargin: `${Math.max(window.innerHeight) * 3 }px` });

document.querySelectorAll('video.lazy-video').forEach((v) => lazyVideoObserver.observe(v));

// ─── REFRESH SCROLLTRIGGER AFTER IMAGES SETTLE ───────────────────────────────
// Images loading after the initial layout pass can shift section heights and
// throw off ScrollTrigger's start/end positions, so we refresh once every
// <img> has either loaded or errored (capped by a timeout so lazy/off-screen
// images that won't load until scrolled into view can't block it forever).
window.addEventListener('load', () => {
  const images = document.querySelectorAll('img');
  if (!images.length) {
    ScrollTrigger.refresh();
    return;
  }

  let remaining = images.length;
  let settled = false;

  function finish() {

    if (settled) return;
    settled = true;
    clearTimeout(timeoutId);
    ScrollTrigger.refresh();
    // refresh() recalculates start/end positions but scrub tweens that were
    // already at the "correct" progress before the recalc don't get
    // re-rendered until the next scroll. Force every trigger to render its
    // (possibly now-different) progress immediately.
    ScrollTrigger.getAll().forEach((st) => st.update());
  }

  function imageSettled() {
    if (--remaining === 0) finish();
  }

  const timeoutId = setTimeout(finish, 10000);

  images.forEach((img) => {
    if (img.complete) {
      imageSettled();
    } else {
      img.addEventListener('load', imageSettled, { once: true });
      img.addEventListener('error', imageSettled, { once: true });
    }
  });
});

// ─── CLICK TO COPY ────────────────────────────────────────────────────────────
// On desktop, clicking a .click-to-copy link copies its text (e.g. an email
// address) to the clipboard and shows a "Copied!" tooltip instead of
// navigating. On mobile the link opens normally (e.g. the mail app).
function copyToClipboard(text) {
  if (navigator.clipboard && window.isSecureContext) {
    navigator.clipboard.writeText(text);
    return;
  }

  // Fallback for non-secure contexts (e.g. local dev over http), where
  // navigator.clipboard is unavailable.
  const textarea = document.createElement('textarea');
  textarea.value = text;
  textarea.style.position = 'fixed';
  textarea.style.opacity = '0';
  document.body.appendChild(textarea);
  textarea.select();
  document.execCommand('copy');
  textarea.remove();
}

document.querySelectorAll('.click-to-copy a').forEach((link) => {
  link.addEventListener('click', (e) => {
    if (window.innerWidth < 1025) return;
    e.preventDefault();
    copyToClipboard(link.textContent.trim());

    const tooltip = document.createElement('span');
    tooltip.className = 'copied-tooltip';
    tooltip.textContent = 'Copied!';
    link.closest('.click-to-copy').appendChild(tooltip);

    gsap.fromTo(tooltip, { opacity: 0, y: 10 }, { opacity: 1, y: 0, duration: 0.25 });
    gsap.to(tooltip, {
      opacity: 0,
      y: -10,
      duration: 0.25,
      delay: 1.2,
      onComplete: () => tooltip.remove(),
    });
  });
});

// ─── RESIZE ───────────────────────────────────────────────────────────────────
// Tells ScrollTrigger to recalculate all trigger positions after a resize.
// The ResizeObserver catches container-level size changes (e.g. font load reflow)
// that window resize alone doesn't catch.

window.addEventListener('resize', () => ScrollTrigger.refresh());

const mainEl = document.querySelector('.site-main');
if (mainEl) {
  let roTimer;
  const ro = new ResizeObserver(() => {
    clearTimeout(roTimer);
    roTimer = setTimeout(() => ScrollTrigger.refresh(), 100);
  });
  ro.observe(mainEl);
}
