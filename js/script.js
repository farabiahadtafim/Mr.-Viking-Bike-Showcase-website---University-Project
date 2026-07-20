/* ============================================
   MR. VIKING - Premium Motorcycle Website
   JavaScript - Animations & Interactions
   ============================================ */

document.addEventListener('DOMContentLoaded', () => {
    // Initialize all modules
    Preloader.init();
    Header.init();
    MobileMenu.init();
    MegaMenu.init();
    HeroSlider.init();
    ScrollReveal.init();
    ParallaxEffects.init();
    CounterAnimation.init();
    SmoothScroll.init();
    NewsletterForm.init();
    Auth.init();
    SearchManager.init();
});

/* ============================================
   Preloader
   ============================================ */
const Preloader = {
    init() {
        const preloader = document.getElementById('preloader');
        if (!preloader) return;

        window.addEventListener('load', () => {
            setTimeout(() => {
                preloader.classList.add('loaded');
                document.body.style.overflow = 'auto';
            }, 2200);
        });

        // Fallback - force hide after 4 seconds
        setTimeout(() => {
            preloader.classList.add('loaded');
            document.body.style.overflow = 'auto';
        }, 4000);
    }
};



/* ============================================
   Header
   ============================================ */
const Header = {
    header: null,
    lastScrollY: 0,

    init() {
        this.header = document.getElementById('header');
        if (!this.header) return;

        window.addEventListener('scroll', () => this.onScroll(), { passive: true });
    },

    onScroll() {
        const scrollY = window.scrollY;

        if (scrollY > 80) {
            this.header.classList.add('scrolled');
        } else {
            this.header.classList.remove('scrolled');
        }

        // Hide/show on scroll direction
        if (scrollY > this.lastScrollY && scrollY > 200) {
            this.header.style.transform = 'translateY(-100%)';
        } else {
            this.header.style.transform = 'translateY(0)';
        }

        this.lastScrollY = scrollY;
    }
};

/* ============================================
   Mobile Menu
   ============================================ */
const MobileMenu = {
    toggle: null,
    menu: null,
    isOpen: false,

    init() {
        this.toggle = document.getElementById('menuToggle');
        this.menu = document.getElementById('fullscreenMenu');
        if (!this.toggle || !this.menu) return;

        this.toggle.addEventListener('click', () => this.toggleMenu());

        // Close menu on link click
        const links = this.menu.querySelectorAll('.fullscreen-nav-link');
        links.forEach(link => {
            link.addEventListener('click', () => {
                this.closeMenu();
            });
        });

        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.closeMenu();
            }
        });
    },

    toggleMenu() {
        this.isOpen = !this.isOpen;
        this.toggle.classList.toggle('active');
        this.menu.classList.toggle('active');
        document.body.style.overflow = this.isOpen ? 'hidden' : '';
    },

    closeMenu() {
        this.isOpen = false;
        this.toggle.classList.remove('active');
        this.menu.classList.remove('active');
        document.body.style.overflow = '';
    }
};

/* ============================================
   Search Manager
   ============================================ */
const SearchManager = {
    overlay: null,
    input: null,
    suggestions: null,
    closeBtn: null,
    openBtns: null,

    init() {
        this.overlay = document.getElementById('searchOverlay');
        this.input = document.getElementById('searchInput');
        this.suggestions = document.getElementById('searchSuggestions');
        this.closeBtn = document.getElementById('searchClose');
        this.openBtns = document.querySelectorAll('#searchBtn, #searchHeaderBtn');

        if (!this.overlay || !this.input) return;

        this.openBtns.forEach(btn => {
            btn.addEventListener('click', () => this.openSearch());
        });

        this.closeBtn.addEventListener('click', () => this.closeSearch());

        this.input.addEventListener('input', (e) => this.handleInput(e.target.value));

        this.input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && this.input.value.trim()) {
                this.executeSearch(this.input.value.trim());
            }
            if (e.key === 'Escape') {
                this.closeSearch();
            }
        });

        // Close on clicking outside container
        this.overlay.addEventListener('click', (e) => {
            if (e.target === this.overlay) this.closeSearch();
        });
    },

    openSearch() {
        this.overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        setTimeout(() => this.input.focus(), 300);
    },

    closeSearch() {
        this.overlay.classList.remove('active');
        document.body.style.overflow = '';
        this.input.value = '';
        this.suggestions.innerHTML = '';
    },

    handleInput(value) {
        if (!value.trim()) {
            this.suggestions.innerHTML = '';
            return;
        }

        const query = value.toLowerCase().trim();
        const matches = Object.values(bikeData).filter(bike =>
            bike.name.toLowerCase().includes(query) ||
            bike.family.toLowerCase().includes(query)
        ).slice(0, 5); // Limit to 5 suggestions

        this.renderSuggestions(matches);
    },

    renderSuggestions(matches) {
        this.suggestions.innerHTML = matches.map(bike => `
            <div class="suggestion-item" data-id="${bike.id}">
                <img src="${bike.thumbnail}" alt="${bike.name}" class="suggestion-img" onerror="this.src='images/hero-motorcycle.png'">
                <div class="suggestion-info">
                    <span class="suggestion-name">${bike.name}</span>
                    <span class="suggestion-brand">${bike.brand}</span>
                </div>
            </div>
        `).join('');

        this.suggestions.querySelectorAll('.suggestion-item').forEach(item => {
            item.addEventListener('click', () => {
                this.executeSearch(item.querySelector('.suggestion-name').textContent);
            });
        });
    },

    executeSearch(query) {
        window.location.href = `motorcycles.html?search=${encodeURIComponent(query)}`;
    }
};

/* ============================================
   Hero Slider
   ============================================ */
const HeroSlider = {
    container: null,
    slides: [],
    dots: [],
    currentIndex: 0,
    interval: null,
    duration: 5000,

    init() {
        this.container = document.getElementById('heroSlider');
        if (!this.container) return;

        this.slides = this.container.querySelectorAll('.slide');
        this.dots = this.container.querySelectorAll('.dot');

        const nextBtn = this.container.querySelector('.slider-arrow.next');
        const prevBtn = this.container.querySelector('.slider-arrow.prev');

        if (nextBtn) nextBtn.addEventListener('click', () => this.nextSlide());
        if (prevBtn) prevBtn.addEventListener('click', () => this.prevSlide());

        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', () => this.goToSlide(index));
        });

        this.startAutoPlay();
    },

    nextSlide() {
        let index = this.currentIndex + 1;
        if (index >= this.slides.length) index = 0;
        this.goToSlide(index);
    },

    prevSlide() {
        let index = this.currentIndex - 1;
        if (index < 0) index = this.slides.length - 1;
        this.goToSlide(index);
    },

    goToSlide(index) {
        if (index === this.currentIndex) return;

        this.slides[this.currentIndex].classList.remove('active');
        this.dots[this.currentIndex].classList.remove('active');

        this.currentIndex = index;

        this.slides[this.currentIndex].classList.add('active');
        this.dots[this.currentIndex].classList.add('active');

        this.resetAutoPlay();
    },

    startAutoPlay() {
        this.interval = setInterval(() => this.nextSlide(), this.duration);
    },

    resetAutoPlay() {
        clearInterval(this.interval);
        this.startAutoPlay();
    }
};

/* ============================================
   Scroll Reveal
   ============================================ */
