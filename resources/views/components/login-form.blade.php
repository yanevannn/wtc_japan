<div class="max-w-md w-full p-6">
    <h1 class="text-3xl font-semibold mb-6 text-black text-center">Sign In</h1>
    <h1 class="text-sm font-semibold mb-6 text-gray-500 text-center">
        Selamat datang kembali! Silahkan masuk ke akun Anda.
    </h1>
    <form action="{{ route('dologin') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-sm font-bold text-gray-700">Email</label>
            <input type="text" id="email" name="email" class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300" placeholder="Masukkan email" required>
        </div>
        <div class="flex items-center justify-between mb-2">
            <label for="password" class="mb-0 text-sm font-bold text-gray-700">Password</label>
            <a class="text-blue-600 hover:underline hover:text-blue-700 font-base text-sm" href="">Kendala Masuk ke Akun?</a>
        </div>
        <div class="relative">
            <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300" placeholder="Masukkan password" required>
        </div>
        @if($errors->any())
        <div class="text-red-500 text-sm">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="!mt-6">
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">Login</button>
        </div>
    </form>
    <div class="mt-10 text-sm text-gray-600 text-center">
        <p>Belum memiliki Akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline hover:text-blue-700 font-semibold">Daftar Sekarang</a></p>
    </div>
</div>