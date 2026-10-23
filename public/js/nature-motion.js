/* Progressive motion: content is visible even when JavaScript is unavailable. */
(() => {
  const root = document.documentElement;
  const preference = matchMedia('(prefers-reduced-motion: reduce)');
  let paused = false;
  try { paused = localStorage.getItem('simplepos-motion') === 'paused'; } catch (_) {}
  const controls = document.querySelectorAll('.motion-toggle');
  const hero = document.querySelector('[data-parallax-hero]');
  const update = () => {
    const stopped = paused || preference.matches;
    root.classList.toggle('motion-paused', stopped);
    controls.forEach(button => {
      button.textContent = stopped ? 'Motion paused' : 'Pause motion';
      button.setAttribute('aria-pressed', String(stopped));
      button.disabled = preference.matches;
    });
    if (stopped && hero) {
      hero.style.setProperty('--hero-x', '0px');
      hero.style.setProperty('--hero-y', '0px');
    }
  };
  controls.forEach(button => button.addEventListener('click', () => {
    paused = !paused;
    try { localStorage.setItem('simplepos-motion', paused ? 'paused' : 'on'); } catch (_) {}
    update();
  }));
  preference.addEventListener('change', update);
  update();
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      if (!paused && !preference.matches) entry.target.classList.add('is-arriving');
      observer.unobserve(entry.target);
    }), { threshold: 0.08 });
    document.querySelectorAll('.section-block,.page-heading,.table-panel,.directory-grid,.about-intro,.architecture-grid,.listing,.card-grid').forEach(el => observer.observe(el));
  }
  if (hero && matchMedia('(pointer:fine)').matches) {
    let frame = 0;
    hero.addEventListener('pointermove', event => {
      if (paused || preference.matches) return;
      cancelAnimationFrame(frame);
      const { left, top, width, height } = hero.getBoundingClientRect();
      const x = ((event.clientX - left) / width - 0.5) * 14;
      const y = ((event.clientY - top) / height - 0.5) * 10;
      frame = requestAnimationFrame(() => {
        hero.style.setProperty('--hero-x', `${x.toFixed(1)}px`);
        hero.style.setProperty('--hero-y', `${y.toFixed(1)}px`);
      });
    });
    hero.addEventListener('pointerleave', () => {
      cancelAnimationFrame(frame);
      hero.style.setProperty('--hero-x', '0px');
      hero.style.setProperty('--hero-y', '0px');
    });
  }
  document.addEventListener('visibilitychange', () => root.classList.toggle('page-hidden', document.hidden));
})();
