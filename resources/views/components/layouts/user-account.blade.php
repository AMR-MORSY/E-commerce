<x-layouts.app>



    <style>
        .nav-link:hover,
        .dashboard-link:hover {
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
    </style>

    <main class="container mx-auto px-4 py-6">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <div class="w-full lg:w-1/4">
                <div class="bg-base-200 rounded-xl shadow-sm p-6">
                    <div class="mb-8">
                        <div class="flex items-center space-x-3 mb-4">
                            <div
                                class="w-12 h-12 user-avatar rounded-full flex items-center justify-center text-white font-bold text-lg">
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

                    <h3 class="font-bold text-base-content mb-4 text-lg">Dashboard</h3>
                    <nav class="space-y-2">
                        <a href="{{route('user.dashboard')}}"
                            class="flex items-center space-x-3 p-3 hover:bg-base-300  rounded-lg @if (request()->routeIs('user.dashboard'))
                                bg-neutral text-neutral-content hover:bg-neutral
                         

                            
                                
                            @endif  font-medium ">
                            <i class="fas fa-tachometer-alt w-5"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{route('user.orders')}}"
                            class="flex items-center space-x-3 p-3 hover:bg-base-300 rounded-lg @if (request()->routeIs('user.orders'))
                                bg-neutral text-neutral-content hover:bg-neutral
                         

                            
                                
                            @endif font-medium ">
                            <i class="fas fa-shopping-bag w-5"></i>
                            <span>Orders</span>
                        </a>
                        <a href="#"
                            class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:text-blue-600 font-medium nav-link">
                            <i class="fas fa-download w-5"></i>
                            <span>Downloads</span>
                        </a>
                        <a href="#"
                            class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:text-blue-600 font-medium nav-link">
                            <i class="fas fa-map-marker-alt w-5"></i>
                            <span>Addresses</span>
                        </a>
                        <a href="#"
                            class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:text-blue-600 font-medium nav-link">
                            <i class="fas fa-user-circle w-5"></i>
                            <span>Account details</span>
                        </a>
                        <a href="#"
                            class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:text-blue-600 font-medium nav-link">
                            <i class="fas fa-star w-5"></i>
                            <span>My Points</span>
                            <span
                                class="ml-auto bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-1 rounded-full">1,240</span>
                        </a>
                        <a href="#"
                            class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:text-blue-600 font-medium nav-link">
                            <i class="fas fa-heart w-5"></i>
                            <span>Wishlist</span>
                            <span
                                class="ml-auto bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded-full">12</span>
                        </a>
                        <a href="#"
                            class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:text-blue-600 font-medium nav-link">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Logout</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="w-full lg:w-3/4">
                {{$slot}}
            </div>
        </div>
    </main>

</x-layouts.app>
