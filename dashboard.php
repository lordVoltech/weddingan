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
?>

<div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="flex-1 flex flex-col">
        <main class="flex-1 content-wrapper">
            <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
                <!-- Page Header -->
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Welcome to Your Dashboard</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage your wedding invitations and guests</p>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <button class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-500 bg-opacity-10 rounded-lg mr-3">
                                <i class="fas fa-envelope text-blue-500"></i>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">Create Invitation</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>

                    <button class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-purple-500 bg-opacity-10 rounded-lg mr-3">
                                <i class="fas fa-users text-purple-500"></i>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">Manage Guests</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>

                    <button class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-500 bg-opacity-10 rounded-lg mr-3">
                                <i class="fas fa-gift text-green-500"></i>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">Digital Gifts</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>
                </div>

                <!-- Getting Started Guide -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Getting Started</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center">
                                <span class="font-semibold">1</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400">Create your first wedding invitation</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center">
                                <span class="font-semibold">2</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400">Add your guest list</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center">
                                <span class="font-semibold">3</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400">Set up digital gifts and RSVP</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
