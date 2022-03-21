@if ($data->countChildren())
    <li class="nav-item">
        <a href="#!">
            <i class="{{ $data->getIcon() }}"></i>
            <span class="menu-title">{{ $data->getText() }}</span>
            {!! $data->generateBadge('badge badge badge-info badge-pill') !!}

        </a>
        <ul class="menu-content">
            @foreach ($data->getChildren() as $r)
            <li class="{{ $r->checkActive() ? 'active' : ''  }}">
                <a class="menu-item" href="{{ $r->getUrl() }}">{{ $r->getText() }}</a>
            </li>
            @endforeach
        </ul>
    </li>
@else
    <li class="nav-item {{ $data->checkActive() ? 'active' : '' }}">
        <a href="{{ $data->getUrl() }}">
            <i class="{{ $data->getIcon() }}"></i>
            <span class="menu-title">{{ $data->getText() }}</span>
        </a>
    </li>
@endif