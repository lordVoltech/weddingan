<?php
// Database configuration
$host = 'localhost';
$dbname = 'user_dashboard';
$username = 'root';
$password = '';

// Initialize PDO as null
$pdo = null;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // For development purposes only. In production, log error and show generic message
    // echo "Connection failed: " . $e->getMessage();
}

// Function to get paginated users
function getPaginatedUsers($page = 1, $per_page = 5, $pdo = null) {
    if (!$pdo) {
        // Fallback data when database is not available
        $demo_users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'role' => 'Admin',
                'status' => 'active',
                'last_active' => '2 minutes ago'
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'role' => 'User',
                'status' => 'active',
                'last_active' => '5 hours ago'
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike@example.com',
                'role' => 'User',
                'status' => 'inactive',
                'last_active' => '2 days ago'
            ],
            [
                'name' => 'Sarah Williams',
                'email' => 'sarah@example.com',
                'role' => 'Editor',
                'status' => 'active',
                'last_active' => '1 hour ago'
            ],
            [
                'name' => 'Tom Brown',
                'email' => 'tom@example.com',
                'role' => 'User',
                'status' => 'active',
                'last_active' => '3 hours ago'
            ]
        ];
        
        // Calculate offset and return sliced array
        $offset = ($page - 1) * $per_page;
        return [
            'users' => array_slice($demo_users, $offset, $per_page),
            'total' => count($demo_users)
        ];
    }
    
    try {
        // Get total count
        $count_stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
        $total = $count_stmt->fetch()['total'];
        
        // Get paginated users
        $offset = ($page - 1) * $per_page;
        $stmt = $pdo->prepare("SELECT * FROM users ORDER BY created_at DESC LIMIT ? OFFSET ?");
        $stmt->execute([$per_page, $offset]);
        
        return [
            'users' => $stmt->fetchAll(),
            'total' => $total
        ];
    } catch(PDOException $e) {
        // Return fallback data if query fails
        return getPaginatedUsers($page, $per_page, null);
    }
}

// Function to get user statistics with fallback data
function getUserStats($pdo = null) {
    // Fallback data when database is not available
    if (!$pdo) {
        return [
            'total_users' => 1250,
            'active_users' => 847,
            'new_users' => 23,
            'online_users' => 42
        ];
    }
    
    $stats = [];
    
    try {
        // Total Users
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
        $stats['total_users'] = $stmt->fetch()['total'];
        
        // Active Users
        $stmt = $pdo->query("SELECT COUNT(*) as active FROM users WHERE status = 'active'");
        $stats['active_users'] = $stmt->fetch()['active'];
        
        // New Users Today
        $stmt = $pdo->query("SELECT COUNT(*) as new FROM users WHERE DATE(created_at) = CURDATE()");
        $stats['new_users'] = $stmt->fetch()['new'];
        
        // Online Users (active in last 15 minutes)
        $stmt = $pdo->query("SELECT COUNT(*) as online FROM users WHERE last_activity >= DATE_SUB(NOW(), INTERVAL 15 MINUTE)");
        $stats['online_users'] = $stmt->fetch()['online'];
    } catch(PDOException $e) {
        // Return fallback data if queries fail
        return [
            'total_users' => 1250,
            'active_users' => 847,
            'new_users' => 23,
            'online_users' => 42
        ];
    }
    
    return $stats;
}

// Function to get recent users with fallback data
function getRecentUsers($pdo = null, $limit = 5) {
    // Fallback data when database is not available
    if (!$pdo) {
        return [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike@example.com',
                'status' => 'inactive',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'name' => 'Sarah Williams',
                'email' => 'sarah@example.com',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))
            ],
            [
                'name' => 'Tom Brown',
                'email' => 'tom@example.com',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days'))
            ]
        ];
    }
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM users ORDER BY created_at DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        // Return fallback data if query fails
        return [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike@example.com',
                'status' => 'inactive',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'name' => 'Sarah Williams',
                'email' => 'sarah@example.com',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))
            ],
            [
                'name' => 'Tom Brown',
                'email' => 'tom@example.com',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days'))
            ]
        ];
    }
}
