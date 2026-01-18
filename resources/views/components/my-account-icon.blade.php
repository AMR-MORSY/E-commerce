@props([
    'navbarDirection' => 'top',
])
<div>

    @auth
    <div class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn m-1">
            <div class="flex justify-center gap-0.5 items-center cursor-pointer" >
                <!-- Icon container -->
                <div class="relative">
                    <!-- Icon -->
                    <div
                        class="btn btn-active @if ($navbarDirection == 'top') btn-neutral
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
                    class="text-sm  font-medium @if ($navbarDirection == 'top') text-neutral-content
                @else
                   text-secondary-content @endif">My
                    Account</span>
            </div>
        </div>
        <ul tabindex="-1" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
          <li><a>Dashboard</a></li>
          <li><a>Orders</a></li>
        </ul>
      </div>
    @else
    <label for="my-drawer-3">
   
        <div class="flex justify-center gap-0.5 items-center cursor-pointer" >
            <!-- Icon container -->
            <div class="relative">
                <!-- Icon -->
                <div
                    class="btn btn-active @if ($navbarDirection == 'top') btn-neutral
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
                class="text-sm  font-medium @if ($navbarDirection == 'top') text-neutral-content
            @else
               text-secondary-content @endif">My
                Account</span>
        </div>
    </label>
    @endauth
   
</div>

