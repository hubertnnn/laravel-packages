@if (is_array($item))
    <li class="{{ $level == 0 ? 'dropdown-submenu-down' : 'dropdown-submenu' }}">
        <a href="#">
            {{$key}}
            @if($level == 0)
                <span class="caret"></span>
            @endif
        </a>
        <ul class="dropdown-menu">
            @foreach ($item as $k => $subitem)
                {!! view("larapanel::panel.menu-item", array(
                        'item' => $subitem,
                        'key' => $k,
                        'admin' => $admin,
                        'level' => $level + 1,
                )) !!}
            @endforeach
        </ul>
    </li>
@else
    <li>
        <a href="{{ route('larapanel.admin.page', ['key' => $key]) }}">{{$item}}</a>
    </li>
@endif
