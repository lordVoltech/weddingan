// Handle sidebar toggle and mobile menu
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const darkModeToggle = document.getElementById('darkModeToggle');

    // Handle sidebar toggle
    function toggleSidebar() {
        sidebar.classList.toggle('-translate-x-full');
        sidebarOverlay.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden', !sidebar.classList.contains('-translate-x-full'));
    }

    // Handle mobile menu toggle
    function toggleMobileMenu() {
        mobileMenu.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden', !mobileMenu.classList.contains('hidden'));
    }

    // Close sidebar on window resize if in mobile view
    function handleResize() {
        if (window.innerWidth >= 768) {
            if (!sidebar.classList.contains('-translate-x-full')) {
                toggleSidebar();
            }
            if (!mobileMenu.classList.contains('hidden')) {
                toggleMobileMenu();
            }
        }
    }

document.addEventListener('DOMContentLoaded', function() {
    // Create loading overlay
    const loadingOverlay = document.createElement('div');
    loadingOverlay.className = 'loading-overlay';
    loadingOverlay.innerHTML = '<div class="loading-spinner"></div>';
    document.body.appendChild(loadingOverlay);

    // Dark mode toggle handler
    const darkModeToggle = document.getElementById('darkModeToggle');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            const moonIcon = document.querySelector('.fa-moon');
            const sunIcon = document.querySelector('.fa-sun');
            
            // Toggle dark mode immediately
            if (isDark) {
                html.classList.remove('dark');
                moonIcon.classList.remove('hidden');
                sunIcon.classList.add('hidden');
                localStorage.setItem('darkMode', 'false');
            } else {
                html.classList.add('dark');
                moonIcon.classList.add('hidden');
                sunIcon.classList.remove('hidden');
                localStorage.setItem('darkMode', 'true');
            }
            
            // Broadcast change to other tabs
            window.dispatchEvent(new StorageEvent('storage', {
                key: 'darkMode',
                newValue: (!isDark).toString()
            }));
        });
    }

    // Listen for dark mode changes from other tabs
    window.addEventListener('storage', (e) => {
        if (e.key === 'darkMode') {
            const html = document.documentElement;
            const moonIcon = document.querySelector('.fa-moon');
            const sunIcon = document.querySelector('.fa-sun');
            
            if (e.newValue === 'true') {
                html.classList.add('dark');
                moonIcon.classList.add('hidden');
                sunIcon.classList.remove('hidden');
            } else {
                html.classList.remove('dark');
                moonIcon.classList.remove('hidden');
                sunIcon.classList.add('hidden');
            }
        }
    });

    // Initialize dark mode on page load
    const isDark = localStorage.getItem('darkMode') === 'true';
    const moonIcon = document.querySelector('.fa-moon');
    const sunIcon = document.querySelector('.fa-sun');
    
    if (isDark) {
        document.documentElement.classList.add('dark');
        moonIcon?.classList.add('hidden');
        sunIcon?.classList.remove('hidden');
    } else {
        document.documentElement.classList.remove('dark');
        moonIcon?.classList.remove('hidden');
        sunIcon?.classList.add('hidden');
    }

