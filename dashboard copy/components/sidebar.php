<?php
require_once 'roles.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Sidebar -->
<aside id="sidebar" class="bg-white dark:bg-gray-800 w-[85%] max-w-[320px] md:w-72 h-screen fixed left-0 top-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out shadow-lg pt-16 z-40 overflow-y-auto">
    <div class="h-full flex flex-col overflow-y-auto">
        <!-- Sidebar Content -->
        <div class="flex-1 px-4 py-4">
            <!-- Profile Section -->
            <div class="flex flex-col items-center space-y-3 mb-6 -mt-2">
                <img class="h-16 w-16 rounded-full object-cover ring-2 ring-blue-500 dark:ring-blue-400 p-1" 
                     src="https://ui-avatars.com/api/?name=Admin+User&background=random" 
                     alt="Profile">
                <div class="text-center">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Welcome,</p>
                    <p class="text-base font-bold text-gray-900 dark:text-white">Admin User</p>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 dark:border-gray-700 mb-6"></div>

            <!-- Navigation Menu -->
            <nav class="space-y-2">
                <!-- Dashboard -->
                <?php if (hasPermission($_SESSION['user_role'], 'dashboard')): ?>
                <a href="index.php" class="<?php echo $current_page == 'index.php' ? 'bg-blue-50 dark:bg-blue-900 text-blue-600 dark:text-blue-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'; ?> group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out">
                    <i class="fas fa-home w-5 h-5 mr-3 transition-transform duration-200 group-hover:scale-110"></i>
                    <span class="transition-colors duration-200">Dashboard</span>
                </a>
                <?php endif; ?>

                <!-- Users -->
                <?php if (hasPermission($_SESSION['user_role'], 'users', 'view')): ?>
                <a href="users.php" class="<?php echo $current_page == 'users.php' ? 'bg-blue-50 dark:bg-blue-900 text-blue-600 dark:text-blue-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'; ?> group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out">
                    <i class="fas fa-users w-5 h-5 mr-3 transition-transform duration-200 group-hover:scale-110"></i>
                    <span class="transition-colors duration-200">Users</span>
                </a>
                <?php endif; ?>

                <!-- User Activity -->
                <?php if (hasPermission($_SESSION['user_role'], 'activity', 'view')): ?>
                <a href="activity.php" class="<?php echo $current_page == 'activity.php' ? 'bg-blue-50 dark:bg-blue-900 text-blue-600 dark:text-blue-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'; ?> group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out">
                    <i class="fas fa-chart-line w-5 h-5 mr-3 transition-transform duration-200 group-hover:scale-110"></i>
                    <span class="transition-colors duration-200">Activity</span>
                </a>
                <?php endif; ?>

                <!-- Settings -->
                <?php if (hasPermission($_SESSION['user_role'], 'settings', 'view')): ?>
                <a href="settings.php" class="<?php echo $current_page == 'settings.php' ? 'bg-blue-50 dark:bg-blue-900 text-blue-600 dark:text-blue-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'; ?> group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out">
                    <i class="fas fa-cog w-5 h-5 mr-3 transition-transform duration-200 group-hover:scale-110"></i>
                    <span class="transition-colors duration-200">Settings</span>
                </a>
                <?php endif; ?>
            </nav>
        </div>

        <!-- Bottom Section -->
        <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-4 mt-auto">
            <a href="logout.php" 
               class="group flex items-center px-4 py-2.5 text-sm font-medium text-red-600 dark:text-red-400 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-all duration-200 ease-in-out">
                <i class="fas fa-sign-out-alt w-5 h-5 mr-3 transition-transform duration-200 group-hover:scale-110 group-hover:-rotate-12"></i>
                <span class="transition-colors duration-200">Logout</span>
            </a>
        </div>
    </div>
</aside>

<!-- Sidebar Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm opacity-0 invisible transition-opacity duration-300 ease-in-out z-30 md:hidden cursor-pointer"></div>
