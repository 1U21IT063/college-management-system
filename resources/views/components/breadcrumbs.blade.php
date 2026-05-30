<!-- Breadcrumbs Component -->
<!-- Usage: {{ Breadcrumbs::render('page-name') }} -->

@if (count($breadcrumbs) > 0)
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb->url }}" class="text-decoration-none">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item @if ($loop->last) active @endif" @if ($loop->last) aria-current="page" @endif>
                        {{ $breadcrumb->title }}
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
