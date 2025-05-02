<?php
// Check if user is not logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Invitation Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <!-- Top Navigation Bar -->
    <nav class="bg-white dark:bg-gray-800 shadow-lg fixed w-full md:w-[calc(100%-18rem)] top-0 z-50 transition-colors duration-200 md:ml-72">
        <div class="max-w-7xl mx-auto px-2 sm:px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Left side - Brand & Toggle -->
                <div class="flex items-center">
                    <button id="sidebar-toggle" 
                            class="text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white focus:outline-none p-2 md:hidden"
                            onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span class="ml-2 text-xl font-semibold text-gray-800 dark:text-white">MomenKita</span>
                </div>

                <!-- Right side -->
                <div class="flex items-center space-x-4">
                    <!-- Dark Mode Toggle -->
                    <button id="darkModeToggle" 
                            class="p-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white focus:outline-none">
                        <i class="fas fa-moon"></i>
                    </button>

                    <!-- User Profile -->
                    <div class="relative">
                        <div class="flex items-center space-x-3">
                            <img class="h-8 w-8 rounded-full object-cover" 
                                 src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_email']); ?>&background=random" 
                                 alt="Profile">
                            <span class="hidden sm:block text-sm font-medium text-gray-700 dark:text-white">
                                <?php echo htmlspecialchars($_SESSION['user_email']); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
        // Dark mode toggle
        document.addEventListener('DOMContentLoaded', function() {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const html = document.documentElement;
            
            // Check for saved dark mode preference
            if (localStorage.getItem('darkMode') === 'true') {
                html.classList.add('dark');
            }
            
            darkModeToggle.addEventListener('click', function() {
                html.classList.toggle('dark');
                localStorage.setItem('darkMode', html.classList.contains('dark'));
            });
        });

        // Sidebar toggle for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (sidebar && overlay) {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('invisible');
                overlay.classList.toggle('opacity-0');
            }
        }
    </script>
</body>
</html>
