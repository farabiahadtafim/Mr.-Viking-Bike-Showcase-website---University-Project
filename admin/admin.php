<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MR. VIKING</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        /* Premium Glassmorphism Design */
        .page-header {
            padding: 180px 0 80px;
            background: linear-gradient(180deg, rgba(10, 10, 10, 0.95) 0%, rgba(17, 17, 17, 0.85) 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 50%, rgba(200, 16, 46, 0.15) 0%, transparent 50%),
                        radial-gradient(circle at 70% 50%, rgba(201, 169, 78, 0.1) 0%, transparent 50%);
            animation: pulse 8s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        .page-title {
            font-size: var(--font-size-5xl);
            font-family: var(--font-display);
            font-style: italic;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 80px var(--container-padding);
            position: relative;
        }
        .admin-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 50px;
            padding-bottom: 30px;
            border-bottom: 1px solid var(--color-border);
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        .tab-btn {
            padding: 14px 36px;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--color-border);
            color: var(--color-text-secondary);
            border-radius: var(--radius-lg);
            cursor: pointer;
            font-weight: 700;
            font-size: var(--font-size-sm);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            transition: all var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }
        .tab-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
            transition: left var(--transition-slow);
        }
        .tab-btn:hover::before { left: 100%; }
        .tab-btn:hover {
            border-color: var(--color-accent);
            color: var(--color-white);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .tab-btn.active {
            background: var(--color-accent);
            border-color: var(--color-accent);
            color: var(--color-white);
            box-shadow: 0 10px 30px var(--color-accent-glow);
        }
        .tab-content { display: none; }
        .tab-content.active { display: block; animation: fadeInUp 0.5s ease; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card {
            background: rgba(20, 20, 20, 0.6);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-xl);
            padding: 40px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            transition: all var(--transition-smooth);
        }
        .card:hover { border-color: var(--color-border-hover); }
        .card-title {
            font-size: 28px;
            font-family: var(--font-display);
            margin-bottom: 30px;
            color: var(--color-white);
            letter-spacing: 0.02em;
        }
        .form-group { margin-bottom: 24px; }
        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: var(--color-text-tertiary);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            color: var(--color-white);
            font-size: 16px;
            font-family: var(--font-primary);
            transition: all var(--transition-base);
        }
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--color-accent);
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 20px var(--color-accent-glow);
        }
        .btn-primary {
            background: var(--color-accent);
            color: var(--color-white);
            padding: 16px 36px;
            border: none;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: var(--font-size-sm);
            letter-spacing: 0.15em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left var(--transition-slow);
        }
        .btn-primary:hover::before { left: 100%; }
        .btn-primary:hover {
            background: var(--color-accent-hover);
            transform: translateY(-3px);
            box-shadow: 0 15px 40px var(--color-accent-glow);
        }
        .btn-primary:active { transform: translateY(0); }
        .btn-danger {
            background: #e74c3c;
            color: var(--color-white);
            padding: 10px 20px;
            border: none;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: var(--font-size-sm);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all var(--transition-base);
        }
        .btn-danger:hover {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(231, 76, 60, 0.3);
        }
        .table-container {
            overflow-x: auto;
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            background: rgba(0, 0, 0, 0.2);
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th, .data-table td {
            padding: 18px 20px;
            text-align: left;
            color: var(--color-text);
            border-bottom: 1px solid var(--color-border);
        }
        .data-table th {
            background: rgba(20, 20, 20, 0.6);
            font-weight: 800;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--color-text-tertiary);
        }
        .data-table tbody tr { transition: background var(--transition-base); }
        .data-table tbody tr:hover {
            background: rgba(200, 16, 46, 0.08);
        }
        .status-pending { 
            display: inline-block;
            padding: 6px 14px;
            background: #f39c12; 
            color: #000; 
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .status-approved { 
            display: inline-block;
            padding: 6px 14px;
            background: #3498db; 
            color: #fff; 
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .status-rejected { 
            display: inline-block;
            padding: 6px 14px;
            background: #e74c3c; 
            color: #fff; 
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .status-delivered { 
            display: inline-block;
            padding: 6px 14px;
            background: #27ae60; 
            color: #fff; 
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .product-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: var(--radius-md);
            border: 1px solid var(--color-border);
        }
        .product-image-cell { width: 100px; }
        .product-price-cell {
            width: 180px;
            white-space: nowrap;
            font-weight: 700;
        }
        /* Select styling */
        select {
            cursor: pointer;
            font-family: var(--font-primary);
        }
        select option {
            background: #1a1a1a;
            color: #fff;
        }
    </style>
</head>
<body class="admin-page">
    <div class="cursor" id="cursor"></div>
    <div class="cursor-follower" id="cursorFollower"></div>

    <header class="header" id="header" style="background: rgba(10,10,10,0.95);">
        <div class="header-inner">
            <a href="../index.php" class="logo" id="logo">
                <span class="logo-text">MR. VIKING</span>
            </a>
            <nav class="main-nav" id="mainNav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="../user/motorcycles.html" class="nav-link" data-text="Motorcycles">Motorcycles</a></li>
                    <li class="nav-item"><a href="../index.php#motorcycles" class="nav-link" data-text="The Range">The Range</a></li>
                    <li class="nav-item"><a href="../user/about-us.html" class="nav-link" data-text="About Us">About Us</a></li>
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
                <a href="../user/compare.html" class="feature-btn" id="compareBtn" aria-label="Compare">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 3h5v5M4 20L21 3M21 16v5h-5M15 15l6 6M4 4l5 5" />
                    </svg>
                    <span class="badge" id="compareBadge">0</span>
                </a>
                <a href="../user/wishlist.html" class="feature-btn" id="wishlistHeaderBtn" aria-label="Wishlist">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    <span class="badge" id="wishlistBadge">0</span>
                </a>
                <a href="../user/cart.html" class="feature-btn" id="cartHeaderBtn" aria-label="Shopping Cart">
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

    <main>
        <div class="page-header">
            <div class="section-container">
                <h1 class="page-title">Admin <em>Dashboard</em></h1>
                <p>Manage products, orders, and users</p>
            </div>
        </div>
        <div class="section-container">
            <div class="admin-container">
                <div class="admin-tabs">
                    <button class="tab-btn active" onclick="switchTab('products')">Products</button>
                    <button class="tab-btn" onclick="switchTab('orders')">Orders</button>
                    <button class="tab-btn" onclick="switchTab('users')">Users</button>
                </div>

                <div id="productsTab" class="tab-content active">
                    <div class="card">
                        <h2 class="card-title">Product Management</h2>
                        <form id="productForm">
                            <input type="hidden" id="productId" name="id">
                            <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" id="productName" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="productFamily">Family</label>
                                <input type="text" id="productFamily" name="family">
                            </div>
                            <div class="form-group">
                                <label for="productPrice">Price (BDT)</label>
                                <input type="text" id="productPrice" name="priceBDT" required>
                            </div>
                            <div class="form-group">
                                <label for="productDescription">Description</label>
                                <textarea id="productDescription" name="description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="productImage">Thumbnail Image</label>
                                <input type="file" id="productImage" name="image" accept="image/*">
                            </div>
                            <button type="submit" class="btn-primary" id="productFormBtn">Add Product</button>
                        </form>
                        <div style="margin-top: 15px;">
                            <button class="btn-primary" style="background: #ff9500; border-color: #ff9500;" onclick="fixProductIds()">Fix Empty Product IDs</button>
                        </div>

                        <h3 class="card-title" style="margin-top: 40px;">Existing Products</h3>
                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th class="product-image-cell">Image</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Family</th>
                                        <th class="product-price-cell">Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="productsTableBody">
                                    <!-- Products will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="ordersTab" class="tab-content">
                    <div class="card">
                        <h2 class="card-title">Order Management</h2>
                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="ordersTableBody">
                                    <!-- Orders will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="usersTab" class="tab-content">
                    <div class="card">
                        <h2 class="card-title">User Management</h2>
                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Admin</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="usersTableBody">
                                    <!-- Users will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../js/bikes.js"></script>
    <script src="../js/features.js"></script>
    <script src="../js/script.js"></script>
    <script>
        let currentAdminUser = null;

        async function initAdmin() {
            const res = await fetch('../includes/auth_handler.php?check=1');
            const data = await res.json();
            if (!data.loggedIn || !data.user.is_admin) {
                alert('Unauthorized access. Please log in as an administrator.');
                window.location.href = '../index.php';
                return;
            }
            currentAdminUser = data.user;
            loadProducts();
            loadOrders();
            loadUsers();
        }

        function switchTab(tab) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            document.querySelector(`.admin-tabs button[onclick="switchTab('${tab}')"]`).classList.add('active');
            document.getElementById(`${tab}Tab`).classList.add('active');
        }

        async function fixProductIds() {
            if (!confirm('This will assign unique IDs to any products that have empty IDs. Continue?')) return;
            try {
                const res = await fetch('../includes/api.php?action=fixProductIds');
                const data = await res.json();
                if (data.success) {
                    alert(data.message);
                    loadProducts();
                } else {
                    alert('Error fixing product IDs: ' + data.message);
                }
            } catch (e) {
                console.error('Error fixing product IDs:', e);
                alert('Error fixing product IDs: ' + e.message);
            }
        }

        // Product Management
        async function loadProducts() {
            const res = await fetch('../includes/api.php?action=getProducts');
            const data = await res.json();
            console.log('Products data from server:', data); // Debug log
            const tbody = document.getElementById('productsTableBody');
            tbody.innerHTML = '';
            if (data.success && data.products) {
                data.products.forEach((product, index) => {
                    // Generate a unique identifier using index if id is empty for debugging
                    const uniqueId = product.id || `index-${index}`;
                    const row = tbody.insertRow();
                    row.innerHTML = `
                        <td><img src="../${product.thumbnail}" class="product-thumbnail"></td>
                        <td>${product.id || '(Empty)'}</td>
                        <td>${product.name}</td>
                        <td>${product.family}</td>
                        <td class="product-price-cell">৳ ${parseInt(product.priceBDT).toLocaleString('en-IN')}</td>
                        <td>
                            <button class="btn-primary" onclick="editProduct('${uniqueId}')">Edit</button>
                            <button class="btn-danger" onclick="deleteProduct('${uniqueId}')">Delete</button>
                        </td>
                    `;
                });
            }
        }

        document.getElementById('productForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const productId = document.getElementById('productId').value;
            
            formData.append('action', productId ? 'editProduct' : 'addProduct');

            const res = await fetch('../includes/api.php', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            if (data.success) {
                alert(productId ? 'Product updated successfully!' : 'Product added successfully!');
                form.reset();
                document.getElementById('productId').value = '';
                document.getElementById('productFormBtn').textContent = 'Add Product';
                loadProducts();
            } else {
                alert('Error: ' + data.message);
            }
        });

        async function editProduct(productId) {
            const res = await fetch(`../includes/api.php?action=getProducts`); // Fetch all products to find the one to edit
            const data = await res.json();
            if (data.success && data.products) {
                const product = data.products.find(p => p.id === productId);
                if (product) {
                    document.getElementById('productId').value = product.id;
                    document.getElementById('productName').value = product.name;
                    document.getElementById('productFamily').value = product.family;
                    document.getElementById('productPrice').value = product.priceBDT;
                    document.getElementById('productDescription').value = product.description;
                    document.getElementById('productFormBtn').textContent = 'Update Product';
                }
            }
        }

        async function deleteProduct(productId) {
            if (!confirm('Are you sure you want to delete this product?')) return;
            console.log('Attempting to delete product with ID:', productId);
            const formData = new FormData();
            formData.append('action', 'deleteProduct');
            formData.append('id', productId);
            try {
                const res = await fetch('../includes/api.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await res.json();
                console.log('Delete product response:', data);
                if (data.success) {
                    alert('Product deleted successfully!');
                    loadProducts();
                } else {
                    alert('Failed to delete product: ' + (data.message || 'Unknown error'));
                }
            } catch (e) {
                console.error('Error deleting product:', e);
                alert('Error deleting product: ' + e.message);
            }
        }

        // Order Management
        async function loadOrders() {
            const res = await fetch('../includes/api.php?action=getOrders');
            const data = await res.json();
            const tbody = document.getElementById('ordersTableBody');
            tbody.innerHTML = '';
            if (data.success && data.orders) {
                data.orders.forEach(order => {
                    const row = tbody.insertRow();
                    row.innerHTML = `
                        <td>${order.order_id}</td>
                        <td>${order.customer_name}</td>
                        <td>${order.items_desc}</td>
                        <td>৳ ${parseInt(order.total_price).toLocaleString('en-IN')}</td>
                        <td><span class="order-status status-${order.status.toLowerCase()}">${order.status}</span></td>
                        <td>
                            <select onchange="updateOrderStatus(${order.order_id}, this.value)">
                                <option value="Pending" ${order.status === 'Pending' ? 'selected' : ''}>Pending</option>
                                <option value="Approved" ${order.status === 'Approved' ? 'selected' : ''}>Approved</option>
                                <option value="Rejected" ${order.status === 'Rejected' ? 'selected' : ''}>Rejected</option>
                                <option value="Delivered" ${order.status === 'Delivered' ? 'selected' : ''}>Delivered</option>
                            </select>
                        </td>
                    `;
                });
            }
        }

        async function updateOrderStatus(orderId, status) {
            const formData = new FormData();
            formData.append('action', 'updateOrderStatus');
            formData.append('order_id', orderId);
            formData.append('status', status);
            const res = await fetch('../includes/api.php', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            if (data.success) {
                alert('Order status updated successfully!');
                loadOrders();
            } else {
                alert('Error: ' + data.message);
            }
        }

        // User Management
        async function loadUsers() {
            const res = await fetch('../includes/auth_handler.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=listUsers'
            });
            const data = await res.json();
            const tbody = document.getElementById('usersTableBody');
            tbody.innerHTML = '';
            if (data.success && data.users) {
                data.users.forEach(user => {
                    const row = tbody.insertRow();
                    row.innerHTML = `
                        <td>${user.id}</td>
                        <td>${user.first_name} ${user.last_name}</td>
                        <td>${user.contact}</td>
                        <td>${user.is_admin ? 'Yes' : 'No'}</td>
                        <td>
                            <button class="btn-danger" onclick="deleteUser(${user.id})">Delete</button>
                            ${!user.is_admin ? `<button class="btn-primary" onclick="makeAdmin(${user.id})">Make Admin</button>` : ''}
                        </td>
                    `;
                });
            }
        }

        async function deleteUser(userId) {
            if (!confirm('Are you sure you want to delete this user?')) return;
            const formData = new FormData();
            formData.append('action', 'deleteUser');
            formData.append('id', userId);
            const res = await fetch('../includes/auth_handler.php', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            if (data.success) {
                alert('User deleted successfully!');
                loadUsers();
            } else {
                alert('Error: ' + data.message);
            }
        }

        async function makeAdmin(userId) {
            if (!confirm('Are you sure you want to make this user an admin?')) return;
            const formData = new FormData();
            formData.append('action', 'makeAdmin');
            formData.append('user_id', userId);
            const res = await fetch('../includes/auth_handler.php', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            if (data.success) {
                alert('User is now an admin!');
                loadUsers();
            } else {
                alert('Error: ' + data.message);
            }
        }

        document.addEventListener('DOMContentLoaded', initAdmin);
    </script>
    <script src="../js/cursor.js"></script>
</body>
</html>
