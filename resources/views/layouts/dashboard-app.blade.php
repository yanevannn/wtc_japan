<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css') {{-- Sesuaikan dengan setup Tailwind atau CSS-mu --}}
</head>

<body class="bg-gray-200">
    {{-- Navbar --}}
    @include('components.dashboard.navbar-dashboard')

    <div class="flex overflow-hidden bg-white pt-16">
        {{-- Sidebar --}}
        @include('components.dashboard.aside-dashboard')

        {{-- Backdrop untuk sidebar --}}
        <div class="bg-gray-900 opacity-50 fixed inset-0 z-10 hidden" id="sidebarBackdrop"></div>

        {{-- Main Content --}}
        <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
            <main class="pt-6 px-4">
                @yield('content')
            </main>
            <p class="text-center text-sm text-gray-500 my-10">
                © 2028-2025 <a href="#" class="hover:underline" target="_blank">WTC2 Japan</a>. All rights reserved.
            </p>
        </div>
    </div>

    {{-- JavaScript untuk interaksi UI --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebar");
            const sidebarBackdrop = document.getElementById("sidebarBackdrop");
            const toggleOpen = document.getElementById("toggleSidebarMobileHamburger");
            const toggleClose = document.getElementById("toggleSidebarMobileClose");

            function openSidebar() {
                sidebar.classList.remove("hidden");
                sidebarBackdrop.classList.remove("hidden");
                toggleOpen.classList.add("hidden");
                toggleClose.classList.remove("hidden");
            }

            function closeSidebar() {
                sidebar.classList.add("hidden");
                sidebarBackdrop.classList.add("hidden");
                toggleOpen.classList.remove("hidden");
                toggleClose.classList.add("hidden");
            }

            toggleOpen.addEventListener("click", openSidebar);
            toggleClose.addEventListener("click", closeSidebar);
            sidebarBackdrop.addEventListener("click", closeSidebar);
        });

        document.addEventListener("DOMContentLoaded", function () {
            const profileButton = document.getElementById("profileButton");
            const profileDropdown = document.getElementById("profileDropdown");

            profileButton.addEventListener("click", function () {
                profileDropdown.classList.toggle("hidden");
            });

            document.addEventListener("click", function (event) {
                if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                    profileDropdown.classList.add("hidden");
                }
            });
        });
    </script>
</body>

</html>
