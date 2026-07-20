<?php
/* ============================================
   MR. VIKING - Auth Handler (PHP + SQLite)
   Handles registration, login, and sessions
   ============================================ */

// Security Headers - MUST be before session_start()
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}

session_start();

header('Content-Type: application/json');

// 1. Database Configuration
$dbHost = 'localhost';
$dbName = 'MrViking_db';
$dbUser = 'root';
$dbPass = '';

function getDB() {
    global $dbHost, $dbName, $dbUser, $dbPass;
    try {
        $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Users table
        $db->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(50) NOT NULL,
            middle_name VARCHAR(50),
            last_name VARCHAR(50) NOT NULL,
            birth_date DATE NOT NULL,
            gender VARCHAR(20) NOT NULL,
            contact VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            is_admin TINYINT(1) DEFAULT 0,
            is_verified TINYINT(1) DEFAULT 0,
            otp_code VARCHAR(10) DEFAULT NULL,
            otp_expiry DATETIME DEFAULT NULL,
            two_factor_enabled TINYINT(1) DEFAULT 0,
            password_reset_token VARCHAR(100) DEFAULT NULL,
            password_reset_expiry DATETIME DEFAULT NULL,
            profile_image VARCHAR(255) DEFAULT NULL,
            phone VARCHAR(30) DEFAULT NULL,
            address TEXT DEFAULT NULL,
            nickname VARCHAR(100) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        // Safely add new columns if they don't exist (for existing databases)
        $cols = $db->query("SHOW COLUMNS FROM users")->fetchAll(PDO::FETCH_COLUMN);
        $migrations = [
            'is_verified' => "ALTER TABLE users ADD COLUMN is_verified TINYINT(1) DEFAULT 0",
            'otp_code' => "ALTER TABLE users ADD COLUMN otp_code VARCHAR(10) DEFAULT NULL",
            'otp_expiry' => "ALTER TABLE users ADD COLUMN otp_expiry DATETIME DEFAULT NULL",
            'two_factor_enabled' => "ALTER TABLE users ADD COLUMN two_factor_enabled TINYINT(1) DEFAULT 0",
            'password_reset_token' => "ALTER TABLE users ADD COLUMN password_reset_token VARCHAR(100) DEFAULT NULL",
            'password_reset_expiry' => "ALTER TABLE users ADD COLUMN password_reset_expiry DATETIME DEFAULT NULL",
            'profile_image' => "ALTER TABLE users ADD COLUMN profile_image VARCHAR(255) DEFAULT NULL",
            'phone' => "ALTER TABLE users ADD COLUMN phone VARCHAR(30) DEFAULT NULL",
            'address' => "ALTER TABLE users ADD COLUMN address TEXT DEFAULT NULL",
            'nickname' => "ALTER TABLE users ADD COLUMN nickname VARCHAR(100) DEFAULT NULL"
        ];
        foreach ($migrations as $col => $sql) {
            if (!in_array($col, $cols)) $db->exec($sql);
        }

        // Orders table (extended)
        $db->exec("CREATE TABLE IF NOT EXISTS orders (
            order_id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            customer_name VARCHAR(150),
            phone VARCHAR(50),
            address TEXT,
            total_price BIGINT,
            status ENUM('Pending','Approved','Rejected','Delivered') DEFAULT 'Pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $db->exec("CREATE TABLE IF NOT EXISTS order_items (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT,
            product_id VARCHAR(100),
            quantity INT DEFAULT 1,
            FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE
        )");

        // News/Blog posts table  
        $db->exec("CREATE TABLE IF NOT EXISTS news_posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(300) NOT NULL,
            content TEXT NOT NULL,
            image VARCHAR(255) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        // Login attempts for brute force protection
        $db->exec("CREATE TABLE IF NOT EXISTS login_attempts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_source VARCHAR(100) NOT NULL,
            attempt_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        
        return $db;
    } catch (PDOException $e) {
        die(json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]));
    }
}

