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
    <title>User Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            bg: '#1a1a1a',
                            surface: '#2d2d2d',
                            text: '#ffffff'
                        }
                    },
                    rotate: {
                        '360': '360deg',
                        '-360': '-360deg'
                    },
                    transitionProperty: {
                        'colors': 'background-color, border-color, color, fill, stroke'
                    },
                    transitionDuration: {
                        '300': '300ms'
                    },
                    transitionTimingFunction: {
                        'in-out': 'cubic-bezier(0.4, 0, 0.2, 1)'
                    }
                }
            }
        }
    </script>
    <style>
        /* Smooth page transition for dark mode */
        html.transitioning * {
            transition: background-color 0.5s ease-in-out,
                      border-color 0.5s ease-in-out,
                      color 0.5s ease-in-out !important;
        }

        body {
            transition: background-color 0.5s ease-in-out;
        }

        /* Prevent flash of unstyled content */
        html.dark body {
            background-color: #1a1a1a;
        }
    </style>
    <style>
        /* Add smooth transitions for dark mode */
        * {
            transition: background-color 0.3s ease-in-out,
                      border-color 0.3s ease-in-out,
                      color 0.3s ease-in-out;
        }
        
        /* Icon rotation animations */
        .rotate-360 {
            animation: rotate360 0.3s ease-in-out;
        }
        
        .rotate-reverse {
            animation: rotateReverse 0.3s ease-in-out;
        }
        
        @keyframes rotate360 {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        @keyframes rotateReverse {
            from { transform: rotate(0deg); }
            to { transform: rotate(-360deg); }
        }

        /* Ripple effect */
        #darkModeToggle {
            position: relative;
            overflow: hidden;
        }

        #darkModeToggle::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%, -50%);
            transform-origin: 50% 50%;
        }

        #darkModeToggle:focus:not(:active)::after {
            animation: ripple 0.5s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }
    </style>
    <!-- Initialize dark mode -->
    <script>
        // Check for saved dark mode preference or system preference
        if (localStorage.getItem('darkMode') === 'true' || 
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-200" x-data="{ isSidebarOpen: false }">
    <!-- Top Navigation Bar -->
    <nav class="bg-white dark:bg-gray-800 shadow-lg fixed w-full md:w-[calc(100%-18rem)] top-0 z-50 transition-colors duration-200 md:ml-72">
        <div class="max-w-7xl mx-auto px-2 sm:px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Left side - Brand -->
                <div class="flex items-center">
                    <button id="sidebar-toggle" 
                            class="relative text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white focus:outline-none p-2 md:hidden transition-all duration-200 ease-in-out hover:scale-110 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg group"
                            onclick="toggleSidebar()">
                        <i class="fas fa-bars text-xl transform transition-transform duration-300 group-hover:rotate-180"></i>
                        <!-- Mobile menu tooltip -->
                        <span class="absolute left-full ml-2 px-2 py-1 text-xs font-medium text-white bg-gray-900 dark:bg-gray-700 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap hidden sm:block">
                            Toggle Menu
                        </span>
                    </button>
                    <span class="ml-2 sm:ml-4 text-lg sm:text-xl font-semibold text-gray-800 dark:text-white truncate">User Dashboard</span>
                </div>

                <!-- Right side - User Profile & Notifications -->
                <div class="flex items-center space-x-2 sm:space-x-4">
                    <!-- Search Bar -->
                    <div class="hidden lg:block">
                        <div class="relative">
                            <input type="text" class="bg-gray-100 dark:bg-gray-700 rounded-lg pl-10 pr-4 py-2 w-48 sm:w-64 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white dark:placeholder-gray-400" placeholder="Search...">
                            <div class="absolute left-3 top-2.5 text-gray-500 dark:text-gray-400">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Dark Mode Toggle -->
                    <div class="relative group">
                        <button id="darkModeToggle" 
                                class="p-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none transform transition-all duration-300 ease-in-out hover:scale-110 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                                onclick="toggleDarkMode()">
                            <i class="fas fa-moon text-xl transition-transform duration-300 ease-in-out group-hover:rotate-12"></i>
                            <i class="fas fa-sun text-xl hidden transition-transform duration-300 ease-in-out group-hover:rotate-90"></i>
                        </button>
                        <!-- Tooltip -->
                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block transition-opacity duration-200">
                            <div class="bg-gray-900 dark:bg-gray-700 text-white px-2 py-1 text-xs rounded-lg whitespace-nowrap">
                                Toggle dark mode
                            </div>
                            <!-- Tooltip arrow -->
                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 -mt-1">
                                <div class="border-4 border-transparent border-t-gray-900 dark:border-t-gray-700"></div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function toggleDarkMode() {
                            const html = document.documentElement;
                            const moonIcon = document.querySelector('.fa-moon');
                            const sunIcon = document.querySelector('.fa-sun');
                            
                            // Add transitioning class
                            html.classList.add('transitioning');
                            
                            if (html.classList.contains('dark')) {
                                // Switching to light mode
                                moonIcon.classList.remove('hidden');
                                moonIcon.classList.add('rotate-reverse');
                                requestAnimationFrame(() => {
                                    html.classList.remove('dark');
                                    setTimeout(() => {
                                        sunIcon.classList.add('hidden');
                                        localStorage.setItem('darkMode', 'false');
                                    }, 150);
                                });
                            } else {
                                // Switching to dark mode
                                sunIcon.classList.remove('hidden');
                                sunIcon.classList.add('rotate-360');
                                requestAnimationFrame(() => {
                                    html.classList.add('dark');
                                    setTimeout(() => {
                                        moonIcon.classList.add('hidden');
                                        localStorage.setItem('darkMode', 'true');
                                    }, 150);
                                });
                            }

                            // Remove transitioning and animation classes after they complete
                            setTimeout(() => {
                                html.classList.remove('transitioning');
                                moonIcon.classList.remove('rotate-reverse');
                                sunIcon.classList.remove('rotate-360');
                            }, 500);
                        }

                        // Initialize dark mode
                        document.addEventListener('DOMContentLoaded', function() {
                            const isDark = localStorage.getItem('darkMode') === 'true';
                            const html = document.documentElement;
                            const moonIcon = document.querySelector('.fa-moon');
                            const sunIcon = document.querySelector('.fa-sun');

                            if (isDark) {
                                html.classList.add('dark');
                                moonIcon.classList.add('hidden');
                                sunIcon.classList.remove('hidden');
                            }
                        });
                    </script>

                    <!-- Notifications -->
                    <button class="relative p-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full"></span>
                    </button>


                    <!-- User Profile Dropdown -->
                    <div class="relative">
                        <div class="flex items-center">
                            <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_name']); ?>" alt="Profile">
                            <div class="hidden sm:block ml-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-white"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                                <span class="block text-xs text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($_SESSION['user_role']); ?></span>
                            </div>
                            <a href="logout.php" class="hidden sm:inline-block ml-4 text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <div class="p-2 relative">
                    <input type="text" class="w-full bg-gray-100 dark:bg-gray-700 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white dark:placeholder-gray-400" placeholder="Search...">
                    <div class="absolute left-5 top-5 text-gray-500 dark:text-gray-400 pointer-events-none">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <a href="logout.php" class="block px-3 py-2 text-base font-medium text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Mobile menu and sidebar scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dark mode toggle functionality
            const darkModeToggle = document.getElementById('darkModeToggle');
            if (darkModeToggle) {
                darkModeToggle.addEventListener('click', () => {
                    document.documentElement.classList.toggle('dark');
                    localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
                });
            }

            // Mobile menu functionality
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Close mobile menu when clicking outside
            document.addEventListener('click', (e) => {
                if (mobileMenu && !mobileMenu.contains(e.target) && 
                    mobileMenuButton && !mobileMenuButton.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });

            // Handle ESC key to close mobile menu
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && mobileMenu) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });
    </script>

    <!-- Sidebar Control Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                const toggleBtn = document.getElementById('sidebar-toggle');
                const icon = toggleBtn.querySelector('i');
                
                if (sidebar && overlay) {
                    // Toggle sidebar
                    sidebar.classList.toggle('-translate-x-full');
                    
                    // Toggle overlay with animation
                    if (overlay.classList.contains('invisible')) {
                        overlay.classList.remove('invisible');
                        setTimeout(() => {
                            overlay.classList.remove('opacity-0');
                        }, 10);
                    } else {
                        overlay.classList.add('opacity-0');
                        setTimeout(() => {
                            overlay.classList.add('invisible');
                        }, 300);
                    }
                    
                    // Toggle body scroll
                    document.body.classList.toggle('overflow-hidden');
                    
                    // Animate hamburger icon
                    icon.classList.toggle('rotate-90');
                }
            }

            // Initialize event listeners
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const overlay = document.getElementById('sidebar-overlay');
            const sidebar = document.getElementById('sidebar');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }

            // Close sidebar when clicking links (mobile only)
            if (sidebar) {
                const links = sidebar.getElementsByTagName('a');
                Array.from(links).forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth < 768) {
                            toggleSidebar();
                        }
                    });
                });
            }

            // Close sidebar on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    const sidebar = document.getElementById('sidebar');
                    if (sidebar && !sidebar.classList.contains('-translate-x-full')) {
                        toggleSidebar();
                    }
                }
            });

            // Handle window resize
            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebar-overlay');
                    
                    if (window.innerWidth >= 768 && sidebar && overlay) {
                        sidebar.classList.add('-translate-x-full');
                        overlay.classList.add('opacity-0', 'invisible');
                        document.body.classList.remove('overflow-hidden');
                    }
                }, 100);
            });
        });
    </script>
</body>
</html>
