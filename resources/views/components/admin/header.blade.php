<div class="page-header">
    <h3 class="page-title">
        <a href="{{ route('users.index') }}" class="nav-link">
           Home
        </a>
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">
                <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
            </li>

            @foreach ($breadcrumbs as $item)
                <li class="breadcrumb-item nav-link {{ $loop->last ? 'active' : '' }}" aria-current="page"><a
                        href="{{ $item['route'] }}">{{ $item['name'] }}</a></li>
            @endforeach
        </ul>
    </nav>
</div>
