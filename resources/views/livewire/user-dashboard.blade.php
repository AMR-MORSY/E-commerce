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

{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }
        
        .nav-link:hover, .dashboard-link:hover {
            background-color: rgba(59, 130, 246, 0.1);
            transition: all 0.3s ease;
        }
        
        .dashboard-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .user-avatar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        /* Sign-in icon animation */
        @keyframes pulse-gentle {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .sign-in-icon:hover {
            animation: pulse-gentle 0.5s ease;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="min-h-screen">
        <!-- Header/Navigation -->
        <header class="bg-white shadow-sm">
            <div class="container mx-auto px-4 py-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold">S</span>
                        </div>
                        <h1 class="text-xl font-bold text-gray-800">Storefront</h1>
                    </div>
                    
                    <nav class="hidden md:flex space-x-6">
                        <a href="#" class="text-gray-600 hover:text-blue-600 font-medium">Home</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 font-medium">Shop</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 font-medium">Categories</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 font-medium">Deals</a>
                        <a href="#" class="text-blue-600 font-medium border-b-2 border-blue-600 pb-1">My Account</a>
                    </nav>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Sign In Icon - Visible when user is NOT logged in -->
                        <a href="#" class="sign-in-icon flex items-center space-x-2 px-3 py-2 rounded-lg bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 border border-blue-100 transition-all duration-200">
                            <i class="fas fa-sign-in-alt text-blue-600"></i>
                            <span class="text-blue-700 font-medium text-sm hidden sm:inline">Sign In</span>
                        </a>
                        
                        <!-- User Icon - Visible when user IS logged in (currently shown) -->
                        <div class="user-icon flex items-center space-x-2 px-3 py-2 rounded-lg bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100">
                            <div class="w-6 h-6 user-avatar rounded-full flex items-center justify-center text-white text-xs font-bold">
                                MA
                            </div>
                            <span class="text-gray-700 font-medium text-sm hidden sm:inline">morsy.amr</span>
                        </div>
                        
                        <button class="text-gray-600 hover:text-blue-600">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <button class="text-gray-600 hover:text-blue-600">
                            <i class="fas fa-bell"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Mobile Navigation -->
                <div class="mt-4 md:hidden">
                    <div class="flex space-x-4 overflow-x-auto">
                        <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50">Home</a>
                        <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50">Shop</a>
                        <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50">Categories</a>
                        <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50">Deals</a>
                        <a href="#" class="px-3 py-2 rounded-lg text-sm font-medium text-blue-600 bg-blue-50">My Account</a>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Breadcrumb -->
        <div class="container mx-auto px-4 py-4">
            <nav class="flex items-center text-sm text-gray-600">
                <a href="#" class="hover:text-blue-600">Home</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-medium">My account</span>
            </nav>
        </div>
        
        <main class="container mx-auto px-4 py-6">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="mb-8">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="w-12 h-12 user-avatar rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    MA
                                </div>
                                <div>
                                    <h2 class="font-bold text-gray-800">morsy.amr</h2>
                                    <p class="text-sm text-gray-500">Gold Member</p>
                                </div>
                            </div>
                            <div class="text-sm text-gray-600">
                                <p>Not morsy.amr?</p>
                                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Log out</a>
                            </div>
                        </div>
                        
                        <h3 class="font-bold text-gray-700 mb-4 text-lg">Dashboard</h3>
                        <nav class="space-y-2">
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg bg-blue-50 text-blue-600 font-medium nav-link">
                                <i class="fas fa-tachometer-alt w-5"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:text-blue-600 font-medium nav-link">
                                <i class="fas fa-shopping-bag w-5"></i>
                                <span>Orders</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:text-blue-600 font-medium nav-link">
                                <i class="fas fa-download w-5"></i>
                                <span>Downloads</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:text-blue-600 font-medium nav-link">
                                <i class="fas fa-map-marker-alt w-5"></i>
                                <span>Addresses</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:text-blue-600 font-medium nav-link">
                                <i class="fas fa-user-circle w-5"></i>
                                <span>Account details</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:text-blue-600 font-medium nav-link">
                                <i class="fas fa-star w-5"></i>
                                <span>My Points</span>
                                <span class="ml-auto bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-1 rounded-full">1,240</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:text-blue-600 font-medium nav-link">
                                <i class="fas fa-heart w-5"></i>
                                <span>Wishlist</span>
                                <span class="ml-auto bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded-full">12</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:text-blue-600 font-medium nav-link">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span>Logout</span>
                            </a>
                        </nav>
                    </div>
                </div>
                
                <!-- Main Content -->
                <div class="w-full lg:w-3/4">
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                        <h1 class="text-2xl font-bold text-gray-800 mb-6">MY ACCOUNT</h1>
                        
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold text-gray-700 mb-4">Hello morsy.amr</h2>
                            <p class="text-gray-600 mb-6">
                                From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.
                            </p>
                            
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-700">
                                            Your account is verified. You have <span class="font-bold">1,240 points</span> available for rewards.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dashboard Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Orders Card -->
                            <a href="#" class="dashboard-card bg-white border border-gray-200 rounded-xl p-5 hover:border-blue-300">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-shopping-bag text-blue-600 text-xl"></i>
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
                            <a href="#" class="dashboard-card bg-white border border-gray-200 rounded-xl p-5 hover:border-blue-300">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-download text-green-600 text-xl"></i>
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
                                            <p class="text-sm text-gray-500">2 days ago • Status: <span class="text-green-600 font-medium">Shipped</span></p>
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
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Standalone Sign-In Icon Examples (for reference) -->
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Sign-In Icon Variations</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Simple Sign-In Icon -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h3 class="font-bold text-gray-700 mb-4">Simple Icon</h3>
                    <a href="#" class="flex items-center justify-center w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        <span>Sign In</span>
                    </a>
                    <p class="text-sm text-gray-500 mt-3">Basic sign-in button with icon</p>
                </div>
                
                <!-- Outline Icon -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h3 class="font-bold text-gray-700 mb-4">Outline Style</h3>
                    <a href="#" class="flex items-center justify-center w-full py-3 px-4 border border-blue-600 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                        <i class="fas fa-user-circle mr-2"></i>
                        <span>Sign In</span>
                    </a>
                    <p class="text-sm text-gray-500 mt-3">Outline version for secondary actions</p>
                </div>
                
                <!-- Icon Only (for compact spaces) -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h3 class="font-bold text-gray-700 mb-4">Icon Only</h3>
                    <a href="#" class="flex items-center justify-center w-12 h-12 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full transition-colors" title="Sign In">
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                    <p class="text-sm text-gray-500 mt-3">Compact icon-only version for mobile/tight spaces</p>
                </div>
                
                <!-- Gradient Style -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h3 class="font-bold text-gray-700 mb-4">Gradient Style</h3>
                    <a href="#" class="flex items-center justify-center w-full py-3 px-4 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-lg transition-all">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        <span>Sign In</span>
                    </a>
                    <p class="text-sm text-gray-500 mt-3">Premium gradient style for emphasis</p>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-8 mt-12">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-6 md:mb-0">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                                <span class="text-gray-800 font-bold">S</span>
                            </div>
                            <h2 class="text-xl font-bold">Storefront</h2>
                        </div>
                        <p class="text-gray-400">Your one-stop shop for everything</p>
                    </div>
                    
                    <div class="text-center md:text-right">
                        <p class="text-gray-400 mb-2">© 2023 Storefront. All rights reserved.</p>
                        <div class="flex justify-center md:justify-end space-x-6">
                            <a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a>
                            <a href="#" class="text-gray-400 hover:text-white">Terms of Service</a>
                            <a href="#" class="text-gray-400 hover:text-white">Help Center</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Simple JavaScript to make the dashboard interactive
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effect to dashboard cards
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach(card => {
                card.addEventListener('click', function(e) {
                    if(e.target.tagName !== 'A') {
                        this.style.transform = 'scale(0.98)';
                        setTimeout(() => {
                            this.style.transform = '';
                        }, 150);
                    }
                });
            });
            
            // Sign In button functionality
            const signInBtn = document.querySelector('.sign-in-icon');
            if(signInBtn) {
                signInBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert('Redirecting to sign in page...');
                    // In a real app, this would redirect to login page
                });
            }
            
            // Logout button confirmation
            const logoutBtn = document.querySelector('a[href="#"]:has(i.fa-sign-out-alt)');
            if(logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if(confirm('Are you sure you want to logout?')) {
                        alert('Logging out...');
                        // In a real app, this would redirect to logout endpoint
                    }
                });
            }
        });
    </script>
</body>
</html> --}}