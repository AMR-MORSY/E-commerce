<div class=" w-full mx-auto  flex justify-center items-center mt-7">

    <form wire:submit="register">
        <!-- Personal Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

            <fieldset >
                <label class="input validator">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                            stroke="currentColor">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </g>
                    </svg>
                    <input type="text" wire:model="first_name" placeholder="First Name" pattern="[A-Za-z]{3,30}"
                        title="First name must be 3-30 letters only (upper or lower case)" required />



                </label>

                <p class="validator-hint">
                    Must be 3 to 30 characters
                    {{-- <br />containing only letters --}}
                </p>

            </fieldset>
            <fieldset >
                <label class="input validator">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                            stroke="currentColor">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </g>
                    </svg>
                    <input type="text" wire:model="last_name" placeholder="Last Name" pattern="[A-Za-z]{3,30}"
                        title="First name must be 3-30 letters only (upper or lower case)" required />



                </label>

                <p class="validator-hint">
                    Must be 3 to 30 characters
                    {{-- <br />containing only letters --}}
                </p>

            </fieldset>
            <fieldset >
                <label class="input validator">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <g fill="none">
                            <path
                                d="M7.25 11.5C6.83579 11.5 6.5 11.8358 6.5 12.25C6.5 12.6642 6.83579 13 7.25 13H8.75C9.16421 13 9.5 12.6642 9.5 12.25C9.5 11.8358 9.16421 11.5 8.75 11.5H7.25Z"
                                fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6 1C4.61929 1 3.5 2.11929 3.5 3.5V12.5C3.5 13.8807 4.61929 15 6 15H10C11.3807 15 12.5 13.8807 12.5 12.5V3.5C12.5 2.11929 11.3807 1 10 1H6ZM10 2.5H9.5V3C9.5 3.27614 9.27614 3.5 9 3.5H7C6.72386 3.5 6.5 3.27614 6.5 3V2.5H6C5.44771 2.5 5 2.94772 5 3.5V12.5C5 13.0523 5.44772 13.5 6 13.5H10C10.5523 13.5 11 13.0523 11 12.5V3.5C11 2.94772 10.5523 2.5 10 2.5Z"
                                fill="currentColor"></path>
                        </g>
                    </svg>
                    <input type="tel" class="tabular-nums" required placeholder="Phone" pattern="01[0125]\d{8}"
                        title="Phone number must start with 01, followed by 0,1,2, or 5, then 8 more digits (12 digits total)"
                        required oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                </label>
                <p class="validator-hint">Egyptian phone number: 11 digits starting with 010, 011, 012, or 015</p>
            </fieldset>
            <fieldset >
                <label class="input validator">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                            stroke="currentColor">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </g>
                    </svg>
                    <input type="email" placeholder="mail@site.com" required />
                </label>
                <div class="validator-hint hidden">Enter valid email address</div>
            </fieldset>
            <fieldset >
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
                <p class="validator-hint hidden">
                    Must be more than 8 characters, including
                    <br />At least one number <br />At least one lowercase letter <br />At least one uppercase letter
                </p>
            </fieldset>
            <fieldset >
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
                    <input type="password" id="con-password" wire:model="confirm_password" required
                        placeholder="Confirm Password"  oninput="this.setCustomValidity(this.value !== document.getElementById('passwordy').value ? 'Passwords do not match' : '')" />
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
