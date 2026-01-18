<div class="drawer  drawer-end flex-1 flex flex-col">
    <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex-1 flex flex-col " wire:listen="side-drawer-closed">
        <!-- Page content here -->


        {{-- <label for="my-drawer-1" class="btn drawer-button">Open drawer</label> --}}
    </div>
    <div class="drawer-side">
        <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>

        <ul class="menu bg-base-200 min-h-full w-80 p-4">
            <!-- Sidebar content here -->


            <div class="flex justify-between items-center mb-4 pb-2 border-b-2 border-neutral">
                <h2 class="text-xl font-bold text-base-content">Sign In</h2>
                <button onclick="closeDrawer()" class="btn btn-ghost btn-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>


            <div class="card bg-base-200 w-full max-w-sm shrink-0 ">
                <div class="card-body">
                    <form wire:submit="login">
                       
                        <fieldset class="fieldset border-b-1 border-base-content pb-7">
                            <label class="label">Email</label>
                            <input type="email" class="input" wire:model="email" placeholder="Email" />
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label class="label">Password</label>
                            <input type="password" id="password" wire:model="password" autocomplete="current-password"
                                 class="input" placeholder="Password" />
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div class=" flex items-center justify-between">

                                <label class="label text-base-content">
                                    <input type="checkbox" wire:model="remember" checked="checked"
                                        class="checkbox checkbox-xs " />
                                    Remember me
                                </label>

                                <a class="link link-hover">Forgot password?</a>
                            </div>
                            <button class="btn btn-neutral mt-4" type="submit">Login</button>
                        </fieldset>
                    </form>
                    {{-- @if (session('credential-error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-7xl mx-auto mt-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('credential-error') }}</span>
                        </div>
                    @endif --}}

                    <div class=" flex flex-col justify-center items-center mt-9">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 " fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <p class=" text-center text-base-content text-base"> Do not have account yet?</p>

                        <a href="{{ route('register') }}"
                            class=" mt-2 underline decoration-solid decoration-secondary-content hover:text-secondary text-secondary-content text-center">CREATE
                            NEW ACCOUNT</a>
                    </div>


                </div>
            </div>







        </ul>
    </div>
</div>
