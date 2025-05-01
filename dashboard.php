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
    <?php require_once 'components/sidebar.php'; ?>
    <div class="flex-1 flex flex-col">
        <?php require_once 'components/header.php'; ?>
        <main class="flex-1 content-wrapper">
            <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
                <!-- Page Header -->
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Dashboard Overview</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Monitor and analyze user statistics</p>
                </div>
                ...
            </div>
        </main>
        <?php require_once 'components/footer.php'; ?>
    </div>
</div>


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

<?php require_once 'components/footer.php'; ?>
