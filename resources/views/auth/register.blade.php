<x-auth-layout>
    <x-slot:title>Register | WTC</x-slot:title>
    <x-slot:image>{{ asset('src/images/auth/register.png') }}</x-slot:image>
    <div class="flex flex-col justify-center flex-1 w-full max-w-md mx-auto">
        <div class="mb-5 sm:mb-8">
            <h1 class="mb-2 font-semibold text-gray-800 text-title-sm dark:text-white/90 sm:text-title-md">
                Sign Up
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Enter your email and password to sign up!
            </p>
        </div>
        <div>
            <form action="{{ route('doregister') }}" method="POST">
                @csrf
                <div class="space-y-5">
                    <x-alert-any-error></x-alert-any-error>
                    @if (session('error'))
                        <x-alert type="error" :message="session('error')" />
                    @elseif(session('success'))
                        <x-alert type="success" :message="session('success')" />
                    @endif
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <!-- First Name -->
                        <div class="sm:col-span-1">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                First Name<span class="text-error-500">*</span>
                            </label>
                            <input type="text" id="fname" name="fname" placeholder="Enter your first name" value="{{ old('fname') }}"
                                required
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                        </div>
                        <!-- Last Name -->
                        <div class="sm:col-span-1">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Last Name<span class="text-error-500">*</span>
                            </label>
                            <input type="text" id="lname" name="lname" placeholder="Enter your last name" value="{{ old('lname') }}"
                                required
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                        </div>
                    </div>
                    <!-- Email -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Email<span class="text-error-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required value="{{ old('email') }}"
                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                    </div>
                    <!-- Password -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Password<span class="text-error-500">*</span>
                        </label>
                        <div x-data="{ showPassword: false }" class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="password" value="{{ old('password') }}"
                                placeholder="Enter your password" required
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                            <span @click="showPassword = !showPassword"
                                class="absolute z-30 text-gray-500 -translate-y-1/2 cursor-pointer right-4 top-1/2 dark:text-gray-400">
                                <svg x-show="!showPassword" class="fill-current" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z"
                                        fill="#98A2B3" />
                                </svg>
                                <svg x-show="showPassword" class="fill-current" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"
                                        fill="#98A2B3" />
                                </svg>
                            </span>
                            
                        </div>
                        <p class="inline-block text-sm font-normal text-gray-400 dark:text-gray-500 mt-2">
                            Password must consist of at least 8 characters, including uppercase and lowercase letters, numbers, and special characters.
                        </p>
                    </div>
                    <!-- Checkbox -->
                    <div>
                        <div x-data="{ checkboxToggle: false }">
                            <label for="checkboxLabelOne"
                                class="flex items-start text-sm font-normal text-gray-700 cursor-pointer select-none dark:text-gray-400">
                                <div class="relative">
                                    <input type="checkbox" id="checkboxLabelOne" class="sr-only" required
                                        @change="checkboxToggle = !checkboxToggle" />
                                    <div :class="checkboxToggle ? 'border-brand-500 bg-brand-500' :
                                        'bg-transparent border-gray-300 dark:border-gray-700'"
                                        class="mr-3 flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]">
                                        <span :class="checkboxToggle ? '' : 'opacity-0'">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7" stroke="white"
                                                    stroke-width="1.94437" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <p class="inline-block font-normal text-gray-500 dark:text-gray-400">
                                    By creating an account means you agree to the
                                    <span class="text-gray-800 dark:text-white/90">
                                        Terms and Conditions,
                                    </span>
                                    and our
                                    <span class="text-gray-800 dark:text-white">
                                        Privacy Policy
                                    </span>
                                </p>
                            </label>
                        </div>
                    </div>
                    <!-- Button -->
                    <div>
                        <button type="submit"
                            class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                            Sign Up
                        </button>
                    </div>
                </div>
            </form>
            <div class="mt-5">
                <p class="text-sm font-normal text-center text-gray-700 dark:text-gray-400 sm:text-start">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-brand-500 hover:text-brand-600 dark:text-brand-400">Sign
                        In</a>
                </p>
            </div>
        </div>
    </div>
</x-auth-layout>