const ScrollReveal = {
    init() {
        // Add reveal classes to elements
        this.addRevealClasses();

        // Create Intersection Observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');

                    // Stagger children animations
                    const staggerChildren = entry.target.querySelectorAll('[data-stagger]');
                    staggerChildren.forEach((child, index) => {
                        child.style.transitionDelay = `${index * 0.1}s`;
                        child.classList.add('visible');
                    });
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Observe elements
        const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .model-card, .innovation-card');
        revealElements.forEach(el => observer.observe(el));
    },

    addRevealClasses() {
        // Section headers
        document.querySelectorAll('.section-header, .section-label, .featured-label').forEach(el => {
            if (!el.classList.contains('reveal')) el.classList.add('reveal');
        });

        // Section titles
        document.querySelectorAll('.section-title, .featured-title, .heritage-title, .racing-title, .newsletter-title').forEach(el => {
            if (!el.classList.contains('reveal')) el.classList.add('reveal');
        });

        // Descriptions
        document.querySelectorAll('.section-subtitle, .featured-description, .heritage-text, .racing-text, .newsletter-subtitle').forEach(el => {
            if (!el.classList.contains('reveal')) el.classList.add('reveal');
        });

        // Heritage section
        document.querySelectorAll('.heritage-left').forEach(el => el.classList.add('reveal-left'));
        document.querySelectorAll('.heritage-right').forEach(el => el.classList.add('reveal-right'));

        // Specs & timeline
        document.querySelectorAll('.featured-specs, .heritage-timeline, .racing-stats').forEach(el => {
            if (!el.classList.contains('reveal')) el.classList.add('reveal');
        });

        // CTAs
        document.querySelectorAll('.hero-cta, .newsletter-form').forEach(el => {
            if (!el.classList.contains('reveal')) el.classList.add('reveal');
        });
    }
};

/* ============================================
   Parallax Effects
   ============================================ */
const ParallaxEffects = {
    init() {
        const featuredImg = document.getElementById('featuredImg');

        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            const vh = window.innerHeight;

            // Featured image parallax
            if (featuredImg) {
                const rect = featuredImg.getBoundingClientRect();
                if (rect.top < vh && rect.bottom > 0) {
                    const progress = (vh - rect.top) / (vh + rect.height);
                    featuredImg.style.transform = `translateY(${(progress - 0.5) * 30}px)`;
                }
            }

            // Heritage cards parallax
            const heritageCards = document.querySelectorAll('.heritage-image-card');
            heritageCards.forEach((card, i) => {
                const rect = card.getBoundingClientRect();
                if (rect.top < vh && rect.bottom > 0) {
                    const progress = (vh - rect.top) / (vh + rect.height);
                    const speed = i === 0 ? -15 : 15;
                    card.style.transform = `translateY(${(progress - 0.5) * speed}px)`;
                }
            });

        }, { passive: true });
    }
};

/* ============================================
   Counter Animation
   ============================================ */
const CounterAnimation = {
    init() {
        const counters = document.querySelectorAll('.racing-stat-number[data-count]');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => observer.observe(counter));
    },

    animateCounter(element) {
        const target = parseInt(element.getAttribute('data-count'));
        const duration = 2000;
        const startTime = performance.now();

        const update = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Easing function
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const current = Math.round(target * easeOutQuart);

            element.textContent = current;

            if (progress < 1) {
                requestAnimationFrame(update);
            }
        };

        requestAnimationFrame(update);
    }
};

/* ============================================
   Smooth Scroll
   ============================================ */
const SmoothScroll = {
    init() {
        document.querySelectorAll('a[href^="#"]').forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');
                if (href === '#') return;

                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const offsetTop = target.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }
};

/* ============================================
   Newsletter Form
   ============================================ */
const NewsletterForm = {
    init() {
        const form = document.getElementById('newsletterForm');
        if (!form) return;

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('newsletterEmail');
            if (email && email.value) {
                // Simulate submission
                const btn = form.querySelector('.newsletter-btn');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<span>Subscribed! âœ“</span>';
                btn.style.background = '#27ae60';
                email.value = '';

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.background = '';
                }, 3000);
            }
        });
    }
};

/* ============================================
   Magnetic Button Effect
   ============================================ */
document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('mousemove', (e) => {
        const rect = btn.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;

        btn.style.transform = `translate(${x * 0.15}px, ${y * 0.15}px)`;
    });

    btn.addEventListener('mouseleave', () => {
        btn.style.transform = '';
    });
});

/* ============================================
   Tilt Effect on Model Cards
   ============================================ */
document.querySelectorAll('.model-card').forEach(card => {
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;

        card.style.transform = `perspective(1000px) rotateY(${x * 5}deg) rotateX(${-y * 5}deg) translateY(-8px)`;
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = '';
    });
});

/* ============================================
   Image Lazy Loading with Fade
   ============================================ */
document.querySelectorAll('img[loading="lazy"]').forEach(img => {
    img.style.opacity = '0';
    img.style.transition = 'opacity 0.5s ease';

    if (img.complete) {
        img.style.opacity = '1';
    } else {
        img.addEventListener('load', () => {
            img.style.opacity = '1';
        });
    }
});

/* ============================================
   Text Scramble Effect (for nav hover)
   ============================================ */
class TextScramble {
    constructor(el) {
        this.el = el;
        this.chars = '!<>-_\\[]{}-=+*^?#________';
        this.update = this.update.bind(this);
    }

    setText(newText) {
        const oldText = this.el.innerText;
        const length = Math.max(oldText.length, newText.length);
        const promise = new Promise(resolve => this.resolve = resolve);
        this.queue = [];

        for (let i = 0; i < length; i++) {
            const from = oldText[i] || '';
            const to = newText[i] || '';
            const start = Math.floor(Math.random() * 40);
            const end = start + Math.floor(Math.random() * 40);
            this.queue.push({ from, to, start, end });
        }

        cancelAnimationFrame(this.frameRequest);
        this.frame = 0;
        this.update();
        return promise;
    }

    update() {
        let output = '';
        let complete = 0;

        for (let i = 0, n = this.queue.length; i < n; i++) {
            let { from, to, start, end, char } = this.queue[i];

            if (this.frame >= end) {
                complete++;
                output += to;
            } else if (this.frame >= start) {
                if (!char || Math.random() < 0.28) {
                    char = this.randomChar();
                    this.queue[i].char = char;
                }
                output += `<span style="color: var(--color-accent); opacity: 0.7">${char}</span>`;
            } else {
                output += from;
            }
        }

        this.el.innerHTML = output;

        if (complete === this.queue.length) {
            this.resolve();
        } else {
            this.frameRequest = requestAnimationFrame(this.update);
            this.frame++;
        }
    }

    randomChar() {
        return this.chars[Math.floor(Math.random() * this.chars.length)];
    }
}

// Apply text scramble to nav links
document.querySelectorAll('.nav-link').forEach(link => {
    const scramble = new TextScramble(link);
    const originalText = link.textContent;

    link.addEventListener('mouseenter', () => {
        scramble.setText(originalText);
    });
});

/* ============================================
   Mega Menu - Motorcycles Hover Panel
   ============================================ */
