<?php
// MR. VIKING eCommerce API - api.php
session_start();
header('Content-Type: application/json');

$dbHost = 'localhost';
$dbName = 'MrViking_db';
$dbUser = 'root';
$dbPass = '';

function getDB() {
    global $dbHost, $dbName, $dbUser, $dbPass;
    try {
        $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die(json_encode(['success' => false, 'message' => 'Database error']));
    }
}

function isAdmin() {
    return isset($_SESSION['user']) && isset($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin'] == 1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle JSON payloads
    $postData = json_decode(file_get_contents('php://input'), true);
    if ($postData) {
        $_POST = array_merge($_POST, $postData);
    }
    
    $action = $_POST['action'] ?? '';

    switch ($action) {
        // ---- PRODUCT MANAGEMENT (ADMIN) ----
        case 'addProduct':
            if (!isAdmin()) die(json_encode(['success' => false, 'message' => 'Unauthorized']));
            handleAddProduct();
            break;
        case 'editProduct':
            if (!isAdmin()) die(json_encode(['success' => false, 'message' => 'Unauthorized']));
            handleEditProduct();
            break;
        case 'deleteProduct':
            if (!isAdmin()) die(json_encode(['success' => false, 'message' => 'Unauthorized']));
            handleDeleteProduct();
            break;

        // ---- ORDER MANAGEMENT ----
        case 'placeOrder':
            handlePlaceOrder();
            break;
        case 'updateOrderStatus':
            if (!isAdmin()) die(json_encode(['success' => false, 'message' => 'Unauthorized']));
            handleUpdateOrderStatus();
            break;
        
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'getProducts':
            handleGetProducts();
            break;
        case 'getOrders':
            if (!isAdmin()) die(json_encode(['success' => false, 'message' => 'Unauthorized']));
            handleGetOrders();
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
}

// ---------------------------------------------------------
// PRODUCT HANDLERS
// ---------------------------------------------------------
function handleGetProducts() {
    $db = getDB();
    try {
        $stmt = $db->query("SELECT * FROM products ORDER BY created_at DESC");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'products' => $products]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleAddProduct() {
    $db = getDB();
    $id = $_POST['id'] ?? uniqid('mv_');
    $name = $_POST['name'] ?? '';
    $family = $_POST['family'] ?? 'BRUTALE';
    $price = $_POST['priceBDT'] ?? '0';
    $desc = $_POST['description'] ?? '';
    
    // Default image if none uploaded
    $thumb = 'images/hero-motorcycle.png';
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "images/uploads/";
        if(!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $thumb = $target_file;
        }
    }

    try {
        $stmt = $db->prepare("INSERT INTO products (id, name, family, description, priceBDT, thumbnail) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id, $name, $family, $desc, $price, $thumb]);
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleEditProduct() {
    $db = getDB();
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $family = $_POST['family'] ?? '';
    $price = $_POST['priceBDT'] ?? '0';
    $desc = $_POST['description'] ?? '';
    $status = $_POST['status'] ?? 'Published';
    
    // Check if new image uploaded
    $thumbUpdate = "";
    $params = [$name, $family, $desc, $price, $status];

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "images/uploads/";
        if(!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $thumbUpdate = ", thumbnail = ?";
            $params[] = $target_file;
        }
    }
    
    $params[] = $id;

    try {
        $stmt = $db->prepare("UPDATE products SET name=?, family=?, description=?, priceBDT=?, status=? $thumbUpdate WHERE id=?");
        $stmt->execute($params);
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleDeleteProduct() {
    $db = getDB();
    $id = $_POST['id'] ?? '';
    if (!$id) die(json_encode(['success' => false]));

    try {
        $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false]);
    }
}

// ---------------------------------------------------------
// ORDER HANDLERS
// ---------------------------------------------------------
function handlePlaceOrder() {
    $db = getDB();
    $userId = isset($_SESSION['user']) ? $_SESSION['user']['id'] : null;
    
    $customerName = $_POST['customer_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $totalPrice = $_POST['total_price'] ?? 0;
    $items = $_POST['items'] ?? []; // Array of assoc arrays: [['id'=>'rid', 'quantity'=>1]]

    if (empty($customerName) || empty($phone) || empty($address) || empty($items)) {
        die(json_encode(['success' => false, 'message' => 'Missing order details']));
    }

    try {
        $db->beginTransaction();
        
        $stmt = $db->prepare("INSERT INTO orders (user_id, customer_name, phone, address, total_price) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $customerName, $phone, $address, $totalPrice]);
        
        $orderId = $db->lastInsertId();

        $stmtItem = $db->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
        foreach ($items as $item) {
            $stmtItem->execute([$orderId, $item['id'], $item['quantity']]);
        }

        $db->commit();
        echo json_encode(['success' => true, 'order_id' => $orderId]);
    } catch (Exception $e) {
        $db->rollBack();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleGetOrders() {
    $db = getDB();
    try {
        // Fetch base orders
        $stmt = $db->query("SELECT * FROM orders ORDER BY created_at DESC");
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Fetch items and map
        $stmtItems = $db->query("SELECT oi.order_id, oi.quantity, p.name FROM order_items oi LEFT JOIN products p ON oi.product_id = p.id");
        $itemsRaw = $stmtItems->fetchAll(PDO::FETCH_ASSOC);
        
        $groupedItems = [];
        foreach($itemsRaw as $r) {
            $groupedItems[$r['order_id']][] = $r['name'] . " (x" . $r['quantity'] . ")";
        }

        foreach($orders as &$ord) {
            $ord['items_desc'] = isset($groupedItems[$ord['order_id']]) ? implode(", ", $groupedItems[$ord['order_id']]) : '-';
        }

        echo json_encode(['success' => true, 'orders' => $orders]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleUpdateOrderStatus() {
    $db = getDB();
    $id = $_POST['order_id'] ?? '';
    $status = $_POST['status'] ?? '';
    
    if (!$id || !$status) die(json_encode(['success' => false]));

    try {
        $stmt = $db->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
        $stmt->execute([$status, $id]);
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false]);
    }
}
?>
