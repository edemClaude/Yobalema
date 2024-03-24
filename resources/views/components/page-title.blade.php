@php
    $title = $title ?? '';
    if (isset($breadcrumbs))
    {
        $url ??= '#';
        $label ??= ucfirst($title);
    }
@endphp

<div class="pagetitle">
    <h1>@yield('title')</h1>
    <nav>
        <ol class="breadcrumb">
            @isset($breadcrumbs)
                @foreach($breadcrumbs as $breadcrumb)
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb['url'] ?? '#' }}">
                            {{ $breadcrumb['label'] }}
                        </a>
                    </li>
                @endforeach
            @endisset
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    </nav>
</div>
