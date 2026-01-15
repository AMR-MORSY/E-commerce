<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="lemonade">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'E-Commerce Store' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>



<body>


    <div id="cart_drawer" class="drawer  drawer-end">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Page content here -->
            <nav class="navbar bg-base-200 shadow-sm px-7">
                {{-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8  bg-amber-200"> --}}
                {{-- <div class="flex justify-between h-16"> --}}
                <div class="flex navbar-start">
                    <div class="dropdown md:hidden">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </div>
                        <ul tabindex="-1"
                            class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                            <li><a>Homepage</a></li>
                            <li><a>Portfolio</a></li>
                            <li><a>About</a></li>
                        </ul>
                    </div>
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold ">ShopHub</a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('home') }}"
                            class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Products
                        </a>
                        @auth
                        
                            <a href="{{ route('admin.products.index') }}"
                                class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Admin
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="flex items-center space-x-4 navbar-end">

                   <livewire:cart-icon/>
                    @auth


                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                       
                        <a href="{{ route('login') }}"
                            class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">Register</a>
                    @endauth
                </div>

            </nav>

            <main>


                @if (session('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-7xl mx-auto mt-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('message') }}</span>

                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-7xl mx-auto mt-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif





                {{ $slot }}
            </main>

            <footer class="bg-gray-800 text-white ">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <p>&copy; {{ date('Y') }} ShopHub. All rights reserved.</p>
                    </div>
                </div>
            </footer>


            {{-- <label for="my-drawer-1" class="btn drawer-button">Open drawer</label> --}}
        </div>
        <div class="drawer-side">
            <label for="my-drawer-1" aria-label="close sidebar" class="drawer-overlay" onclick="closeDrawer()" ></label>
            <ul class="menu bg-base-200 min-h-full w-80 p-4">
                <!-- Sidebar content here -->
                {{-- <li><a>Sidebar Item 1</a></li>
         <li><a>Sidebar Item 2</a></li> --}}
         <livewire:shopping-cart :isDrawer="true" />
            </ul>
        </div>
    </div>



    @livewireScripts
    <script>
        Livewire.on('cart-updated', () => {
            const drawer = document.getElementById('my-drawer-1');
            if (drawer) {
                drawer.checked=true;
            }
        });

        function closeDrawer() {
            document.getElementById('my-drawer-4').checked = false;
        }
    </script>
</body>

</html>