const MegaMenu = {
    navItem: null,
    menu: null,
    backdrop: null,
    familyList: null,
    variantList: null,
    previewImg: null,
    variantName: null,
    badge: null,
    modelTitle: null,
    specCyl: null,
    specCc: null,
    specHp: null,
    exploreBtn: null,
    closeTimer: null,
    isOpen: false,

    init() {
        this.navItem = document.getElementById('navMotorcycles');
        this.menu = document.getElementById('megaMenu');
        this.backdrop = document.getElementById('megaMenuBackdrop');
        this.familyList = document.getElementById('megaFamilyList');
        this.variantList = document.getElementById('megaVariantList');

        this.previewImg = document.getElementById('megaPreviewImg');
        this.variantName = document.getElementById('megaVariantName');
        this.badge = document.getElementById('megaBadge');
        this.modelTitle = document.getElementById('megaModelTitle');
        this.specCyl = document.getElementById('megaSpecCyl');
        this.specCc = document.getElementById('megaSpecCc');
        this.specHp = document.getElementById('megaSpecHp');
        this.exploreBtn = document.getElementById('megaExploreBtn');

        if (!this.navItem || !this.menu) return;

        this.navItem.addEventListener('mouseenter', () => this.open());
        this.navItem.addEventListener('mouseleave', () => this.scheduleClose());
        this.menu.addEventListener('mouseenter', () => this.cancelClose());
        this.menu.addEventListener('mouseleave', () => this.scheduleClose());

        if (this.backdrop) this.backdrop.addEventListener('click', () => this.close());
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && this.isOpen) this.close(); });
    },

    open() {
        this.cancelClose();
        if (this.isOpen) return;
        this.isOpen = true;
        this.menu.classList.add('open');
        if (this.backdrop) this.backdrop.classList.add('active');
        this.renderFamilies();
    },

    validateLoginEmail(input) {
        const val = input.value.trim();
        const errorBox = document.getElementById('loginIdError');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const mobileRegex = /^[0-9+]{10,15}$/;

        if (val === '') {
            if (errorBox) errorBox.style.display = 'none';
            return;
        }

        if (emailRegex.test(val) || mobileRegex.test(val)) {
            if (errorBox) errorBox.style.display = 'none';
            input.style.borderColor = 'rgba(255,255,255,0.1)';
        } else {
            if (errorBox) {
                errorBox.style.display = 'block';
                if (val.includes('@') && !val.includes('.')) {
                    errorBox.textContent = 'Missing "." (e.g. .com) in email';
                } else if (!val.includes('@')) {
                    errorBox.textContent = 'Invalid email format (missing @)';
                } else {
                    errorBox.textContent = 'Invalid email or mobile format';
                }
            }
            input.style.borderColor = '#ff4d4d';
        }
    },

    close() {
        this.isOpen = false;
        this.menu.classList.remove('open');
        if (this.backdrop) this.backdrop.classList.remove('active');
    },

    scheduleClose() { this.closeTimer = setTimeout(() => this.close(), 150); },
    cancelClose() { clearTimeout(this.closeTimer); },

    renderFamilies() {
        if (!this.familyList) return;
        this.familyList.innerHTML = '';

        Object.keys(familyData).forEach((family, idx) => {
            const item = document.createElement('div');
            item.className = 'mega-model-item';
            item.innerHTML = `<span class="mega-model-name">${family}</span>`;
            item.addEventListener('mouseenter', () => this.switchFamily(family, item));
            this.familyList.appendChild(item);
            if (idx === 0) this.switchFamily(family, item);
        });
    },

    switchFamily(family, element) {
        this.familyList.querySelectorAll('.mega-model-item').forEach(i => i.classList.remove('active'));
        element.classList.add('active');

        this.variantList.innerHTML = '';
        const models = familyData[family] || [];

        models.forEach((modelId, idx) => {
            const bike = bikeData[modelId] || { name: modelId.toUpperCase() };
            const item = document.createElement('div');
            item.className = 'mega-model-item';
            item.innerHTML = `<span class="mega-model-name">${bike.variant || bike.name}</span>`;
            item.addEventListener('mouseenter', () => this.switchPreview(modelId, item));
            this.variantList.appendChild(item);
            if (idx === 0) this.switchPreview(modelId, item);
        });
    },

    switchPreview(modelId, element) {
        this.variantList.querySelectorAll('.mega-model-item').forEach(i => i.classList.remove('active'));
        element.classList.add('active');

        const bike = bikeData[modelId];
        if (!bike) return;

        if (this.previewImg) {
            this.previewImg.classList.add('switching');
            setTimeout(() => {
                this.previewImg.src = bike.heroImage;
                this.variantName.textContent = bike.variant || '';
                this.badge.textContent = bike.badge || '';
                this.badge.style.display = bike.badge ? 'inline-block' : 'none';
                this.modelTitle.textContent = bike.family;
                this.specCyl.textContent = bike.stats.cylinders;
                this.specCc.innerHTML = `${bike.stats.capacity}<sup>cc</sup>`;
                this.specHp.innerHTML = `${bike.stats.hp}<sup>HP</sup>`;
                this.exploreBtn.href = `product.html?model=${modelId}`;
                this.exploreBtn.textContent = `Explore ${bike.name} →`;
                this.previewImg.classList.remove('switching');
            }, 250);
        }
    }
};

/* ============================================
   Auth System - Login & Signup
   ============================================ */
