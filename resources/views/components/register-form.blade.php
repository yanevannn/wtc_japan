<div class="max-w-md w-full p-6" id="registerForm">
    <h1 class="text-3xl font-semibold mb-6 text-black text-center">Pendaftaran Akun</h1>
    <h2 class="text-sm text-gray-500">Sudah memiliki akun ? <a href="{{ route('login') }}"
            class="text-blue-600 hover:underline hover:text-blue-700 font-bold">Masuk</a></h2>

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700">Nama Lengkap</label>
                <input type="text" id="name" name="name"
                    class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300"
                    placeholder="Masukkan Nama Lengkap" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-bold text-gray-700">Email</label>
                <input type="email" id="email" name="email"
                    class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300"
                    placeholder="Masukkan email" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300"
                    placeholder="Masukkan password">
                <p class="text-sm mt-2 text-gray-700">Password harus memenuhi kriteria berikut : </p>
                <ul class="mt-2 text-xs text-gray-500">
                    <li id="length" class="flex items-center text-gray-500">
                        <svg class="inline-block w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Minimal 8 karakter
                    </li>
                    <li id="uppercase" class="flex items-center text-gray-500">
                        <svg class="inline-block w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Huruf besar (A-Z)
                    </li>
                    <li id="lowercase" class="flex items-center text-gray-500">
                        <svg class="inline-block w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Huruf kecil (a-z)
                    </li>
                    <li id="number" class="flex items-center text-gray-500">
                        <svg class="inline-block w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Angka (1 sampai 9)
                    </li>
                    <li id="special" class="flex items-center text-gray-500">
                        <svg class="inline-block w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Karakter spesial (!@#$%^&*(),.?":{}|<>)
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <button type="submit" id="registerButton"
                class="mt-5 w-full bg-gray-400 text-white p-2 rounded-md focus:outline-none transition-colors duration-300"
                disabled>Daftar Sekarang</button>
        </div>
    </form>
    <p class="text-gray-500 text-sm text-justify mt-4"> Dengan melakukan pendaftaran, saya setuju dengan
        <a href="" class="text-blue-600 hover:underline hover:text-blue-700 font-semibold">Kebijakan Privasi dan
            Syarat & Ketentuan</a> WTC 2 Japan.
    </p>
</div>


<script>
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const length = document.getElementById('length');
        const uppercase = document.getElementById('uppercase');
        const lowercase = document.getElementById('lowercase');
        const number = document.getElementById('number');
        const special = document.getElementById('special');

        // Check length
        if (password.length >= 8) {
            length.classList.remove('text-gray-500');
            length.classList.add('text-green-500');
            length.querySelector('svg').classList.add('text-green-500');
        } else {
            length.classList.remove('text-green-500');
            length.classList.add('text-gray-500');
            length.querySelector('svg').classList.remove('text-green-500');
        }

        // Check uppercase
        if (/[A-Z]/.test(password)) {
            uppercase.classList.remove('text-gray-500');
            uppercase.classList.add('text-green-500');
            uppercase.querySelector('svg').classList.add('text-green-500');
        } else {
            uppercase.classList.remove('text-green-500');
            uppercase.classList.add('text-gray-500');
            uppercase.querySelector('svg').classList.remove('text-green-500');
        }

        // Check lowercase
        if (/[a-z]/.test(password)) {
            lowercase.classList.remove('text-gray-500');
            lowercase.classList.add('text-green-500');
            lowercase.querySelector('svg').classList.add('text-green-500');
        } else {
            lowercase.classList.remove('text-green-500');
            lowercase.classList.add('text-gray-500');
            lowercase.querySelector('svg').classList.remove('text-green-500');
        }

        // Check number
        if (/\d/.test(password)) {
            number.classList.remove('text-gray-500');
            number.classList.add('text-green-500');
            number.querySelector('svg').classList.add('text-green-500');
        } else {
            number.classList.remove('text-green-500');
            number.classList.add('text-gray-500');
            number.querySelector('svg').classList.remove('text-green-500');
        }

        // Check special character
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            special.classList.remove('text-gray-500');
            special.classList.add('text-green-500');
            special.querySelector('svg').classList.add('text-green-500');
        } else {
            special.classList.remove('text-green-500');
            special.classList.add('text-gray-500');
            special.querySelector('svg').classList.remove('text-green-500');
        }
    });

    // Fungsi untuk mengecek apakah semua kriteria password sudah terpenuhi
    function isPasswordValid(password) {
        return (
            password.length >= 8 &&
            /[A-Z]/.test(password) &&
            /[a-z]/.test(password) &&
            /\d/.test(password) &&
            /[!@#$%^&*(),.?":{}|<>]/.test(password)
        );
    }

    // Fungsi untuk mengecek apakah semua input sudah terisi
    function checkFormValidity() {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const registerButton = document.getElementById('registerButton');

        if (name !== '' && email !== '' && isPasswordValid(password)) {
            registerButton.disabled = false;
            registerButton.classList.remove('bg-gray-400');
            registerButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
        } else {
            registerButton.disabled = true;
            registerButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
            registerButton.classList.add('bg-gray-400');
        }
    }

    // Event listener untuk memantau perubahan pada input
    document.getElementById('email').addEventListener('input', checkFormValidity);
    document.getElementById('password').addEventListener('input', function() {
        checkFormValidity();
    });
</script>
