
@extends('layouts.app')

@section('title', 'Detail Produk - FJB UMMI')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA PRODUK DEMO
    |--------------------------------------------------------------------------
    | Sementara mengikuti produk yang ada pada katalog.
    | Nantinya seluruh data akan diambil dari MySQL.
    */

    $products = [
        [
            'id' => 1,
            'name' => 'Headphone Wireless Premium',
            'category' => 'Elektronik',
            'price' => 175000,
            'old_price' => 220000,
            'stock' => 12,
            'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=900&auto=format&fit=crop',
            'description' => 'Headphone wireless dengan desain modern dan nyaman digunakan. Cocok untuk mendengarkan musik, mengikuti perkuliahan daring, dan menemani aktivitas sehari-hari.',
        ],
        [
            'id' => 2,
            'name' => 'Hoodie Casual Mahasiswa',
            'category' => 'Fashion',
            'price' => 135000,
            'old_price' => 180000,
            'stock' => 18,
            'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=900&auto=format&fit=crop',
            'description' => 'Hoodie casual dengan desain sederhana dan gaya modern. Cocok untuk aktivitas kampus, kegiatan santai, dan penggunaan sehari-hari.',
        ],
        [
            'id' => 3,
            'name' => 'Buku Bacaan dan Referensi',
            'category' => 'Buku',
            'price' => 45000,
            'old_price' => 60000,
            'stock' => 9,
            'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=900&auto=format&fit=crop',
            'description' => 'Buku bacaan untuk menemani waktu luang dan menambah wawasan. Detail judul, penulis, dan kondisi buku akan disesuaikan dengan data penjual.',
        ],
        [
            'id' => 4,
            'name' => 'Tumbler Minimalis',
            'category' => 'Perlengkapan',
            'price' => 55000,
            'old_price' => 79000,
            'stock' => 20,
            'image' => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=900&auto=format&fit=crop',
            'description' => 'Botol minum dengan desain minimalis yang praktis dibawa ke kampus, kelas, maupun kegiatan sehari-hari.',
        ],
        [
            'id' => 5,
            'name' => 'Keyboard Mechanical RGB',
            'category' => 'Elektronik',
            'price' => 250000,
            'old_price' => 310000,
            'stock' => 7,
            'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=900&auto=format&fit=crop',
            'description' => 'Keyboard mechanical dengan desain modern untuk menunjang kegiatan mengetik, pemrograman, dan penggunaan komputer.',
        ],
        [
            'id' => 6,
            'name' => 'Tas Fashion Wanita',
            'category' => 'Fashion',
            'price' => 89000,
            'old_price' => 120000,
            'stock' => 14,
            'image' => 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=900&auto=format&fit=crop',
            'description' => 'Tas dengan desain elegan dan praktis untuk melengkapi penampilan sehari-hari, baik saat kuliah maupun bepergian.',
        ],
        [
            'id' => 7,
            'name' => 'Cookies Cokelat Homemade',
            'category' => 'Makanan',
            'price' => 25000,
            'old_price' => 30000,
            'stock' => 25,
            'image' => 'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?w=900&auto=format&fit=crop',
            'description' => 'Cookies cokelat homemade yang cocok sebagai camilan saat belajar, mengerjakan tugas, atau berkumpul bersama teman.',
        ],
        [
            'id' => 8,
            'name' => 'Notebook Catatan Kuliah',
            'category' => 'Buku',
            'price' => 28000,
            'old_price' => 35000,
            'stock' => 30,
            'image' => 'https://images.unsplash.com/photo-1531346878377-a5be20888e57?w=900&auto=format&fit=crop',
            'description' => 'Buku catatan dengan desain sederhana untuk mencatat materi kuliah, membuat rangkuman, dan menyusun agenda belajar.',
        ],
    ];

    // Mencari produk berdasarkan ID pada URL
    $product = collect($products)->firstWhere('id', (int) $productId);

    // Jika produk tidak ditemukan, tampilkan halaman 404
    if (!$product) {
        abort(404, 'Produk tidak ditemukan.');
    }

    // Perhitungan diskon
    $discount = $product['old_price'] > $product['price']
        ? round(
            (($product['old_price'] - $product['price'])
            / $product['old_price']) * 100
        )
        : 0;

    // Rekomendasi produk
    $relatedProducts = array_values(array_filter(
        $products,
        fn($item) => $item['id'] !== $product['id']
    ));

    usort($relatedProducts, function ($a, $b) use ($product) {
        $aSame = $a['category'] === $product['category'] ? 1 : 0;
        $bSame = $b['category'] === $product['category'] ? 1 : 0;

        return $bSame <=> $aSame;
    });

    $relatedProducts = array_slice($relatedProducts, 0, 4);
