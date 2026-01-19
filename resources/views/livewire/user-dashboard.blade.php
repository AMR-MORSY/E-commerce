<div class="bg-base-200 rounded-xl shadow-sm p-6 mb-8">
    <h1 class="text-2xl font-bold text-base-content mb-6">MY ACCOUNT</h1>

    <div class="mb-8">
        <h2 class="text-lg font-semibold text-base-content mb-4">Hello morsy.amr</h2>
        <p class="text-base-content mb-6">
            From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and
            edit your password and account details.
        </p>

        <div class="bg-info border-l-4 border-blue-500 p-4 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-info-content mt-1"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-info-content">
                        Your account is verified. You have <span class="font-bold">1,240 points</span> available for
                        rewards.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Orders Card -->
        <a href="#" class="dashboard-card bg-base-100  rounded-xl p-5 hover:border hover:border-base-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-info rounded-lg flex items-center justify-center">
                    <i class="fas fa-shopping-bag text-info-content text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-500">3 pending</span>
            </div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">Orders</h3>
            <p class="text-gray-600 text-sm mb-4">Track, return, or buy things again</p>
            <div class="text-blue-600 font-medium flex items-center">
                <span>View orders</span>
                <i class="fas fa-chevron-right ml-2 text-sm"></i>
            </div>
        </a>

        <!-- Downloads Card -->
        <a href="#" class="dashboard-card bg-base-100  rounded-xl p-5 hover:border hover:border-base-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-success rounded-lg flex items-center justify-center">
                    <i class="fas fa-download text-success-content text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-500">5 items</span>
            </div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">Downloads</h3>
            <p class="text-gray-600 text-sm mb-4">Access your digital purchases</p>
            <div class="text-blue-600 font-medium flex items-center">
                <span>View downloads</span>
                <i class="fas fa-chevron-right ml-2 text-sm"></i>
            </div>
        </a>

        <!-- Addresses Card -->
        <a href="#" class="dashboard-card bg-white border border-gray-200 rounded-xl p-5 hover:border-blue-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-purple-600 text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-500">2 addresses</span>
            </div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">Addresses</h3>
            <p class="text-gray-600 text-sm mb-4">Edit shipping and billing addresses</p>
            <div class="text-blue-600 font-medium flex items-center">
                <span>Manage addresses</span>
                <i class="fas fa-chevron-right ml-2 text-sm"></i>
            </div>
        </a>

        <!-- Account Details Card -->
        <a href="#" class="dashboard-card bg-white border border-gray-200 rounded-xl p-5 hover:border-blue-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-circle text-yellow-600 text-xl"></i>
                </div>
            </div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">Account Details</h3>
            <p class="text-gray-600 text-sm mb-4">Edit login, name, and mobile number</p>
            <div class="text-blue-600 font-medium flex items-center">
                <span>Edit account</span>
                <i class="fas fa-chevron-right ml-2 text-sm"></i>
            </div>
        </a>

        <!-- My Points Card -->
        <a href="#" class="dashboard-card bg-white border border-gray-200 rounded-xl p-5 hover:border-blue-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-star text-red-600 text-xl"></i>
                </div>
                <span class="text-lg font-bold text-gray-800">1,240</span>
            </div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">My Points</h3>
            <p class="text-gray-600 text-sm mb-4">Redeem your rewards points</p>
            <div class="text-blue-600 font-medium flex items-center">
                <span>View points</span>
                <i class="fas fa-chevron-right ml-2 text-sm"></i>
            </div>
        </a>

        <!-- Wishlist Card -->
        <a href="#" class="dashboard-card bg-white border border-gray-200 rounded-xl p-5 hover:border-blue-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-heart text-pink-600 text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-500">12 items</span>
            </div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">Wishlist</h3>
            <p class="text-gray-600 text-sm mb-4">View your saved items</p>
            <div class="text-blue-600 font-medium flex items-center">
                <span>View wishlist</span>
                <i class="fas fa-chevron-right ml-2 text-sm"></i>
            </div>
        </a>
    </div>

    <!-- Recent Activity -->
    <div class="mt-10">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Activity</h2>
        <div class="bg-gray-50 rounded-xl p-5">
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-shopping-bag text-blue-600 text-sm"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-800 font-medium">Order #ORD-78945 placed</p>
                        <p class="text-sm text-gray-500">2 days ago • Status: <span
                                class="text-green-600 font-medium">Shipped</span></p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-download text-green-600 text-sm"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-800 font-medium">Downloaded "Digital Product Guide"</p>
                        <p class="text-sm text-gray-500">5 days ago</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-star text-yellow-600 text-sm"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-800 font-medium">Earned 50 points for review</p>
                        <p class="text-sm text-gray-500">1 week ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Simple JavaScript to make the dashboard interactive
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effect to dashboard cards
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach(card => {
                card.addEventListener('click', function(e) {
                    if (e.target.tagName !== 'A') {
                        this.style.transform = 'scale(0.98)';
                        setTimeout(() => {
                            this.style.transform = '';
                        }, 150);
                    }
                });
            });

            // Logout button confirmation
            const logoutBtn = document.querySelector('a[href="#"]:has(i.fa-sign-out-alt)');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('Are you sure you want to logout?')) {
                        alert('Logging out...');
                        // In a real app, this would redirect to logout endpoint
                    }
                });
            }
        });
    </script>

</div>
