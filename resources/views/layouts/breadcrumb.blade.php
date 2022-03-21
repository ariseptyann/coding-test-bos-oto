<ol class="breadcrumb">
    <li class="breadcrumb-item">
        @if (Route::is('province.index'))
            Home
        @else
            <a href="{{ route('province.index') }}">Home</a>
        @endif
    </li>
  
    @isset($breadcrumbs)
        @foreach ($breadcrumbs as $r)
            @if (!is_null($r[1]))
                <li class="breadcrumb-item">
                    <a href="{{ $r[1] }}">{{ $r[0] }}</a>
                </li>
            @else
                <li class="breadcrumb-item">{{ $r[0] }}</li>
            @endif
        @endforeach      
    @endisset
</ol>