// Initialize theme based on localStorage or system preference
function initializeTheme() {
    const savedTheme = localStorage.getItem('darkMode');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const html = document.documentElement;
    
    // Use saved preference or system preference
    const shouldBeDark = savedTheme !== null ? savedTheme === 'true' : systemPrefersDark;
    html.classList.toggle('dark', shouldBeDark);
    
    // Listen for changes in other tabs
    window.addEventListener('storage', (e) => {
        if (e.key === 'darkMode') {
            html.classList.toggle('dark', e.newValue === 'true');
        }
    });
    
    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (localStorage.getItem('darkMode') === null) {
            html.classList.toggle('dark', e.matches);
        }
    });
}

    // Event listeners
    if (sidebarToggle && sidebar && sidebarOverlay) {
        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);
    }

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', toggleMobileMenu);
    }

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            toggleDarkMode();
        });
    }

    // Close sidebar/menu when clicking a link (mobile)
    const sidebarLinks = sidebar.querySelectorAll('a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 768) {
                toggleSidebar();
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', handleResize);

    // Initialize theme
    initializeTheme();

    // Handle user search and pagination
    const userSearch = document.getElementById('userSearch');
    if (userSearch) {
        let searchTimeout;
        const tableBody = document.querySelector('tbody');
        const paginationContainer = document.querySelector('[aria-label="Pagination"]');
        const loadingTemplate = `
            <tr>
                <td colspan="5" class="px-6 py-4 text-center">
                    <div class="flex justify-center items-center space-x-3">
                        <i class="fas fa-circle-notch fa-spin text-blue-500"></i>
                        <span class="text-gray-500 dark:text-gray-400">Searching...</span>
                    </div>
                </td>
            </tr>
        `;

        userSearch.addEventListener('input', (e) => {
            // Clear previous timeout
            clearTimeout(searchTimeout);

            // Show loading state
            if (tableBody) {
                tableBody.innerHTML = loadingTemplate;
            }

            // Set new timeout for search
            searchTimeout = setTimeout(() => {
                const searchTerm = e.target.value.toLowerCase();
                
                // Get all rows and filter
                const rows = Array.from(document.querySelectorAll('tr[data-user]'));
                rows.forEach(row => {
                    const userData = row.getAttribute('data-user');
                    if (userData) {
                        const user = JSON.parse(userData);
                        const matchesSearch = user.name.toLowerCase().includes(searchTerm) || 
                                           user.email.toLowerCase().includes(searchTerm) ||
                                           user.role.toLowerCase().includes(searchTerm);
                        row.style.display = matchesSearch ? '' : 'none';
                    }
                });

                // Update results count
                const visibleRows = rows.filter(row => row.style.display !== 'none').length;
                const countSpan = document.querySelector('.user-count');
                if (countSpan) {
                    countSpan.textContent = `${visibleRows} user${visibleRows !== 1 ? 's' : ''}`;
                }

                // Hide pagination if searching
                if (paginationContainer) {
                    paginationContainer.style.display = searchTerm ? 'none' : '';
                }
            }, 300);
        });
    }
});

// Handle page transitions
document.addEventListener('click', (e) => {
    const pageLink = e.target.closest('a[href*="page="]');
    if (pageLink) {
        e.preventDefault();
        const tableBody = document.querySelector('tbody');
        
        if (tableBody) {
            // Show loading state
            tableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center">
                        <div class="flex justify-center items-center space-x-3">
                            <i class="fas fa-circle-notch fa-spin text-blue-500"></i>
                            <span class="text-gray-500 dark:text-gray-400">Loading...</span>
                        </div>
                    </td>
                </tr>
            `;
            
            // Navigate to the page
            window.location.href = pageLink.href;
        }
    }
});

// Handle card animations
document.querySelectorAll('.dashboard-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        if (window.innerWidth >= 768) {
            this.classList.add('transform', 'scale-105', 'shadow-lg');
        }
    });
    
    card.addEventListener('mouseleave', function() {
        if (window.innerWidth >= 768) {
            this.classList.remove('transform', 'scale-105', 'shadow-lg');
        }
    });
});

// Initialize tooltips with responsive positioning
document.querySelectorAll('[data-tooltip]').forEach(element => {
    element.addEventListener('mouseenter', function(e) {
        if (window.innerWidth >= 768) {
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip absolute bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-xs sm:text-sm px-2 py-1 rounded';
            tooltip.textContent = this.getAttribute('data-tooltip');
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';
            tooltip.style.left = rect.left + (rect.width - tooltip.offsetWidth) / 2 + 'px';
        }
    });
    
    element.addEventListener('mouseleave', function() {
        if (window.innerWidth >= 768) {
            document.querySelector('.tooltip')?.remove();
        }
    });
});
