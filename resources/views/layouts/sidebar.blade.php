<div class="main-menu menu-static menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @php
                $item = [
                    'text' => 'Province',
                    'url'  => 'province.index',
                    'icon' => 'icon-globe',
                ];
                $menu = new MenuItem($item['text'], $item['url'], $item['icon']);
                $menu->isRoute();
            @endphp
            @include('layouts.sidebar-item', ['data' => $menu])

            @php
                $item = [
                    'text' => 'City',
                    'url'  => 'city.index',
                    'icon' => 'icon-layers',
                ];
                $menu = new MenuItem($item['text'], $item['url'], $item['icon']);
                $menu->isRoute();
            @endphp
            @include('layouts.sidebar-item', ['data' => $menu])

            @php
                $item = [
                    'text' => 'Kelurahan',
                    'url'  => 'kelurahan.index',
                    'icon' => 'icon-home',
                ];
                $menu = new MenuItem($item['text'], $item['url'], $item['icon']);
                $menu->isRoute();
            @endphp
            @include('layouts.sidebar-item', ['data' => $menu])

            @php
                $item = [
                    'text' => 'Kecamatan',
                    'url'  => 'kecamatan.index',
                    'icon' => 'icon-target',
                ];
                $menu = new MenuItem($item['text'], $item['url'], $item['icon']);
                $menu->isRoute();
            @endphp
            
            @include('layouts.sidebar-item', ['data' => $menu])
        </ul>
    </div>
</div>