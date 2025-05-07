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

$emailValue = isset($_SESSION['old_email']) ? $_SESSION['old_email'] : '';
unset($_SESSION['old_email']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MomenKita - Register</title>
    <link rel="icon" type="image/png" href="assets/favicon.ico" />
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body class="bg-gradient-to-br from-cream to-white min-h-screen flex items-center justify-center p-4 font-body text-navy">
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

    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row">
        <!-- Left Side - Image -->
        <div class="md:w-1/2 bg-cover bg-center h-64 md:h-auto relative" style="background-image: url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80')">
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center p-12">
                <div class="text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-display">Join MomenKita</h2>
                    <p class="text-white text-lg font-body">Create your account to get started</p>
                </div>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="md:w-1/2 py-12 px-8 md:px-12">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-secondary mb-2 font-display">Create Account</h1>
                <p class="text-gray-600">Please fill in the form to create your account</p>
            </div>

            <form action="register.php" method="POST" class="space-y-6" autocomplete="off">
                <div class="space-y-2">
                    <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($emailValue); ?>" 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" 
                               placeholder="Enter your email" autocomplete="email" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="password" id="password" name="password" 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" 
                               placeholder="Enter your password" autocomplete="new-password" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="repeat_password" class="text-sm font-medium text-gray-700">Confirm Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="password" id="repeat_password" name="repeat_password" 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" 
                               placeholder="Confirm your password" autocomplete="new-password" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-secondary py-3 px-4 rounded-lg hover:bg-opacity-90 transition duration-200 font-semibold">
                    Register
                </button>

                <p class="text-center text-sm text-gray-600 mt-6">
                    Already have an account? 
                    <a href="login.php" class="text-primary hover:text-secondary font-medium transition duration-200">Log in</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
