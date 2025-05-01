@props(['label', 'menuKey', 'icon', 'activePaths' => []])

@php
    // Cek apakah salah satu submenu aktif
    $isActive = false;
    foreach ($activePaths as $path) {
        if (request()->is($path)) {
            $isActive = true;
            break;
        }
    }
@endphp

<li x-data="{ open: {{ $isActive ? 'true' : 'false' }} }">
    <!-- Parent Link -->
    <a href="#" @click.prevent="open = !open" class="menu-item group {{ $isActive ? 'menu-item-active' : 'menu-item-inactive' }}"
       :class="open ? 'menu-item-active' : 'menu-item-inactive'">

        <!-- Icon -->
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" :class="open ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
            {!! $icon !!}
        </svg>

        <!-- Label -->
        <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">{{ $label }}</span>

        <!-- Arrow -->
        <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"  :class="sidebarToggle ? 'lg:hidden' : ''"
             :class="open ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive'" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </a>

    <!-- Dropdown Menu -->
    <div class="overflow-hidden transform translate"
         :class="open ? 'block' : 'hidden'">
        <ul class="flex flex-col gap-1 mt-2 menu-dropdown pl-9" :class="sidebarToggle ? 'lg:hidden' : ''">
            {{ $slot }}
        </ul>
    </div>
</li>
