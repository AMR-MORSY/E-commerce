<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="acid">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (isset($seoTitle) && isset($seoDescription))
        <x-seo-meta :title="$seoTitle" :description="$seoDescription" :image="$seoImage ?? null" :canonical="$seoCanonical ?? null" :keywords="$seoKeywords ?? null" />
    @else
        <title>{{ $title ?? 'E-Commerce Store' }}</title>
        <meta name="description" content="Shop quality products at great prices. Free shipping available.">
    @endif


  <!-- Luxury Fonts from Google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Raleway:wght@300;400;500;600;700&family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles

    <!-- Allow additional head content from pages -->
    @stack('head')

</head>


<body class="bg-base-100 text-base-content ">




    @livewire('auth.login', ['currentPageRoute' => Route::currentRouteName(), 'currentPageRouteParams' => Route::current()->parameters()])
    <x-right-side-cart-drawer />



    <div class="drawer">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">

            <!-- Navbar -->
            <div class="navbar bg-base-300 fixed z-5  w-full lg:px-28">
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


                    <x-my-account-icon navbarDirection="top" />

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
                <div class=" min-h-screen"> <!-- Ensures minimum height -->
                    {{ $slot }}

                </div>
                <footer class="bg-neutral  text-white  mt-auto ">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        <div class="text-center">
                            <p>&copy; {{ date('Y') }} ShopHub. All rights reserved.</p>
                        </div>
                    </div>
                </footer>


                <div class="navbar block fixed bottom-0 left-0 right-0 lg:hidden bg-base-200    w-full px-5">

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


                            <x-my-account-icon navbarDirection="bottom" />



                        @endauth
                    </div>
                </div>


            </main>



        </div>
        {{-- <div class="drawer-side">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
           
            <ul class="menu bg-base-200 min-h-full w-80 p-4">
                <li><a>Home</a></li>
                <li>
                    <details open>
                        <summary>Categories</summary>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a>{{ $category->name }}</a></li>
                            @endforeach

                        </ul>
                    </details>
                </li>
                <li><a>Deals</a></li>
            </ul>
        </div> --}}
        <div class="drawer-side">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>

            <aside class="bg-base-200 min-h-full flex flex-col w-80">
                <!-- Header -->
                <div class="p-6 border-b">
                    <div class="flex items-center space-x-3">
                        <div class="avatar">
                            <div
                                class="w-10 rounded-full bg-primary text-primary-content flex items-center justify-center">
                                <span class="text-xl font-bold">S</span>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">Shop Name</h2>
                            <p class="text-sm text-base-content/60">Browse Categories</p>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="mt-4">
                        <div class="form-control">
                            <div class="input-group input-group-sm">
                                <input type="text" placeholder="Search..." class="input input-bordered w-full" />
                                <button class="btn btn-square btn-sm">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex-1 overflow-y-auto p-4">
                    <ul class="menu space-y-1">
                        <li>
                            <a class="rounded-lg {{ request()->is('/') ? 'active' : '' }}">
                                <i class="fas fa-home mr-3"></i>Home
                            </a>
                        </li>

                        <li class="menu-title mt-6 mb-2">
                            <span class="text-xs font-semibold uppercase text-base-content/60">Shop By Category</span>
                        </li>

                        <li>
                            <details open>
                                <summary class="font-medium rounded-lg">
                                    <i class="fas fa-th-large mr-3"></i>All Categories
                                </summary>
                                {{-- <ul class="mt-2 ml-2 space-y-1">
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{route('category.products',$category->name)}}" class="rounded-lg hover:bg-base-300">
                                                <div class="flex items-center justify-between">
                                                    <span>{{ $category->name }}</span>
                                                    <span
                                                        class="badge badge-sm badge-ghost">{{ $category->products_count }}</span>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul> --}}
                            </details>
                        </li>

                        <li>
                            <a class="rounded-lg">
                                <i class="fas fa-tag mr-3"></i>Deals
                                <span class="badge badge-secondary badge-sm ml-auto">HOT</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Footer -->
                <div class="p-4 border-t">
                    <div class="flex items-center justify-between">
                        <button class="btn btn-ghost btn-sm">
                            <i class="fas fa-user mr-2"></i>Account
                        </button>
                        <div class="flex space-x-2">
                            <button class="btn btn-ghost btn-square btn-sm">
                                <i class="fas fa-cog"></i>
                            </button>
                            <button class="btn btn-ghost btn-square btn-sm">
                                <i class="fas fa-question-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </aside>
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
        Livewire.on('open_login', () => {
            const drawer = document.getElementById('my-drawer-2');
            if (drawer) {
                drawer.checked = true;
            }
        });
    </script>
    <style>
        .menu a,
        .menu details summary {
            transition: all 0.2s ease;
        }

        .menu ul {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</body>

</html>
