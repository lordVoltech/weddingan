<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Sidebar -->
<aside id="sidebar" class="bg-gradient-to-b from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 w-[85%] max-w-[320px] md:w-72 h-[calc(100vh-4rem)] fixed left-0 top-16 transform -translate-x-full md:translate-x-0 transition-all duration-300 ease-in-out shadow-lg z-40 overflow-y-auto">
    <div class="h-full flex flex-col overflow-y-auto">
        <!-- Sidebar Content -->
        <div class="flex-1 px-4 py-4">
            <!-- Profile Section -->
            <div class="flex flex-col items-center space-y-3 mb-6 -mt-2">
                <div class="relative group">
                    <img class="h-16 w-16 rounded-full object-cover ring-2 ring-blue-500 dark:ring-blue-400 p-1 transition-transform duration-300 group-hover:scale-105" 
                         src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_email']); ?>&background=random" 
                         alt="Profile">
                    <div class="absolute inset-0 rounded-full bg-blue-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                </div>
                <div class="text-center">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Welcome,</p>
                    <p class="text-base font-bold bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-400 dark:to-blue-600 bg-clip-text text-transparent"><?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 dark:border-gray-700 mb-6"></div>

            <!-- Navigation Menu -->
            <nav class="space-y-1.5">
                <!-- Dashboard -->
                <a href="dashboard.php" class="<?php echo $current_page == 'dashboard.php' ? 'bg-blue-50/80 dark:bg-blue-900/50 text-blue-600 dark:text-blue-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50/80 dark:hover:bg-gray-700/50'; ?> group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out hover:scale-[1.02]">
                    <i class="fas fa-home w-5 h-5 mr-3 transition-transform duration-200 group-hover:scale-110"></i>
                    <span class="transition-colors duration-200">Dashboard</span>
                </a>

                <!-- Users -->
                <a href="users.php" class="text-gray-600 dark:text-gray-300 hover:bg-gray-50/80 dark:hover:bg-gray-700/50 group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out hover:scale-[1.02]">
                    <i class="fas fa-users w-5 h-5 mr-3 transition-transform duration-200 group-hover:scale-110"></i>
                    <span class="transition-colors duration-200">Users</span>
                </a>

                <!-- User Activity -->
                <a href="activity.php" class="text-gray-600 dark:text-gray-300 hover:bg-gray-50/80 dark:hover:bg-gray-700/50 group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out hover:scale-[1.02]">
                    <i class="fas fa-chart-line w-5 h-5 mr-3 transition-transform duration-200 group-hover:scale-110"></i>
                    <span class="transition-colors duration-200">Activity</span>
                </a>

                <!-- Settings -->
                <a href="settings.php" class="text-gray-600 dark:text-gray-300 hover:bg-gray-50/80 dark:hover:bg-gray-700/50 group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out hover:scale-[1.02]">
                    <i class="fas fa-cog w-5 h-5 mr-3 transition-transform duration-200 group-hover:scale-110"></i>
                    <span class="transition-colors duration-200">Settings</span>
                </a>
            </nav>
        </div>

        <!-- Bottom Section -->
        <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-4 mt-auto">
            <a href="logout.php" 
               class="group flex items-center px-4 py-2.5 text-sm font-medium text-red-600 dark:text-red-400 rounded-lg hover:bg-red-50/80 dark:hover:bg-red-900/30 transition-all duration-200 ease-in-out hover:scale-[1.02]">
                <i class="fas fa-sign-out-alt w-5 h-5 mr-3 transition-all duration-200 group-hover:scale-110 group-hover:-rotate-12"></i>
                <span class="transition-all duration-200 group-hover:translate-x-0.5">Logout</span>
            </a>
        </div>
    </div>
</aside>

<!-- Sidebar Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm opacity-0 invisible transition-opacity duration-300 ease-in-out z-30 md:hidden cursor-pointer"></div>
