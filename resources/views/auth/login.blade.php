<x-layout>
    {{-- <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Sign in to your account
                </h2>
            </div>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                            placeholder="Email address" value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                            placeholder="Password">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" 
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign in
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:text-indigo-500">
                        Don't have an account? Register
                    </a>
                </div>
            </form>
        </div>
    </div> --}}
    <style>
        .display-none {
            display: none;
        }
    </style>
    <div class="hero min-h-[50vh]">
        <div class="hero-overlay bg-neutral"></div>
        <div class="hero-content text-neutral-content flex flex-col mt-20  text-center">

            <h1 class=" text-5xl md:text-7xl ">My Account</h1>

            <nav class="max-w-7xl  mx-auto px-4 py-4 mt-5" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="{{ url('/') }}" class=" hover:underline">Home</a></li>

                    <li class="flex items-center">
                        <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" />
                        </svg>
                        <span class="text-gray-500">My Account</span>
                    </li>
                </ol>
            </nav>


        </div>
    </div>

    <div class=" min-h-[50vh] grid grid-cols-1 mx-auto max-w-7xl  px-4 py-8 md:grid-cols-2 ">
        <div class="card bg-base-200 w-full  mx-auto  max-h-fit max-w-96 register display-none ">
            <div class="card-body">
                <h2 class=" underline text-neutral text-2xl text-center ">Register</h2>
                <form wire:submit="login">

                    <fieldset class="fieldset pb-7">
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
                        <label class="label">Confirm Password</label>
                        <input type="password" id="password" wire:model="confirm_password"
                            autocomplete="current-password" class="input" placeholder="confirm Password" />
                        @error('confirm_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <button class="btn btn-neutral mt-4" type="submit">Register</button>
                    </fieldset>
                </form>




            </div>
        </div>

        <div class="card bg-base-200  mx-auto w-full max-h-fit max-w-96 login  ">
            <div class="card-body">
                <h2 class=" underline text-neutral text-2xl text-center">Login</h2>
                <form method="POST" action="{{ route('submit_login') }}">
                    @csrf
                    <fieldset class="fieldset pb-7">
                        <label class="label">Email</label>
                        <input type="email" class="input" value="{{ old('email') }}" name="email" placeholder="Email" />
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <label class="label">Password</label>
                        <input type="password" id="password" name="password" autocomplete="current-password"
                            class="input" placeholder="Password" />
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div class=" flex items-center justify-between">

                            <label class="label text-base-content">
                                <input type="checkbox" name="remember" checked="checked"
                                    class="checkbox checkbox-xs " />
                                Remember me
                            </label>

                            <a class="link link-hover">Forgot password?</a>
                        </div>
                        <button class="btn btn-neutral mt-4" type="submit">Login</button>
                    </fieldset>
                </form>




            </div>
        </div>
        <div class="divider md:hidden">OR</div>

        <div
            class=" w-full max-h-fit flex mx-auto md:mx-0 flex-col max-w-96 md:border-l-2 md:border-base-300 px-5 py-5  ">
            <h2 class=" text-neutral text-center font-semibold text-2xl my-4 auth-heading">Register</h2>
            <p class=" text-base-content register-content">Registering for this site allows you to access your order
                status and history.
                Just fill in the fields
                below, and we'll get a new account set up for you in no time. We will only ask you for information
                necessary to make the purchase process faster and easier.</p>
            <p class=" text-base-content login-content display-none"> Your personal data will be used to support your
                experience throughout this website, to manage access to
                your
                account, and for other purposes described in our privacy policy. </p>


            <button class="btn btn-neutral mt-4 mx-auto" id="auth-toggle-btn" onclick="toggleAuth()">Register</button>


        </div>





    </div>
    <script>
        function toggleAuth() {
            const authToggleBtn = document.getElementById('auth-toggle-btn');
            const registerCard = document.querySelector('.register');
            const loginCard = document.querySelector('.login');
            const loginContent = document.querySelector('.login-content');
            const registerContent = document.querySelector('.register-content');
            const authHeading = document.querySelector('.auth-heading');
            const innerText = authToggleBtn.innerText;

            if (innerText === 'Register') {

                registerCard.classList.remove('display-none');
                loginCard.classList.add('display-none');
                authToggleBtn.innerText = 'Login';
                loginContent.classList.remove('display-none')
                registerContent.classList.add('display-none')
                authHeading.innerText = "Login"
                return;

            }
            loginCard.classList.remove('display-none');
            registerCard.classList.add('display-none');
            authToggleBtn.innerText = 'Register';
            registerContent.classList.remove('display-none')
            loginContent.classList.add('display-none')
            authHeading.innerText = "Register"
            return;


            // console.log(loginCard);


        }
    </script>
</x-layout>
