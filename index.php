<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="MR. VIKING - Crafting motorcycle art since 1945. Each motorcycle is handcrafted and assembled by expert and passionate technicians.">
    <title>MR. VIKING - Italian Motorcycle Art Since 1945</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/mega-menu.css">
    <link rel="icon" type="image/png" href="images/Mr. Viking.png">
</head>

<body>
    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="preloader-logo">MR. VIKING</div>
            <div class="preloader-bar">
                <div class="preloader-bar-fill"></div>
            </div>
            <div class="preloader-text">Loading Experience...</div>
        </div>
    </div>



    <!-- Header / Navigation -->
    <header class="header" id="header">
        <div class="header-inner">
            <a href="index.php" class="logo" id="logo">
                <img src="images/Mr. Viking.png" alt="MR. VIKING Logo" class="logo-img">
                <span class="logo-text">MR. VIKING</span>
            </a>
            <nav class="main-nav" id="mainNav">
                <ul class="nav-list">
                    <li class="nav-item nav-item--has-mega" id="navMotorcycles">
                        <a href="user/motorcycles.html" class="nav-link" data-text="Motorcycles">Motorcycles</a>

                        <!-- Mega Menu Overlay -->
                        <div class="mega-menu" id="megaMenu">
                            <div class="mega-menu-content">
                                <!-- Col 1: Families -->
                                <div class="mega-families" id="megaFamilies">
                                    <!-- Populated by JS -->
                                </div>

                                <!-- Col 2: Sub-models -->
                                <div class="mega-models" id="megaSubModels">
                                    <!-- Populated by JS -->
                                </div>

                                <!-- Col 3: Detail View -->
                                <div class="mega-detail" id="megaDetail">
                                    <div id="megaBadge" class="detail-badge">LIMITED EDITION</div>
                                    <div class="detail-img-wrapper">
                                        <img id="megaMainImg" src="" alt="Motorcycle" class="detail-main-img">
                                    </div>
                                    <div class="detail-footer">
                                        <div id="megaModelName" class="detail-logo-text">RUSH <em>Mamba</em></div>
                                        <div class="detail-specs">
                                            <div class="spec-block">
                                                <div><span id="specCyl" class="spec-num">4</span></div>
                                                <span class="spec-lab">Cylinders</span>
                                            </div>
                                            <div class="spec-block">
                                                <div><span id="specCC" class="spec-num">998</span><span
                                                        class="spec-unit">CC</span></div>
                                                <span class="spec-lab">Capacity</span>
                                            </div>
                                            <div class="spec-block">
                                                <div><span id="specHP" class="spec-num">208</span><span
                                                        class="spec-unit">HP</span></div>
                                                <span class="spec-lab">Horsepower</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"><a href="user/about-us.html" class="nav-link" data-text="About Us">About Us</a></li>
                    <li class="nav-item"><a href="user/community.html" class="nav-link" data-text="Community">Community</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <button class="login-btn" id="loginBtn" aria-label="Login">
                    <span class="login-btn-text">Login</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        style="margin-left: 8px;">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </button>
                <button class="search-header-btn" id="searchHeaderBtn" aria-label="Search">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <span class="search-btn-text">Search</span>
                </button>
                
                <!-- New Feature Icons -->
                <a href="user/compare.html" class="feature-btn" id="compareBtn" aria-label="Compare">
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
                <a href="user/cart.html" class="feature-btn" id="cartHeaderBtn" aria-label="Shopping Cart">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                        <path d="M3 6h18"></path>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span class="badge" id="cartBadge">0</span>
                </a>

                <button class="menu-toggle" id="menuToggle" aria-label="Toggle Menu">
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                </button>
            </div>

            <!-- User Avatar Dropdown (shown when logged in) -->
            <div id="userStatus" style="display:none; position:relative; align-items:center; gap:12px;">
                <div id="userAvatarDropdown" style="position:relative;">
                    <button id="userAvatarBtn" onclick="document.getElementById('userDropdownMenu').classList.toggle('open')" style="background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:10px; color:#fff;">
                        <div id="userAvatarCircle" style="width:36px;height:36px;border-radius:50%;background:#c00000;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:0.85rem;border:2px solid #c00000;overflow:hidden;">
                            <span id="userAvatarInitial">U</span>
                            <img id="userAvatarImg" src="" alt="" style="display:none;width:100%;height:100%;object-fit:cover;">
                        </div>
                        <span id="userNameDisplay" style="font-size:0.8rem;font-weight:600;"></span>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div id="userDropdownMenu" style="display:none; position:absolute; top:calc(100% + 12px); right:0; background:#111; border:1px solid rgba(255,255,255,0.1); border-radius:10px; min-width:200px; padding:10px 0; z-index:9999; box-shadow: 0 20px 40px rgba(0,0,0,0.5);">
                        <a href="user/profile.php" style="display:flex;align-items:center;gap:10px;padding:12px 20px;color:#ddd;text-decoration:none;font-size:0.82rem;transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='none'">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            My Profile
                        </a>
                        <a href="user/profile.php" onclick="setTimeout(()=>window.profileSwitchTab&&profileSwitchTab('orders'),100)" style="display:flex;align-items:center;gap:10px;padding:12px 20px;color:#ddd;text-decoration:none;font-size:0.82rem;transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='none'">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg>
                            My Orders
                        </a>
                        <div id="adminDropLink" style="display:none;">
                            <div style="border-top:1px solid rgba(255,255,255,0.07);margin:6px 0;"></div>
                            <a href="admin/admin.php" style="display:flex;align-items:center;gap:10px;padding:12px 20px;color:#c00000;text-decoration:none;font-size:0.82rem;font-weight:700;transition:background 0.2s;" onmouseover="this.style.background='rgba(192,0,0,0.08)'" onmouseout="this.style.background='none'">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>
                                Admin Dashboard
                            </a>
                        </div>
                        <div style="border-top:1px solid rgba(255,255,255,0.07);margin:6px 0;"></div>
                        <button id="logoutBtn" onclick="Auth.handleLogout()" style="display:flex;align-items:center;gap:10px;padding:12px 20px;color:#ff4444;font-size:0.82rem;background:none;border:none;cursor:pointer;width:100%;text-align:left;transition:background 0.2s;" onmouseover="this.style.background='rgba(255,68,68,0.06)'" onmouseout="this.style.background='none'">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Auth Modal -->
    <div class="auth-modal" id="authModal">
        <div class="auth-modal-backdrop" id="authClose"></div>
        <div class="auth-container">
            <button class="auth-close-btn" id="authCloseBtn">&times;</button>

            <div id="loginMsg" style="display:none; padding:10px; margin-bottom:15px; border-radius:4px; text-align:center; font-weight:bold; font-size: 0.9rem;"></div>

            <!-- Login View -->
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
                            <input type="password" id="loginPass" placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢" required>
                            <button type="button" class="pw-eye-btn" onclick="togglePw('loginPass',this)" aria-label="Toggle password">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
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
                        <img src="images/fb_icon.png" alt="Facebook">
                        <span>Continue with Facebook</span>
                    </button>
                </div>

                <div class="auth-footer">
                    <p>Don't have an account? <a href="#" id="toSignup">Sign Up</a></p>
                </div>
            </div>

            <!-- Signup View -->
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
                        <label for="signupContact" id="contactLabel">Email Address</label>
                        <input type="text" id="signupContact" placeholder="email@example.com" required>
                        <button type="button" class="toggle-contact-btn" id="toggleContact">Mobile Number, username or email</button>
                    </div>

                    <div class="form-group-auth">
                        <label for="signupPass">Password</label>
                        <div class="pw-wrap">
                            <input type="password" id="signupPass" placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢" required>
                            <button type="button" class="pw-eye-btn" onclick="togglePw('signupPass',this)" aria-label="Toggle password">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
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

    <!-- Mega Menu - Motorcycles -->
    <div class="mega-menu" id="megaMenu" role="dialog" aria-label="Motorcycles Menu">
        <div class="mega-menu-inner" style="grid-template-columns: 240px 240px 1fr;">
            <!-- Column 1: Families -->
            <div class="mega-menu-left" id="megaFamilyList" style="background: #fdfdfd;">
                <!-- Populated by JS -->
            </div>

            <!-- Column 2: Variants -->
            <div class="mega-menu-left" id="megaVariantList"
                style="background: #ffffff; border-right: 1px solid #eeeeee;">
                <!-- Populated by JS -->
            </div>

            <!-- Column 3: Preview -->
            <div class="mega-menu-right" id="megaPreviewArea">
                <div class="mega-preview-header">
                    <span class="mega-variant-name" id="megaVariantName">Select a Model</span>
                    <span class="mega-badge" id="megaBadge"></span>
                </div>
                <div class="mega-preview-image">
                    <img src="images/hero_motorcycle_1775993542951.png" alt="Model Preview" id="megaPreviewImg">
                </div>
                <div class="mega-preview-footer">
                    <span class="mega-model-title-large" id="megaModelTitle">MR. VIKING</span>
                    <div class="mega-preview-specs">
                        <div class="mega-spec-item">
                            <span class="mega-spec-val" id="megaSpecCyl">-</span>
                            <span class="mega-spec-label">Cylinders</span>
                        </div>
                        <div class="mega-spec-item">
                            <span class="mega-spec-val" id="megaSpecCc">-<sup>cc</sup></span>
                            <span class="mega-spec-label">Capacity</span>
                        </div>
                        <div class="mega-spec-item">
                            <span class="mega-spec-val" id="megaSpecHp">-<sup>HP</sup></span>
                            <span class="mega-spec-label">Horsepower</span>
                        </div>
                    </div>
                </div>
                <a href="user/motorcycles.html" class="mega-explore-btn" id="megaExploreBtn"
                    style="margin-top: 20px;">Explore Range &rarr;</a>
            </div>
        </div>
    </div>
    <div class="mega-menu-backdrop" id="megaMenuBackdrop"></div>

    <!-- Full Screen Mobile Menu -->
    <div class="fullscreen-menu" id="fullscreenMenu">
        <div class="fullscreen-menu-inner">
            <ul class="fullscreen-nav-list">
                <li class="fullscreen-nav-item"><a href="#motorcycles" class="fullscreen-nav-link">Motorcycles</a></li>
                <li class="fullscreen-nav-item"><a href="#heritage" class="fullscreen-nav-link">Heritage</a></li>
                <li class="fullscreen-nav-item"><a href="#innovation" class="fullscreen-nav-link">Innovation</a></li>
                <li class="fullscreen-nav-item"><a href="#racing" class="fullscreen-nav-link">Racing</a></li>
                <li class="fullscreen-nav-item"><a href="user/about-us.html" class="fullscreen-nav-link">About Us</a></li>
                <li class="fullscreen-nav-item"><a href="#" class="fullscreen-nav-link">News</a></li>
            </ul>
            <div class="fullscreen-menu-footer">
                <div class="menu-social-links">
                    <a href="#" class="social-link">Instagram</a>
                    <a href="#" class="social-link">Facebook</a>
                    <a href="#" class="social-link">YouTube</a>
                    <a href="#" class="social-link">X</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Slider Section -->
    <section class="hero-slider" id="heroSlider">
        <div class="slider-wrapper">
            <!-- Slide 1: Sartoria Meccanica -->
            <div class="slide active" data-index="0">
                <div class="slide-bg"
                    style="background-image: url('images/Heropage/imgi_78_SartoriaMeccanicaHPDesk.jpg');"></div>
                <div class="slide-content">
                    <h1 class="slide-title">SARTORIA<br>MECCANICA</h1>
                    <a href="user/motorcycles.html" class="btn btn-slider">LEARN MORE</a>
                </div>
            </div>

            <!-- Slide 2: SV Ago -->
            <div class="slide" data-index="1">
                <div class="slide-bg"
                    style="background-image: url('images/Heropage/imgi_81_SVAgo-Banner-Desktop.jpg');"></div>
                <div class="slide-content">
                    <h1 class="slide-title">A TRIBUTE<br>TO GREATNESS</h1>
                    <a href="user/motorcycles.html" class="btn btn-slider">LEARN MORE</a>
                </div>
            </div>

            <!-- Slide 3: Brutale -->
            <div class="slide" data-index="2">
                <div class="slide-bg"
                    style="background-image: url('images/Heropage/imgi_63_Brutale-Serie-Oro-HP-Desktop.jpg');"></div>
                <div class="slide-content">
                    <h1 class="slide-title">BRUTALE<br>SERIE ORO</h1>
                    <a href="user/motorcycles.html" class="btn btn-slider">LEARN MORE</a>
                </div>
            </div>

            <!-- Slide 4: F3 -->
            <div class="slide" data-index="3">
                <div class="slide-bg" style="background-image: url('images/Heropage/imgi_89_f3-competizione.jpg');">
                </div>
                <div class="slide-content">
                    <h1 class="slide-title">F3<br>COMPETIZIONE</h1>
                    <a href="user/motorcycles.html" class="btn btn-slider">LEARN MORE</a>
                </div>
            </div>

            <!-- Slide 5: Rush -->
            <div class="slide" data-index="4">
                <div class="slide-bg" style="background-image: url('images/Heropage/imgi_59_rush-titanio.jpg');"></div>
                <div class="slide-content">
                    <h1 class="slide-title">RUSH<br>TITANIO</h1>
                    <a href="user/motorcycles.html" class="btn btn-slider">LEARN MORE</a>
                </div>
            </div>
        </div>

        <!-- Slider Controls -->
        <div class="slider-controls">
            <button class="slider-arrow prev" aria-label="Previous Slide">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M15 18l-6-6 6-6" />
                </svg>
            </button>
            <button class="slider-arrow next" aria-label="Next Slide">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M9 18l6-6-6-6" />
                </svg>
            </button>
        </div>

        <!-- Slider Pagination -->
        <div class="slider-pagination">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </section>

    <!-- About Us Teaser Section -->
    <section class="about-teaser" id="aboutTeaser" style="background-color: #f1f1f1; padding: 120px 5vw;">
        <div style="max-width: 1400px; margin: 0 auto; display: flex; flex-direction: column; gap: 50px;">
            <!-- Typography block mixed with inline video -->
            <div style="text-align: center;">
                <h2 style="color: #000; line-height: 1.1; margin: 0; text-transform: uppercase;">
                    <!-- Line 1 -->
                    <span
                        style="font-family: Impact, sans-serif; font-size: clamp(3rem, 6vw, 6rem); letter-spacing: 0.05em; display: inline-flex; align-items: baseline; justify-content: center; flex-wrap: wrap;">
                        <span
                            style="display: inline-block; width: 1.7em; height: 1em; background: #000; overflow: hidden; margin-right: 0.15em; border-radius: 4px; vertical-align: text-bottom; flex-shrink: 0;">
                            <iframe
                                src="https://player.vimeo.com/video/966531287?background=1&autoplay=1&loop=1&muted=1"
                                style="width: 100%; height: 100%; border: none;" allow="autoplay; fullscreen"
                                allowfullscreen></iframe>
                        </span>
                        WE DO NOT
                    </span>
                    <span
                        style="font-family: 'Playfair Display', serif; font-weight: 700; font-style: normal; font-size: clamp(3rem, 6vw, 6rem); letter-spacing: -0.02em;">
                        SIMPLY</span><br>

                    <!-- Line 2 -->
                    <span
                        style="font-family: 'Playfair Display', serif; font-weight: 700; font-style: normal; font-size: clamp(3rem, 6vw, 6rem); letter-spacing: -0.02em;">BUILD</span>
                    <span
                        style="font-family: Impact, sans-serif; font-size: clamp(3rem, 6vw, 6rem); letter-spacing: 0.05em;">
                        MOTORCYCLES,</span><br>

                    <!-- Line 3 -->
                    <span
                        style="font-family: Impact, sans-serif; font-size: clamp(3rem, 6vw, 6rem); letter-spacing: 0.05em;">WE
                    </span>
                    <span
                        style="font-family: 'Playfair Display', serif; font-weight: 700; font-style: normal; font-size: clamp(3rem, 6vw, 6rem); letter-spacing: -0.02em;">CRAFT</span>
                    <span
                        style="font-family: Impact, sans-serif; font-size: clamp(3rem, 6vw, 6rem); letter-spacing: 0.05em;">
                        EMOTIONS.</span>
                </h2>
            </div>

            <!-- Context and CTA -->
            <div
                style="text-align: center; display: flex; flex-direction: column; align-items: center; gap: 25px; margin-top: 20px;">
                <p
                    style="color: #333; font-family: 'Inter', sans-serif; font-size: 1.15rem; max-width: 700px; line-height: 1.6; margin: 0;">
                    We look to the future, and build machines that are always one step ahead. Discover our legacy and
                    the passion that drives every MR. VIKING.
                </p>
                <a href="user/about-us.html"
                    style="display: inline-flex; align-items: center; justify-content: center; padding: 15px 40px; border: 2px solid #000; color: #000; background: #fff; text-transform: uppercase; font-family: Impact, sans-serif; font-size: 1.2rem; letter-spacing: 0.1em; transition: all 0.3s ease; text-decoration: none;"
                    onmouseover="this.style.background='#000'; this.style.color='#fff';"
                    onmouseout="this.style.background='#fff'; this.style.color='#000';">
                    ABOUT US <span style="font-size: 0.8rem; margin-left: 10px;">&#9654;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Models Interactive Gallery (SECTION 3) -->
    <section class="models-accordion-section"
        style="width: 100vw; height: 90vh; min-height: 600px; background: #f1f1f1; display: flex; overflow: hidden; padding: 30px 1.5vw; gap: 6px;">
        <style>
            .acc-panel {
                flex: 1;
                background: #fff;
                position: relative;
                transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
                overflow: hidden;
                cursor: pointer;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items: center;
                padding-top: 0;
                padding-bottom: 30px;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            }

            .models-accordion-section:hover .acc-panel:not(:hover):not(.active) {
                opacity: 0.7;
                filter: grayscale(0.2);
            }

            .acc-panel:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
                z-index: 10;
            }

            .acc-panel.active {
                flex: 12;
                cursor: default;
                padding: 0;
                display: block;
                opacity: 1 !important;
                filter: none !important;
                transform: none !important;
            }

            /* Collapsed State Thumbnails */
            .acc-thumb-wrapper {
                width: 100%;
                height: 100px;
                position: relative;
                overflow: hidden;
                margin-top: 10px;
                transition: opacity 0.3s;
                display: flex;
                align-items: center;
            }

            .acc-thumb {
                position: absolute;
                height: 100%;
                width: 250%;
                /* Large width to ensure it is cut in half */
                object-fit: cover;
                object-position: right center;
                /* Focus on the right half of the image */
                right: 0;
                /* Anchor flush against the right */
            }

            /* Override for the LXP Logo which shouldn't be cut */
            .acc-thumb.logo-thumb {
                position: static;
                width: 80%;
                margin: 0 auto;
                object-fit: contain;
                object-position: center;
            }

            .acc-vertical-title {
                writing-mode: vertical-rl;
                transform: rotate(180deg);
                font-family: Impact, sans-serif;
                font-size: 2rem;
                letter-spacing: 0.05em;
                color: #000;
                text-transform: uppercase;
                transition: opacity 0.3s;
                white-space: nowrap;
                margin-top: auto;
            }

            .acc-panel.active .acc-thumb-wrapper,
            .acc-panel.active .acc-vertical-title {
                opacity: 0;
                pointer-events: none;
                position: absolute;
            }

            /* Expanded State */
            .acc-expanded-content {
                position: absolute;
                inset: 0;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.4s 0.2s;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                padding: 40px;
            }

            .acc-panel.active .acc-expanded-content {
                opacity: 1;
                pointer-events: auto;
            }

            .acc-logo {
                height: 30px;
                width: auto;
                object-fit: contain;
                object-position: left top;
            }

            .acc-bike-main {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 85%;
                height: auto;
                max-height: 70vh;
                object-fit: contain;
                filter: drop-shadow(0 30px 40px rgba(0, 0, 0, 0.2));
            }

            .acc-footer {
                display: flex;
                justify-content: space-between;
                align-items: flex-end;
                z-index: 2;
            }

            .acc-desc {
                font-family: 'Inter', sans-serif;
                font-size: 0.9rem;
                line-height: 1.5;
                color: #333;
                max-width: 400px;
            }

            .acc-btn {
                font-family: 'Orbitron', sans-serif;
                font-weight: 900;
                border: 1px solid #000;
                padding: 12px 30px;
                font-size: 0.85rem;
                letter-spacing: 0.1em;
                color: #000;
                text-decoration: none;
                text-transform: uppercase;
                transition: all 0.3s ease;
                background: transparent;
            }

            .acc-btn:hover {
                background: #000;
                color: #fff;
            }
        </style>

        <!-- 1. Rush -->
        <div class="acc-panel" onclick="activateAccPanel(this)">
            <div class="acc-thumb-wrapper">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/RUSH Mamba.webp" class="acc-thumb"
                    alt="Rush Thumb">
            </div>
            <div class="acc-vertical-title">RUSH</div>
            <div class="acc-expanded-content">
                <img src="images/MR. VIKING - About Us - MR. VIKING/imgi_8_rush-logo.svg" class="acc-logo"
                    alt="Rush Logo">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/RUSH Mamba.webp" class="acc-bike-main"
                    alt="Rush Main">
                <div class="acc-footer">
                    <p class="acc-desc">Hyper naked without compromises. The ultimate expression of power and
                        breathtaking design, crafted for drag-strip supremacy.</p>
                    <a href="user/motorcycles.html" class="acc-btn">LEARN MORE</a>
                </div>
            </div>
        </div>

        <!-- 2. Brutale -->
        <div class="acc-panel" onclick="activateAccPanel(this)">
            <div class="acc-thumb-wrapper">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/BRUTALE 1000 RR.webp" class="acc-thumb"
                    alt="Brutale Thumb">
            </div>
            <div class="acc-vertical-title">BRUTALE</div>
            <div class="acc-expanded-content">
                <img src="images/MR. VIKING - About Us - MR. VIKING/imgi_12_brutale-1000-rr.svg" class="acc-logo"
                    alt="Brutale Logo">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/BRUTALE 1000 RR.webp" class="acc-bike-main"
                    alt="Brutale Main">
                <div class="acc-footer">
                    <p class="acc-desc">The hyper naked icon. Pure muscular aesthetic combined with cutting edge hyper
                        sports performance.</p>
                    <a href="user/motorcycles.html" class="acc-btn">LEARN MORE</a>
                </div>
            </div>
        </div>

        <!-- 3. Dragster (Active by default) -->
        <div class="acc-panel active" onclick="activateAccPanel(this)">
            <div class="acc-thumb-wrapper">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/DRAGSTER RR OTTANTESIMO.webp"
                    class="acc-thumb" alt="Dragster Thumb">
            </div>
            <div class="acc-vertical-title">DRAGSTER</div>
            <div class="acc-expanded-content">
                <img src="images/MR. VIKING - About Us - MR. VIKING/imgi_17_dragster-rr-ottantesimo.svg" class="acc-logo"
                    alt="Dragster Logo">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/DRAGSTER RR OTTANTESIMO.webp"
                    class="acc-bike-main" alt="Dragster Main">
                <div class="acc-footer">
                    <p class="acc-desc">Awe-inspiring, compact and a lifestyle statement in its own right. Dragster is
                        the perfect blend of technology, raw power and design.</p>
                    <a href="user/motorcycles.html" class="acc-btn">LEARN MORE</a>
                </div>
            </div>
        </div>

        <!-- 4. Turismo Veloce -->
        <div class="acc-panel" onclick="activateAccPanel(this)">
            <div class="acc-thumb-wrapper">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/TURISMO VELOCE LUSSO SCS.webp"
                    class="acc-thumb" alt="Turismo Veloce Thumb">
            </div>
            <div class="acc-vertical-title">TURISMO VELOCE</div>
            <div class="acc-expanded-content">
                <img src="images/MR. VIKING - About Us - MR. VIKING/imgi_20_turismo-veloce-r.svg" class="acc-logo"
                    alt="Turismo Veloce Logo">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/TURISMO VELOCE LUSSO SCS.webp"
                    class="acc-bike-main" alt="Turismo Veloce Main">
                <div class="acc-footer">
                    <p class="acc-desc">The sports tourer from Schiranna. Taking the unmistakable styling and emotion of
                        an MR. VIKING grand touring.</p>
                    <a href="user/motorcycles.html" class="acc-btn">LEARN MORE</a>
                </div>
            </div>
        </div>

        <!-- 5. F3 -->
        <div class="acc-panel" onclick="activateAccPanel(this)">
            <div class="acc-thumb-wrapper">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/F3 RR.webp" class="acc-thumb"
                    alt="F3 Thumb">
            </div>
            <div class="acc-vertical-title">F3</div>
            <div class="acc-expanded-content">
                <img src="images/MR. VIKING - About Us - MR. VIKING/imgi_27_f3-r.svg" class="acc-logo" alt="F3 Logo">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/F3 RR.webp" class="acc-bike-main"
                    alt="F3 Main">
                <div class="acc-footer">
                    <p class="acc-desc">The ultimate supersport. A balance of breathtaking lines and championship
                        winning performance.</p>
                    <a href="user/motorcycles.html" class="acc-btn">LEARN MORE</a>
                </div>
            </div>
        </div>

        <!-- 6. Superveloce -->
        <div class="acc-panel" onclick="activateAccPanel(this)">
            <div class="acc-thumb-wrapper">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/SUPERVELOCE S.webp" class="acc-thumb"
                    alt="Superveloce Thumb">
            </div>
            <div class="acc-vertical-title">SUPERVELOCE</div>
            <div class="acc-expanded-content">
                <img src="images/MR. VIKING - About Us - MR. VIKING/imgi_34_superveloce-s.svg" class="acc-logo"
                    alt="Superveloce Logo">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/SUPERVELOCE S.webp" class="acc-bike-main"
                    alt="Superveloce Main">
                <div class="acc-footer">
                    <p class="acc-desc">Neo-classic racing design. The modern interpretation of the iconic MR. VIKING
                        racing legacy.</p>
                    <a href="user/motorcycles.html" class="acc-btn">LEARN MORE</a>
                </div>
            </div>
        </div>

        <!-- 7. Enduro Veloce -->
        <div class="acc-panel" onclick="activateAccPanel(this)">
            <div class="acc-thumb-wrapper">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/ENDURO VELOCE ENDURO VELOCE.webp"
                    class="acc-thumb" alt="Enduro Veloce Thumb">
            </div>
            <div class="acc-vertical-title">ENDURO VELOCE</div>
            <div class="acc-expanded-content">
                <img src="images/MR. VIKING - About Us - MR. VIKING/imgi_43_enduro-veloce-enduro-veloce.svg"
                    class="acc-logo" alt="Enduro Veloce Logo">
                <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/ENDURO VELOCE ENDURO VELOCE.webp"
                    class="acc-bike-main" alt="Enduro Veloce Main">
                <div class="acc-footer">
                    <p class="acc-desc">The new era of all-terrain adventure. Master every horizon with unrelenting
                        performance.</p>
                    <a href="user/motorcycles.html" class="acc-btn">LEARN MORE</a>
                </div>
            </div>
        </div>

        <script>
            function activateAccPanel(clickedPanel) {
                document.querySelectorAll('.acc-panel').forEach(panel => {
                    panel.classList.remove('active');
                });
                clickedPanel.classList.add('active');
            }
        </script>
    </section>

    <!-- Models Showcase (SECTION 4) -->
    <section class="models-section" id="motorcycles">
        <style>
            .models-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
                transition: all 0.5s ease;
            }

            .model-card {
                /* Restoring original dark background/border from styles.css */
                background: var(--color-bg-card);
                border: 1px solid var(--color-border);
                /* Keeping requested reduced radius */
                border-radius: 12px;
                overflow: hidden;
                transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .models-grid:hover .model-card:not(:hover) {
                opacity: 0.5;
                filter: grayscale(0.5) brightness(0.8);
                transform: scale(0.97);
            }

            .model-card:hover {
                transform: translateY(-10px) scale(1.02);
                box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
                border-color: var(--color-accent);
                z-index: 2;
            }
        </style>
        <div class="section-container">
            <div class="section-header">
                <div class="section-label">
                    <span class="label-line"></span>
                    <span>The Range</span>
                </div>
                <h2 class="section-title">Our Motorcycles</h2>
                <p class="section-subtitle">Each model represents the pinnacle of Italian engineering and design
                    excellence.</p>
            </div>
            <div class="models-grid" id="modelsGrid">
                <!-- Model Card 1 - Rush -->
                <div class="model-card" data-model="rush">
                    <div class="model-card-image">
                        <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/RUSH Mamba.webp"
                            alt="MR. VIKING Rush" loading="lazy">
                        <div class="model-card-overlay">
                            <span class="model-badge">Limited Edition</span>
                        </div>
                        <div class="model-actions-hover">
                            <button class="action-btn" data-action="add-wishlist" data-id="rush-mamba" title="Add to Wishlist">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </button>
                            <button class="action-btn" data-action="add-compare" data-id="rush-mamba" title="Compare">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 3h5v5M4 20L21 3M21 16v5h-5M15 15l6 6M4 4l5 5" />
                                </svg>
                            </button>
                            <button class="action-btn" data-action="add-cart" data-id="rush-mamba" title="Add to Cart">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                                    <path d="M3 6h18"></path>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="model-card-info">
                        <h3 class="model-name">Rush</h3>
                        <p class="model-tagline">Mamba Limited Edition</p>
                        <div class="model-specs-mini">
                            <div class="mini-spec">
                                <span class="mini-spec-val">4</span>
                                <span class="mini-spec-label">CYL</span>
                            </div>
                            <div class="mini-spec">
                                <span class="mini-spec-val">998</span>
                                <span class="mini-spec-label">CC</span>
                            </div>
                            <div class="mini-spec">
                                <span class="mini-spec-val">208</span>
                                <span class="mini-spec-label">HP</span>
                            </div>
                        </div>
                        <a href="user/model-detail.html" class="model-link">
                            <span>Explore</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Model Card 2 - Brutale -->
                <div class="model-card" data-model="brutale">
                    <div class="model-card-image">
                        <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/BRUTALE 1000 RR.webp"
                            alt="MR. VIKING Brutale" loading="lazy">
                        <div class="model-card-overlay"></div>
                        <div class="model-actions-hover">
                            <button class="action-btn" data-action="add-wishlist" data-id="brutale-1000-rr" title="Add to Wishlist">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </button>
                            <button class="action-btn" data-action="add-compare" data-id="brutale-1000-rr" title="Compare">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 3h5v5M4 20L21 3M21 16v5h-5M15 15l6 6M4 4l5 5" />
                                </svg>
                            </button>
                            <button class="action-btn" data-action="add-cart" data-id="brutale-1000-rr" title="Add to Cart">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                                    <path d="M3 6h18"></path>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="model-card-info">
                        <h3 class="model-name">Brutale</h3>
                        <p class="model-tagline">1000 RR</p>
                        <div class="model-specs-mini">
                            <div class="mini-spec">
                                <span class="mini-spec-val">4</span>
                                <span class="mini-spec-label">CYL</span>
                            </div>
                            <div class="mini-spec">
                                <span class="mini-spec-val">998</span>
                                <span class="mini-spec-label">CC</span>
                            </div>
                            <div class="mini-spec">
                                <span class="mini-spec-val">208</span>
                                <span class="mini-spec-label">HP</span>
                            </div>
                        </div>
                        <a href="user/model-detail.html" class="model-link">
                            <span>Explore</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Model Card 3 - Superveloce -->
                <div class="model-card" data-model="superveloce">
                    <div class="model-card-image">
                        <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/SUPERVELOCE S.webp"
                            alt="MR. VIKING Superveloce" loading="lazy">
                        <div class="model-card-overlay">
                            <span class="model-badge">New</span>
                        </div>
                        <div class="model-actions-hover">
                            <button class="action-btn" data-action="add-wishlist" data-id="superveloce-s" title="Add to Wishlist">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </button>
                            <button class="action-btn" data-action="add-compare" data-id="superveloce-s" title="Compare">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 3h5v5M4 20L21 3M21 16v5h-5M15 15l6 6M4 4l5 5" />
                                </svg>
                            </button>
                            <button class="action-btn" data-action="add-cart" data-id="superveloce-s" title="Add to Cart">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                                    <path d="M3 6h18"></path>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="model-card-info">
                        <h3 class="model-name">Superveloce</h3>
                        <p class="model-tagline">S</p>
                        <div class="model-specs-mini">
                            <div class="mini-spec">
                                <span class="mini-spec-val">3</span>
                                <span class="mini-spec-label">CYL</span>
                            </div>
                            <div class="mini-spec">
                                <span class="mini-spec-val">798</span>
                                <span class="mini-spec-label">CC</span>
                            </div>
                            <div class="mini-spec">
                                <span class="mini-spec-val">148</span>
                                <span class="mini-spec-label">HP</span>
                            </div>
                        </div>
                        <a href="user/model-detail.html" class="model-link">
                            <span>Explore</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Model Card 4 - Dragster -->
                <div class="model-card" data-model="dragster">
                    <div class="model-card-image">
                        <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/DRAGSTER RR OTTANTESIMO.webp"
                            alt="MR. VIKING Dragster" loading="lazy">
                        <div class="model-card-overlay">
                            <span class="model-badge">Limited Edition</span>
                        </div>
                        <div class="model-actions-hover">
                            <button class="action-btn" data-action="add-wishlist" data-id="dragster-rr-80" title="Add to Wishlist">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </button>
                            <button class="action-btn" data-action="add-compare" data-id="dragster-rr-80" title="Compare">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 3h5v5M4 20L21 3M21 16v5h-5M15 15l6 6M4 4l5 5" />
                                </svg>
                            </button>
                            <button class="action-btn" data-action="add-cart" data-id="dragster-rr-80" title="Add to Cart">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                                    <path d="M3 6h18"></path>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="model-card-info">
                        <h3 class="model-name">Dragster</h3>
                        <p class="model-tagline">RR Ottantesimo</p>
                        <div class="model-specs-mini">
                            <div class="mini-spec">
                                <span class="mini-spec-val">3</span>
                                <span class="mini-spec-label">CYL</span>
                            </div>
                            <div class="mini-spec">
                                <span class="mini-spec-val">801</span>
                                <span class="mini-spec-label">CC</span>
                            </div>
                            <div class="mini-spec">
                                <span class="mini-spec-val">140</span>
                                <span class="mini-spec-label">HP</span>
                            </div>
                        </div>
                        <a href="user/model-detail.html" class="model-link">
                            <span>Explore</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Model Card 5 - F3 -->
                <div class="model-card" data-model="f3">
                    <div class="model-card-image">
                        <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/F3 RR.webp" alt="MR. VIKING F3"
                            loading="lazy">
                        <div class="model-card-overlay"></div>
                        <div class="model-actions-hover">
                            <button class="action-btn" data-action="add-wishlist" data-id="f3-rr" title="Add to Wishlist">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </button>
                            <button class="action-btn" data-action="add-compare" data-id="f3-rr" title="Compare">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 3h5v5M4 20L21 3M21 16v5h-5M15 15l6 6M4 4l5 5" />
                                </svg>
                            </button>
                            <button class="action-btn" data-action="add-cart" data-id="f3-rr" title="Add to Cart">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                                    <path d="M3 6h18"></path>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="model-card-info">
                        <h3 class="model-name">F3</h3>
                        <p class="model-tagline">RR</p>
                        <div class="model-specs-mini">
                            <div class="mini-spec">
                                <span class="mini-spec-val">3</span>
                                <span class="mini-spec-label">CYL</span>
                            </div>
                            <div class="mini-spec">
                                <span class="mini-spec-val">798</span>
                                <span class="mini-spec-label">CC</span>
                            </div>
                            <div class="mini-spec">
                                <span class="mini-spec-val">147</span>
                                <span class="mini-spec-label">HP</span>
                            </div>
                        </div>
                        <a href="user/model-detail.html" class="model-link">
                            <span>Explore</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Model Card 6 - Turismo Veloce -->
                <div class="model-card" data-model="turismo">
                    <div class="model-card-image">
                        <img src="images/MR. VIKING - About Us - MR. VIKING/All Bikes/TURISMO VELOCE LUSSO SCS.webp"
                            alt="MR. VIKING Turismo Veloce" loading="lazy">
                        <div class="model-card-overlay"></div>
                        <div class="model-actions-hover">
                            <button class="action-btn" data-action="add-wishlist" data-id="turismo-veloce-lusso" title="Add to Wishlist">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </button>
                            <button class="action-btn" data-action="add-compare" data-id="turismo-veloce-lusso" title="Compare">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 3h5v5M4 20L21 3M21 16v5h-5M15 15l6 6M4 4l5 5" />
                                </svg>
                            </button>
                            <button class="action-btn" data-action="add-cart" data-id="turismo-veloce-lusso" title="Add to Cart">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                                    <path d="M3 6h18"></path>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="model-card-info">
                        <h3 class="model-name">Turismo Veloce</h3>
                        <p class="model-tagline">Lusso SCS</p>
                        <div class="model-specs-mini">
                            <div class="mini-spec">
                                <span class="mini-spec-val">3</span>
                                <span class="mini-spec-label">CYL</span>
                            </div>
                            <div class="mini-spec">
                                <span class="mini-spec-val">798</span>
                                <span class="mini-spec-label">CC</span>
                            </div>
                            <div class="mini-spec">
                                <span class="mini-spec-val">110</span>
                                <span class="mini-spec-label">HP</span>
                            </div>
                        </div>
                        <a href="user/model-detail.html" class="model-link">
                            <span>Explore</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Heritage / Story Section -->
    <section class="heritage-section" id="heritage">
        <div class="heritage-parallax-bg"></div>
        <div class="section-container">
            <div class="heritage-content">
                <div class="heritage-left">
                    <div class="section-label">
                        <span class="label-line"></span>
                        <span>Our Story</span>
                    </div>
                    <h2 class="heritage-title">A Legacy of <br><em>Italian Excellence</em></h2>
                    <p class="heritage-text">Since 1945, MR. VIKING has been synonymous with Italian motorcycle
                        excellence. Born from the vision of Count Domenico Agusta, who transformed a small aviation
                        company in Cascina Costa into the most successful racing motorcycle manufacturer in history.</p>
                    <p class="heritage-text">With 37 World Championship titles and 270 Grand Prix victories, MR. VIKING
                        motorcycles are the ultimate expression of Italian design and engineering mastery.</p>
                    <div class="heritage-timeline">
                        <div class="timeline-item" data-year="1945">
                            <span class="timeline-year">1945</span>
                            <span class="timeline-event">Foundation Year</span>
                        </div>
                        <div class="timeline-item" data-year="1956">
                            <span class="timeline-year">1956</span>
                            <span class="timeline-event">First World Title</span>
                        </div>
                        <div class="timeline-item" data-year="1997">
                            <span class="timeline-year">1997</span>
                            <span class="timeline-event">F4 Revolution</span>
                        </div>
                        <div class="timeline-item" data-year="2024">
                            <span class="timeline-year">2024</span>
                            <span class="timeline-event">New Era</span>
                        </div>
                    </div>
                </div>
                <div class="heritage-right">
                    <div class="heritage-image-stack">
                        <div class="heritage-image-card heritage-card-1">
                            <img src="images/superveloce.png" alt="MR. VIKING Heritage" loading="lazy">
                        </div>
                        <div class="heritage-image-card heritage-card-2">
                            <img src="images/brutale.png" alt="MR. VIKING Racing Heritage" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Innovation Section -->
    <section class="innovation-section" id="innovation">
        <div class="section-container">
            <div class="section-header section-header-center">
                <div class="section-label">
                    <span class="label-line"></span>
                    <span>Technology</span>
                </div>
                <h2 class="section-title">Innovation at the Core</h2>
                <p class="section-subtitle">Pioneering technologies that push the boundaries of performance and design.
                </p>
            </div>
            <div class="innovation-grid">
                <div class="innovation-card" id="innovCard1">
                    <div class="innovation-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="1.5" />
                            <path d="M24 14V34M14 24H34" stroke="currentColor" stroke-width="1.5" />
                            <circle cx="24" cy="24" r="6" stroke="currentColor" stroke-width="1.5" />
                        </svg>
                    </div>
                    <h3 class="innovation-title">Counter-Rotating Crankshaft</h3>
                    <p class="innovation-text">Advanced engine technology that enhances cornering precision and overall
                        bike agility.</p>
                </div>
                <div class="innovation-card" id="innovCard2">
                    <div class="innovation-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <rect x="8" y="8" width="32" height="32" rx="4" stroke="currentColor" stroke-width="1.5" />
                            <path d="M16 24L22 30L32 18" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </div>
                    <h3 class="innovation-title">Smart Clutch System</h3>
                    <p class="innovation-text">Revolutionary SCS technology providing a seamless and effortless riding
                        experience.</p>
                </div>
                <div class="innovation-card" id="innovCard3">
                    <div class="innovation-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M24 4L44 14V34L24 44L4 34V14L24 4Z" stroke="currentColor" stroke-width="1.5" />
                            <path d="M24 18L34 24L24 30L14 24L24 18Z" stroke="currentColor" stroke-width="1.5" />
                        </svg>
                    </div>
                    <h3 class="innovation-title">Adaptive Aerodynamics</h3>
                    <p class="innovation-text">Winglets and bodywork designed in the wind tunnel for maximum downforce
                        and stability.</p>
                </div>
                <div class="innovation-card" id="innovCard4">
                    <div class="innovation-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="1.5" />
                            <path d="M24 12V24L32 32" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <h3 class="innovation-title">Race-Derived Electronics</h3>
                    <p class="innovation-text">Full IMU-based electronics package with multi-level traction control and
                        ABS cornering.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Racing Section -->
    <section class="racing-section" id="racing">
        <div class="racing-bg"></div>
        <div class="section-container">
            <div class="racing-content">
                <div class="section-label section-label-light">
                    <span class="label-line"></span>
                    <span>Racing DNA</span>
                </div>
                <h2 class="racing-title">Born on the <br>Track.</h2>
                <p class="racing-text">Every MR. VIKING carries the DNA of champions. Our racing heritage isn't just
                    history â€” it's the foundation of every motorcycle we build today.</p>
                <div class="racing-stats">
                    <div class="racing-stat">
                        <div class="racing-stat-number" data-count="37">0</div>
                        <div class="racing-stat-label">World Titles</div>
                    </div>
                    <div class="racing-stat">
                        <div class="racing-stat-number" data-count="270">0</div>
                        <div class="racing-stat-label">GP Victories</div>
                    </div>
                    <div class="racing-stat">
                        <div class="racing-stat-number" data-count="75">0</div>
                        <div class="racing-stat-label">Years of Racing</div>
                    </div>
                </div>
                <a href="#" class="btn btn-primary btn-light">
                    <span class="btn-text">Racing Heritage</span>
                    <span class="btn-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter / CTA Section -->
    <section class="newsletter-section" id="newsletter">
        <div class="section-container">
            <div class="newsletter-content">
                <h2 class="newsletter-title">Stay in the <em>Fast Lane</em></h2>
                <p class="newsletter-subtitle">Subscribe to receive exclusive updates, event invitations, and first
                    access to limited editions.</p>
                <form class="newsletter-form" id="newsletterForm">
                    <div class="form-group">
                        <input type="email" placeholder="Enter your email address" class="newsletter-input"
                            id="newsletterEmail" required>
                        <button type="submit" class="newsletter-btn">
                            <span>Subscribe</span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-top">
            <div class="section-container">
                <div class="footer-grid">
                    <div class="footer-col footer-brand">
                        <a href="#" class="footer-logo">MR. VIKING</a>
                        <p class="footer-brand-text">Crafting motorcycle art since 1945. Each motorcycle is handcrafted
                            and assembled by expert and passionate technicians in our factory in Schiranna, Varese,
                            Italy.</p>
                        <div class="footer-social">
                            <a href="#" class="footer-social-link" aria-label="Instagram">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5">
                                    <rect x="2" y="2" width="20" height="20" rx="5" />
                                    <circle cx="12" cy="12" r="5" />
                                    <circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" />
                                </svg>
                            </a>
                            <a href="#" class="footer-social-link" aria-label="Facebook">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                                </svg>
                            </a>
                            <a href="#" class="footer-social-link" aria-label="YouTube">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5">
                                    <path
                                        d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.43z" />
                                    <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="footer-col">
                        <h4 class="footer-col-title">Motorcycles</h4>
                        <ul class="footer-links">
                            <li><a href="user/motorcycles.html">Rush</a></li>
                            <li><a href="user/motorcycles.html">Brutale</a></li>
                            <li><a href="user/motorcycles.html">Dragster</a></li>
                            <li><a href="user/model-detail.html">Superveloce</a></li>
                            <li><a href="user/motorcycles.html">F3</a></li>
                            <li><a href="user/motorcycles.html">Turismo Veloce</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4 class="footer-col-title">Company</h4>
                        <ul class="footer-links">
                            <li><a href="#">Heritage</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Racing</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Press</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4 class="footer-col-title">Support</h4>
                        <ul class="footer-links">
                            <li><a href="#">Find a Dealer</a></li>
                            <li><a href="#">Owner's Area</a></li>
                            <li><a href="#">Service</a></li>
                            <li><a href="#">Warranty</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="section-container">
                <div class="footer-bottom-inner">
                    <p class="footer-copyright">&copy; 2024 MR. VIKING Motor S.p.A. All rights reserved.</p>
                    <div class="footer-bottom-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Cookie Policy</a>
                        <a href="#">Terms & Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/bikes.js"></script>
    <script src="js/features.js"></script>
    <script src="js/script.js"></script>
    <script>
        const motorcyclesData = {
            "RUSH": {
                default: "Mamba",
                models: {
                    "Mamba": { img: "RUSH Mamba.webp", spec: { cyl: 4, cc: 998, hp: 208 }, badge: "LIMITED EDITION" }
                }
            },
            "BRUTALE": {
                default: "800",
                models: {
                    "800": { img: "BRUTALE 800.webp", spec: { cyl: 3, cc: 798, hp: 113 } },
                    "RR OTTANTESIMO": { img: "BRUTALE RR OTTANTESIMO.webp", spec: { cyl: 3, cc: 798, hp: 140 }, badge: "LIMITED EDITION" },
                    "1000 RS": { img: "BRUTALE 1000 RS.webp", spec: { cyl: 4, cc: 998, hp: 208 } },
                    "1000 RR": { img: "BRUTALE 1000 RR.webp", spec: { cyl: 4, cc: 998, hp: 208 } },
                    "1000 RR ASSEN": { img: "BRUTALE 1000 RR ASSEN.webp", spec: { cyl: 4, cc: 998, hp: 208 }, badge: "LIMITED EDITION" }
                }
            },
            "DRAGSTER": {
                default: "RR OTTANTESIMO",
                models: {
                    "RR OTTANTESIMO": { img: "DRAGSTER RR OTTANTESIMO.webp", spec: { cyl: 3, cc: 801, hp: 140 }, badge: "LIMITED EDITION" }
                }
            },
            "TURISMO VELOCE": {
                default: "R",
                models: {
                    "R": { img: "TURISMO VELOCE  R.png", spec: { cyl: 3, cc: 798, hp: 110 } },
                    "LUSSO SCS": { img: "TURISMO VELOCE LUSSO SCS.webp", spec: { cyl: 3, cc: 798, hp: 110 } },
                    "R SCS": { img: "TURISMO VELOCE R SCS.webp", spec: { cyl: 3, cc: 798, hp: 110 } }
                }
            },
            "F3": {
                default: "R",
                models: {
                    "R": { img: "F3 R.png", spec: { cyl: 3, cc: 798, hp: 128 } },
                    "RR": { img: "F3 RR.webp", spec: { cyl: 3, cc: 798, hp: 147 } },
                    "COMPETIZIONE": { img: "F3 COMPETIZIONE.webp", spec: { cyl: 3, cc: 798, hp: 160 }, badge: "LIMITED EDITION" }
                }
            },
            "SUPERVELOCE": {
                default: "S",
                models: {
                    "S": { img: "SUPERVELOCE S.webp", spec: { cyl: 3, cc: 798, hp: 148 } },
                    "98": { img: "SUPERVELOCE 98.png", spec: { cyl: 3, cc: 798, hp: 147 }, badge: "LIMITED EDITION" },
                    "1000 SERIE ORO": { img: "SUPERVELOCE 1000 SERIE ORO.webp", spec: { cyl: 4, cc: 998, hp: 208 }, badge: "LIMITED EDITION" },
                    "1000 AGO": { img: "SUPERVELOCE 1000 AGO.webp", spec: { cyl: 3, cc: 798, hp: 147 }, badge: "LIMITED EDITION" }
                }
            },
            "ENDURO VELOCE": {
                default: "ENDURO VELOCE",
                models: {
                    "ENDURO VELOCE": { img: "ENDURO VELOCE ENDURO VELOCE.webp", spec: { cyl: 3, cc: 931, hp: 124 } },
                    "LXP ORIOLI": { img: "ENDURO VELOCE  LXP ORIOLI.png", spec: { cyl: 3, cc: 931, hp: 124 }, badge: "LIMITED EDITION" }
                }
            }
        };

        const imgBasePath = "images/MR. VIKING - About Us - MR. VIKING/All Bikes/";

        function initMegaMenu() {
            const familyContainer = document.getElementById('megaFamilies');
            const subModelContainer = document.getElementById('megaSubModels');
            const mainImg = document.getElementById('megaMainImg');
            const modelNameEl = document.getElementById('megaModelName');
            const badgeEl = document.getElementById('megaBadge');
            const specCyl = document.getElementById('specCyl');
            const specCC = document.getElementById('specCC');
            const specHP = document.getElementById('specHP');

            let currentFamily = "RUSH";

            function updateDetail(familyName, modelName) {
                const data = motorcyclesData[familyName].models[modelName];

                // Switch image with animation
                mainImg.classList.add('switching');
                setTimeout(() => {
                    mainImg.src = imgBasePath + data.img;
                    mainImg.onload = () => mainImg.classList.remove('switching');
                }, 150);

                if (familyName === "RUSH") {
                    modelNameEl.innerHTML = `RUSH <em>${modelName}</em>`;
                } else {
                    modelNameEl.innerHTML = `${familyName} <em>${modelName}</em>`;
                }

                if (data.badge) {
                    badgeEl.style.display = "block";
                    badgeEl.textContent = data.badge;
                } else {
                    badgeEl.style.display = "none";
                }

                specCyl.textContent = data.spec.cyl;
                specCC.textContent = data.spec.cc;
                specHP.textContent = data.spec.hp;
            }

            function renderSubModels(familyName) {
                subModelContainer.innerHTML = '';
                const familyData = motorcyclesData[familyName];

                Object.keys(familyData.models).forEach((modelName, index) => {
                    const el = document.createElement('div');
                    el.className = 'model-sub-item' + (index === 0 ? ' active' : '');
                    el.textContent = modelName;
                    el.onmouseenter = () => {
                        document.querySelectorAll('.model-sub-item').forEach(i => i.classList.remove('active'));
                        el.classList.add('active');
                        updateDetail(familyName, modelName);
                    };
                    subModelContainer.appendChild(el);
                });
            }

            // Initial render of families
            Object.keys(motorcyclesData).forEach((familyName, index) => {
                const el = document.createElement('div');
                el.className = 'family-item' + (index === 0 ? ' active' : '');

                // Find first model for thumb
                const firstModelKey = Object.keys(motorcyclesData[familyName].models)[0];
                const thumbImg = motorcyclesData[familyName].models[firstModelKey].img;

                el.innerHTML = `
                    <span class="family-name">${familyName}</span>
                    <img src="${imgBasePath + thumbImg}" class="family-thumb" alt="${familyName}">
                `;

                el.onmouseenter = () => {
                    document.querySelectorAll('.family-item').forEach(i => i.classList.remove('active'));
                    el.classList.add('active');
                    renderSubModels(familyName);
                    updateDetail(familyName, motorcyclesData[familyName].default);
                };

                familyContainer.appendChild(el);
            });

            // Initial state
            renderSubModels("RUSH");
            updateDetail("RUSH", "Mamba");
        }

        document.addEventListener('DOMContentLoaded', () => {
            initMegaMenu();

            const navMotorcycles = document.getElementById('navMotorcycles');
            let leaveTimeout;

            navMotorcycles.addEventListener('mouseenter', () => {
                clearTimeout(leaveTimeout);
                navMotorcycles.classList.add('is-active');
            });

            navMotorcycles.addEventListener('mouseleave', () => {
                leaveTimeout = setTimeout(() => {
                    navMotorcycles.classList.remove('is-active');
                }, 300); // 300ms grace period
            });
        });
    </script>
    <!-- Search Overlay -->
    <div class="search-overlay" id="searchOverlay">
        <div class="search-overlay-close" id="searchClose">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
        </div>
        <div class="search-container">
            <div class="search-input-wrapper">
                <input type="text" class="search-input" id="searchInput" placeholder="Search by bike name..." autocomplete="off">
                <div class="search-input-line"></div>
            </div>
            <div class="search-suggestions" id="searchSuggestions">
                <!-- Suggestions injected here -->
            </div>
        </div>
    </div>
    <script src="js/cursor.js"></script>
</body>
<script>
/* Global password eye toggle â€” works on any page that loads this */
function togglePw(inputId, btn) {
    const input = document.getElementById(inputId);
    if (!input) return;
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    btn.innerHTML = isHidden
        ? `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`
        : `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
    btn.style.color = isHidden ? '#c00000' : '#555';
}
</script>


</html>
