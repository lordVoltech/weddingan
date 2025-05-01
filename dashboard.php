<?php
session_start();
require_once 'components/roles.php';

// Check if user is not logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if user has permission to view dashboard
checkPermission('dashboard', 'view');

require_once 'components/config.php';
require_once 'components/header.php';
require_once 'components/sidebar.php';

// Get user statistics
$stats = getUserStats($pdo);
$recentUsers = getRecentUsers($pdo);
?>

<div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="flex-1 flex flex-col">
        <main class="flex-1 content-wrapper">
            <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
                <!-- Page Header -->
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Dashboard Overview</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Monitor and analyze user statistics</p>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <!-- Total Users Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 transition-transform duration-200 hover:scale-105">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1"><?php echo number_format($stats['total_users']); ?></h3>
                            </div>
                            <div class="p-3 bg-blue-500 bg-opacity-10 rounded-full">
                                <i class="fas fa-users text-xl text-blue-500"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-green-500 flex items-center">
                                <i class="fas fa-arrow-up mr-1 text-xs"></i>
                                12%
                            </span>
                            <span class="text-gray-600 dark:text-gray-400 ml-2">from last month</span>
                        </div>
                    </div>

                    <!-- Active Users Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 transition-transform duration-200 hover:scale-105">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Users</p>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1"><?php echo number_format($stats['active_users']); ?></h3>
                            </div>
                            <div class="p-3 bg-green-500 bg-opacity-10 rounded-full">
                                <i class="fas fa-user-check text-xl text-green-500"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-green-500 flex items-center">
                                <i class="fas fa-arrow-up mr-1 text-xs"></i>
                                8%
                            </span>
                            <span class="text-gray-600 dark:text-gray-400 ml-2">from yesterday</span>
                        </div>
                    </div>

                    <!-- New Users Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 transition-transform duration-200 hover:scale-105">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">New Users Today</p>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1"><?php echo number_format($stats['new_users']); ?></h3>
                            </div>
                            <div class="p-3 bg-purple-500 bg-opacity-10 rounded-full">
                                <i class="fas fa-user-plus text-xl text-purple-500"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-purple-500 flex items-center">
                                <i class="fas fa-plus mr-1 text-xs"></i>
                                New
                            </span>
                            <span class="text-gray-600 dark:text-gray-400 ml-2">since last check</span>
                        </div>
                    </div>

                    <!-- Online Users Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 transition-transform duration-200 hover:scale-105">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Online Users</p>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1"><?php echo number_format($stats['online_users']); ?></h3>
                            </div>
                            <div class="p-3 bg-yellow-500 bg-opacity-10 rounded-full">
                                <i class="fas fa-signal text-xl text-yellow-500"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-yellow-500 flex items-center">
                                <i class="fas fa-clock mr-1 text-xs"></i>
                                Live
                            </span>
                            <span class="text-gray-600 dark:text-gray-400 ml-2">updating every minute</span>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- User Activity Chart -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">User Activity</h3>
                            <div class="flex items-center space-x-2">
                                <button class="px-3 py-1 text-sm bg-blue-100 text-blue-600 rounded-full dark:bg-blue-900 dark:text-blue-300">Weekly</button>
                                <button class="px-3 py-1 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">Monthly</button>
                            </div>
                        </div>
                        <div class="h-80">
                            <canvas id="userActivityChart"></canvas>
                        </div>
                    </div>

                    <!-- Recent Users -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Users</h3>
                            <a href="users.php" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View all</a>
                        </div>
                        <div class="space-y-4">
                            <?php foreach ($recentUsers as $user): ?>
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg transition-colors duration-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <div class="flex items-center space-x-3">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['name']); ?>&background=random" alt="">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white"><?php echo htmlspecialchars($user['name']); ?></p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($user['email']); ?></p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs <?php echo $user['status'] === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300'; ?> rounded-full">
                                    <?php echo ucfirst($user['status']); ?>
                                </span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <?php if (hasPermission($_SESSION['user_role'], 'users', 'add')): ?>
                    <button class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-500 bg-opacity-10 rounded-lg mr-3">
                                <i class="fas fa-user-plus text-blue-500"></i>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">Add New User</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>
                    <?php endif; ?>

                    <?php if (hasPermission($_SESSION['user_role'], 'activity', 'view')): ?>
                    <button class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-purple-500 bg-opacity-10 rounded-lg mr-3">
                                <i class="fas fa-chart-line text-purple-500"></i>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">View Activity</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>
                    <?php endif; ?>

                    <?php if (hasPermission($_SESSION['user_role'], 'settings', 'view')): ?>
                    <button class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-500 bg-opacity-10 rounded-lg mr-3">
                                <i class="fas fa-cog text-green-500"></i>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">Settings</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Initialize Charts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sample data for the chart
    const ctx = document.getElementById('userActivityChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Active Users',
                data: [65, 59, 80, 81, 56, 55, 40],
                fill: true,
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        drawBorder: false,
                        color: document.documentElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: {
                        color: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#4b5563'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#4b5563'
                    }
                }
            }
        }
    });
});
</script>
