/**
 * MR. VIKING - Dual Cursor System
 * Homepage: Ultra-Premium 3D Glossy Glass Cursor
 * Global: Windows 11 Style Premium Smooth Cursor
 */

class CursorManager {
    constructor() {
        this.isHomepage = this.detectHomepage();
        this.init();
    }

    detectHomepage() {
        const path = window.location.pathname;
        const isIndex = path === '/' || path.endsWith('index.html') || path.endsWith('index.php') || path === '';
        // Also check if we are on a page that looks like the homepage (has hero section)
        return isIndex || !!document.querySelector('.hero');
    }

    init() {
        if (matchMedia('(pointer:fine)').matches) {
            if (this.isHomepage) {
                new Glossy3DCursor();
            } else {
                new Windows11SmoothCursor();
            }
        }
    }
}

/**
 * TYPE 1: Ultra-Premium 3D Glossy Glass Cursor (Homepage)
 */
class Glossy3DCursor {
    constructor() {
        this.container = null;
        this.arrow = null;
        this.mouse = { x: 0, y: 0 };
        this.pos = { x: 0, y: 0 };
        this.angle = 0;
        this.targetAngle = 0;
        this.lerp = 0.12;
        this.angleLerp = 0.15;
        this.snapRadius = 80;
        this.isActive = false;

        this.init();
    }

    init() {
        const old = document.getElementById('premium-cursor-3d') || document.getElementById('premium-cursor-smooth');
        if (old) old.remove();

        this.createElements();
        window.addEventListener('mousemove', (e) => this.handleMouseMove(e));
        this.render();
    }

    createElements() {
        this.container = document.createElement('div');
        this.container.id = 'premium-cursor-3d';
        
        this.arrow = document.createElement('div');
        this.arrow.className = 'glass-arrow';
        
        const arrowSvg = `<svg viewBox="0 0 40 40"><path d="M20 5 L35 30 L20 25 L5 30 Z" fill="currentColor" /></svg>`;

        this.arrow.innerHTML = `
            <div class="glass-body"></div>
            <div class="glass-iridescent-border"></div>
            <div class="glass-gloss"></div>
            <div class="glass-head-container">
                <div class="glass-head-arrow">${arrowSvg}</div>
            </div>
        `;

        this.container.appendChild(this.arrow);
        document.body.appendChild(this.container);
    }

    handleMouseMove(e) {
        if (!this.isActive) {
            this.isActive = true;
            this.container.style.opacity = '1';
            document.documentElement.classList.add('custom-cursor-active');
        }

        const prevX = this.mouse.x;
        const prevY = this.mouse.y;
        
        this.mouse.x = e.clientX;
        this.mouse.y = e.clientY;

        const dx = this.mouse.x - prevX;
        const dy = this.mouse.y - prevY;

        if (Math.abs(dx) > 1 || Math.abs(dy) > 1) {
            this.targetAngle = (Math.atan2(dy, dx) * 180 / Math.PI) + 90;
        }

        const hueShift = (this.mouse.x / window.innerWidth) * 360;
        document.documentElement.style.setProperty('--cursor-iridescent-hue', hueShift + 'deg');
    }

    findMagneticTarget() {
        const targets = document.querySelectorAll('button, a, .nav-item, .sidebar-link, .pw-eye-btn');
        let closest = null;
        let minDistance = this.snapRadius;

        targets.forEach(el => {
            const rect = el.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            const distance = Math.hypot(this.mouse.x - centerX, this.mouse.y - centerY);

            if (distance < minDistance) {
                minDistance = distance;
                closest = { x: centerX, y: centerY, dist: distance, el: el };
            }
        });

        return closest;
    }

