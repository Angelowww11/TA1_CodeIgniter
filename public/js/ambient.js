(() => {
    const canvas = document.getElementById('ambient-particles');
    if (!canvas) return;

    const context = canvas.getContext('2d', { alpha: true });
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const palette = ['#b97852', '#9cae9c', '#d3ad78'];
    let particles = [];
    let width = 0;
    let height = 0;
    let frame = 0;

    function resize() {
        const ratio = Math.min(window.devicePixelRatio || 1, 1.5);
        width = window.innerWidth;
        height = window.innerHeight;
        canvas.width = Math.round(width * ratio);
        canvas.height = Math.round(height * ratio);
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;
        context.setTransform(ratio, 0, 0, ratio, 0, 0);
        const count = Math.min(58, Math.max(24, Math.round((width * height) / 27000)));
        particles = Array.from({ length: count }, (_, index) => ({
            x: Math.random() * width,
            y: Math.random() * height,
            radius: index % 9 === 0 ? 2 : 0.8 + Math.random() * 0.8,
            speedX: (Math.random() - 0.5) * 0.13,
            speedY: -0.06 - Math.random() * 0.13,
            color: palette[index % palette.length],
            alpha: 0.12 + Math.random() * 0.2,
        }));
        paint(false);
    }

    function paint(animate = true) {
        context.clearRect(0, 0, width, height);
        for (let i = 0; i < particles.length; i += 1) {
            const dot = particles[i];
            if (animate) {
                dot.x += dot.speedX;
                dot.y += dot.speedY;
                if (dot.x < -8) dot.x = width + 8;
                if (dot.x > width + 8) dot.x = -8;
                if (dot.y < -8) { dot.y = height + 8; dot.x = Math.random() * width; }
            }
            context.beginPath();
            context.arc(dot.x, dot.y, dot.radius, 0, Math.PI * 2);
            context.fillStyle = dot.color;
            context.globalAlpha = dot.alpha;
            context.fill();

            for (let j = i + 1; j < particles.length; j += 1) {
                const other = particles[j];
                const dx = dot.x - other.x;
                const dy = dot.y - other.y;
                const distance = Math.hypot(dx, dy);
                if (distance < 112) {
                    context.beginPath();
                    context.moveTo(dot.x, dot.y);
                    context.lineTo(other.x, other.y);
                    context.strokeStyle = '#a27b5f';
                    context.globalAlpha = (1 - distance / 112) * 0.075;
                    context.lineWidth = 0.7;
                    context.stroke();
                }
            }
        }
        context.globalAlpha = 1;
        if (animate && !reducedMotion.matches && !document.hidden) frame = window.requestAnimationFrame(() => paint());
    }

    function stop() {
        window.cancelAnimationFrame(frame);
        paint(false);
    }

    function start() {
        window.cancelAnimationFrame(frame);
        paint(true);
    }

    window.addEventListener('resize', resize, { passive: true });
    document.addEventListener('visibilitychange', () => document.hidden ? stop() : start());
    reducedMotion.addEventListener('change', () => reducedMotion.matches ? stop() : start());
    resize();
    if (!reducedMotion.matches) start();
})();
