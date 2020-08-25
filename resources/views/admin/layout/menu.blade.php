<ul>
    @foreach (config('navigation') as $menu)
        <li class="menu-item @if($_leftmenu[0] === $menu['id']) active @endif">
            <span class="menu-collapse position-relative">
                @if($menu['route'] === '')
                    <span class="icon text-icon {{ $menu['icon'] }}"></span>
                    <span class="text-label ml-1">{{ $menu['name'] }}</span>
                @else
                    <a href="{{ $menu['route'] }}"><span class="icon text-icon {{ $menu['icon'] }}"></span></a>
                    <a href="{{ $menu['route'] }}" class="text-label ml-1">{{ $menu['name'] }}</a> 
                @endif
            </span>
            @if(count($menu['child']) > 0 && $menu['route'] === '')
                <div class="menu-subitem collapse @if($_leftmenu[0] === $menu['id']) show @endif">
                    <ul>
                        @foreach ($menu['child'] as $submenu)
                            <li>
                                <a href="{{ $submenu['route'] }}" class="@if($_leftmenu[0] === $menu['id'] && $_leftmenu[1] === $submenu['id']) active @endif">{{ $submenu['name'] }}</a>
                            </li>
                        @endforeach 
                    </ul>
                </div>
            @endif
        </li>
    @endforeach
</ul>
