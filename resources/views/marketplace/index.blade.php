
@extends('layouts.app')

@section('title', 'Beranda - FJB UMMI')

@php

    /*
    |--------------------------------------------------------------------------
    | DATA HERO BANNER
    |--------------------------------------------------------------------------
    | Data sementara untuk banner utama marketplace.
    | Nantinya bisa dikelola melalui database.
    */

    $slides = [
        [
            'label' => 'MARKETPLACE MAHASISWA UMMI',
            'title' => 'Satu Kampus, Banyak Cerita Belanja.',
            'description' => 'Temukan berbagai kebutuhan kuliah, fashion, elektronik, makanan, dan produk kreatif mahasiswa dalam satu marketplace Universitas Muhammadiyah Sukabumi.',
            'button' => 'Jelajahi Produk',
            'target' => '#produk',
        ],
        [
            'label' => 'BELANJA MUDAH DAN PRAKTIS',
            'title' => 'Temukan Produk Favoritmu.',
            'description' => 'Belanja kebutuhan sehari-hari dengan lebih mudah. Jelajahi berbagai produk menarik dari komunitas mahasiswa UMMI.',
            'button' => 'Lihat Kategori',
            'target' => '#kategori',
        ],
        [
            'label' => 'DUKUNG USAHA MAHASISWA',
            'title' => 'Dari Mahasiswa, Untuk Mahasiswa.',
            'description' => 'FJB UMMI hadir sebagai ruang digital untuk mendukung kreativitas, kewirausahaan, dan aktivitas jual beli di lingkungan kampus.',
            'button' => 'Mulai Belanja',
            'target' => '#produk',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | DATA KATEGORI PRODUK
    |--------------------------------------------------------------------------
    */

    $categories = [
        [
            'name' => 'Elektronik',
            'icon' => '💻',
        ],
        [
            'name' => 'Fashion',
            'icon' => '👕',
        ],
        [
            'name' => 'Buku',
            'icon' => '📚',
        ],
        [
            'name' => 'Makanan',
            'icon' => '🍪',
        ],
        [
            'name' => 'Perlengkapan',
            'icon' => '🎒',
        ],
        [
            'name' => 'Lainnya',
            'icon' => '🛍️',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | DATA PRODUK MARKETPLACE
    |--------------------------------------------------------------------------
    | Produk masih berupa data contoh.
    | Foto menggunakan Unsplash.
    */

    $products = [
        [
            'id' => 1,
            'name' => 'Headphone Wireless Premium',
            'category' => 'Elektronik',
            'price' => 175000,
            'old_price' => 220000,
            'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=700&auto=format&fit=crop',
        ],
        [
            'id' => 2,
            'name' => 'Hoodie Casual Mahasiswa',
            'category' => 'Fashion',
            'price' => 135000,
            'old_price' => 180000,
            'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=700&auto=format&fit=crop',
        ],
        [
            'id' => 3,
            'name' => 'Buku Bacaan dan Referensi',
            'category' => 'Buku',
            'price' => 45000,
            'old_price' => 60000,
            'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=700&auto=format&fit=crop',
        ],
        [
            'id' => 4,
            'name' => 'Tumbler Minimalis',
            'category' => 'Perlengkapan',
            'price' => 55000,
            'old_price' => 79000,
            'image' => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=700&auto=format&fit=crop',
        ],
        [
            'id' => 5,
            'name' => 'Keyboard Mechanical RGB',
            'category' => 'Elektronik',
            'price' => 250000,
            'old_price' => 310000,
            'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=700&auto=format&fit=crop',
        ],
        [
            'id' => 6,
            'name' => 'Tas Fashion Wanita',
            'category' => 'Fashion',
            'price' => 89000,
            'old_price' => 120000,
            'image' => 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=700&auto=format&fit=crop',
        ],
        [
            'id' => 7,
            'name' => 'Cookies Cokelat Homemade',
            'category' => 'Makanan',
            'price' => 25000,
            'old_price' => 30000,
            'image' => 'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?w=700&auto=format&fit=crop',
        ],
        [
            'id' => 8,
            'name' => 'Notebook Catatan Kuliah',
            'category' => 'Buku',
            'price' => 28000,
            'old_price' => 35000,
            'image' => 'https://images.unsplash.com/photo-1531346878377-a5be20888e57?w=700&auto=format&fit=crop',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | FITUR PENCARIAN PRODUK
    |--------------------------------------------------------------------------
    | Mengambil kata kunci dari URL:
    | http://127.0.0.1:8000/?q=buku
    */

    $keyword = trim((string) request('q', ''));

    $filteredProducts = $keyword === ''
        ? $products
        : array_values(array_filter(
            $products,
            function ($product) use ($keyword) {

                return
                    stripos($product['name'], $keyword) !== false
                    ||
                    stripos($product['category'], $keyword) !== false;

            }
        ));

@endphp


@section('content')

    <!-- =========================================
         HERO BANNER
    ========================================== -->

    <x-hero-banner :slides="$slides" />


    <!-- =========================================
         KATEGORI PRODUK
    ========================================== -->

    <section class="container section" id="kategori">

        <div class="section-header">

            <div>
                <h2>Jelajahi Kategori</h2>

                <p>
                    Temukan kebutuhan kuliah dan gaya hidupmu
                    melalui berbagai kategori produk.
                </p>
            </div>

        </div>


        <div class="category-grid">

            @foreach ($categories as $category)

                <x-category-card
                    :category="$category"
                />

            @endforeach

        </div>

    </section>


    <!-- =========================================
         PRODUK PILIHAN MAHASISWA
    ========================================== -->

    <section class="container section" id="produk">

        <div class="section-header">

            <div>

                <h2>
                    Produk Pilihan Mahasiswa ✨
                </h2>

                <p>
                    Temukan berbagai produk menarik
                    untuk kebutuhan sehari-harimu.
                </p>

            </div>

        </div>


        <!-- INFORMASI HASIL PENCARIAN -->

        @if ($keyword !== '')

            <div style="
                background: #EAF3F8;
                padding: 15px 20px;
                margin-bottom: 25px;
                border-radius: 10px;
                color: #102F4B;
                font-size: 13px;
            ">

                Hasil pencarian untuk:

                <strong>
                    {{ $keyword }}
                </strong>

                ({{ count($filteredProducts) }} produk)

                <a
                    href="{{ route('home') }}#produk"
                    style="
                        float: right;
                        color: #327DAF;
                        font-weight: bold;
                    "
                >
                    Hapus Filter
                </a>

            </div>

        @endif


        <!-- GRID PRODUK -->

        <div class="product-grid">

            @forelse ($filteredProducts as $product)

                <x-product-card
                    :product="$product"
                />

            @empty

                <!-- JIKA PRODUK TIDAK DITEMUKAN -->

                <div style="
                    grid-column: 1 / -1;
                    background: white;
                    text-align: center;
                    padding: 60px 20px;
                    border-radius: 15px;
                    border: 1px solid #E8EDF1;
                ">

                    <div style="font-size: 45px;">
                        🔍
                    </div>

                    <h3 style="
                        color: #102F4B;
                        margin-top: 15px;
                    ">
                        Produk Tidak Ditemukan
                    </h3>

                    <p style="
                        color: #82909D;
                        margin-top: 10px;
                        font-size: 13px;
                    ">
                        Maaf, belum ada produk yang sesuai
                        dengan pencarianmu.
                    </p>

                    <a
                        href="{{ route('home') }}#produk"
                        style="
                            display: inline-block;
                            background: #102F4B;
                            color: white;
                            padding: 12px 22px;
                            border-radius: 8px;
                            margin-top: 22px;
                            font-size: 12px;
                        "
                    >
                        Lihat Semua Produk
                    </a>

                </div>

            @endforelse

        </div>

    </section>


    <!-- =========================================
         BANNER PROMOSI MARKETPLACE
    ========================================== -->

    <section class="container section">

        <div style="
            display: grid;
            grid-template-columns: repeat(
                auto-fit,
                minmax(min(100%, 280px), 1fr)
            );
            gap: 20px;
        ">

            <!-- PROMOSI FASHION -->

            <div style="
                background: #E3EEF4;
                border-radius: 18px;
                padding: 35px 30px;
                min-height: 190px;
            ">

                <small style="
                    color: #327DAF;
                    font-weight: bold;
                    letter-spacing: 1px;
                ">
                    FASHION & LIFESTYLE
                </small>

                <h2 style="
                    margin-top: 13px;
                    font-size: 25px;
                    color: #102F4B;
                ">
                    Gaya Kampus<br>
                    Lebih Percaya Diri.
                </h2>

                <a
                    href="{{ route('home', ['q' => 'Fashion']) }}#produk"
                    style="
                        display: inline-block;
                        margin-top: 20px;
                        color: #102F4B;
                        font-weight: bold;
                        font-size: 12px;
                    "
                >
                    Jelajahi Fashion →
                </a>

            </div>


            <!-- PROMOSI BUKU -->

            <div style="
                background: #F5EBDF;
                border-radius: 18px;
                padding: 35px 30px;
                min-height: 190px;
            ">

                <small style="
                    color: #327DAF;
                    font-weight: bold;
                    letter-spacing: 1px;
                ">
                    CAMPUS ESSENTIALS
                </small>

                <h2 style="
                    margin-top: 13px;
                    font-size: 25px;
                    color: #102F4B;
                ">
                    Lengkapi<br>
                    Kebutuhan Kuliahmu.
                </h2>

                <a
                    href="{{ route('home', ['q' => 'Buku']) }}#produk"
                    style="
                        display: inline-block;
                        margin-top: 20px;
                        color: #102F4B;
                        font-weight: bold;
                        font-size: 12px;
                    "
                >
                    Cari Buku →
                </a>

            </div>

        </div>

    </section>


    <!-- =========================================
         TENTANG MARKETPLACE FJB UMMI
    ========================================== -->

    <section class="container section" id="tentang">

        <div style="
            background: #102F4B;
            border-radius: 20px;
            padding: 50px 35px;
            color: white;
            text-align: center;
        ">

            <span style="
                font-size: 11px;
                color: #A9CEE5;
                letter-spacing: 2px;
            ">
                MORE THAN JUST A MARKETPLACE
            </span>

            <h2 style="
                color: white;
                margin-top: 15px;
                font-size: clamp(24px, 3vw, 32px);
            ">
                Dari Mahasiswa, untuk Mahasiswa.
            </h2>

            <p style="
                max-width: 650px;
                margin: 20px auto 0;
                font-size: 14px;
                line-height: 1.9;
                color: #C7DCE9;
            ">

                FJB UMMI merupakan platform marketplace
                yang dirancang untuk mendukung aktivitas
                jual beli, kreativitas, dan kewirausahaan
                mahasiswa Universitas Muhammadiyah Sukabumi.

            </p>

            <a
                href="#produk"
                style="
                    display: inline-block;
                    margin-top: 25px;
                    padding: 13px 25px;
                    background: white;
                    color: #102F4B;
                    border-radius: 9px;
                    font-size: 12px;
                    font-weight: bold;
                "
            >
                Mulai Jelajahi Produk →
            </a>

        </div>

    </section>

@endsection
