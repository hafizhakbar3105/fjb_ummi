
@props(['category'])

@php
    $name = $category['name'] ?? 'Kategori';
    $icon = $category['icon'] ?? '🛍️';
@endphp

<a
    href="{{ route('home', ['q' => $name]) }}#produk"
    class="category-card"
>
    <div class="category-icon">
        <span>{{ $icon }}</span>
    </div>

    <span class="category-name">
        {{ $name }}
    </span>
</a>
