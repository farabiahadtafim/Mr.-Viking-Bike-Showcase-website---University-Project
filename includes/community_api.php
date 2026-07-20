<?php
// MR. VIKING Community API
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

function getUserId() {
    return $_SESSION['user']['id'] ?? null;
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'fetchPosts':
        handleFetchPosts();
        break;
    case 'createPost':
        handleCreatePost();
        break;
    case 'toggleReaction':
        handleToggleReaction();
        break;
    case 'addComment':
        handleAddComment();
        break;
    case 'getBikeRatings':
        handleGetBikeRatings();
        break;
    case 'deletePost':
        handleDeletePost();
        break;
    case 'archivePost':
        handleArchivePost();
        break;
    case 'cleanupPosts':
        handleCleanupPosts();
        break;
    case 'pinPost':
        handlePinPost();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action: ' . $action]);
}

// --- Handlers ---

function handleFetchPosts() {
    $db = getDB();
    $userId = getUserId();
    $type = $_GET['type'] ?? 'All'; // News, Review, User Post, All
    $sort = $_GET['sort'] ?? 'Latest'; // Latest, Popular

    $where = "WHERE cp.status = 'Published'";
    if ($type !== 'All' && $type !== 'Ratings') {
        $where .= " AND cp.type = " . $db->quote($type);
    }

    $orderBy = "cp.is_pinned DESC, cp.created_at DESC";
    if ($sort === 'Popular') {
        $orderBy = "cp.is_pinned DESC, reaction_count DESC, cp.created_at DESC";
    }

    try {
        $query = "
            SELECT 
                cp.*, 
                u.first_name, u.last_name, u.profile_image,
                ((SELECT COUNT(*) FROM post_reactions WHERE post_id = cp.id) + cp.fake_likes) as reaction_count,
                ((SELECT COUNT(*) FROM post_reactions WHERE post_id = cp.id AND type='Like') + cp.fake_likes) as like_count,
                (SELECT COUNT(*) FROM post_reactions WHERE post_id = cp.id AND type='Love') as love_count,
                (SELECT COUNT(*) FROM post_reactions WHERE post_id = cp.id AND type='Care') as care_count,
                (SELECT COUNT(*) FROM post_reactions WHERE post_id = cp.id AND type='Haha') as haha_count,
                (SELECT COUNT(*) FROM post_reactions WHERE post_id = cp.id AND type='Wow') as wow_count,
                (SELECT COUNT(*) FROM post_reactions WHERE post_id = cp.id AND type='Sad') as sad_count,
                (SELECT COUNT(*) FROM post_reactions WHERE post_id = cp.id AND type='Angry') as angry_count,
                ((SELECT COUNT(*) FROM post_comments WHERE post_id = cp.id) + cp.fake_comments) as comment_count,
                cp.fake_shares as share_count,
                (SELECT type FROM post_reactions WHERE post_id = cp.id AND user_id = :current_user_id LIMIT 1) as my_reaction
            FROM community_posts cp
            JOIN users u ON cp.user_id = u.id
            $where
            ORDER BY $orderBy
        ";

        $stmt = $db->prepare($query);
        $stmt->execute(['current_user_id' => $userId]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch comments for each post
        foreach ($posts as &$post) {
            $cStmt = $db->prepare("
                SELECT pc.*, u.first_name, u.last_name, u.profile_image 
                FROM post_comments pc 
                JOIN users u ON pc.user_id = u.id 
                WHERE pc.post_id = ? 
                ORDER BY pc.created_at ASC
            ");
            $cStmt->execute([$post['id']]);
            $post['comments'] = $cStmt->fetchAll(PDO::FETCH_ASSOC);
        }

        echo json_encode(['success' => true, 'posts' => $posts]);

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleCreatePost() {
    if (!getUserId()) die(json_encode(['success' => false, 'message' => 'Login required']));
    
    $db = getDB();
    $userId = getUserId();
    $content = $_POST['content'] ?? '';
    $type = $_POST['type'] ?? 'User Post';
    $bikeId = $_POST['bike_id'] ?? null;
    $rating = $_POST['rating'] ?? null;

    if (empty($content)) die(json_encode(['success' => false, 'message' => 'Content cannot be empty']));

    $mediaUrl = null;
    if (isset($_FILES['media']) && $_FILES['media']['error'] == 0) {
        $uploadDir = 'images/uploads/posts/';
        $ext = pathinfo($_FILES['media']['name'], PATHINFO_EXTENSION);
        $filename = 'post_' . time() . '_' . uniqid() . '.' . $ext;
        if (move_uploaded_file($_FILES['media']['tmp_name'], $uploadDir . $filename)) {
            $mediaUrl = $uploadDir . $filename;
        }
    }

    try {
        $stmt = $db->prepare("INSERT INTO community_posts (user_id, type, content, media_url, bike_id, rating) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $type, $content, $mediaUrl, $bikeId, $rating]);
        echo json_encode(['success' => true, 'message' => 'Post created!']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleToggleReaction() {
    $userId = getUserId();
    if (!$userId) die(json_encode(['success' => false, 'message' => 'Login required']));

    $db = getDB();
    $postId = $_POST['post_id'] ?? null;
    $type = $_POST['type'] ?? 'Like'; // Like, Love, Wow

    try {
        // Check if exists
        $stmt = $db->prepare("SELECT id, type FROM post_reactions WHERE post_id = ? AND user_id = ?");
        $stmt->execute([$postId, $userId]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            if ($existing['type'] === $type) {
                // Remove if same
                $db->prepare("DELETE FROM post_reactions WHERE id = ?")->execute([$existing['id']]);
                echo json_encode(['success' => true, 'action' => 'removed']);
            } else {
                // Update if different
                $db->prepare("UPDATE post_reactions SET type = ? WHERE id = ?")->execute([$type, $existing['id']]);
                echo json_encode(['success' => true, 'action' => 'updated']);
            }
        } else {
            // Insert new
            $db->prepare("INSERT INTO post_reactions (post_id, user_id, type) VALUES (?, ?, ?)")->execute([$postId, $userId, $type]);
            echo json_encode(['success' => true, 'action' => 'added']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleAddComment() {
    $userId = getUserId();
    if (!$userId) die(json_encode(['success' => false, 'message' => 'Login required']));

    $db = getDB();
    $postId = $_POST['post_id'] ?? null;
    $parentId = $_POST['parent_id'] ?? null;
    $content = $_POST['content'] ?? '';

    if (empty($content)) die(json_encode(['success' => false, 'message' => 'Comment cannot be empty']));

    try {
        $stmt = $db->prepare("INSERT INTO post_comments (post_id, parent_id, user_id, content) VALUES (?, ?, ?, ?)");
        $stmt->execute([$postId, $parentId, $userId, $content]);
        echo json_encode(['success' => true, 'message' => 'Comment added!']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleGetBikeRatings() {
    $db = getDB();
    try {
        $query = "
            SELECT 
                bike_id, 
                AVG(rating) as avg_rating, 
                COUNT(*) as review_count
            FROM community_posts 
            WHERE type = 'Review' AND rating IS NOT NULL AND status = 'Published'
            GROUP BY bike_id
            ORDER BY avg_rating DESC
        ";
        $stmt = $db->query($query);
        $ratings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'ratings' => $ratings]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleDeletePost() {
    $userId = getUserId();
    if (!$userId) die(json_encode(['success' => false, 'message' => 'Login required']));
    
    $db = getDB();
    $postId = $_POST['post_id'] ?? null;
    
    try {
        // Check ownership or admin
        $stmt = $db->prepare("SELECT user_id FROM community_posts WHERE id = ?");
        $stmt->execute([$postId]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$post) die(json_encode(['success' => false, 'message' => 'Post not found']));
        
        if ($post['user_id'] != $userId && !isAdmin()) {
            die(json_encode(['success' => false, 'message' => 'Unauthorized']));
        }

        $db->prepare("DELETE FROM community_posts WHERE id = ?")->execute([$postId]);
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleArchivePost() {
    $userId = getUserId();
    if (!$userId) die(json_encode(['success' => false, 'message' => 'Login required']));
    
    $db = getDB();
    $postId = $_POST['post_id'] ?? null;
    
    try {
        // Check ownership or admin
        $stmt = $db->prepare("SELECT user_id FROM community_posts WHERE id = ?");
        $stmt->execute([$postId]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$post) die(json_encode(['success' => false, 'message' => 'Post not found']));
        
        if ($post['user_id'] != $userId && !isAdmin()) {
            die(json_encode(['success' => false, 'message' => 'Unauthorized']));
        }

        $db->prepare("UPDATE community_posts SET status = 'Archived' WHERE id = ?")->execute([$postId]);
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handleCleanupPosts() {
    // Only admins can trigger manual cleanup, but we can also auto-run it
    if (!isAdmin()) die(json_encode(['success' => false, 'message' => 'Admin only']));
    
    $db = getDB();
    try {
        $stmt = $db->query("SELECT id, media_url FROM community_posts WHERE media_url IS NOT NULL");
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $deletedCount = 0;
        
        foreach ($posts as $post) {
            if (!file_exists($post['media_url'])) {
                $db->prepare("DELETE FROM community_posts WHERE id = ?")->execute([$post['id']]);
                $deletedCount++;
            }
        }
        echo json_encode(['success' => true, 'deleted_count' => $deletedCount]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function handlePinPost() {
    if (!isAdmin()) die(json_encode(['success' => false, 'message' => 'Unauthorized']));
    $db = getDB();
    $postId = $_POST['post_id'] ?? null;
    $isPinned = $_POST['is_pinned'] ?? 0;
    try {
        $db->prepare("UPDATE community_posts SET is_pinned = ? WHERE id = ?")->execute([$isPinned, $postId]);
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false]);
    }
}
?>
