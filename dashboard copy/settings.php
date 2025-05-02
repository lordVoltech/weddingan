<?php
session_start();
require_once 'components/roles.php';
require_once 'components/config.php';

// Check if user has permission to view settings
checkPermission('settings', 'view');

require_once 'components/header.php';
require_once 'components/sidebar.php';

// Check if user has permission to edit settings
$canEditSettings = hasPermission($_SESSION['user_role'], 'settings', 'edit');
?>

<!-- Main Content -->
<main class="ml-0 md:ml-72 pt-16 min-h-screen">
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6 py-4 sm:py-6">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Settings</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage your account and application preferences</p>
        </div>

        <!-- Settings Sections -->
        <div class="space-y-4 sm:space-y-6">
            <!-- Profile Settings -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                <div class="p-4 sm:p-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Profile Settings</h2>
                    <form class="space-y-4 sm:space-y-6">
                        <!-- Profile Picture -->
                        <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0">
                            <img class="h-16 w-16 sm:h-20 sm:w-20 rounded-full" src="https://ui-avatars.com/api/?name=Admin+User&size=80" alt="">
                            <div class="sm:ml-4">
                                <button type="button" class="px-3 sm:px-4 py-1.5 sm:py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" <?php echo !$canEditSettings ? 'disabled' : ''; ?>>
                                    Change Photo
                                </button>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">JPG, GIF or PNG. Max size of 2MB</p>
                            </div>
                        </div>

                        <!-- Name & Email -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name" value="Admin User" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" <?php echo !$canEditSettings ? 'disabled' : ''; ?>>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                <input type="email" name="email" id="email" value="admin@example.com" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" <?php echo !$canEditSettings ? 'disabled' : ''; ?>>
                            </div>
                        </div>

                        <!-- Bio -->
                        <div>
                            <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bio</label>
                            <textarea id="bio" name="bio" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" <?php echo !$canEditSettings ? 'disabled' : ''; ?>></textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Security Settings -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                <div class="p-4 sm:p-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Security Settings</h2>
                    <form class="space-y-4 sm:space-y-6">
                        <!-- Change Password -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" <?php echo !$canEditSettings ? 'disabled' : ''; ?>>
                            </div>
                            <div>
                                <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" <?php echo !$canEditSettings ? 'disabled' : ''; ?>>
                            </div>
                        </div>

                        <!-- Two Factor Authentication -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between space-y-3 sm:space-y-0">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white">Two-Factor Authentication</h3>
                                <p class="mt-1 text-xs sm:text-sm text-gray-500 dark:text-gray-400">Add additional security to your account</p>
                            </div>
                            <button type="button" class="px-3 sm:px-4 py-1.5 sm:py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 text-xs sm:text-sm">
                                Enable 2FA
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Notification Settings -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                <div class="p-4 sm:p-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Notification Settings</h2>
                    <form>
                        <div class="space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between space-y-3 sm:space-y-0">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">Email Notifications</h3>
                                    <p class="mt-1 text-xs sm:text-sm text-gray-500 dark:text-gray-400">Receive email updates about your account</p>
                                </div>
                                <button type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-blue-600" role="switch" aria-checked="true">
                                    <span class="translate-x-5 pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200">
                                        <span class="opacity-0 ease-in duration-200 absolute inset-0 h-full w-full flex items-center justify-center transition-opacity" aria-hidden="true">
                                            <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                                <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </span>
                                </button>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between space-y-3 sm:space-y-0">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">Push Notifications</h3>
                                    <p class="mt-1 text-xs sm:text-sm text-gray-500 dark:text-gray-400">Receive push notifications in your browser</p>
                                </div>
                                <button type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-gray-200" role="switch" aria-checked="false">
                                    <span class="translate-x-0 pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200">
                                        <span class="opacity-100 ease-in duration-200 absolute inset-0 h-full w-full flex items-center justify-center transition-opacity" aria-hidden="true">
                                            <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                                <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Save Changes Button -->
            <?php if ($canEditSettings): ?>
            <div class="flex justify-end">
                <button type="button" class="px-3 sm:px-4 py-1.5 sm:py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 text-xs sm:text-sm">
                    Save Changes
                </button>
            </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require_once 'components/footer.php'; ?>