const Auth = {
    modal: null,
    loginBtn: null,
    authClose: null,
    authCloseBtn: null,
    toSignup: null,
    toLogin: null,
    loginView: null,
    signupView: null,
    toggleContact: null,
    contactLabel: null,
    signupContact: null,
    isMobileMode: false,

    init() {
        this.modal = document.getElementById('authModal');
        this.loginBtn = document.getElementById('loginBtn');
        this.authClose = document.getElementById('authClose');
        this.authCloseBtn = document.getElementById('authCloseBtn');
        this.toSignup = document.getElementById('toSignup');
        this.toLogin = document.getElementById('toLogin');
        this.loginView = document.getElementById('loginView');
        this.signupView = document.getElementById('signupView');
        this.toggleContact = document.getElementById('toggleContact');
        this.contactLabel = document.getElementById('contactLabel');
        this.signupContact = document.getElementById('signupContact');

        if (!this.modal || !this.loginBtn) return;

        this.loginBtn.addEventListener('click', () => this.open());
        this.authClose.addEventListener('click', () => this.close());
        this.authCloseBtn.addEventListener('click', () => this.close());
        this.toSignup.addEventListener('click', (e) => { e.preventDefault(); this.switchView('signup'); });
        this.toLogin.addEventListener('click', (e) => { e.preventDefault(); this.switchView('login'); });
        this.toggleContact.addEventListener('click', () => this.toggleContactMethod());

        // Handle Forms
        document.getElementById('loginForm').addEventListener('submit', (e) => this.handleLogin(e));
        document.getElementById('signupForm').addEventListener('submit', (e) => this.handleSignup(e));
        document.getElementById('logoutBtn').addEventListener('click', () => this.handleLogout());

        // Social Buttons
        document.getElementById('googleAuthBtn').addEventListener('click', () => {
            window.location.href = 'auth_handler.php?action=googleLogin';
        });
        document.getElementById('facebookAuthBtn').addEventListener('click', () => this.handleSocialAuth('Facebook'));

        // Forgot Password
        const forgotLink = document.getElementById('forgotPasswordLink');
        if (forgotLink) {
            forgotLink.addEventListener('click', (e) => {
                e.preventDefault();
                this.showForgotPasswordForm();
            });
        }

        // Check if already logged in (Simulated for now, will be connected to PHP)
        this.checkLoginStatus();
    },

    handleSocialAuth(provider) {
        const width = provider === 'Facebook' ? 900 : 500;
        const height = 650;
        const left = (window.innerWidth / 2) - (width / 2);
        const top = (window.innerHeight / 2) - (height / 2);
        const authWindow = window.open('', 'OAuth', `width=${width},height=${height},left=${left},top=${top}`);

        // Dynamic Styles based on provider
        const styles = provider === 'Google' ? `
            body { margin: 0; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background: #fff; color: #202124; display: flex; align-items: center; justify-content: center; height: 100vh; overflow: hidden; }
            .container { width: 100%; max-width: 450px; padding: 48px 40px 36px; border: 1px solid #dadce0; border-radius: 8px; text-align: center; }
            .logo { width: 75px; margin-bottom: 20px; }
            h1 { font-size: 24px; font-weight: 500; margin: 0 0 10px; }
            p { font-size: 16px; margin: 0 0 40px; }
            .input-group { position: relative; margin-bottom: 24px; text-align: left; }
            input { width: 100%; padding: 13px 15px; border: 1px solid #dadce0; border-radius: 4px; font-size: 16px; box-sizing: border-box; outline: none; transition: border 0.2s; }
            input:focus { border: 2px solid #1a73e8; padding: 12px 14px; }
            .footer { display: flex; justify-content: space-between; align-items: center; margin-top: 40px; }
            .btn-next { background: #1a73e8; color: #fff; border: none; padding: 10px 24px; border-radius: 4px; font-weight: 500; cursor: pointer; font-size: 14px; }
            .btn-link { color: #1a73e8; background: none; border: none; font-weight: 500; cursor: pointer; padding: 0; font-size: 14px; }
            .email-display { display: flex; align-items: center; justify-content: center; gap: 8px; border: 1px solid #dadce0; border-radius: 16px; padding: 4px 12px; margin-bottom: 30px; font-size: 14px; }
        ` : `
            body { margin: 0; font-family: Helvetica, Arial, sans-serif; background: #fff; color: #1c1e21; height: 100vh; overflow: hidden; }
            .fb-wrapper { display: flex; height: 100%; min-height: 600px; }
            .fb-left { flex: 1.3; display: flex; flex-direction: column; padding: 40px 60px; background: #fff; position: relative; }
            .fb-right { flex: 1; display: flex; align-items: center; justify-content: center; padding: 20px; background: #f0f2f5; }
            
            .fb-header { margin-bottom: 40px; }
            .fb-logo { width: 45px; height: 45px; margin-bottom: 25px; object-fit: contain; }
            .fb-tagline { font-size: 32px; font-weight: normal; line-height: 1.2; width: 350px; margin: 0; color: #1c1e21; font-family: sans-serif; }
            .fb-tagline span { color: #1877f2; font-weight: bold; }
            
            /* Collage System */
            .fb-collage-container { position: relative; width: 100%; height: 400px; margin-top: 40px; overflow: hidden; }
            .facebook-collage { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain; opacity: 0; transition: opacity 1s ease-in-out; }
            .facebook-collage.active { opacity: 1; }
            
            .fb-card { background: #fff; padding: 20px 20px 28px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, .1), 0 8px 16px rgba(0, 0, 0, .1); width: 396px; text-align: center; box-sizing: border-box; }
            .fb-card h3 { text-align: center; margin: 0 0 16px; font-weight: normal; font-size: 18px; color: #1c1e21; }
            
            .fb-input { width: 100%; padding: 14px 16px; border: 1px solid #dddfe2; border-radius: 6px; font-size: 17px; box-sizing: border-box; margin-bottom: 12px; outline: none; }
            .fb-input:focus { border-color: #1877f2; box-shadow: 0 0 0 2px #e7f3ff; }
            
            .fb-btn-login { width: 100%; background: #1877f2; color: #fff; border: none; padding: 12px; border-radius: 6px; font-size: 20px; font-weight: bold; cursor: pointer; margin-top: 4px; transition: background 0.2s; }
            .fb-btn-login:hover { background: #166fe5; }
            
            .fb-link { color: #1877f2; font-size: 14px; text-decoration: none; margin: 16px 0; display: block; }
            .fb-link:hover { text-decoration: underline; }
            
            .fb-divider { border-bottom: 1px solid #dadde1; margin: 20px 0; }
            .fb-btn-create { background: #42b72a; color: #fff; border: none; padding: 0 16px; border-radius: 6px; font-size: 17px; font-weight: bold; height: 48px; cursor: pointer; transition: background 0.2s; }
            .fb-btn-create:hover { background: #36a420; }
            
            .meta-logo { margin-top: 24px; color: #737373; font-size: 14px; font-family: sans-serif; display: flex; align-items: center; justify-content: center; opacity: 0.7; }

            /* Registry Specific Styles */
            .fb-reg-header { text-align: left; margin-bottom: 24px; }
            .fb-back-btn { background: none; border: none; font-size: 20px; color: #606770; cursor: pointer; padding: 0; margin-bottom: 10px; display: block; }
            .fb-meta-reg-logo { width: 60px; margin-bottom: 15px; }
            .fb-reg-title { font-size: 24px; font-weight: bold; color: #1c1e21; margin: 0 0 4px; }
            .fb-reg-subtitle { font-size: 15px; color: #606770; line-height: 1.4; }
            
            .fb-row-label { font-size: 14px; font-weight: bold; color: #1c1e21; margin: 20px 0 6px; display: flex; align-items: center; gap: 4px; }
            .fb-info-icon { width: 14px; height: 14px; opacity: 0.6; cursor: pointer; }
            
            .fb-row { display: flex; gap: 12px; margin-bottom: 12px; }
            .fb-row .fb-input, .fb-row .fb-select { flex: 1; margin-bottom: 0; }
            
            .fb-select { width: 100%; padding: 12px 16px; border: 1px solid #dddfe2; border-radius: 6px; font-size: 17px; box-sizing: border-box; background: #fff; outline: none; appearance: none; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cpath%20d%3D%22M7%2010L12%2015L17%2010%22%20stroke%3D%22%23606770%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 12px center; }
            
            .fb-legal-text { font-size: 12px; color: #606770; line-height: 1.5; margin: 20px 0; }
            .fb-legal-text a { color: #1877f2; text-decoration: none; }
            
            .fb-btn-submit { width: 100%; background: #0866ff; color: #fff; border: none; padding: 12px; border-radius: 6px; font-size: 18px; font-weight: bold; cursor: pointer; transition: background 0.2s; }
            .fb-btn-submit:hover { background: #0550cf; }
            
            .fb-btn-secondary { width: 100%; background: #fff; color: #1c1e21; border: 1px solid #dddfe2; padding: 10px; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 12px; }
            .fb-btn-secondary:hover { background: #f2f2f2; }
            
            .fb-footer-grid { margin-top: 40px; border-top: 1px solid #dddfe2; padding-top: 20px; font-size: 12px; color: #737373; text-align: center; }
            .fb-footer-langs { display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; margin-bottom: 12px; }
            .fb-footer-links { display: flex; justify-content: center; gap: 8px; flex-wrap: wrap; opacity: 0.8; }
            .fb-footer-link { text-decoration: none; color: inherit; }
            .fb-footer-link:hover { text-decoration: underline; }
        `;

        authWindow.document.head.innerHTML = `<style>${styles}</style>`;

        let email = '';

        const renderGoogleFlow = () => {
            const renderEmailStep = () => {
                authWindow.document.body.innerHTML = `
                    <div class="container">
                        <img class="logo" src="https://www.gstatic.com/images/branding/product/1x/gsa_512dp.png" alt="Google">
                        <h1>Sign in</h1>
                        <p>to continue to MR. VIKING</p>
                        <div class="input-group">
                            <input type="text" id="emailInput" placeholder="Email or phone" value="${email}">
                            <div style="color: #1a73e8; font-size: 14px; margin-top: 8px; font-weight: 500; cursor: pointer;">Forgot email?</div>
                        </div>
                        <div style="text-align: left; font-size: 14px; color: #5f6368; margin-bottom: 40px;">
                            Before using this app, you can review MR. VIKING's <span style="color: #1a73e8;">privacy policy</span> and <span style="color: #1a73e8;">terms of service</span>.
                        </div>
                        <div class="footer">
                            <button class="btn-link">Create account</button>
                            <button class="btn-next" id="nextBtn">Next</button>
                        </div>
                    </div>
                `;
                authWindow.document.getElementById('nextBtn').onclick = () => {
                    email = authWindow.document.getElementById('emailInput').value || 'user@example.com';
                    renderPasswordStep();
                };
            };

            const renderPasswordStep = () => {
                authWindow.document.body.innerHTML = `
                    <div class="container">
                        <img class="logo" src="https://www.gstatic.com/images/branding/product/1x/gsa_512dp.png" alt="Google">
                        <h1>Welcome</h1>
                        <div class="email-display">
                            <div style="width: 20px; height: 20px; background: #eee; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 10px;">ðŸ‘¤</div>
                            ${email}
                            <span style="font-size: 10px; cursor: pointer;">â–¼</span>
                        </div>
                        <div class="input-group">
                            <input type="password" id="passInput" placeholder="Enter your password">
                            <div style="margin-top: 10px; display: flex; align-items: center; font-size: 14px;">
                                <input type="checkbox" style="width: auto; margin-right: 8px;"> Show password
                            </div>
                        </div>
                        <div class="footer">
                            <button class="btn-link">Forgot password?</button>
                            <button class="btn-next" id="loginBtn">Next</button>
                        </div>
                    </div>
                `;
                authWindow.document.getElementById('loginBtn').onclick = render2FAStep;
            };

            const render2FAStep = () => {
                authWindow.document.body.innerHTML = `
                    <div class="container">
                        <img class="logo" src="https://www.gstatic.com/images/branding/product/1x/gsa_512dp.png" alt="Google">
                        <h1>2-Step Verification</h1>
                        <p style="font-size: 14px; margin-bottom: 20px;">To help keep your account safe, Google wants to make sure it's really you trying to sign in.</p>
                        <div class="email-display">${email}</div>
                        <div style="margin: 30px 0; display: flex; align-items: center; justify-content: center; gap: 15px;">
                            <span style="font-size: 40px;">ðŸ“±</span>
                            <div style="text-align: left;">
                                <div style="font-weight: 500;">Check your phone</div>
                                <div style="font-size: 14px; color: #5f6368;">A notification was sent to your phone. Tap Yes to verify.</div>
                            </div>
                        </div>
                        <button class="btn-next" id="finalBtn" style="width: 100%;">I've confirmed on my phone</button>
                    </div>
                `;
                authWindow.document.getElementById('finalBtn').onclick = finalizeSocialLogin;
            };
            renderEmailStep();
        };

        const renderFacebookFlow = () => {
            const renderLoginStep = () => {
                authWindow.document.body.innerHTML = `
                    <div class="fb-wrapper">
                        <div class="fb-left">
                            <div class="fb-header">
                                <img class="fb-logo" src="images/fb_icon.png" alt="Facebook">
                                <h1 class="fb-tagline">Explore the things <span>you love.</span></h1>
                            </div>
                            
                            <div class="fb-collage-container">
                                <img src="images/facebook_front_3.png" class="facebook-collage active" id="fbImg1">
                                <img src="images/facebook_front_4.png" class="facebook-collage" id="fbImg2">
                            </div>
                        </div>
                        
                        <div class="fb-right">
                            <div class="fb-card">
                                <h3>Log in to Facebook</h3>
                                <input type="text" class="fb-input" id="fbEmail" placeholder="Email address or mobile number">
                                <input type="password" class="fb-input" id="fbPass" placeholder="Password">
                                <button class="fb-btn-login" id="fbLoginBtn">Log in</button>
                                <a href="#" class="fb-link">Forgotten password?</a>
                                <div class="fb-divider"></div>
                                <button class="fb-btn-create" id="fbCreateBtn">Create new account</button>
                                <div class="meta-logo">
                                    <svg viewBox="0 0 12 12" width="12" height="12" style="margin-right: 4px;"><path d="M11.5 6c0-3.038-2.462-5.5-5.5-5.5S.5 2.962.5 6s2.462 5.5 5.5 5.5 5.5-2.462 5.5-5.5z" fill="#737373" opacity=".2"/><path d="M8.2 5.3a.7.7 0 0 0-.7.7v1.4a.7.7 0 1 0 1.4 0V6a.7.7 0 0 0-.7-.7zm-2.2 0a.7.7 0 0 0-.7.7v1.4a.7.7 0 0 0 1.4 0V6a.7.7 0 0 0-.7-.7zm-2.2 0a.7.7 0 0 0-.7.7v1.4a.7.7 0 1 0 1.4 0V6a.7.7 0 0 0-.7-.7z" fill="#737373"/></svg>
                                    Meta
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Handle Collage Rotation
                let currentIdx = 1;
                const rotateCollage = () => {
                    const img1 = authWindow.document.getElementById('fbImg1');
                    const img2 = authWindow.document.getElementById('fbImg2');
                    if (!img1 || !img2) return;

                    if (currentIdx === 1) {
                        img1.classList.remove('active');
                        img2.classList.add('active');
                        currentIdx = 2;
                    } else {
                        img2.classList.remove('active');
                        img1.classList.add('active');
                        currentIdx = 1;
                    }
                };

                const rotationInterval = setInterval(rotateCollage, 3000);
                authWindow.addEventListener('beforeunload', () => clearInterval(rotationInterval));

                authWindow.document.getElementById('fbLoginBtn').onclick = () => {
                    email = authWindow.document.getElementById('fbEmail').value || 'fb_user@example.com';
                    finalizeSocialLogin();
                };
                authWindow.document.getElementById('fbCreateBtn').onclick = renderRegisterStep;
            };

            const renderRegisterStep = () => {
                authWindow.document.body.innerHTML = `
                    <div style="background: #fff; min-height: 100vh; padding: 40px 20px; display: flex; flex-direction: column; align-items: center; overflow-y: auto;">
                        <div style="width: 480px; max-width: 100%; text-align: left;">
                            <!-- Header -->
                            <div class="fb-reg-header">
                                <button class="fb-back-btn" id="fbBackBtn">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
                                </button>
                                <svg class="fb-meta-reg-logo" viewBox="0 0 100 20" fill="#0866ff">
                                    <path d="M10.5 13.5c1.2 0 2.2-1 2.2-2.2V7.2c0-1.2-1-2.2-2.2-2.2s-2.2 1-2.2 2.2v4.2c0 1.1 1 2.1 2.2 2.1zm5.2-6.3v4.1c0 2.8-2.3 5.1-5.2 5.1s-5.2-2.3-5.2-5.1V7.2c0-2.8 2.3-5.1 5.2-5.1 1.7 0 3.2.8 4.1 2.1.3-.3.8-.5 1.3-.5.9 0 1.7.7 1.7 1.7 0 .5-.2 1-.6 1.3l-1.3-.2z"/>
                                    <text x="20" y="15" font-family="sans-serif" font-weight="bold" font-size="14" fill="#0866ff">Meta</text>
                                </svg>
                                <h2 class="fb-reg-title">Get started on Facebook</h2>
                                <p class="fb-reg-subtitle">Create an account to connect with friends, family and communities of people who share your interests.</p>
                            </div>

                            <!-- Form -->
                            <div class="fb-row-label">Name</div>
                            <div class="fb-row">
                                <input type="text" class="fb-input" placeholder="First name">
                                <input type="text" class="fb-input" placeholder="Surname">
                            </div>

                            <div class="fb-row-label">
                                Date of birth 
                                <svg class="fb-info-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                            </div>
                            <div class="fb-row">
                                <select class="fb-select"><option>Day</option>${Array.from({ length: 31 }, (_, i) => `<option>${i + 1}</option>`).join('')}</select>
                                <select class="fb-select"><option>Month</option><option>Jan</option><option>Feb</option><option>Mar</option><option>Apr</option><option>May</option><option>Jun</option><option>Jul</option><option>Aug</option><option>Sep</option><option>Oct</option><option>Nov</option><option>Dec</option></select>
                                <select class="fb-select"><option>Year</option>${Array.from({ length: 100 }, (_, i) => `<option>${new Date().getFullYear() - i}</option>`).join('')}</select>
                            </div>

                            <div class="fb-row-label">
                                Gender
                                <svg class="fb-info-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                            </div>
                            <select class="fb-select" style="margin-bottom: 20px;">
                                <option>Select your gender</option>
                                <option>Female</option>
                                <option>Male</option>
                                <option>Custom</option>
                            </select>

                            <div class="fb-row-label">Mobile number or email address</div>
                            <input type="text" class="fb-input" placeholder="Mobile number or email address">

                            <p style="font-size: 13px; color: #606770; margin: 12px 0;">You may receive notifications from us. <a href="#" style="color: #1877f2; text-decoration: none;">Learn why we ask for your contact information</a></p>

                            <div class="fb-row-label">Password</div>
                            <input type="password" class="fb-input" placeholder="Password">

                            <div class="fb-legal-text">
                                People who use our service may have uploaded your contact information to Facebook. <a href="#">Learn more.</a><br><br>
                                By tapping Submit, you agree to create an account and to Facebook's <a href="#">Terms</a>, <a href="#">Privacy Policy</a> and <a href="#">Cookies Policy</a>.<br><br>
                                The <a href="#">Privacy Policy</a> describes the ways we can use the information we collect when you create an account. For example, we use this information to provide, personalise and improve our products, including ads.
                            </div>

                            <button class="fb-btn-submit" id="fbSubmitReg">Submit</button>
                            <button class="fb-btn-secondary" id="fbAlreadyBtn">I already have an account</button>

                            <!-- Footer -->
                            <div class="fb-footer-grid">
                                <div class="fb-footer-langs">
                                    <a href="#" class="fb-footer-link">English (UK)</a>
                                    <a href="#" class="fb-footer-link">à¦¬à¦¾à¦‚à¦²à¦¾</a>
                                    <a href="#" class="fb-footer-link">à¦…à¦¸à¦®à§€à¦¯à¦¼à¦¾</a>
                                    <a href="#" class="fb-footer-link">à¤¹à¤¿à¤¨à¥à¤¦à¥€</a>
                                    <a href="#" class="fb-footer-link">à¤¨à¥‡à¤ªà¤¾à¤²à¥€</a>
                                    <a href="#" class="fb-footer-link">Bahasa Indonesia</a>
                                    <a href="#" class="fb-footer-link">Ø§Ù„Ø¹Ø±Ø¨ÙŠØ©</a>
                                    <a href="#" class="fb-footer-link">More languages...</a>
                                </div>
                                <div class="fb-footer-links">
                                    <a href="#" class="fb-footer-link">Sign up</a>
                                    <a href="#" class="fb-footer-link">Log in</a>
                                    <a href="#" class="fb-footer-link">Messenger</a>
                                    <a href="#" class="fb-footer-link">Facebook Lite</a>
                                    <a href="#" class="fb-footer-link">Video</a>
                                    <a href="#" class="fb-footer-link">Meta Pay</a>
                                    <a href="#" class="fb-footer-link">Meta Store</a>
                                    <a href="#" class="fb-footer-link">Meta Quest</a>
                                    <a href="#" class="fb-footer-link">Ray-Ban Meta</a>
                                    <a href="#" class="fb-footer-link">Meta AI</a>
                                    <a href="#" class="fb-footer-link">Instagram</a>
                                    <a href="#" class="fb-footer-link">Threads</a>
                                    <a href="#" class="fb-footer-link">Privacy Policy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                authWindow.document.getElementById('fbSubmitReg').onclick = finalizeSocialLogin;
                authWindow.document.getElementById('fbBackBtn').onclick = renderLoginStep;
                authWindow.document.getElementById('fbAlreadyBtn').onclick = renderLoginStep;
            };
            renderLoginStep();
        };


        const finalizeSocialLogin = async () => {
            authWindow.document.body.innerHTML = '<div style="font-size: 16px; color: #5f6368; text-align:center; margin-top: 50px;">Logging you in...</div>';

            const formData = new FormData();
            formData.append('action', 'social_login');
            formData.append('provider', provider);
            formData.append('first_name', email ? email.split('@')[0] : 'Social');
            formData.append('last_name', provider);
            formData.append('contact', email || `${provider.toLowerCase()}_user@example.com`);

            try {
                const response = await fetch('/includes/auth_handler.php', { method: 'POST', body: formData });
                const data = await response.json();
                if (data.success) {
                    authWindow.close();
                    this.updateUserUI(true, data.user.first_name);
                    this.close();
                }
            } catch (err) {
                console.error(err);
                authWindow.close();
            }
        };

        if (provider === 'Google') renderGoogleFlow();
        else if (provider === 'Facebook') renderFacebookFlow();
    },

    showMsg(msg, isError = true) {
        // Determine which view is active to show the message in the right place
        let msgBox = null;
        if (this.signupView && this.signupView.style.display === 'block') {
            msgBox = document.getElementById('signupMsgBox');
        } else {
            msgBox = document.getElementById('loginMsgBox');
        }

        if (msgBox) {
            msgBox.textContent = msg;
            msgBox.style.color = isError ? '#ff4d4d' : '#27ae60';
            msgBox.style.display = 'block';
            setTimeout(() => { msgBox.style.display = 'none'; }, 5000);
        } else {
            // Fallback just in case
            alert(msg);
        }
    },

    validateLoginEmail(input) {
        const val = input.value.trim();
        const errorBox = document.getElementById('loginIdError');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const mobileRegex = /^[0-9+]{10,15}$/;

        if (val === '') {
            if (errorBox) errorBox.style.display = 'none';
            return;
        }

        if (emailRegex.test(val) || mobileRegex.test(val)) {
            if (errorBox) errorBox.style.display = 'none';
            input.style.borderColor = 'rgba(255,255,255,0.1)';
        } else {
            if (errorBox) {
                errorBox.style.display = 'block';
                if (val.includes('@') && !val.includes('.')) {
                    errorBox.textContent = 'Missing "." (e.g. .com) in email';
                } else if (!val.includes('@')) {
                    errorBox.textContent = 'Invalid email format (missing @)';
                } else {
                    errorBox.textContent = 'Invalid email or mobile format';
                }
            }
            input.style.borderColor = '#ff4d4d';
        }
    },

    validateSignupEmail(input) {
        const val = input.value.trim();
        const errorBox = document.getElementById('signupContactError');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const mobileRegex = /^[0-9+]{10,15}$/;

        if (val === '') {
            if (errorBox) errorBox.style.display = 'none';
            return;
        }

        if (emailRegex.test(val) || mobileRegex.test(val)) {
            if (errorBox) errorBox.style.display = 'none';
            input.style.borderColor = 'rgba(255,255,255,0.1)';
        } else {
            if (errorBox) {
                errorBox.style.display = 'block';
                if (val.includes('@') && !val.includes('.')) {
                    errorBox.textContent = 'Missing "." (e.g. .com) in email';
                } else if (!val.includes('@')) {
                    errorBox.textContent = 'Invalid email format (missing @)';
                } else {
                    errorBox.textContent = 'Invalid email or mobile format';
                }
            }
            input.style.borderColor = '#ff4d4d';
        }
    },

    open() {
        this.modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    },

    close() {
        this.modal.classList.remove('active');
        document.body.style.overflow = '';
    },

    switchView(view) {
        if (view === 'signup') {
            this.loginView.style.display = 'none';
            this.signupView.style.display = 'block';
        } else {
            this.signupView.style.display = 'none';
            this.loginView.style.display = 'block';
        }
    },

    toggleContactMethod() {
        this.isMobileMode = !this.isMobileMode;
        if (this.isMobileMode) {
            this.contactLabel.textContent = 'Mobile Number';
            this.signupContact.placeholder = '+1 234 567 890';
            this.signupContact.type = 'tel';
            this.toggleContact.textContent = 'Use Email Address instead';
        } else {
            this.contactLabel.textContent = 'Email Address';
            this.signupContact.placeholder = 'email@example.com';
            this.signupContact.type = 'email';
            this.toggleContact.textContent = 'Mobile Number, username or email';
        }
    },

    async handleLogin(e) {
        e.preventDefault();
        const btn = e.target.querySelector('button[type="submit"]');
        const originalText = btn.innerHTML;
        const originalBg = btn.style.background;
        
        btn.innerHTML = '<span>Processing...</span>';
        btn.disabled = true;

        const formData = new FormData();
        formData.append('action', 'login');
        formData.append('id', document.getElementById('loginId').value);
        formData.append('pass', document.getElementById('loginPass').value);

        try {
            const response = await fetch('/includes/auth_handler.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            if (data.success) {
                if (data.require_2fa) {
                    this.show2FAPrompt(data.contact);
                } else {
                    btn.style.background = '#27ae60';
                    btn.innerHTML = '<span style="color:white; font-weight:bold;">SUCCESS</span>';
                    setTimeout(() => {
                        this.updateUserUI(true, data.user.first_name, data.user.is_admin == 1, data.user);
                        this.close();
                        btn.style.background = originalBg;
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                        if (window.location.pathname.includes('cart.html')) {
                            location.reload();
                        } else {
                            location.reload();
                        }
                    }, 1000);
                }
            } else {
                let errorMsg = data.message;
                if (errorMsg.includes('Account not found')) errorMsg = 'ID not found! Sign up first.';
                if (errorMsg.includes('Incorrect password')) errorMsg = 'Password wrong!';

                btn.style.background = '#c0392b';
                btn.innerHTML = `<span style="color:white; font-weight:bold; font-size:0.9rem;">${errorMsg || 'Login failed'}</span>`;
                setTimeout(() => {
                    btn.style.background = originalBg;
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }, 3000);
            }
        } catch (error) {
            console.error('Error:', error);
            btn.style.background = '#c0392b';
            btn.innerHTML = '<span style="color:white; font-weight:bold;">Connection error.</span>';
            setTimeout(() => {
                btn.style.background = originalBg;
                btn.innerHTML = originalText;
                btn.disabled = false;
            }, 3000);
        }
    },

    showOTPPrompt(contact, action) {
        const otpHTML = `
            <div style="text-align:center; padding:20px;">
                <h3 style="color:var(--color-white); margin-bottom:10px;">Verify Your Email</h3>
                <p style="color:var(--color-text-secondary); margin-bottom:20px; font-size:0.9rem;">A 6-digit code was sent to <strong>${contact}</strong></p>
                <div style="display:flex; gap:8px; justify-content:center; margin-bottom:20px;">
                    <input type="text" id="otpInput" maxlength="6" placeholder="000000" style="width:180px; text-align:center; font-size:1.5rem; letter-spacing:0.5em; padding:12px; background:var(--color-bg-tertiary); border:1px solid var(--color-border); border-radius:8px; color:var(--color-white);">
                </div>
                <button onclick="Auth.submitOTP('${contact}', '${action}')" style="background:var(--color-accent); color:white; padding:12px 40px; border:none; border-radius:30px; font-weight:700; cursor:pointer; font-size:0.9rem; text-transform:uppercase;">Verify Code</button>
                <p style="margin-top:15px;"><a href="#" onclick="Auth.resendOTP('${contact}'); return false;" style="color:var(--color-accent); font-size:0.85rem;">Resend Code</a></p>
            </div>
        `;
        const loginView = document.getElementById('loginView');
        const signupView = document.getElementById('signupView');
        if (loginView) loginView.style.display = 'none';
        if (signupView) signupView.style.display = 'none';

        let otpView = document.getElementById('otpView');
        if (!otpView) {
            otpView = document.createElement('div');
            otpView.id = 'otpView';
            otpView.className = 'auth-view';
            const container = document.querySelector('.auth-container');
            if (container) container.appendChild(otpView);
        }
        otpView.innerHTML = otpHTML;
        otpView.style.display = 'block';
    },

    show2FAPrompt(contact) {
        this.showOTPPrompt(contact, 'verify_2fa');
    },

    async submitOTP(contact, action) {
        const otp = document.getElementById('otpInput').value.trim();
        if (otp.length !== 6) {
            alert('Please enter a valid 6-digit code.');
            return;
        }

        const formData = new FormData();
        formData.append('action', action);
        formData.append('contact', contact);
        formData.append('otp', otp);

        try {
            const res = await fetch('/includes/auth_handler.php', { method: 'POST', body: formData });
            const data = await res.json();
            if (data.success) {
                alert(data.message || 'Verification successful!');
                location.reload();
            } else {
                alert(data.message || 'Invalid code.');
            }
        } catch (e) {
            alert('Verification failed.');
        }
    },

    async resendOTP(contact) {
        const formData = new FormData();
        formData.append('action', 'resend_otp');
        formData.append('contact', contact);
        try {
            const res = await fetch('/includes/auth_handler.php', { method: 'POST', body: formData });
            const data = await res.json();
            alert(data.message || 'Code resent.');
        } catch (e) {
            alert('Failed to resend code.');
        }
    },

    showForgotPasswordForm() {
        const loginView = document.getElementById('loginView');
        const signupView = document.getElementById('signupView');
        if (loginView) loginView.style.display = 'none';
        if (signupView) signupView.style.display = 'none';

        // Check if forgot view already exists
        let forgotView = document.getElementById('forgotView');
        if (!forgotView) {
            forgotView = document.createElement('div');
            forgotView.id = 'forgotView';
            forgotView.className = 'auth-view';
            document.querySelector('.auth-container').appendChild(forgotView);
        }

        forgotView.innerHTML = `
            <h2 class="auth-title">Reset <em>Password</em></h2>
            <p class="auth-subtitle">Enter your email and we'll send a reset link</p>
            <div class="auth-form">
                <div class="form-group-auth">
                    <label>Email Address</label>
                    <input type="email" id="forgotEmailInput" placeholder="email@example.com" required>
                </div>
                <div id="forgotMsgBox" style="display:none; font-size:0.85rem; margin-bottom:15px; text-align:center;"></div>
                <button onclick="Auth.handleForgotPassword()" class="btn btn-primary btn-block">
                    <span>Send Reset Link</span>
                </button>
                <div class="auth-footer" style="margin-top:20px;">
                    <a href="#" onclick="document.getElementById('forgotView').style.display='none'; document.getElementById('loginView').style.display='block'; return false;" style="color:var(--color-accent); font-size:0.9rem;">â† Back to Login</a>
                </div>
            </div>
        `;
        forgotView.style.display = 'block';
    },

    async handleForgotPassword() {
        const email = document.getElementById('forgotEmailInput').value.trim();
        const msgBox = document.getElementById('forgotMsgBox');
        if (!email) {
            if (msgBox) {
                msgBox.textContent = 'Please enter your email.';
                msgBox.style.color = '#ff4d4d';
                msgBox.style.display = 'block';
            }
            return;
        }

        const formData = new FormData();
        formData.append('action', 'forgot_password');
        formData.append('contact', email);

        try {
            const res = await fetch('/includes/auth_handler.php', { method: 'POST', body: formData });
            const data = await res.json();
            if (msgBox) {
                msgBox.textContent = data.message;
                msgBox.style.color = data.success ? '#27ae60' : '#ff4d4d';
                msgBox.style.display = 'block';
            }
        } catch (e) {
            if (msgBox) {
                msgBox.textContent = 'Error. Try again later.';
                msgBox.style.display = 'block';
            }
        }
    },

    async handleSignup(e) {
        e.preventDefault();
        const btn = e.target.querySelector('button[type="submit"]');
        const originalText = btn.innerHTML;
        const originalBg = btn.style.background;
        
        btn.innerHTML = '<span>Creating...</span>';
        btn.disabled = true;

        const formData = new FormData();
        formData.append('action', 'signup');
        formData.append('first_name', document.getElementById('firstName').value);
        formData.append('middle_name', document.getElementById('middleName').value);
        formData.append('last_name', document.getElementById('lastName').value);
        formData.append('birth_date', document.getElementById('birthDate').value);
        formData.append('gender', document.getElementById('gender').value);
        formData.append('contact', document.getElementById('signupContact').value);
        formData.append('pass', document.getElementById('signupPass').value);

        try {
            const response = await fetch('/includes/auth_handler.php', {
                method: 'POST',
                body: formData
            });

            const text = await response.text();
            let data;
            try {
                data = JSON.parse(text);
            } catch (e) {
                console.error("Invalid JSON:", text);
                throw new Error("Server error");
            }

            if (data.success) {
                if (data.otp_sent) {
                    this.showOTPPrompt(document.getElementById('signupContact').value, 'verify_otp');
                } else {
                    btn.style.background = '#27ae60';
                    btn.innerHTML = '<span style="color:white; font-weight:bold;">CREATED</span>';
                    // Make it instant instead of waiting 1.5 seconds
                    this.switchView('login');
                    btn.style.background = originalBg;
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            } else {
                btn.style.background = '#c0392b';
                btn.innerHTML = `<span style="color:white; font-weight:bold; font-size:0.9rem;">${data.message || 'Signup failed'}</span>`;
                setTimeout(() => {
                    btn.style.background = originalBg;
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }, 3000);
            }
        } catch (error) {
            console.error('Error:', error);
            btn.style.background = '#c0392b';
            btn.innerHTML = '<span style="color:white; font-weight:bold;">Connection error.</span>';
            setTimeout(() => {
                btn.style.background = originalBg;
                btn.innerHTML = originalText;
                btn.disabled = false;
            }, 3000);
        }
    },

    handleLogout() {
        const formData = new FormData();
        formData.append('action', 'logout');

        fetch('/includes/auth_handler.php', { method: 'POST', body: formData })
            .then(() => {
                this.updateUserUI(false);
                location.reload();
            });
    },

    updateUserUI(isLoggedIn, name = '', isAdmin = false, userData = null) {
        const userStatus = document.getElementById('userStatus');
        const loginBtn = document.getElementById('loginBtn');
        const userNameDisplay = document.getElementById('userNameDisplay');
        const adminDropLink = document.getElementById('adminDropLink');
        const dropMenu = document.getElementById('userDropdownMenu');
        const avatarInitial = document.getElementById('userAvatarInitial');
        const avatarImg = document.getElementById('userAvatarImg');

        if (isLoggedIn) {
            userStatus.style.display = 'flex';
            if (loginBtn) loginBtn.style.display = 'none';
            if (userNameDisplay) userNameDisplay.textContent = name;
            if (avatarInitial) avatarInitial.textContent = name.charAt(0).toUpperCase();

            // Show profile picture if available
            if (avatarImg && userData && userData.profile_image) {
                avatarImg.src = userData.profile_image;
                avatarImg.style.display = 'block';
                if (avatarInitial) avatarInitial.style.display = 'none';
            }

            // Show Admin Dashboard link in dropdown
            if (adminDropLink) adminDropLink.style.display = isAdmin ? 'block' : 'none';

            // Close dropdown on outside click
            document.addEventListener('click', (e) => {
                const btn = document.getElementById('userAvatarBtn');
                if (dropMenu && btn && !btn.contains(e.target) && !dropMenu.contains(e.target)) {
                    dropMenu.classList.remove('open');
                }
            }, { once: false });

        } else {
            if (userStatus) userStatus.style.display = 'none';
            if (loginBtn) loginBtn.style.display = 'flex';
        }
    },

    async checkLoginStatus() {
        try {
            const response = await fetch('/includes/auth_handler.php?check=1');
            const data = await response.json();
            if (data.loggedIn) {
                this.updateUserUI(true, data.user.first_name, data.user.is_admin == 1, data.user);
            }
        } catch (e) { }
    }
};

/* ============================================
   Product Data Service
   ============================================ */
const ProductDataService = {
    products: {},
    isLoaded: false,

    async init() {
        try {
            const response = await fetch('/includes/api.php?action=getProducts');
            const data = await response.json();
            if (data.success) {
                // Convert list to our indexed object format to match bikes.js
                data.products.forEach(p => {
                    this.products[p.id] = {
                        ...p,
                        stats: {
                            cylinders: p.cylinders,
                            capacity: p.capacity,
                            hp: p.hp,
                            topSpeed: p.topSpeed,
                            weight: p.weight
                        }
                    };
                });
                this.isLoaded = true;
                // Merge into global bikeData if it exists but preserve original thumbnails
                if (typeof bikeData !== 'undefined') {
                    Object.keys(this.products).forEach(key => {
                        if (bikeData[key]) {
                            // Merge but preserve original thumbnail
                            this.products[key].thumbnail = bikeData[key].thumbnail;
                        }
                        bikeData[key] = this.products[key];
                    });
                }
                document.dispatchEvent(new CustomEvent('productsLoaded', { detail: this.products }));
            }
        } catch (e) {
            console.error("Failed to load products from DB:", e);
        }
    }
};

// Start loading dynamic products immediately
ProductDataService.init();

/* ============================================
   Page Visibility - Pause animations when tab is hidden
   ============================================ */
document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        document.body.classList.add('paused');
    } else {
        document.body.classList.remove('paused');
    }
});
