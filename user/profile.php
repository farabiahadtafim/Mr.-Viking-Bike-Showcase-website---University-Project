<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - MR. VIKING</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .page-header {
            padding: 150px 0 60px;
            background: var(--color-bg-secondary);
            text-align: center;
        }
        .page-title {
            font-size: var(--font-size-5xl);
            font-family: var(--font-display);
            font-style: italic;
            margin-bottom: 10px;
        }
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 0;
        }
        .profile-tabs {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            border-bottom: 1px solid var(--color-border);
            padding-bottom: 20px;
        }
        .tab-btn {
            padding: 12px 30px;
            background: transparent;
            border: 1px solid var(--color-border);
            color: var(--color-text);
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        .tab-btn:hover {
            border-color: var(--color-accent);
            color: var(--color-white);
        }
        .tab-btn.active {
            background: var(--color-accent);
            border-color: var(--color-accent);
            color: var(--color-white);
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        .card {
            background: var(--color-bg-card);
            border: 1px solid var(--color-border);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 20px;
        }
        .card-title {
            font-size: 24px;
            font-family: var(--font-display);
            margin-bottom: 25px;
            color: var(--color-white);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--color-text-secondary);
            font-size: 14px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            background: #1a1a1a;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            color: var(--color-white);
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--color-accent);
        }
        .btn-primary {
            background: var(--color-accent);
            color: var(--color-white);
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }
        .btn-primary:hover {
            background: var(--color-accent-hover);
            transform: translateY(-2px);
        }
        .btn-danger {
            background: #e74c3c;
            color: var(--color-white);
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-danger:hover {
            background: #c0392b;
        }
        .order-item {
            padding: 20px;
            border-bottom: 1px solid var(--color-border);
        }
        .order-item:last-child {
            border-bottom: none;
        }
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .order-id {
            font-size: 18px;
            font-weight: 700;
            color: var(--color-white);
        }
        .order-date {
            color: var(--color-text-tertiary);
            font-size: 14px;
        }
        .order-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .order-status.Pending {
            background: #f39c12;
            color: #000;
        }
        .order-status.Approved {
            background: #3498db;
            color: #fff;
        }
        .order-status.Delivered {
            background: #27ae60;
            color: #fff;
        }
        .order-status.Rejected {
            background: #e74c3c;
            color: #fff;
        }
        .order-details {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 20px;
            margin-bottom: 10px;
        }
        .order-items-list {
            color: var(--color-text-secondary);
            font-size: 14px;
        }
        .order-total {
            font-size: 20px;
            font-weight: 800;
            color: var(--color-accent);
        }
        .empty-orders {
            text-align: center;
            padding: 60px 0;
            color: var(--color-text-tertiary);
        }
        .contact-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
        @media (max-width: 768px) {
            .contact-section {
                grid-template-columns: 1fr;
            }
            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            .order-details {
                grid-template-columns: 1fr;
            }
        }
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #1a1a1a;
            border-radius: 8px;
        }
        .contact-item svg {
            width: 24px;
            height: 24px;
            color: var(--color-accent);
        }
        .contact-item div {
            display: flex;
            flex-direction: column;
        }
        .contact-item label {
            font-size: 12px;
            color: var(--color-text-tertiary);
            text-transform: uppercase;
        }
        .contact-item span {
            font-size: 16px;
            color: var(--color-white);
            font-weight: 600;
        }
    </style>