// Helper to check admin status
function isAdmin() {
    return isset($_SESSION['user']) && isset($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin'] == 1;
}

// 2. Handle Check Session
if (isset($_GET['check'])) {
    if (isset($_SESSION['user'])) {
        echo json_encode(['loggedIn' => true, 'user' => $_SESSION['user']]);
    } else {
        echo json_encode(['loggedIn' => false]);
    }
    exit;
}

// 3. Handle POST Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'signup':
            handleSignup();
            break;
        case 'login':
            handleLogin();
            break;
        case 'verify_otp':
            handleVerifyOTP();
            break;
        case 'resend_otp':
            handleResendOTP();
            break;
        case 'verify_2fa':
            handleVerify2FA();
            break;
        case 'logout':
            handleLogout();
            break;
        case 'forgot_password':
            handleForgotPassword();
            break;
        case 'reset_password':
            handleResetPassword();
            break;
        case 'updateProfile':
            if (!isset($_SESSION['user'])) die(json_encode(['success' => false, 'message' => 'Not logged in']));
            handleUpdateProfile();
            break;
        case 'changePassword':
            if (!isset($_SESSION['user'])) die(json_encode(['success' => false, 'message' => 'Not logged in']));
            handleChangePassword();
            break;
        case 'getUserOrders':
            if (!isset($_SESSION['user'])) die(json_encode(['success' => false, 'message' => 'Not logged in']));
            handleGetUserOrders();
            break;
        case 'listUsers':
            if (!isAdmin()) die(json_encode(['success' => false, 'message' => 'Unauthorized']));
            handleListUsers();
            break;
        case 'deleteUser':
            if (!isAdmin()) die(json_encode(['success' => false, 'message' => 'Unauthorized']));
            handleDeleteUser();
            break;
        case 'updateUser':
            if (!isAdmin()) die(json_encode(['success' => false, 'message' => 'Unauthorized']));
            handleUpdateUser();
            break;
        case 'makeAdmin':
            if (!isAdmin()) die(json_encode(['success' => false, 'message' => 'Unauthorized']));
            handleMakeAdmin();
            break;
        case 'social_login':
            handleSocialLogin();
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
}

// ==========================================
// GOOGLE OAUTH 2.0 INTEGRATION
// ==========================================
$google_client_id = 'YOUR_GOOGLE_CLIENT_ID'; // User replaced this
$google_client_secret = 'YOUR_GOOGLE_CLIENT_SECRET'; // User replaced this
$google_redirect_uri = 'http://localhost:8000/includes/auth_handler.php?action=googleCallback';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle Google OAuth GET redirects
    $action = $_GET['action'] ?? '';
    if ($action === 'googleLogin') {
        handleGoogleLogin();
    } else if ($action === 'googleCallback') {
        handleGoogleCallback();
    }
}

function handleGoogleLogin() {
    global $google_client_id, $google_redirect_uri;
    $url = "https://accounts.google.com/o/oauth2/v2/auth?client_id=" . urlencode($google_client_id) . 
           "&redirect_uri=" . urlencode($google_redirect_uri) . 
           "&response_type=code&scope=" . urlencode("email profile");
    header("Location: $url");
    exit;
}