@endphp

@push('styles')
<style>
    /* ===============================
       PRODUCT DETAIL FJB UMMI
    =============================== */

    .pd-page {
        padding-bottom: 45px;
    }

    .pd-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        padding: 28px 0;
        font-size: 12px;
        color: #8395A3;
    }

    .pd-breadcrumb a {
        color: #327DAF;
        transition: color .25s;
    }

    .pd-breadcrumb a:hover {
        color: #102F4B;
    }

    .pd-main {
        display: grid;
        grid-template-columns:
            minmax(0, 1fr) minmax(0, 1.05fr);
        gap: 38px;
        background: white;
        border: 1px solid #E8EDF1;
        border-radius: 22px;
        padding: 32px;
    }

    /* GAMBAR PRODUK */

    .pd-gallery {
        min-width: 0;
    }

    .pd-image {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
        background: #F0F5F8;
        aspect-ratio: 1 / 1;
    }

    .pd-image img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .6s ease;
    }

    .pd-image:hover img {
        transform: scale(1.04);
    }

    .pd-image-label {
        position: absolute;
        top: 18px;
        left: 18px;
        padding: 9px 14px;
        background: rgba(255,255,255,.95);
        color: #102F4B;
        border-radius: 7px;
        font-size: 11px;
        font-weight: 700;
    }

    .pd-image-note {
        margin-top: 15px;
        text-align: center;
        font-size: 11px;
        color: #8A99A6;
    }

    /* INFORMASI PRODUK */

    .pd-summary {
        min-width: 0;
        padding: 7px 0;
    }

    .pd-category {
        display: inline-block;
        background: #EAF3F8;
        color: #327DAF;
        border-radius: 30px;
        padding: 9px 15px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .6px;
    }

    .pd-title {
        color: #102F4B;
        font-size: clamp(24px, 2.8vw, 35px);
        line-height: 1.35;
        margin-top: 18px;
        letter-spacing: -.7px;
    }

    .pd-subtitle {
        margin-top: 13px;
        color: #8193A1;
        font-size: 12px;
        line-height: 1.8;
    }

    .pd-price-box {
        background: #F3F8FB;
        border: 1px solid #E5EFF5;
        padding: 23px 25px;
        border-radius: 14px;
        margin-top: 24px;
    }

    .pd-price {
        color: #102F4B;
        font-size: clamp(25px,3vw,34px);
        font-weight: 800;
        letter-spacing: -.7px;
    }

    .pd-price-bottom {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 13px;
        margin-top: 8px;
    }

    .pd-old-price {
        color: #99A7B3;
        font-size: 13px;
        text-decoration: line-through;
    }

    .pd-discount {
        color: #C65262;
        background: #FFF0F2;
        border-radius: 5px;
        padding: 6px 9px;
        font-size: 11px;
        font-weight: 700;
    }

    .pd-details {
        margin-top: 26px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .pd-detail-row {
        display: grid;
        grid-template-columns: 115px 1fr;
        align-items: start;
        gap: 15px;
        font-size: 13px;
    }

    .pd-detail-row span {
        color: #8193A1;
    }

    .pd-detail-row strong {
        color: #31485B;
        font-weight: 600;
    }

    .pd-stock {
        color: #277C69 !important;
    }

    /* JUMLAH */

    .pd-quantity {
        display: flex;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
        margin-top: 27px;
    }

    .pd-quantity-label {
        color: #8193A1;
        font-size: 13px;
        min-width: 95px;
    }

    .pd-quantity-control {
        display: flex;
        align-items: center;
        overflow: hidden;
        border: 1px solid #E2EAF0;
        border-radius: 10px;
        height: 45px;
    }

    .pd-quantity-control button {
        height: 100%;
        width: 43px;
        border: 0;
        background: #F6F9FB;
        color: #102F4B;
        font-size: 20px;
        transition: background .25s;
    }

    .pd-quantity-control button:hover {
        background: #EAF3F8;
    }

    .pd-quantity-control input {
        width: 52px;
        height: 100%;
        text-align: center;
        border: 0;
        border-left: 1px solid #E2EAF0;
        border-right: 1px solid #E2EAF0;
        outline: none;
        font-size: 14px;
        font-weight: 700;
        color: #102F4B;
        appearance: textfield;
    }

    .pd-quantity-control input::-webkit-inner-spin-button,
    .pd-quantity-control input::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .pd-quantity-hint {
        font-size: 11px;
        color: #98A8B3;
    }

    /* TOMBOL AKSI */

    .pd-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 27px;
    }

    .pd-btn {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        border-radius: 10px;
        padding: 16px 12px;
        font-size: 12px;
        font-weight: 700;
        transition: .3s ease;
    }

    .pd-btn-cart {
        background: #102F4B;
        color: white;
        border: 1px solid #102F4B;
    }

    .pd-btn-cart:hover {
        background: #327DAF;
        border-color: #327DAF;
    }

    .pd-btn-buy {
        background: white;
        color: #102F4B;
        border: 1px solid #BDD3E2;
    }

    .pd-btn-buy:hover {
        background: #EAF3F8;
    }

    .pd-extra-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
        margin-top: 21px;
        align-items: center;
    }

    .pd-extra-actions button,
    .pd-extra-actions a {
        background: none;
        border: none;
        font-size: 12px;
        color: #50758F;
        font-weight: 600;
    }

    .pd-extra-actions button:hover,
    .pd-extra-actions a:hover {
        color: #102F4B;
    }

    .pd-favorite.active {
        color: #D45D6F;
    }

    /* TOKO */

    .pd-seller {
        margin-top: 24px;
        border: 1px solid #E8EDF1;
        border-radius: 15px;
        background: white;
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 17px;
    }

    .pd-seller-avatar {
        width: 55px;
        height: 55px;
        border-radius: 14px;
        background: #EAF3F8;
        color: #102F4B;
        display: grid;
        place-items: center;
        font-size: 24px;
        flex-shrink: 0;
    }

    .pd-seller-info {
        flex: 1;
    }

    .pd-seller-info h3 {
        font-size: 15px;
        color: #102F4B;
    }

    .pd-seller-info p {
        color: #8193A1;
        font-size: 12px;
        margin-top: 7px;
    }

    .pd-seller-badge {
        font-size: 10px;
        background: #F0F6FA;
        color: #327DAF;
        border-radius: 20px;
        padding: 9px 13px;
        font-weight: 700;
    }

    /* DESKRIPSI */

    .pd-info-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 22px;
        margin-top: 28px;
    }

    .pd-panel {
        padding: 31px;
        background: white;
        border: 1px solid #E8EDF1;
        border-radius: 16px;
    }

    .pd-panel h2 {
        font-size: 19px;
        color: #102F4B;
        margin-bottom: 19px;
    }

    .pd-panel p {
        color: #718494;
        font-size: 13px;
        line-height: 2;
    }

    .pd-specifications {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .pd-specifications div {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        font-size: 12px;
    }

    .pd-specifications span {
        color: #8294A1;
    }

    .pd-specifications strong {
        color: #102F4B;
        text-align: right;
        font-weight: 600;
    }

    /* PRODUK TERKAIT */

    .pd-related {
        margin-top: 65px;
    }

    .pd-related-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 25px;
    }

    .pd-related-heading h2 {
        font-size: 25px;
        color: #102F4B;
    }

    .pd-related-heading p {
        font-size: 12px;
        color: #8294A1;
        margin-top: 8px;
    }

    .pd-related-heading a {
        color: #327DAF;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .pd-related-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0,1fr));
        gap: 18px;
    }

    /* NOTIFIKASI */

    .pd-toast {
        position: fixed;
        bottom: 25px;
        right: 25px;
        background: #102F4B;
        color: white;
        padding: 16px 22px;
        border-radius: 11px;
        font-size: 12px;
        z-index: 300;
        max-width: calc(100vw - 40px);
        opacity: 0;
        visibility: hidden;
        transform: translateY(15px);
        transition: .3s ease;
        box-shadow: 0 12px 35px rgba(16,47,75,.2);
    }

    .pd-toast.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    /* RESPONSIVE */

    @@media (max-width: 1000px) {
        .pd-main {
            gap: 25px;
            padding: 24px;
        }

        .pd-related-grid {
            grid-template-columns: repeat(2, minmax(0,1fr));
        }
    }

    @@media (max-width: 760px) {
        .pd-main {
            grid-template-columns: 1fr;
        }

        .pd-info-grid {
            grid-template-columns: 1fr;
        }

        .pd-title {
            font-size: 27px;
        }
    }

    @@media (max-width: 600px) {
        .pd-breadcrumb {
            padding: 20px 0;
            font-size: 11px;
        }

        .pd-main {
            padding: 15px;
            gap: 25px;
            border-radius: 16px;
        }

        .pd-title {
            font-size: 24px;
        }

        .pd-price-box {
            padding: 19px;
        }

        .pd-price {
            font-size: 27px;
        }

        .pd-detail-row {
            grid-template-columns: 95px 1fr;
            font-size: 12px;
        }

        .pd-actions {
            grid-template-columns: 1fr;
        }

        .pd-seller {
            padding: 17px;
            flex-wrap: wrap;
        }

        .pd-panel {
            padding: 23px;
        }

        .pd-related-grid {
            gap: 12px;
        }

        .pd-related-heading h2 {
            font-size: 20px;
        }
    }

    @@media (prefers-reduced-motion: reduce) {
        .pd-image img,
        .pd-btn,
        .pd-toast {
            transition: none;
        }
    }
