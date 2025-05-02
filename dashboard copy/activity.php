<?php
session_start();
require_once 'components/roles.php';
require_once 'components/config.php';

// Check if user has permission to view activity
checkPermission('activity', 'view');

require_once 'components/header.php';
require_once 'components/sidebar.php';
?>

<!-- Main Content -->
<main class="ml-0 md:ml-72 pt-16 min-h-screen">
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6 py-4 sm:py-6">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">User Activity</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Monitor user actions and system events</p>
        </div>

        <!-- Activity Timeline -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Activities</h2>
                    <div class="flex space-x-2">
                        <button class="px-2 sm:px-3 py-1 text-xs sm:text-sm text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600">
                            <i class="fas fa-filter mr-1"></i> Filter
                        </button>
                        <?php if (hasPermission($_SESSION['user_role'], 'activity', 'export')): ?>
                        <button class="px-2 sm:px-3 py-1 text-xs sm:text-sm text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600">
                            <i class="fas fa-download mr-1"></i> Export
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Timeline -->
            <div class="p-4">
                <div class="flow-root">
                    <ul class="-mb-8">
                        <?php
                        $activities = [
                            [
                                'user' => 'John Doe',
                                'action' => 'logged in',
                                'time' => '2 minutes ago',
                                'icon' => 'fa-sign-in-alt',
                                'color' => 'bg-green-100 text-green-600'
                            ],
                            [
                                'user' => 'Sarah Williams',
                                'action' => 'updated their profile',
                                'time' => '1 hour ago',
                                'icon' => 'fa-user-edit',
                                'color' => 'bg-blue-100 text-blue-600'
                            ],
                            [
                                'user' => 'Mike Johnson',
                                'action' => 'deleted a post',
                                'time' => '3 hours ago',
                                'icon' => 'fa-trash',
                                'color' => 'bg-red-100 text-red-600'
                            ],
                            [
                                'user' => 'Jane Smith',
                                'action' => 'added a new comment',
                                'time' => '5 hours ago',
                                'icon' => 'fa-comment',
                                'color' => 'bg-purple-100 text-purple-600'
                            ],
                            [
                                'user' => 'Tom Brown',
                                'action' => 'uploaded a file',
                                'time' => '1 day ago',
                                'icon' => 'fa-file-upload',
                                'color' => 'bg-yellow-100 text-yellow-600'
                            ]
                        ];

                        foreach ($activities as $index => $activity):
                        ?>
                        <li>
                            <div class="relative pb-8">
                                <?php if ($index !== count($activities) - 1): ?>
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700 hidden sm:block" aria-hidden="true"></span>
                                <?php endif; ?>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-6 w-6 sm:h-8 sm:w-8 rounded-full <?php echo str_replace(['bg-', 'text-'], ['dark:bg-', 'dark:text-'], $activity['color']); ?> flex items-center justify-center ring-4 sm:ring-8 ring-white dark:ring-gray-800">
                                            <i class="fas <?php echo $activity['icon']; ?>"></i>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-0.5 sm:pt-1.5 flex justify-between space-x-2 sm:space-x-4">
                                        <div>
                                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-medium text-gray-900 dark:text-white truncate max-w-[120px] sm:max-w-none inline-block align-bottom"><?php echo htmlspecialchars($activity['user']); ?></span>
                                                <?php echo htmlspecialchars($activity['action']); ?>
                                            </p>
                                        </div>
                                        <div class="text-right text-xs sm:text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                            <time><?php echo htmlspecialchars($activity['time']); ?></time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="px-2 sm:px-4 py-2 sm:py-3 border-t border-gray-200 dark:border-gray-700 text-center">
                <button class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium">
                    Load More Activities
                </button>
            </div>
        </div>

        <!-- Activity Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mt-4 sm:mt-6">
            <!-- Today's Activity -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Today's Activity</h3>
                <div class="mt-2">
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">147</p>
                        <p class="ml-2 text-sm font-medium text-green-600 dark:text-green-400">
                            <i class="fas fa-arrow-up"></i>
                            12%
                        </p>
                    </div>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Compared to yesterday</p>
                </div>
            </div>

            <!-- Most Active User -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Most Active User</h3>
                <div class="mt-2 flex items-center">
                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Sarah+Williams&background=random" alt="">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Sarah Williams</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">42 actions today</p>
                    </div>
                </div>
            </div>

            <!-- Peak Activity Time -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Peak Activity Time</h3>
                <div class="mt-2">
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">2:00 PM</p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Most active hour today</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'components/footer.php'; ?>
