<x-auth-layout>
    <x-slot:title>Forgot Password | WTC</x-slot:title>
    <x-slot:image>{{ asset('src/images/auth/login.png') }}</x-slot:image>
    <div class="flex flex-col justify-center flex-1 w-full max-w-md mx-auto">
        <div>
            <div class="mb-5 sm:mb-8">
                <h1 class="mb-2 font-semibold text-gray-800 text-title-sm dark:text-white/90 sm:text-title-md">
                    Forgot Password ?
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Enter your email to reset your Password!
                </p>
            </div>
            <div>

                <form action="{{ route('doForgotPassword') }}" method="POST">
                    @csrf
                    <div class="space-y-5">
                        @if (session('error'))
                            <x-alert type="error" :message="session('error')" />
                        @elseif (session('warning'))
                            <x-alert type="warning" :message="session('warning')" />
                        @elseif (session('success'))
                            <x-alert type="success" :message="session('success')" />
                        @elseif(session('info'))
                            <x-alert type="info" :message="session('info')" />  
                        @endif
                        <!-- Email -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Email <span class="text-error-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" placeholder="info@gmail.com" value="{{ old('email') }}" required
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                        </div>
                        <div>
                            <button type="submit"
                                class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                                Confirm
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
