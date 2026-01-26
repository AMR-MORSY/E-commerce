<div class=" w-full mx-auto  flex justify-center items-center mt-20">

    <form wire:submit="register">
        <!-- Personal Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

            <fieldset>
                <label class="input validator">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                            stroke="currentColor">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </g>
                    </svg>
                    <input type="text" wire:model="first_name" placeholder="First Name" pattern="[A-Za-z]{3,30}"
                        title="First name must be 3-30 letters only (upper or lower case)" required value="{{old('first_name')}}" />



                </label>

                <p class="validator-hint">
                    Must be 3 to 30 characters

                </p>

            </fieldset>
            <fieldset>
                <label class="input validator">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                            stroke="currentColor">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </g>
                    </svg>
                    <input type="text" wire:model="last_name" placeholder="Last Name" pattern="[A-Za-z]{3,30}"
                        title="First name must be 3-30 letters only (upper or lower case)" required value="{{old('last_name')}}" />



                </label>

                <p class="validator-hint">
                    Must be 3 to 30 characters
                    {{-- <br />containing only letters --}}
                </p>

            </fieldset>
           
            <fieldset>
                <label class="input validator">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                            stroke="currentColor">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </g>
                    </svg>
                    <input type="email" wire:model="email" placeholder="mail@site.com" required value="{{old('email')}}" />
                </label>
                @error('email')
                    <div class=" bg-error">
                        <p class="mt-1 text-sm text-left text-error-content">{{ $message }}</p>
                    </div>
                @enderror
                <div class="validator-hint hidden">Enter valid email address</div>
            </fieldset>
            <fieldset>
                <label class="input validator">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                            stroke="currentColor">
                            <path
                                d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z">
                            </path>
                            <circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle>
                        </g>
                    </svg>
                    <input type="password" id="passwordy" required wire:model="password" placeholder="Password"
                        minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="Must be more than 8 characters, including number, lowercase letter, uppercase letter" />
                    <button type="button" class="password-toggle" id="togglePassword">
                        <span class="eye-icon">👁️‍🗨️</span>
                    </button>
                </label>
                @error('password')
                    <div class=" bg-error">
                        <p class="mt-1 text-sm text-left text-error-content">{{ $message }}</p>
                    </div>
                @enderror
                <p class="validator-hint hidden">
                    Must be more than 8 characters, including
                    <br />At least one number <br />At least one lowercase letter <br />At least one uppercase letter
                </p>
            </fieldset>
            <fieldset>
                <label class="input validator">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                            stroke="currentColor">
                            <path
                                d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z">
                            </path>
                            <circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle>
                        </g>
                    </svg>
                    <input type="password" id="con-password" wire:model="password_confirmation" required
                        placeholder="Confirm Password"
                        oninput="this.setCustomValidity(this.value !== document.getElementById('passwordy').value ? 'Passwords do not match' : '')" />
                    <button type="button" class="password-toggle" id="toggle-confirm-Password">
                        <span class="eye-icon">👁️‍🗨️</span>
                    </button>
                </label>
                <p class="validator-hint hidden">
                    Password do not match

                </p>
            </fieldset>

        </div>

        <button class="btn btn-neutral mt-4" type="submit">Register</button>
    </form>



    <style>
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            font-size: 20px;
            color: #666;
        }

        .password-toggle:hover {
            color: #333;
        }
    </style>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const toggleConfirmPassword = document.getElementById('toggle-confirm-Password');
        const password = document.getElementById('passwordy');
        const conPassword = document.getElementById('con-password');

        togglePassword.addEventListener('click', function() {



            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the eye icon
            this.textContent = type === 'password' ? '👁️‍🗨️' : '👁️';

        });
        toggleConfirmPassword.addEventListener('click', function() {



            // Toggle the type attribute
            const type = conPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            conPassword.setAttribute('type', type);

            // Toggle the eye icon
            this.textContent = type === 'password' ? '👁️‍🗨️' : '👁️';

        });
    </script>
</div>
