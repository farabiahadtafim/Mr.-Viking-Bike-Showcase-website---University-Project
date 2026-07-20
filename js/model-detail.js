/* ============================================
   MR. VIKING - Model Detail Page JavaScript
   ============================================ */

document.addEventListener('DOMContentLoaded', () => {
    SpecsTabs.init();
    ColorConfigurator.init();
    DetailScrollReveal.init();
    ModelHeroParallax.init();
});

/* ============================================
   Specifications Tabs
   ============================================ */
const SpecsTabs = {
    init() {
        const tabs = document.querySelectorAll('.spec-tab');
        const panels = document.querySelectorAll('.spec-panel');
        if (!tabs.length) return;

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.dataset.tab;

                // Deactivate all
                tabs.forEach(t => t.classList.remove('active'));
                panels.forEach(p => {
                    p.classList.remove('active');
                    p.style.display = 'none';
                });

                // Activate selected
                tab.classList.add('active');
                const panel = document.getElementById(`panel-${target}`);
                if (panel) {
                    panel.style.display = 'block';
                    requestAnimationFrame(() => {
                        panel.classList.add('active');
                    });
                }

                // Animate rows in
                const rows = panel ? panel.querySelectorAll('.spec-row') : [];
                rows.forEach((row, i) => {
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(-20px)';
                    setTimeout(() => {
                        row.style.transition = 'all 0.4s cubic-bezier(0.16, 1, 0.3, 1)';
                        row.style.opacity = '1';
                        row.style.transform = 'translateX(0)';
                    }, i * 50);
                });
            });
        });

        // Trigger initial row animation
        const activePanel = document.querySelector('.spec-panel.active');
        if (activePanel) {
            const rows = activePanel.querySelectorAll('.spec-row');
            rows.forEach((row, i) => {
                row.style.opacity = '0';
                setTimeout(() => {
                    row.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    row.style.opacity = '1';
                }, 300 + i * 60);
            });
        }
    }
};

/* ============================================
   Color Configurator
   ============================================ */
const ColorConfigurator = {
    init() {
        const options = document.querySelectorAll('.color-option');
        const configImage = document.getElementById('configImage');
        if (!options.length) return;

        // Color tint filters to simulate color changes
        const colorFilters = {
            'Ago Red/Silver':    'hue-rotate(0deg) saturate(1.2)',
            'Pearl White/Red':   'hue-rotate(0deg) saturate(0.3) brightness(1.4)',
            'Matt Black/Gold':   'hue-rotate(0deg) saturate(0.1) brightness(0.7)',
            'Racing Blue/White': 'hue-rotate(200deg) saturate(1.5)',
        };

        options.forEach(option => {
            option.addEventListener('click', () => {
                options.forEach(o => o.classList.remove('active'));
                option.classList.add('active');

                const colorName = option.dataset.color;

                if (configImage) {
                    // Fade out, apply filter, fade in
                    configImage.style.transition = 'opacity 0.3s ease';
                    configImage.style.opacity = '0';
                    setTimeout(() => {
                        configImage.style.filter = colorFilters[colorName] || 'none';
                        configImage.style.opacity = '1';
                    }, 300);
                }
            });
        });
    }
};

/* ============================================
   Detail Page Scroll Reveal
   ============================================ */
const DetailScrollReveal = {
    init() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    // Stagger sibling cards
                    const siblings = entry.target.parentElement.querySelectorAll(
                        '.design-feature-card, .related-card'
                    );
                    const idx = Array.from(siblings).indexOf(entry.target);
                    entry.target.style.transitionDelay = `${idx * 0.12}s`;
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

        // Observe feature cards
        document.querySelectorAll('.design-feature-card, .related-card').forEach(el => {
            observer.observe(el);
        });

        // Generic reveal for design text
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll(
            '.design-text .section-label, .design-title, .design-description, ' +
            '.showcase-overlay, .config-price-tag, .color-options, .model-cta-content'
        ).forEach(el => {
            el.classList.add('reveal');
            revealObserver.observe(el);
        });

        document.querySelectorAll('.design-text').forEach(el => {
            el.classList.add('reveal-left');
            revealObserver.observe(el);
        });

        // Spec rows hover effect (subtle glow)
        document.querySelectorAll('.spec-row').forEach(row => {
            row.addEventListener('mouseenter', () => {
                row.style.background = 'rgba(200, 16, 46, 0.04)';
                row.style.paddingLeft = '12px';
            });
            row.addEventListener('mouseleave', () => {
                row.style.background = '';
                row.style.paddingLeft = '';
            });
        });
    }
};

/* ============================================
   Model Hero Mouse Parallax
   ============================================ */
const ModelHeroParallax = {
    init() {
        const hero = document.getElementById('modelHero');
        const img = document.getElementById('modelHeroImg');
        if (!hero || !img) return;

        hero.addEventListener('mousemove', (e) => {
            const rect = hero.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width - 0.5) * 25;
            const y = ((e.clientY - rect.top) / rect.height - 0.5) * 15;
            img.style.transform = `translate(${x}px, ${y}px) scale(1.03)`;
        });

        hero.addEventListener('mouseleave', () => {
            img.style.transform = '';
        });

        // Scroll parallax on hero image
        window.addEventListener('scroll', () => {
            if (window.scrollY < window.innerHeight) {
                const progress = window.scrollY / window.innerHeight;
                img.style.transform = `translateY(${progress * 60}px) scale(${1 - progress * 0.05})`;
            }
        }, { passive: true });
    }
};

/* ============================================
   Tilt on related cards
   ============================================ */
document.querySelectorAll('.related-card').forEach(card => {
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;
        card.style.transform = `perspective(800px) rotateY(${x * 6}deg) rotateX(${-y * 6}deg) translateY(-6px)`;
    });
    card.addEventListener('mouseleave', () => {
        card.style.transform = '';
    });
});