    render() {
        const snap = this.findMagneticTarget();
        let targetX = this.mouse.x;
        let targetY = this.mouse.y;

        if (snap) {
            const pull = 1 - (snap.dist / this.snapRadius);
            targetX = this.mouse.x + (snap.x - this.mouse.x) * pull * 0.7;
            targetY = this.mouse.y + (snap.y - this.mouse.y) * pull * 0.7;
            this.arrow.classList.add('snapped');
            this.targetAngle = (Math.atan2(snap.y - this.mouse.y, snap.x - this.mouse.x) * 180 / Math.PI) + 90;
        } else {
            this.arrow.classList.remove('snapped');
        }

        this.pos.x += (targetX - this.pos.x) * this.lerp;
        this.pos.y += (targetY - this.pos.y) * this.lerp;

        let diff = (this.targetAngle - this.angle) % 360;
        if (diff > 180) diff -= 360;
        if (diff < -180) diff += 360;
        this.angle += diff * this.angleLerp;

        const tiltIntensity = 10; // Reduced intensity
        const maxTilt = 20; // Cap the tilt
        let tiltX = ( (this.mouse.y - this.pos.y) / 20) * tiltIntensity;
        let tiltY = (-(this.mouse.x - this.pos.x) / 20) * tiltIntensity;
        
        tiltX = Math.max(-maxTilt, Math.min(maxTilt, tiltX));
        tiltY = Math.max(-maxTilt, Math.min(maxTilt, tiltY));

        this.container.style.transform = `translate3d(${this.pos.x}px, ${this.pos.y}px, 0)`;
        this.arrow.style.transform = `
            rotateZ(${this.angle}deg) 
            rotateX(${tiltX}deg) 
            rotateY(${tiltY}deg) 
            scale(${snap ? 1.2 : 1})
        `;

        requestAnimationFrame(() => this.render());
    }
}

/**
 * TYPE 2: Windows 11 Style Premium Smooth Cursor (Global)
 */
class Windows11SmoothCursor {
    constructor() {
        this.container = null;
        this.mouse = { x: 0, y: 0 };
        this.pos = { x: 0, y: 0 };
        this.lerp = 0.15;
        this.isActive = false;

        this.init();
    }

    init() {
        const old = document.getElementById('premium-cursor-3d') || document.getElementById('premium-cursor-smooth');
        if (old) old.remove();

        this.createElements();
        window.addEventListener('mousemove', (e) => this.handleMouseMove(e));
        this.setupHoverListeners();
        this.render();
    }

    createElements() {
        this.container = document.createElement('div');
        this.container.id = 'premium-cursor-smooth';
        
        // Exact Windows 11 Arrow SVG
        const arrowSvg = `
            <svg viewBox="0 0 32 32" class="cursor-win11-arrow">
                <path d="M5.52 2.87c-.22-.22-.6-.06-.6.34v17.58c0 .45.54.67.85.35l4.83-4.83 3.06 7.43c.1.25.38.38.63.28l2.24-.92c.25-.1.38-.38.28-.63l-3.06-7.43h6.58c.31 0 .47-.38.25-.6L6.1 2.87c-.22-.22-.6-.06-.6.34z" 
                fill="white" stroke="black" stroke-width="1.2" />
            </svg>
        `;

        this.container.innerHTML = `
            <div class="cursor-smooth-circle"></div>
            ${arrowSvg}
        `;

        document.body.appendChild(this.container);
    }

    handleMouseMove(e) {
        if (!this.isActive) {
            this.isActive = true;
            this.container.style.opacity = '1';
            document.documentElement.classList.add('custom-cursor-active');
        }
        this.mouse.x = e.clientX;
        this.mouse.y = e.clientY;
    }

    setupHoverListeners() {
        const targets = 'a, button, .nav-item, [role="button"], input, select, textarea';
        document.addEventListener('mouseover', (e) => {
            if (e.target.closest(targets)) document.body.classList.add('cursor-hover');
        });
        document.addEventListener('mouseout', (e) => {
            if (e.target.closest(targets)) document.body.classList.remove('cursor-hover');
        });
    }

    render() {
        this.pos.x += (this.mouse.x - this.pos.x) * this.lerp;
        this.pos.y += (this.mouse.y - this.pos.y) * this.lerp;
        this.container.style.transform = `translate3d(${this.pos.x}px, ${this.pos.y}px, 0)`;
        requestAnimationFrame(() => this.render());
    }
}

// Global Initialization
if (document.readyState === 'complete' || document.readyState === 'interactive') {
    new CursorManager();
} else {
    document.addEventListener('DOMContentLoaded', () => new CursorManager());
}
