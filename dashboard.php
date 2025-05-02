<?php
session_start();

// Check if user is not logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Initialize empty stats
$stats = [
    'total_users' => 0,
    'active_users' => 0,
    'new_users' => 0,
    'online_users' => 0
];
$recentUsers = [];
?>

<div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="flex-1 flex flex-col">
        <main class="flex-1 content-wrapper mt-16 md:ml-72">
            <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
                <!-- Welcome Section -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                                <?php
                                $hour = date('H');
                                $greeting = '';
                                if ($hour >= 5 && $hour < 12) {
                                    $greeting = 'Good Morning';
                                } elseif ($hour >= 12 && $hour < 18) {
                                    $greeting = 'Good Afternoon';
                                } else {
                                    $greeting = 'Good Evening';
                                }
                                echo $greeting . ', ' . htmlspecialchars($_SESSION['user_email']);
                                ?>
                            </h1>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Here's what's happening with your dashboard today</p>
                        </div>
                        <div class="relative" x-data="{ open: false }" @keydown.escape.window="open = false">
                            <button @click="open = !open" 
                                    class="relative p-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white focus:outline-none transition-colors duration-200 group">
                                <i class="fas fa-bell text-xl transition-transform duration-200 group-hover:scale-110"></i>
                                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full" 
                                      x-text="$store.notifications.count"
                                      x-show="$store.notifications.count > 0"
                                      x-transition:enter="transition ease-out duration-300"
                                      x-transition:enter-start="opacity-0 scale-50"
                                      x-transition:enter-end="opacity-100 scale-100"></span>
                            </button>
                            
                            <!-- Notification Dropdown -->
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 z-50">
                                <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Notifications</h3>
                                    <span class="px-2 py-1 text-xs font-medium text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900/50 rounded-full" x-text="$store.notifications.count + ' New'"></span>
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    <!-- Notification Items -->
                                    <template x-for="(item, index) in $store.notifications.items" :key="index">
                                        <a href="#" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <div :class="`w-8 h-8 rounded-full bg-${item.color}-500 bg-opacity-10 flex items-center justify-center`">
                                                        <i :class="`fas fa-${item.icon} text-${item.color}-500`"></i>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white" x-text="item.title"></p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400" x-text="item.time"></p>
                                                </div>
                                            </div>
                                        </a>
                                    </template>
                                </div>
                                <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-700">
                                    <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:underline hover:text-blue-800 dark:hover:text-blue-200 transition-colors duration-200">View all notifications</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <?php $role = $_SESSION['user_role'];
                
                    $konten_file = 'includes/{$role}/konten-{$role}.php';
                    echo "<pre>Path dicoba: $konten_file</pre>";


                    if (file_exists($konten_file)) {
                        include $konten_file;
                    } else {
                        echo "<p class='text-red-500'>Konten untuk role ini belum tersedia.</p>";
                    }
                ?>

                
            </div>
        </main>
    </div>
</div>

<!-- Alpine.js and Chart.js -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Initialize Alpine.js -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('notifications', {
            count: 3,
            items: [
                {
                    icon: 'user-plus',
                    color: 'blue',
                    title: 'New user registered',
                    time: '2 minutes ago'
                },
                {
                    icon: 'chart-line',
                    color: 'green',
                    title: 'Activity spike detected',
                    time: '1 hour ago'
                },
                {
                    icon: 'exclamation-triangle',
                    color: 'yellow',
                    title: 'System update required',
                    time: '2 hours ago'
                }
            ]
        })
    })
</script>

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
