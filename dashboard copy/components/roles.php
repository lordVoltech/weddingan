<?php
// Define role constants
define('ROLE_ADMIN', 'admin');
define('ROLE_EDITOR', 'editor');
define('ROLE_USER', 'user');

// Define permissions for each role
$role_permissions = [
    ROLE_ADMIN => [
        'dashboard' => true,
        'users' => ['view', 'add', 'edit', 'delete'],
        'activity' => ['view', 'export'],
        'settings' => ['view', 'edit']
    ],
    ROLE_EDITOR => [
        'dashboard' => true,
        'users' => ['view'],
        'activity' => ['view'],
        'settings' => ['view']
    ],
    ROLE_USER => [
        'dashboard' => true,
        'activity' => ['view'],
        'settings' => ['view']
    ]
];

// Function to check if user has permission
function hasPermission($userRole, $module, $action = 'view') {
    global $role_permissions;
    
    if (!isset($role_permissions[$userRole])) {
        return false;
    }
    
    if (!isset($role_permissions[$userRole][$module])) {
        return false;
    }
    
    if ($role_permissions[$userRole][$module] === true) {
        return true;
    }
    
    return in_array($action, $role_permissions[$userRole][$module]);
}

// Function to check if current user has permission
function checkPermission($module, $action = 'view') {
    if (!isset($_SESSION['user_role'])) {
        header("Location: login.php");
        exit();
    }
    
    if (!hasPermission($_SESSION['user_role'], $module, $action)) {
        die("Access Denied: You don't have permission to access this resource.");
    }
    
    return true;
}
