<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        @php
            $menus = maticpressMenu();
        @endphp

        @forelse ($menus as $menu)
            @php
                $active = in_array(Route::currentRouteName(), @$menu['routes'] ?? []) ? 'active' : '';
            @endphp
            <li class="sidebar-item {{isset($menu['submenus']) ? 'has-sub' : ''}} {{$active}}">
                <a href="{{$menu['url']}}" class='sidebar-link' {{(isset($menu['submenus']) || $active) ? '' : 'wire:navigate'}}>
                    <i class="{{$menu['icon']}}"></i>
                    <span>{{$menu['title']}}</span>
                </a>

                @if( isset($menu['submenus']) )
                    <ul class="submenu {{$active ? 'submenu-open' : ''}}">
                        @forelse($menu['submenus'] as $submenu)
                        @php
                            $active_sub = in_array(Route::currentRouteName(), @$submenu['routes'] ?? []) ? 'active' : '';
                        @endphp
                        <li class="submenu-item {{$active_sub}}">
                            <a href="{{$submenu['url']}}" class="submenu-link" wire:navigate>{{$submenu['title']}}</a>
                        </li>
                        @empty
                        @endforelse
                    </ul>
                @endif

            </li>
        @empty
            
        @endforelse

    </ul>
</div>