</style>
@endpush

@section('content')

<div class="pd-page">

    <div class="container">

        <!-- BREADCRUMB -->
        <nav class="pd-breadcrumb" aria-label="Breadcrumb">

            <a href="{{ route('home') }}">
                Beranda
            </a>

            <span>›</span>

            <a href="{{ route('products') }}">
                Katalog Produk
            </a>

            <span>›</span>

            <span>{{ $product['name'] }}</span>

        </nav>


        <!-- DETAIL PRODUK UTAMA -->
        <section class="pd-main">

            <!-- FOTO PRODUK -->
            <div class="pd-gallery">

                <div class="pd-image">

                    <img
                        src="{{ $product['image'] }}"
                        alt="{{ $product['name'] }}"
                    >

                    <span class="pd-image-label">
                        PRODUK DEMO
                    </span>

                </div>

                <p class="pd-image-note">
                    Foto ilustrasi produk untuk pengembangan FJB UMMI
                </p>

            </div>


            <!-- INFORMASI PRODUK -->
            <div class="pd-summary">

                <span class="pd-category">
                    {{ strtoupper($product['category']) }}
                </span>

                <h1 class="pd-title">
                    {{ $product['name'] }}
                </h1>

                <p class="pd-subtitle">
                    Jelajahi informasi produk sebelum melakukan
                    pembelian melalui marketplace FJB UMMI.
                </p>


                <!-- HARGA -->
                <div class="pd-price-box">

                    <div class="pd-price">
                        Rp{{ number_format($product['price'], 0, ',', '.') }}
                    </div>

                    <div class="pd-price-bottom">

                        @if($discount > 0)

                            <span class="pd-old-price">
                                Rp{{ number_format($product['old_price'], 0, ',', '.') }}
                            </span>

                            <span class="pd-discount">
                                Hemat {{ $discount }}%
                            </span>

                        @endif

                    </div>

                </div>


                <!-- INFORMASI SINGKAT -->
                <div class="pd-details">

                    <div class="pd-detail-row">
                        <span>Kategori</span>
                        <strong>{{ $product['category'] }}</strong>
                    </div>

                    <div class="pd-detail-row">
                        <span>Lokasi</span>
                        <strong>📍 Sukabumi, Jawa Barat</strong>
                    </div>

                    <div class="pd-detail-row">
                        <span>Ketersediaan</span>
                        <strong class="pd-stock">
                            {{ $product['stock'] }} stok demo
                        </strong>
                    </div>

                    <div class="pd-detail-row">
                        <span>Status</span>
                        <strong>Produk Contoh</strong>
                    </div>

                </div>


                <!-- JUMLAH PRODUK -->
                <div class="pd-quantity">

                    <span class="pd-quantity-label">
                        Jumlah
                    </span>

                    <div class="pd-quantity-control">

                        <button type="button"
                                id="quantityMinus"
                                aria-label="Kurangi jumlah">
                            −
                        </button>

                        <input
                            type="number"
                            id="detailQuantity"
                            value="1"
                            min="1"
                            max="{{ $product['stock'] }}"
                            data-max="{{ $product['stock'] }}"
                            aria-label="Jumlah produk"
                        >

                        <button type="button"
                                id="quantityPlus"
                                aria-label="Tambah jumlah">
                            +
                        </button>

                    </div>

                    <span class="pd-quantity-hint">
                        Maksimal {{ $product['stock'] }} (demo)
                    </span>

                </div>


                <!-- TOMBOL AKSI -->
                <div class="pd-actions">

                    <button
                        type="button"
                        class="pd-btn pd-btn-cart"
                        id="detailAddCart"
                        data-id="{{ $product['id'] }}"
                        data-name="{{ $product['name'] }}"
                    >
                        🛒 Tambah ke Keranjang
                    </button>

                    <button
                        type="button"
                        class="pd-btn pd-btn-buy"
                        id="detailBuyNow"
                    >
                        Beli Sekarang →
                    </button>

                </div>


                <div class="pd-extra-actions">

                    <button
                        type="button"
                        class="pd-favorite"
                        id="detailFavorite"
                        data-id="{{ $product['id'] }}"
                        aria-pressed="false"
                    >
                        ♡ Tambah ke Favorit
                    </button>

                    <a href="{{ route('products') }}">
                        ← Kembali ke Katalog
                    </a>

                </div>

            </div>

        </section>


        <!-- INFORMASI PENJUAL -->
        <section class="pd-seller">

            <div class="pd-seller-avatar">
                🏪
            </div>

            <div class="pd-seller-info">
                <h3>Toko Contoh FJB UMMI</h3>
                <p>📍 Sukabumi · Profil penjual demo</p>
            </div>

            <span class="pd-seller-badge">
                TOKO DEMO
            </span>

        </section>


        <!-- INFORMASI LENGKAP -->
        <div class="pd-info-grid">

            <!-- DESKRIPSI -->
            <section class="pd-panel">

                <h2>Deskripsi Produk</h2>

                <p>
                    {{ $product['description'] }}
                </p>

                <p style="margin-top:18px">
                    Informasi ini merupakan data contoh
                    untuk pengembangan website FJB UMMI.
                    Spesifikasi asli, kondisi barang,
                    dan informasi penjual akan ditampilkan
                    setelah sistem terhubung dengan database.
                </p>

            </section>


            <!-- SPESIFIKASI -->
            <section class="pd-panel">

                <h2>Informasi Produk</h2>

                <div class="pd-specifications">

                    <div>
                        <span>Kategori</span>
                        <strong>{{ $product['category'] }}</strong>
                    </div>

                    <div>
                        <span>Lokasi</span>
                        <strong>Sukabumi</strong>
                    </div>

                    <div>
                        <span>Stok</span>
                        <strong>{{ $product['stock'] }} (demo)</strong>
                    </div>

                    <div>
                        <span>Harga</span>
                        <strong>
                            Rp{{ number_format($product['price'], 0, ',', '.') }}
                        </strong>
                    </div>

                    <div>
                        <span>Penjual</span>
                        <strong>Toko Contoh</strong>
                    </div>

                    <div>
                        <span>Pengiriman</span>
                        <strong>Belum tersedia</strong>
                    </div>

                </div>

            </section>

        </div>


        <!-- REKOMENDASI PRODUK -->
        <section class="pd-related">

            <div class="pd-related-heading">

                <div>
                    <h2>Produk Lainnya untuk Kamu ✨</h2>

                    <p>
                        Jelajahi produk menarik lainnya
                        di FJB UMMI.
                    </p>
                </div>

                <a href="{{ route('products') }}">
                    Semua Produk →
                </a>

            </div>

            <div class="pd-related-grid">

                @foreach($relatedProducts as $related)

                    <x-product-card :product="$related" />

                @endforeach

            </div>

        </section>

    </div>

