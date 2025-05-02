<?php
session_start();
require_once 'components/roles.php';

// Check if user is already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Demo users with different roles
$demo_users = [
    'admin@example.com' => [
        'password' => 'admin123',
        'name' => 'Admin User',
        'role' => ROLE_ADMIN
    ],
    'editor@example.com' => [
        'password' => 'editor123',
        'name' => 'Editor User',
        'role' => ROLE_EDITOR
    ],
    'user@example.com' => [
        'password' => 'user123',
        'name' => 'Regular User',
        'role' => ROLE_USER
    ]
];

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($demo_users[$email]) && $demo_users[$email]['password'] === $password) {
        $_SESSION['user_id'] = md5($email);
        $_SESSION['user_name'] = $demo_users[$email]['name'];
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = $demo_users[$email]['role'];
        
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - User Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-lg">
            <!-- Header -->
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900">Welcome Back</h2>
                <p class="mt-2 text-sm text-gray-600">Please sign in to your account</p>
            </div>

            <!-- Login Form -->
            <form class="mt-8 space-y-6" method="POST" action="">
                <?php if (isset($error)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
                    </div>
                <?php endif; ?>

                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" required autocomplete="email"
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                            placeholder="Email address">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                            placeholder="Password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember_me" type="checkbox" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-lock"></i>
                        </span>
                        Sign in
                    </button>
                </div>
            </form>

            <!-- Demo Credentials -->
            <div class="mt-6 text-center text-sm">
                <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                    <p class="font-medium text-gray-800">Demo Credentials:</p>
                    
                    <div class="border-b pb-2">
                        <p class="font-medium text-blue-600">Admin Account:</p>
                        <p>Email: admin@example.com</p>
                        <p>Password: admin123</p>
                    </div>
                    
                    <div class="border-b pb-2">
                        <p class="font-medium text-green-600">Editor Account:</p>
                        <p>Email: editor@example.com</p>
                        <p>Password: editor123</p>
                    </div>
                    
                    <div>
                        <p class="font-medium text-purple-600">User Account:</p>
                        <p>Email: user@example.com</p>
                        <p>Password: user123</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
