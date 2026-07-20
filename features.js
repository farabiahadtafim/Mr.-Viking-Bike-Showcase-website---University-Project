/**
 * MR. VIKING - Features Manager
 * Handles Wishlist, Shopping Cart, and Comparison logic using localStorage.
 */

const FeatureManager = {
    // Current state
    wishlist: JSON.parse(localStorage.getItem('mv_wishlist')) || [],
    cart: JSON.parse(localStorage.getItem('mv_cart')) || [],
    compare: JSON.parse(localStorage.getItem('mv_compare')) || [],

    init() {
        this.updateBadges();
        this.syncButtonStates();
        this.setupListeners();
    },

    setupListeners() {
        // Universal listeners for "Add to" buttons if they exist
        document.addEventListener('click', (e) => {
            const wishlistBtn = e.target.closest('[data-action="add-wishlist"], [data-action="wishlist"]');
            const cartBtn = e.target.closest('[data-action="add-cart"], [data-action="cart"]');
            const compareBtn = e.target.closest('[data-action="add-compare"], [data-action="compare"]');

            if (wishlistBtn) {
                e.preventDefault();
                e.stopPropagation();
                const id = wishlistBtn.dataset.id;
                this.toggleWishlist(id);
                this.animateButton(wishlistBtn);
            }

            if (cartBtn) {
                e.preventDefault();
                e.stopPropagation();
                const id = cartBtn.dataset.id;
                this.addToCart(id);
                this.animateButton(cartBtn);
            }

            if (compareBtn) {
                e.preventDefault();
                e.stopPropagation();
                const id = compareBtn.dataset.id;
                this.addToCompare(id);
                this.animateButton(compareBtn);
            }
        });
    },

    // --- Wishlist Logic ---
    toggleWishlist(id) {
        const index = this.wishlist.indexOf(id);
        if (index === -1) {
            this.wishlist.push(id);
            this.showNotification('Added to Wishlist');
        } else {
            this.wishlist.splice(index, 1);
            this.showNotification('Removed from Wishlist');
        }
        localStorage.setItem('mv_wishlist', JSON.stringify(this.wishlist));
        this.updateBadges();
        this.updateUI();
        this.syncButtonStates();
    },

    moveToCart(id) {
        if (this.wishlist.includes(id)) {
            this.toggleWishlist(id); // Remove from wishlist
        }
        this.addToCart(id); // Add to cart
    },

    // --- Cart Logic ---
    addToCart(id, quantity = 1) {
        const item = this.cart.find(i => i.id === id);
        if (item) {
            item.quantity += quantity;
        } else {
            this.cart.push({ id, quantity });
        }
        localStorage.setItem('mv_cart', JSON.stringify(this.cart));
        this.showNotification('Added to Cart');
        this.updateBadges();
        this.updateUI();
        this.syncButtonStates();
    },

    removeFromCart(id) {
        this.cart = this.cart.filter(i => i.id !== id);
        localStorage.setItem('mv_cart', JSON.stringify(this.cart));
        this.updateBadges();
        this.updateUI();
        this.syncButtonStates();
    },

    updateCartQuantity(id, quantity) {
        const item = this.cart.find(i => i.id === id);
        if (item) {
            item.quantity = Math.max(1, quantity);
            localStorage.setItem('mv_cart', JSON.stringify(this.cart));
            this.updateUI();
        }
    },

    clearCart() {
        this.cart = [];
        localStorage.removeItem('mv_cart');
        this.updateBadges();
        this.updateUI();
        this.syncButtonStates();
    },

    // --- Compare Logic ---
    addToCompare(id) {
        if (this.compare.includes(id)) {
            this.compare = this.compare.filter(i => i !== id);
            this.showNotification('Removed from Comparison');
        } else {
            if (this.compare.length >= 3) {
                this.showNotification('Max 3 bikes for comparison', 'warning');
                return;
            }
            this.compare.push(id);
            this.showNotification('Added to Comparison');
        }
        localStorage.setItem('mv_compare', JSON.stringify(this.compare));
        this.updateBadges();
        this.updateUI();
        this.syncButtonStates();
    },

    removeFromCompare(id) {
        this.compare = this.compare.filter(i => i !== id);
        localStorage.setItem('mv_compare', JSON.stringify(this.compare));
        this.updateBadges();
        this.updateUI();
        this.syncButtonStates();
    },

    // --- UI Helpers ---
    updateBadges() {
        const wishlistBadge = document.getElementById('wishlistBadge');
        const cartBadge = document.getElementById('cartBadge');
        const compareBadge = document.getElementById('compareBadge');

        if (wishlistBadge) {
            wishlistBadge.textContent = this.wishlist.length;
            wishlistBadge.style.display = this.wishlist.length > 0 ? 'flex' : 'none';
        }

        if (cartBadge) {
            const totalItems = this.cart.reduce((sum, item) => sum + item.quantity, 0);
            cartBadge.textContent = totalItems;
            cartBadge.style.display = totalItems > 0 ? 'flex' : 'none';
        }

        if (compareBadge) {
            compareBadge.textContent = this.compare.length;
            compareBadge.style.display = this.compare.length > 0 ? 'flex' : 'none';
        }
    },

    syncButtonStates() {
        // Sync Wishlist buttons
        document.querySelectorAll('[data-action="wishlist"], [data-action="add-wishlist"]').forEach(btn => {
            const id = btn.dataset.id;
            if (this.wishlist.includes(id)) {
                btn.classList.add('active');
                btn.style.color = 'var(--color-accent)'; // Example visual cue
            } else {
                btn.classList.remove('active');
                btn.style.color = '';
            }
        });

        // Sync Compare buttons
        document.querySelectorAll('[data-action="compare"], [data-action="add-compare"]').forEach(btn => {
            const id = btn.dataset.id;
            if (this.compare.includes(id)) {
                btn.classList.add('active');
                btn.style.color = 'var(--color-accent)';
            } else {
                btn.classList.remove('active');
                btn.style.color = '';
            }
        });
        
        // Sync Cart buttons
        document.querySelectorAll('[data-action="cart"], [data-action="add-cart"]').forEach(btn => {
            const id = btn.dataset.id;
            const inCart = this.cart.some(item => item.id === id);
            if (inCart) {
                btn.classList.add('active');
                if(btn.tagName !== 'BUTTON' || !btn.textContent.includes('ADD TO CART')) {
                     btn.style.color = 'var(--color-accent)';
                } else {
                     btn.textContent = 'IN CART';
                }
            } else {
                btn.classList.remove('active');
                if(btn.tagName !== 'BUTTON' || btn.textContent.includes('IN CART')) {
                     btn.style.color = '';
                     if(btn.textContent.includes('IN CART')) btn.textContent = 'ADD TO CART';
                }
            }
        });
    },

    animateButton(btn) {
        btn.classList.add('clicked');
        setTimeout(() => btn.classList.remove('clicked'), 300);
    },

    showNotification(message, type = 'success') {
        // Create notification element if it doesn't exist
        let container = document.getElementById('mv-notifications');
        if (!container) {
            container = document.createElement('div');
            container.id = 'mv-notifications';
            container.style.cssText = `
                position: fixed;
                bottom: 30px;
                right: 30px;
                z-index: 9999;
                display: flex;
                flex-direction: column;
                gap: 10px;
            `;
            document.body.appendChild(container);
        }

        const toast = document.createElement('div');
        toast.className = `notification toast-${type}`;
        toast.innerHTML = `
            <div class="notification-body" style="
                background: ${type === 'warning' ? '#f39c12' : '#000'};
                color: #fff;
                padding: 12px 24px;
                border-radius: 8px;
                border-left: 4px solid ${type === 'warning' ? '#fff' : '#c8102e'};
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                font-size: 14px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1px;
                animation: slideIn 0.3s ease-out forwards;
            ">
                ${message}
            </div>
        `;
        container.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease-in forwards';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    },

    // Placeholder for page-specific UI updates (e.g., refreshing a grid)
    updateUI() {
        if (typeof renderWishlist === 'function') renderWishlist();
        if (typeof renderCart === 'function') renderCart();
        if (typeof renderComparison === 'function') renderComparison();
    }
};

// Initialize on load
document.addEventListener('DOMContentLoaded', () => FeatureManager.init());

// Animation Keyframes (to be added to CSS)
// @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
// @keyframes slideOut { from { transform: translateX(0); opacity: 1; } to { transform: translateX(100%); opacity: 0; } }
