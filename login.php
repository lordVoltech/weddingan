<?php
session_start();

if (isset($_SESSION['error_message'])) {
    $errorMessage = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['user_id'])) {
    // Sudah login, langsung arahkan ke dashboard
    header('Location: dashboard.php');
    exit;
}

$emailValue = isset($_SESSION['old_email']) ? $_SESSION['old_email'] : '';
unset($_SESSION['old_email']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MomenKita - Login</title>
    <link rel="icon" type="image/png" href="assets/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FFDA77',
                        secondary: '#2A3D65',
                        cream: '#F9F5F0'
                    },
                    fontFamily: {
                        display: ['Playfair Display', 'serif'],
                        body: ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
        .custom-shadow {
            box-shadow: 0 0 40px rgba(0,0,0,0.1);
        }
        .google-btn {
            background: white;
            color: #757575;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 12px;
            width: 100%;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .google-btn:hover {
            background: #f5f5f5;
        }
        .google-btn img {
            margin-right: 8px;
            width: 18px;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-cream to-white min-h-screen flex items-center justify-center p-4">
    <?php if (isset($errorMessage)): ?>
    <div class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg z-50" role="alert">
        <span class="block sm:inline"><?php echo htmlspecialchars($errorMessage); ?></span>
        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <?php endif; ?>

    <?php if (isset($successMessage)): ?>
    <div class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg z-50" role="alert">
        <span class="block sm:inline"><?php echo htmlspecialchars($successMessage); ?></span>
        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <?php endif; ?>

    <div class="w-full max-w-4xl bg-white rounded-2xl custom-shadow overflow-hidden flex flex-col md:flex-row">
        <!-- Left Side - Image -->
        <div class="md:w-1/2 bg-cover bg-center h-64 md:h-auto relative" style="background-image: url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80')">
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center p-12">
                <div class="text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-display">Welcome to MomenKita</h2>
                    <p class="text-white text-lg font-body">Create beautiful wedding invitations in minutes</p>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="md:w-1/2 py-12 px-8 md:px-12">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-secondary mb-2 font-display">Welcome Back!</h1>
                <p class="text-gray-600">Please sign in to your account</p>
            </div>

            <form action="auth.php" method="POST" class="space-y-6">
                <div class="space-y-2">
                    <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($emailValue); ?>" 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" 
                               placeholder="Enter your email" autocomplete="email">
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="password" id="password" name="password" 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" 
                               placeholder="Enter your password" autocomplete="current-password">
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-secondary py-3 px-4 rounded-lg hover:bg-opacity-90 transition duration-200 font-semibold">
                    Sign In
                </button>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Or continue with</span>
                    </div>
                </div>

                <!-- Custom Google Sign In Button -->
                <button type="button" onclick="handleGoogleSignIn()" class="google-btn">
                    <img src="assets/g-logo.png" alt="Google Logo">
                    Sign in with Google
                </button>

                <p class="text-center text-sm text-gray-600 mt-6">
                    Don't have an account? 
                    <a href="register-tampil.php" class="text-primary hover:text-secondary font-medium transition duration-200">Sign up</a>
                </p>
            </form>
        </div>
    </div>
</body>

<script>
function handleGoogleSignIn() {
    google.accounts.id.initialize({
        client_id: '468756575892-ev53i0f1hfjdg180lo82q2pr545g95ae.apps.googleusercontent.com',
        callback: handleCredentialResponse
    });
    google.accounts.id.prompt();
}

function handleCredentialResponse(response) {
    fetch("validate_token.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id_token=" + response.credential
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.href = "dashboard.php";
        } else {
            alert("Login failed. Please try again.");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred. Please try again.");
    });
}
</script>
</html>