</head>
<body class="cart-page">
    <div class="cursor" id="cursor"></div>
    <div class="cursor-follower" id="cursorFollower"></div>

    <header class="header" id="header" style="background: rgba(10,10,10,0.95);">
        <div class="header-inner">
            <a href="../index.php" class="logo" id="logo">
                <span class="logo-text">MR. VIKING</span>
            </a>
            <nav class="main-nav" id="mainNav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="motorcycles.html" class="nav-link" data-text="Motorcycles">Motorcycles</a></li>
                    <li class="nav-item"><a href="../index.php#motorcycles" class="nav-link" data-text="The Range">The Range</a></li>
                    <li class="nav-item"><a href="about-us.html" class="nav-link" data-text="About Us">About Us</a></li>
                    <li class="nav-item"><a href="#" class="nav-link" data-text="News">News</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <button class="search-header-btn" id="searchHeaderBtn" aria-label="Search">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <span class="search-btn-text">Search</span>
                </button>
                <a href="compare.html" class="feature-btn" id="compareBtn" aria-label="Compare">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 3h5v5M4 20L21 3M21 16v5h-5M15 15l6 6M4 4l5 5" />
                    </svg>
                    <span class="badge" id="compareBadge">0</span>
                </a>
                <a href="wishlist.html" class="feature-btn" id="wishlistHeaderBtn" aria-label="Wishlist">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    <span class="badge" id="wishlistBadge">0</span>
                </a>
                <a href="cart.html" class="feature-btn" id="cartHeaderBtn" aria-label="Shopping Cart">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                        <path d="M3 6h18"></path>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span class="badge" id="cartBadge">0</span>
                </a>
            </div>
        </div>
        <div id="userStatus" style="display:none"></div>
        <button id="loginBtn" style="display:none" aria-hidden="true"></button>
    </header>

    <div class="auth-modal" id="authModal">
        <div class="auth-modal-backdrop" id="authClose"></div>
        <div class="auth-container">
            <button class="auth-close-btn" id="authCloseBtn">&times;</button>
            <div id="loginMsg" style="display:none; padding:10px; margin-bottom:15px; border-radius:4px; text-align:center; font-weight:bold; font-size: 0.9rem;"></div>
            <div class="auth-view" id="loginView">
                <h2 class="auth-title">Welcome <em>Back</em></h2>
                <p class="auth-subtitle">Login to your MR. VIKING account</p>
                <form class="auth-form" id="loginForm">
                    <div class="form-group-auth">
                        <label for="loginId">Email or Mobile Number</label>
                        <input type="text" id="loginId" placeholder="Enter your ID" required>
                    </div>
                    <div class="form-group-auth">
                        <label for="loginPass">Password</label>
                        <div class="pw-wrap">
                            <input type="password" id="loginPass" placeholder="••••••••" required>
                            <button type="button" class="pw-eye-btn" onclick="togglePw('loginPass',this)" aria-label="Toggle password">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <span>Login</span>
                    </button>
                    <p style="text-align:right; margin-top:8px;"><a href="#" id="forgotPasswordLink" style="color:var(--color-accent); font-size:0.85rem;">Forgot Password?</a></p>
                </form>
                <div class="auth-divider"><span>OR</span></div>
                <div class="social-auth">
                    <button class="social-btn google" id="googleAuthBtn">
                        <img src="https://www.gstatic.com/images/branding/product/1x/gsa_512dp.png" alt="Google">
                        <span>Continue with Google</span>
                    </button>
                    <button class="social-btn facebook" id="facebookAuthBtn">
                        <img src="../images/fb_icon.png" alt="Facebook">
                        <span>Continue with Facebook</span>
                    </button>
                </div>
                <div class="auth-footer">
                    <p>Don't have an account? <a href="#" id="toSignup">Sign Up</a></p>
                </div>
            </div>
            <div class="auth-view" id="signupView" style="display: none;">
                <h2 class="auth-title">Create <em>Account</em></h2>
                <p class="auth-subtitle">Join the world of Italian excellence</p>
                <form class="auth-form" id="signupForm">
                    <div class="form-row">
                        <div class="form-group-auth">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" placeholder="First Name" required>
                        </div>
                        <div class="form-group-auth">
                            <label for="middleName">Middle Name</label>
                            <input type="text" id="middleName" placeholder="Middle Name">
                        </div>
                    </div>
                    <div class="form-group-auth">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" placeholder="Last Name" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group-auth">
                            <label for="birthDate">Birth Date</label>
                            <input type="date" id="birthDate" required>
                        </div>
                        <div class="form-group-auth">
                            <label for="gender">Gender</label>
                            <select id="gender" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group-auth">
                        <label for="signupContact">Email Address</label>
                        <input type="text" id="signupContact" placeholder="email@example.com" required>
                        <button type="button" class="toggle-contact-btn" id="toggleContact">Mobile Number, username or email</button>
                    </div>
                    <div class="form-group-auth">
                        <label for="signupPass">Password</label>
                        <div class="pw-wrap">
                            <input type="password" id="signupPass" placeholder="••••••••" required>
                            <button type="button" class="pw-eye-btn" onclick="togglePw('signupPass',this)" aria-label="Toggle password">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <span>Sign Up</span>
                    </button>
                </form>
                <div class="auth-footer">
                    <p>Already have an account? <a href="#" id="toLogin">Login</a></p>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="page-header">
            <div class="section-container">
                <h1 class="page-title">My <em>Profile</em></h1>
                <p>Manage your account and orders</p>
            </div>
        </div>
        <div class="section-container">
            <div class="profile-container">
                <div class="profile-tabs">
                    <button class="tab-btn active" onclick="switchTab('profile')">Profile</button>
                    <button class="tab-btn" onclick="switchTab('orders')">My Orders</button>
                    <button class="tab-btn" onclick="switchTab('support')">Support</button>
                </div>

                <div id="profileTab" class="tab-content active">
                    <div class="card">
                        <h2 class="card-title">Edit Profile</h2>
                        <form id="profileForm">
                            <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div class="form-group">
                                    <label for="editFirstName">First Name</label>
                                    <input type="text" id="editFirstName" name="first_name">
                                </div>
                                <div class="form-group">
                                    <label for="editLastName">Last Name</label>
                                    <input type="text" id="editLastName" name="last_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editPhone">Phone</label>
                                <input type="text" id="editPhone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="editAddress">Address</label>
                                <textarea id="editAddress" name="address" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>

                <div id="ordersTab" class="tab-content">
                    <div class="card">
                        <h2 class="card-title">Order History</h2>
                        <div id="ordersList">
                            <div class="empty-orders">
                                <p>Loading your orders...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="supportTab" class="tab-content">
                    <div class="card">
                        <h2 class="card-title">Contact Support</h2>
                        <div class="contact-section">
                            <div>
                                <form id="contactForm">
                                    <div class="form-group">
                                        <label for="contactSubject">Subject</label>
                                        <input type="text" id="contactSubject" placeholder="How can we help you?">
                                    </div>
                                    <div class="form-group">
                                        <label for="contactMessage">Message</label>
                                        <textarea id="contactMessage" placeholder="Describe your issue..." rows="5"></textarea>
                                    </div>
                                    <button type="submit" class="btn-primary">Send Message</button>
                                </form>
                            </div>
                            <div>
                                <div class="contact-info">
                                    <div class="contact-item">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                        <div>
                                            <label>Phone</label>
                                            <span>+880 1700 000000</span>
                                        </div>
                                    </div>
                                    <div class="contact-item">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <div>
                                            <label>Email</label>
                                            <span>support@mrviking.com</span>
                                        </div>
                                    </div>
                                    <div class="contact-item">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <div>
                                            <label>Address</label>
                                            <span>Dhaka, Bangladesh</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="search-overlay" id="searchOverlay">
        <div class="search-overlay-close" id="searchClose">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 6L6 18M6 6l12 12" />
            </svg>
        </div>
        <div class="search-container">
            <div class="search-input-wrapper">
                <input type="text" class="search-input" id="searchInput" placeholder="Search by bike name..." autocomplete="off">
                <div class="search-input-line"></div>
            </div>
            <div class="search-suggestions" id="searchSuggestions"></div>
        </div>
    </div>

    <script src="../js/bikes.js"></script>
    <script src="../js/features.js"></script>
    <script src="../js/script.js"></script>
    <script>
        let currentUser = null;

        async function init() {
            const res = await fetch('../includes/auth_handler.php?check=1');
            const data = await res.json();
            if (!data.loggedIn) {
                Auth.open();
                return;
            }
            currentUser = data.user;
            populateProfileForm();
            loadOrders();
        }

        function switchTab(tab) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            if (tab === 'profile') {
                document.querySelector('.tab-btn:nth-child(1)').classList.add('active');
                document.getElementById('profileTab').classList.add('active');
            } else if (tab === 'orders') {
                document.querySelector('.tab-btn:nth-child(2)').classList.add('active');
                document.getElementById('ordersTab').classList.add('active');
            } else if (tab === 'support') {
                document.querySelector('.tab-btn:nth-child(3)').classList.add('active');
                document.getElementById('supportTab').classList.add('active');
            }
        }

        window.profileSwitchTab = switchTab;

        function populateProfileForm() {
            document.getElementById('editFirstName').value = currentUser.first_name || '';
            document.getElementById('editLastName').value = currentUser.last_name || '';
            document.getElementById('editPhone').value = currentUser.phone || '';
            document.getElementById('editAddress').value = currentUser.address || '';
        }

        async function loadOrders() {
            try {
                const formData = new FormData();
                formData.append('action', 'getUserOrders');
                const res = await fetch('../includes/auth_handler.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await res.json();
                if (data.success) {
                    renderOrders(data.orders);
                } else {
                    document.getElementById('ordersList').innerHTML = '<div class="empty-orders"><p>Failed to load orders: ' + data.message + '</p></div>';
                }
            } catch (e) {
                document.getElementById('ordersList').innerHTML = '<div class="empty-orders"><p>Error loading orders</p></div>';
            }
        }

        function renderOrders(orders) {
            const container = document.getElementById('ordersList');
            if (!orders || orders.length === 0) {
                container.innerHTML = '<div class="empty-orders"><p>No orders found</p></div>';
                return;
            }
            container.innerHTML = orders.map(order => {
                const itemsHtml = order.items.map(item => `${item.name} x${item.quantity}`).join(', ');
                return `
                    <div class="order-item">
                        <div class="order-header">
                            <div>
                                <div class="order-id">Order #${order.order_id}</div>
                                <div class="order-date">${new Date(order.created_at).toLocaleString()}</div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <span class="order-status ${order.status}">${order.status}</span>
                                <button class="btn-danger" onclick="deleteOrder(${order.order_id})">Delete</button>
                            </div>
                        </div>
                        <div class="order-details">
                            <div class="order-items-list">${itemsHtml}</div>
                            <div class="order-total">৳ ${parseInt(order.total_price).toLocaleString('en-IN')}</div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        async function deleteOrder(orderId) {
            if (!confirm('Are you sure you want to delete this order?')) return;
            try {
                const formData = new FormData();
                formData.append('action', 'deleteOrder');
                formData.append('order_id', orderId);
                const res = await fetch('../includes/api.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await res.json();
                if (data.success) {
                    alert('Order deleted successfully');
                    loadOrders();
                } else {
                    alert('Failed to delete order: ' + data.message);
                }
            } catch (e) {
                alert('Error deleting order');
            }
        }

        document.getElementById('profileForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            formData.append('action', 'updateProfile');
            try {
                const res = await fetch('../includes/auth_handler.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await res.json();
                if (data.success) {
                    alert('Profile updated successfully');
                    currentUser = data.user;
                } else {
                    alert('Failed to update profile: ' + data.message);
                }
            } catch (e) {
                alert('Error updating profile');
            }
        });

        document.getElementById('contactForm').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Thank you for contacting us! We will get back to you soon.');
            e.target.reset();
        });

        document.addEventListener('DOMContentLoaded', init);
    </script>
    <script src="../js/cursor.js"></script>
</body>
</html>
