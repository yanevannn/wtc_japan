<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Home
    </title>
    <link rel="icon" href="favicon.ico">
    @vite(['resources/css/app.css'])

</head>

<body x-data="{ page: 'page404', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode === true }">
    <!-- ===== Preloader Start ===== -->
    <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 500) })"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black"
        style="display: none;">
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent">
        </div>
    </div>

    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="relative z-1 flex min-h-screen flex-col items-center justify-center overflow-hidden p-6">
        <!-- ===== Common Grid Shape Start ===== -->
        <div class="absolute right-0 top-0 -z-1 w-full max-w-[250px] xl:max-w-[450px]">
            <img src="src/images/shape/grid-01.svg" alt="grid">
        </div>
        <div class="absolute bottom-0 left-0 -z-1 w-full max-w-[250px] rotate-180 xl:max-w-[450px]">
            <img src="src/images/shape/grid-01.svg" alt="grid">
        </div>

        <!-- ===== Common Grid Shape End ===== -->

        <!-- Centered Content -->
        <div class="mx-auto w-full max-w-[242px] text-center sm:max-w-[472px]">
            <h1 class="mb-8 text-title-md font-bold text-gray-800 dark:text-white/90 xl:text-title-2xl">
                ERROR
            </h1>

            <img src="src/images/error/404.svg" alt="404" class="dark:hidden">
            <img src="src/images/error/404-dark.svg" alt="404" class="hidden dark:block">

            <p class="mb-6 mt-10 text-base text-gray-700 dark:text-gray-400 sm:text-lg">
                We can’t seem to find the page you are looking for!
            </p>

            <a href="{{ route('login') }}"
                class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                Back to Home Page
            </a>
        </div>
        <!-- Footer -->
        <p class="absolute bottom-6 left-1/2 -translate-x-1/2 text-center text-sm text-gray-500 dark:text-gray-400">
            © <span id="year">2025</span> - TailAdmin
        </p>
    </div>

    <!-- ===== Page Wrapper End ===== -->
    <script defer="" src="bundle.js"></script>

    <svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1"
        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
        style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
        <defs id="SvgjsDefs1002"></defs>
        <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
        <path id="SvgjsPath1004" d="M0 0 "></path>
    </svg>
</body>

</html>
