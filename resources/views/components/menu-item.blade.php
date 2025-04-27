@props(['href', 'label', 'icon', 'activePath' => ''])

<li>
    <a href="{{ $href }}" 
       class="menu-item group {{ Request::is($activePath) ? 'menu-item-active' : 'menu-item-inactive' }}">
        
        <!-- Memuat file SVG -->
        {!! $icon !!} 

        <!-- Menu Label -->
        <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
            {!! $label !!}
        </span>
    </a>
</li>