</div>

<!-- NOTIFIKASI -->
<div id="detailToast"
     class="pd-toast"
     role="status"
     aria-live="polite"></div>

@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ==================================
    // NOTIFIKASI
    // ==================================

    const toast = document.getElementById('detailToast');
    let toastTimer;

    function notify(message) {
        if (!toast) return;

        toast.textContent = message;
        toast.classList.add('show');

        clearTimeout(toastTimer);

        toastTimer = setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }


    // ==================================
    // PENGATURAN JUMLAH
    // ==================================

    const quantityInput =
        document.getElementById('detailQuantity');

    const maxStock = Number(quantityInput.dataset.max);

    function validateQuantity(value) {
        const number = Math.floor(Number(value));

        if (!Number.isFinite(number)) return 1;

        return Math.max(1, Math.min(number, maxStock));
    }

    function getQuantity() {
        const value = validateQuantity(quantityInput.value);
        quantityInput.value = value;

        return value;
    }

    document.getElementById('quantityMinus')
        .addEventListener('click', function () {

            quantityInput.value =
                validateQuantity(getQuantity() - 1);

        });

    document.getElementById('quantityPlus')
        .addEventListener('click', function () {

            quantityInput.value =
                validateQuantity(getQuantity() + 1);

        });

    quantityInput.addEventListener('change', getQuantity);


    // ==================================
    // LOCAL STORAGE HELPER
    // ==================================

    function readStorage(key) {
        try {
            const data = JSON.parse(
                localStorage.getItem(key) || '[]'
            );

            return Array.isArray(data) ? data : [];
        } catch (error) {
            return [];
        }
    }

    function saveStorage(key, data) {
        try {
            localStorage.setItem(
                key,
                JSON.stringify(data)
            );
        } catch (error) {
            // Simulasi tetap bekerja selama halaman terbuka.
        }
    }


    // ==================================
    // KERANJANG DEMO
    // ==================================

    const cartKey = 'fjb_ummi_demo_cart_v2';

    let cart = readStorage(cartKey);

    function addToCart(id, name, quantity) {

        const existing = cart.find(item => item.id === id);

        if (existing) {
            existing.quantity =
                (Number(existing.quantity) || 0) + quantity;
        } else {
            cart.push({
                id: id,
                name: name,
                quantity: quantity
            });
        }

        saveStorage(cartKey, cart);

        // Beri tahu navbar agar jumlah keranjang langsung diperbarui.
        window.dispatchEvent(new Event('fjb-cart-updated'));

        const cartCount = document.getElementById('cartCount');

        if (cartCount) {
            cartCount.textContent = cart.reduce(
                (sum, item) => sum + Number(item.quantity || 0),
                0
            );
        }

        notify(
            quantity + ' × ' + name +
            ' ditambahkan ke keranjang demo.'
        );
    }


    // TOMBOL DETAIL PRODUK
    document.getElementById('detailAddCart')
        .addEventListener('click', function () {

            addToCart(
                this.dataset.id,
                this.dataset.name,
                getQuantity()
            );

        });


    // TOMBOL PRODUK REKOMENDASI
    document.querySelectorAll('.fjb-add-cart')
        .forEach(button => {

            button.addEventListener('click', function () {

                addToCart(
                    this.dataset.id,
                    this.dataset.name,
                    1
                );

            });

        });


    // ==================================
    // FAVORIT DEMO
    // ==================================

    const favoriteKey = 'fjb_ummi_favorites_v1';
    let favorites = readStorage(favoriteKey);

    const detailFavorite =
        document.getElementById('detailFavorite');

    function toggleFavorite(id) {
        if (favorites.includes(id)) {
            favorites = favorites.filter(
                item => item !== id
            );

            notify('Produk dihapus dari favorit demo.');
        } else {
            favorites.push(id);

            notify('Produk ditambahkan ke favorit demo.');
        }

        saveStorage(favoriteKey, favorites);
        updateFavoriteButtons();
    }

    function updateFavoriteButtons() {

        const active = favorites.includes(
            detailFavorite.dataset.id
        );

        detailFavorite.classList.toggle('active', active);
        detailFavorite.setAttribute(
            'aria-pressed',
            String(active)
        );

        detailFavorite.textContent = active
            ? '♥ Hapus dari Favorit'
            : '♡ Tambah ke Favorit';

        document.querySelectorAll('.fjb-favorite')
            .forEach(button => {

                const card = button.closest(
                    '.fjb-product-card'
                );

                const id = card?.querySelector(
                    '.fjb-add-cart'
                )?.dataset.id;

                const selected = favorites.includes(id);

                button.classList.toggle('active', selected);

                button.setAttribute(
                    'aria-pressed',
                    String(selected)
                );

            });
    }

    detailFavorite.addEventListener('click', function () {
        toggleFavorite(this.dataset.id);
    });

    document.querySelectorAll('.fjb-favorite')
        .forEach(button => {

            button.addEventListener('click', function () {

                const card = this.closest('.fjb-product-card');

                const id = card?.querySelector(
                    '.fjb-add-cart'
                )?.dataset.id;

                if (id) toggleFavorite(id);

            });

        });

    updateFavoriteButtons();


    // ==================================
    // BELI SEKARANG (DEMO)
    // ==================================

    document.getElementById('detailBuyNow')
        .addEventListener('click', function () {

            notify(
                'Fitur checkout belum tersedia. ' +
                'Saat ini halaman masih menggunakan produk demo.'
            );

        });

});
</script>
@endpush
