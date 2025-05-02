<?php
// Function to get paginated users
function getPaginatedUsers($page = 1, $per_page = 5, $pdo = null) {
    if (!$pdo) {
        return [
            'users' => [],
            'total' => 0
        ];
    }
    
    try {
        // Get total count
        $count_stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
        $total = $count_stmt->fetch()['total'];
        
        // Get paginated users
        $offset = ($page - 1) * $per_page;
        $stmt = $pdo->prepare("
            SELECT 
                id,
                email,
                created_at,
                is_verified,
                CASE 
                    WHEN is_verified = 1 THEN 'active'
                    ELSE 'inactive'
                END as status
            FROM users 
            ORDER BY created_at DESC 
            LIMIT ? OFFSET ?
        ");
        $stmt->execute([$per_page, $offset]);
        
        return [
            'users' => $stmt->fetchAll(),
            'total' => $total
        ];
    } catch(PDOException $e) {
        error_log("Error fetching users: " . $e->getMessage());
        return [
            'users' => [],
            'total' => 0
        ];
    }
}

// Function to get user statistics
function getUserStats($pdo = null) {
    if (!$pdo) {
        return [
            'total_users' => 0,
            'active_users' => 0,
            'new_users' => 0,
            'online_users' => 0
        ];
    }
    
    $stats = [];
    
    try {
        // Total Users
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
        $stats['total_users'] = $stmt->fetch()['total'];
        
        // Active (Verified) Users
        $stmt = $pdo->query("SELECT COUNT(*) as active FROM users WHERE is_verified = 1");
        $stats['active_users'] = $stmt->fetch()['active'];
        
        // New Users Today
        $stmt = $pdo->query("SELECT COUNT(*) as new FROM users WHERE DATE(created_at) = CURDATE()");
        $stats['new_users'] = $stmt->fetch()['new'];
        
        // Recently Active Users (created in last 15 minutes)
        $stmt = $pdo->query("SELECT COUNT(*) as online FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 15 MINUTE)");
        $stats['online_users'] = $stmt->fetch()['online'];
        
    } catch(PDOException $e) {
        error_log("Error fetching user stats: " . $e->getMessage());
        return [
            'total_users' => 0,
            'active_users' => 0,
            'new_users' => 0,
            'online_users' => 0
        ];
    }
    
    return $stats;
}

// Function to get recent users
function getRecentUsers($pdo = null, $limit = 5) {
    if (!$pdo) {
        return [];
    }
    
    try {
        $stmt = $pdo->prepare("
            SELECT 
                id,
                email as name,
                email,
                created_at,
                CASE 
                    WHEN is_verified = 1 THEN 'active'
                    ELSE 'inactive'
                END as status
            FROM users 
            ORDER BY created_at DESC 
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        error_log("Error fetching recent users: " . $e->getMessage());
        return [];
    }
}
