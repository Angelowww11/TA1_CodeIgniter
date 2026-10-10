(() => {
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (!reduceMotion && 'IntersectionObserver' in window) {
    document.documentElement.classList.add('js-motion');
    const reveal = new IntersectionObserver((entries, observer) => {
      for (const entry of entries) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      }
    }, { threshold: 0.08 });
    document.querySelectorAll('.rise-in').forEach(element => reveal.observe(element));
  }

  const hero = document.querySelector('[data-parallax-hero]');
  if (hero && !reduceMotion && window.matchMedia('(pointer: fine)').matches) {
    hero.addEventListener('pointermove', event => {
      const bounds = hero.getBoundingClientRect();
      const x = ((event.clientX - bounds.left) / bounds.width - 0.5) * 10;
      const y = ((event.clientY - bounds.top) / bounds.height - 0.5) * 10;
      hero.style.setProperty('--hero-x', `${x.toFixed(1)}px`);
      hero.style.setProperty('--hero-y', `${y.toFixed(1)}px`);
    });
    hero.addEventListener('pointerleave', () => {
      hero.style.setProperty('--hero-x', '0px');
      hero.style.setProperty('--hero-y', '0px');
    });
  }

  const filters = document.querySelector('[data-task-filters]');
  if (filters) {
    const rows = [...document.querySelectorAll('[data-task-status]')];
    const announcement = document.querySelector('[data-task-count]');
    filters.addEventListener('click', event => {
      const button = event.target.closest('button[data-status]');
      if (!button || !filters.contains(button)) return;
      const selected = button.dataset.status;
      let count = 0;
      rows.forEach(row => {
        row.hidden = selected !== 'all' && row.dataset.taskStatus !== selected;
        if (!row.hidden) count++;
      });
      filters.querySelectorAll('button[data-status]').forEach(item => {
        const active = item === button;
        item.classList.toggle('is-selected', active);
        item.setAttribute('aria-pressed', String(active));
      });
      if (announcement) announcement.textContent = `${count} ${count === 1 ? 'task' : 'tasks'} shown`;
    });
  }
})();
