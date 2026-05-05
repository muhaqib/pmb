/**
 * PMB STIT Mambaul Hikmah - Main Application Script
 * Institutional Excellence Design System
 */

// Intersection Observer for scroll-based animations
document.addEventListener('DOMContentLoaded', () => {
    // Animate elements on scroll
    const animateOnScroll = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    document.querySelectorAll('[data-animate]').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = `opacity 0.6s ease ${el.dataset.delay || '0s'}, transform 0.6s ease ${el.dataset.delay || '0s'}`;
        animateOnScroll.observe(el);
    });

    // Counter animation for statistics
    document.querySelectorAll('[data-count]').forEach(counter => {
        const target = parseInt(counter.dataset.count);
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const interval = setInterval(() => {
                        current += step;
                        if (current >= target) {
                            current = target;
                            clearInterval(interval);
                        }
                        counter.textContent = Math.floor(current).toLocaleString('id-ID');
                    }, 16);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        observer.observe(counter);
    });
});
