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



<body class="h-full flex flex-col bg-base-200">


    <div class="drawer  drawer-end flex-1 flex flex-col">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex-1 flex flex-col ">
            <!-- Page content here -->


            {{-- <label for="my-drawer-1" class="btn drawer-button">Open drawer</label> --}}
        </div>
        <div class="drawer-side">
            <label for="my-drawer-1" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 min-h-full w-80 p-4">
                <!-- Sidebar content here -->

                <livewire:shopping-cart :isDrawer="true" />
            </ul>
        </div>
    </div>

    <div class="drawer">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">

            <!-- Navbar -->
            <div class="navbar bg-neutral w-full px-5">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-2" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block h-6 w-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="mx-2 flex-1 px-2"> <a href="{{ route('home') }}" class="text-2xl font-bold ">ShopHub</a>
                </div>
                <div class="hidden flex-none lg:block">
                    <ul class="menu menu-horizontal">
                        <!-- Navbar menu content here -->
                        <li> <a href="{{ route('home') }}"
                                class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Products
                            </a></li>
                        <li> @auth

                                <a href="{{ route('admin.products.index') }}"
                                    class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Admin
                                </a>
                            @endauth
                        </li>
                    </ul>
                </div>
                <div class="lg:flex items-center space-x-4 hidden navbar-end">

                    <livewire:cart-icon />
                    @auth


                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                        {{-- <a href="{{ route('login') }}"
                            class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">Register</a> --}}
                        <!-- Simple version without notification badge -->
                        <div class=" justify-center gap-0.5 items-center flex cursor-pointer">
                            <!-- Icon container -->
                            <div class="relative">
                                <!-- Icon -->
                                <div class="btn btn-active btn-neutral btn-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 "
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Text label -->
                            <span class="text-sm text-neutral-content font-medium">My Account</span>
                        </div>
                    @endauth
                </div>
            </div>

            <main class="flex-1">


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




                <!-- Page Content -->
                <div class="min-h-[calc(100vh-200px)]"> <!-- Ensures minimum height -->
                    {{ $slot }}
                </div>
            </main>

            <footer class="bg-neutral text-white  mt-auto ">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <p>&copy; {{ date('Y') }} ShopHub. All rights reserved.</p>
                    </div>
                </div>
            </footer>

            <div class="navbar block lg:hidden bg-secondary w-full px-5">
                {{-- <div class="flex-none lg:hidden">
                    <label for="my-drawer-2" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block h-6 w-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="mx-2 flex-1 px-2"> <a href="{{ route('home') }}" class="text-2xl font-bold ">ShopHub</a>
                </div> --}}
                {{-- <div class="hidden flex-none lg:block">
                    <ul class="menu menu-horizontal">
                        <!-- Navbar menu content here -->
                        <li> <a href="{{ route('home') }}"
                                class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Products
                            </a></li>
                        <li> @auth

                                <a href="{{ route('admin.products.index') }}"
                                    class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Admin
                                </a>
                            @endauth
                        </li>
                    </ul>
                </div> --}}
                <div class="flex items-center justify-between ">

                    <livewire:cart-icon />
                    @auth


                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                        {{-- <a href="{{ route('login') }}"
                            class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">Register</a> --}}
                        <!-- Simple version without notification badge -->
                        <div class="flex justify-center gap-0.5 items-center cursor-pointer">
                            <!-- Icon container -->
                            <div class="relative">
                                <!-- Icon -->
                                <div class="btn btn-active btn-secondary btn-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 "
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Text label -->
                            <span class="text-sm text-secondary-content font-medium">My Account</span>
                        </div>
                    @endauth
                </div>
            </div>

        </div>
        <div class="drawer-side">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 min-h-full w-80 p-4">
                <!-- Sidebar content here -->
                <li><a>Sidebar Item 1</a></li>
                <li><a>Sidebar Item 2</a></li>
            </ul>
        </div>
    </div>



    @livewireScripts
    <script>
        Livewire.on('cart-updated', () => {
            const drawer = document.getElementById('my-drawer-1');
            if (drawer) {
                drawer.checked = true;
            }
        });
    </script>
</body>

</html>
