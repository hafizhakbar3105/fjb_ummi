
@props(['product'])

@php
    $id = $product['id'] ?? 0;
    $name = $product['name'] ?? 'Produk FJB UMMI';
    $category = $product['category'] ?? 'Lainnya';
    $image = $product['image'] ?? '';
    $price = (int) ($product['price'] ?? 0);

    $oldPrice = (int) (
        $product['old_price']
        ?? $product['old']
        ?? 0
    );

    $discount = $oldPrice > $price && $oldPrice > 0
        ? round((($oldPrice - $price) / $oldPrice) * 100)
        : 0;
@endphp

<article class="fjb-product-card">

    <!-- GAMBAR PRODUK -->
    <div class="fjb-product-image">

        <!-- LINK MENUJU DETAIL PRODUK -->
        <a
            href="{{ route('product.detail', ['id' => $id]) }}"
            aria-label="Lihat detail {{ $name }}"
            style="display:block;width:100%;height:100%;"
        >
            <img
                src="{{ $image }}"
                alt="{{ $name }}"
                loading="lazy"
            >
        </a>

        <!-- LABEL DISKON -->
        @if($discount > 0)
            <span class="fjb-discount">
                -{{ $discount }}%
            </span>
        @endif

        <!-- TOMBOL FAVORIT -->
        <button
            type="button"
            class="fjb-favorite"
            aria-label="Favorit {{ $name }}"
            aria-pressed="false"
        >
            ♡
        </button>

    </div>


    <!-- INFORMASI PRODUK -->
    <div class="fjb-product-content">

        <!-- KATEGORI -->
        <span class="fjb-product-category">
            {{ $category }}
        </span>

        <!-- NAMA PRODUK -->
        <h3 class="fjb-product-title">

            <a href="{{ route('product.detail', ['id' => $id]) }}">
                {{ $name }}
            </a>

        </h3>

        <!-- LOKASI -->
        <p class="fjb-product-location">
            📍 Sukabumi
        </p>

        <!-- HARGA PRODUK -->
        <div class="fjb-product-price">

            <strong>
                Rp{{ number_format($price, 0, ',', '.') }}
            </strong>

            @if($discount > 0)
                <del>
                    Rp{{ number_format($oldPrice, 0, ',', '.') }}
                </del>
            @endif

        </div>

        <!-- TOMBOL KERANJANG -->
        <button
            type="button"
            class="fjb-add-cart"
            data-id="{{ $id }}"
            data-name="{{ $name }}"
        >
            🛒 Tambah ke Keranjang
        </button>

    </div>

</article>
