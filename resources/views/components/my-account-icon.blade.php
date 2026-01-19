@props([
    'navbarDirection' => 'top',
])
<div>

    @auth
        <div class="dropdown dropdown-end">

            <div class="flex justify-center flex-col  items-center cursor-pointer" tabindex="0">
                <!-- Icon container -->
                <div class="relative">
                    <!-- Icon -->
                    <div
                        class="btn  @if ($navbarDirection == 'top') btn-base-100
                @else
                    btn-secondary @endif  btn-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>

                <!-- Text label -->
                {{-- <span
                    class="text-sm  font-medium @if ($navbarDirection == 'top') text-base-content
                @else
                   text-secondary-content @endif">My
                    Account</span> --}}
            </div>

            <ul tabindex="-1" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li><a>Orders</a></li>
                <form method="POST" action="{{ route('logout') }}">
                    <li>

                        @csrf

                        <button type="submit" class=" cursor-pointer">Logout</button>


                    </li>
                </form>
            </ul>
        </div>
    @else
        <label for="my-drawer-3">

            <div class="flex justify-center gap-0.5 items-center cursor-pointer">
                <!-- Icon container -->
                <div class="relative">
                    <!-- Icon -->
                    <div
                        class="btn  @if ($navbarDirection == 'top') btn-base-100
            @else
                btn-secondary @endif  btn-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>

                <!-- Text label -->
                <span
                    class="text-sm  font-medium @if ($navbarDirection == 'top') text-base-content
            @else
               text-secondary-content @endif">My
                    Account</span>
            </div>
        </label>
    @endauth

</div>