function handleGoogleCallback() {
    global $google_client_id, $google_client_secret, $google_redirect_uri;
    $code = $_GET['code'] ?? '';
    if (!$code) die('Error: No code provided by Google.');

    // 1. Exchange code for token
    $ch = curl_init('https://oauth2.googleapis.com/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'code' => $code,
        'client_id' => $google_client_id,
        'client_secret' => $google_client_secret,
        'redirect_uri' => $google_redirect_uri,
        'grant_type' => 'authorization_code'
    ]));
    $res = curl_exec($ch);
    if($res === false) {
        die('cURL Error: ' . curl_error($ch));
    }
    curl_close($ch);
    
    $tokenData = json_decode($res, true);
    if (!isset($tokenData['access_token'])) {
        die('Error authenticating with Google (Check Client ID/Secret). ' . print_r($tokenData, true));
    }

    // 2. Get User Profile Info
    $ch2 = curl_init('https://www.googleapis.com/oauth2/v2/userinfo');
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch2, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $tokenData['access_token']]);
    $profileRes = curl_exec($ch2);
    curl_close($ch2);

    $profile = json_decode($profileRes, true);
    if (!$profile || !isset($profile['email'])) {
        die('Error fetching Google Profile.');
    }

    // 3. Login or Create the user
    $db = getDB();
    $contact = $profile['email'];
    $firstName = $profile['given_name'] ?? 'Google';
    $lastName = $profile['family_name'] ?? 'User';

    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE contact = ?");
        $stmt->execute([$contact]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $stmt = $db->prepare("INSERT INTO users (first_name, last_name, contact, password, gender, birth_date) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$firstName, $lastName, $contact, 'GOOGLE_AUTH_PLACEHOLDER', 'Other', '1900-01-01']);
            
            $stmt = $db->prepare("SELECT * FROM users WHERE contact = ?");
            $stmt->execute([$contact]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Google accounts are verified by default
        $db->prepare("UPDATE users SET is_verified = 1 WHERE id = ?")->execute([$user['id']]);
        
        // Re-fetch to get verified status and all columns
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user['id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        unset($user['password']);
        
        $_SESSION['user'] = $user;
        header("Location: ../index.php");
        exit;

    } catch (PDOException $e) {
        die('Database error handling Google Login: ' . $e->getMessage());
    }
}

function handleSocialLogin() {
    $db = getDB();
    $firstName = $_POST['first_name'] ?? 'Social';
    $lastName  = $_POST['last_name'] ?? 'User';
    $contact   = $_POST['contact'] ?? '';
    $provider  = $_POST['provider'] ?? 'Social';

    if (empty($contact)) {
        echo json_encode(['success' => false, 'message' => 'Invalid social data']);
        return;
    }

    try {
        // Check if user exists
        $stmt = $db->prepare("SELECT * FROM users WHERE contact = ?");
        $stmt->execute([$contact]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // Create a new social user
            $stmt = $db->prepare("INSERT INTO users (first_name, last_name, contact, password, gender, birth_date) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$firstName, $lastName, $contact, 'SOCIAL_AUTH_PROVIDER', 'Other', '1900-01-01']);
            
            // Re-fetch
            $stmt = $db->prepare("SELECT * FROM users WHERE contact = ?");
            $stmt->execute([$contact]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Social accounts are verified by default
        $db->prepare("UPDATE users SET is_verified = 1 WHERE id = ?")->execute([$user['id']]);
        
        // Re-fetch complete data
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user['id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        unset($user['password']);
        $_SESSION['user'] = $user;
        echo json_encode(['success' => true, 'user' => $user]);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Social login error: ' . $e->getMessage()]);
    }
}


function handleSignup() {
    $db = getDB();
    
    $firstName  = $_POST['first_name'] ?? '';
    $middleName = $_POST['middle_name'] ?? '';
    $lastName   = $_POST['last_name'] ?? '';
    $birthDate  = $_POST['birth_date'] ?? '';
    $gender     = $_POST['gender'] ?? '';
    $contact    = $_POST['contact'] ?? '';
    $pass       = $_POST['pass'] ?? '';

    if (empty($firstName) || empty($lastName) || empty($contact) || empty($pass)) {
        echo json_encode(['success' => false, 'message' => 'Required fields are missing']);
        return;
    }

    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

    try {
        // Special logic: First user becomes admin automatically
        $count = $db->query("SELECT count(*) FROM users")->fetchColumn();
        $isAdmin = ($count == 0) ? 1 : 0;
        
        $stmt = $db->prepare("INSERT INTO users (first_name, middle_name, last_name, birth_date, gender, contact, password, is_admin, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)");
        $stmt->execute([$firstName, $middleName, $lastName, $birthDate, $gender, $contact, $hashedPass, $isAdmin]);

        $stmt = $db->prepare("SELECT * FROM users WHERE contact = ?");
        $stmt->execute([$contact]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        unset($user['password']);
        $_SESSION['user'] = $user;
        
        echo json_encode(['success' => true, 'message' => 'Account created and logged in!', 'otp_sent' => false, 'user' => $user]);
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo json_encode(['success' => false, 'message' => 'Email or mobile number already registered']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Signup error: ' . $e->getMessage()]);
        }
    }
}

function handleLogin() {
    $db = getDB();
    
    $id   = $_POST['id'] ?? '';
    $pass = $_POST['pass'] ?? '';

    if (empty($id) || empty($pass)) {
        echo json_encode(['success' => false, 'message' => 'Please enter ID and password']);
        return;
    }

    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE contact = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'Account not found. Please sign up first.']);
            return;
        }

        if (password_verify($pass, $user['password'])) {
            unset($user['password']);
            $_SESSION['user'] = $user;
            echo json_encode(['success' => true, 'user' => $user]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect password. Try again or use Forgot Password.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Login error. Please try again later.']);
    }
}

function handleListUsers() {
    $db = getDB();
    try {
        $stmt = $db->query("SELECT id, first_name, middle_name, last_name, birth_date, gender, contact, is_admin, created_at FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'users' => $users]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Fetch error']);
    }
}

function handleMakeAdmin() {
    $db = getDB();
    $id = $_POST['user_id'] ?? null;
    if (!$id) die(json_encode(['success' => false, 'message' => 'Missing ID']));

    try {
        $stmt = $db->prepare("UPDATE users SET is_admin = 1 WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
}

function handleDeleteUser() {
    $db = getDB();
    $id = $_POST['id'] ?? null;
    if (!$id) die(json_encode(['success' => false]));

    try {
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false]);
    }
}

function handleUpdateUser() {
    $db = getDB();
    $id = $_POST['id'] ?? null;
    if (!$id) die(json_encode(['success' => false]));

    $firstName = $_POST['first_name'] ?? '';
    $lastName  = $_POST['last_name'] ?? '';
    $contact   = $_POST['contact'] ?? '';

    try {
        $stmt = $db->prepare("UPDATE users SET first_name = ?, last_name = ?, contact = ? WHERE id = ?");
        $stmt->execute([$firstName, $lastName, $contact, $id]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false]);
    }
}

function handleLogout() {
    session_destroy();
    echo json_encode(['success' => true]);
}

function handleUpdateProfile() {
    $db = getDB();
    $id = $_SESSION['user']['id'];
    $firstName = $_POST['first_name'] ?? '';
    $lastName  = $_POST['last_name'] ?? '';
    $phone     = $_POST['phone'] ?? '';
    $address   = $_POST['address'] ?? '';
    $nickname  = $_POST['nickname'] ?? '';

    // Handle profile image upload
    $imagePath = $_SESSION['user']['profile_image'] ?? null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $uploadDir = 'images/uploads/avatars/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
        $filename = 'avatar_' . $id . '.' . $ext;
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadDir . $filename)) {
            $imagePath = $uploadDir . $filename;
        }
    }

    try {
        $stmt = $db->prepare("UPDATE users SET first_name=?, last_name=?, phone=?, address=?, profile_image=?, nickname=? WHERE id=?");
        $stmt->execute([$firstName, $lastName, $phone, $address, $imagePath, $nickname, $id]);

        // Refresh session
        $stmt2 = $db->prepare("SELECT * FROM users WHERE id=?");
        $stmt2->execute([$id]);
        $user = $stmt2->fetch(PDO::FETCH_ASSOC);
        unset($user['password']);
        $_SESSION['user'] = $user;

        echo json_encode(['success' => true, 'user' => $user]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleChangePassword() {
    $db = getDB();
    $id = $_SESSION['user']['id'];
    $currentPass = $_POST['current_password'] ?? '';
    $newPass     = $_POST['new_password'] ?? '';

    if (strlen($newPass) < 6) {
        echo json_encode(['success' => false, 'message' => 'New password must be at least 6 characters']);
        return;
    }

    try {
        $stmt = $db->prepare("SELECT password FROM users WHERE id=?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row || !password_verify($currentPass, $row['password'])) {
            echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
            return;
        }

        $hashed = password_hash($newPass, PASSWORD_DEFAULT);
        $stmt2 = $db->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt2->execute([$hashed, $id]);
        echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleGetUserOrders() {
    $db = getDB();
    $userId = $_SESSION['user']['id'];

    try {
        $stmt = $db->prepare("SELECT * FROM orders WHERE user_id=? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Attach items
        foreach ($orders as &$order) {
            $s = $db->prepare("SELECT oi.quantity, p.name FROM order_items oi LEFT JOIN products p ON oi.product_id=p.id WHERE oi.order_id=?");
            $s->execute([$order['order_id']]);
            $items = $s->fetchAll(PDO::FETCH_ASSOC);
            $order['items'] = $items;
            $order['items_display'] = implode(', ', array_map(fn($i) => $i['name'] . ' x' . $i['quantity'], $items));
        }

        echo json_encode(['success' => true, 'orders' => $orders]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// ==========================================
// ADVANCED AUTHENTICATION FUNCTIONS
// ==========================================

function handleVerifyOTP() {
    $db = getDB();
    $id = $_POST['contact'] ?? '';
    $otp = $_POST['otp'] ?? '';

    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE contact = ? AND otp_code = ? AND otp_expiry > NOW()");
        $stmt->execute([$id, $otp]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $db->prepare("UPDATE users SET is_verified = 1, otp_code = NULL, otp_expiry = NULL WHERE id = ?")->execute([$user['id']]);
            
            unset($user['password']);
            $_SESSION['user'] = $user;
            echo json_encode(['success' => true, 'message' => 'Email verified successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid or expired OTP.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Verification error']);
    }
}

function handleVerify2FA() {
    $db = getDB();
    $id = $_POST['contact'] ?? '';
    $otp = $_POST['otp'] ?? '';

    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE contact = ? AND otp_code = ? AND otp_expiry > NOW()");
        $stmt->execute([$id, $otp]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $db->prepare("UPDATE users SET otp_code = NULL, otp_expiry = NULL WHERE id = ?")->execute([$user['id']]);
            
            unset($user['password']);
            $_SESSION['user'] = $user;
            echo json_encode(['success' => true, 'user' => $user]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid or expired OTP.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => '2FA error']);
    }
}

function handleResendOTP() {
    $db = getDB();
    $id = $_POST['contact'] ?? '';

    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE contact = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $otp = sprintf("%06d", mt_rand(1, 999999));
            $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));
            $db->prepare("UPDATE users SET otp_code = ?, otp_expiry = ? WHERE id = ?")->execute([$otp, $expiry, $user['id']]);
            
            // MailService::sendOTP($user['contact'], $otp);
            echo json_encode(['success' => true, 'message' => 'A new code has been sent.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error resending OTP']);
    }
}

function handleForgotPassword() {
    $db = getDB();
    $contact = $_POST['contact'] ?? '';

    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE contact = ?");
        $stmt->execute([$contact]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
            $db->prepare("UPDATE users SET password_reset_token = ?, password_reset_expiry = ? WHERE id = ?")->execute([$token, $expiry, $user['id']]);
            
            // Output the token here since we don't have a real mailer yet
            // MailService::sendResetLink($user['contact'], $token);
            echo json_encode(['success' => true, 'message' => 'Password reset instructions have been sent to your email.', 'demo_token' => $token]);
        } else {
            // Keep the same response to prevent user enumeration
            echo json_encode(['success' => true, 'message' => 'Password reset instructions have been sent to your email.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
}

function handleResetPassword() {
    $db = getDB();
    $token = $_POST['token'] ?? '';
    $newPass = $_POST['new_password'] ?? '';

    if (strlen($newPass) < 6) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters']);
        return;
    }

    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE password_reset_token = ? AND password_reset_expiry > NOW()");
        $stmt->execute([$token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $hashed = password_hash($newPass, PASSWORD_DEFAULT);
            $db->prepare("UPDATE users SET password = ?, password_reset_token = NULL, password_reset_expiry = NULL WHERE id = ?")->execute([$hashed, $user['id']]);
            echo json_encode(['success' => true, 'message' => 'Password has been successfully reset. You can now login.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid or expired password reset link.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Reset error']);
    }
}
