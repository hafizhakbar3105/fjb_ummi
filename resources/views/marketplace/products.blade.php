
@extends('layouts.app')

@section('title', 'Katalog Produk - FJB UMMI')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA PRODUK MARKETPLACE
    |--------------------------------------------------------------------------
    | Data sementara untuk tampilan katalog.
    | Nantinya produk akan diambil dari database MySQL.
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
    | KATEGORI PRODUK
    |--------------------------------------------------------------------------
    */

    $categories = [
        'Elektronik',
        'Fashion',
        'Buku',
        'Makanan',
        'Perlengkapan',
        'Lainnya',
    ];

    $categoryCounts = array_count_values(
        array_column($products, 'category')
    );

    /*
    |--------------------------------------------------------------------------
    | SEARCH, FILTER, DAN SORTING
    |--------------------------------------------------------------------------
    */

    $keyword = trim((string) request('q', ''));
    $category = (string) request('category', '');
    $sort = (string) request('sort', 'terbaru');

    // Validasi kategori
    if (!in_array($category, $categories, true)) {
        $category = '';
    }

    // Validasi pilihan pengurutan
    $allowedSorts = [
        'terbaru',
        'harga_terendah',
        'harga_tertinggi',
        'nama_az',
    ];

    if (!in_array($sort, $allowedSorts, true)) {
        $sort = 'terbaru';
    }

    // Filter pencarian dan kategori
    $filteredProducts = array_values(array_filter(
        $products,
        function ($product) use ($keyword, $category) {

            $matchSearch = $keyword === ''
                || stripos($product['name'], $keyword) !== false
                || stripos($product['category'], $keyword) !== false;

            $matchCategory = $category === ''
                || $product['category'] === $category;

            return $matchSearch && $matchCategory;
        }
    ));

    // Pengurutan produk
    if ($sort === 'harga_terendah') {

        usort(
            $filteredProducts,
            fn($a, $b) => $a['price'] <=> $b['price']
        );

    } elseif ($sort === 'harga_tertinggi') {

        usort(
            $filteredProducts,
            fn($a, $b) => $b['price'] <=> $a['price']
        );

    } elseif ($sort === 'nama_az') {

        usort(
            $filteredProducts,
            fn($a, $b) => strcmp($a['name'], $b['name'])
        );

    } else {

        // Simulasi produk terbaru berdasarkan ID
        usort(
            $filteredProducts,
            fn($a, $b) => $b['id'] <=> $a['id']
        );
    }

    $totalProducts = count($filteredProducts);
@endphp


{{-- ==========================================
     CSS HALAMAN KATALOG
========================================== --}}

@push('styles')
<style>

    /* GLOBAL KATALOG */

    .catalog-page {
        background: #F8FAFB;
        min-height: 100vh;
        padding-bottom: 65px;
    }

    /* BREADCRUMB */

    .catalog-breadcrumb {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        padding: 28px 0;
        font-size: 12px;
        color: #8193A1;
    }

    .catalog-breadcrumb a {
        color: #327DAF;
        transition: color .3s ease;
    }

    .catalog-breadcrumb a:hover {
        color: #102F4B;
    }

    /* HERO KATALOG */

    .catalog-hero {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        padding: 55px;
        background: linear-gradient(
            110deg,
            #102F4B 0%,
            #245B85 65%,
            #4B95C0 100%
        );
        color: white;
    }

    .catalog-hero::after {
        content: '';
        position: absolute;
        width: 280px;
        height: 280px;
        top: -110px;
        right: -50px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,.22);
        box-shadow:
            0 0 0 45px rgba(255,255,255,.04),
            0 0 0 95px rgba(255,255,255,.03);
        pointer-events: none;
    }

    .catalog-hero-content {
        position: relative;
        z-index: 1;
        max-width: 650px;
    }

    .catalog-eyebrow {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        color: #B8DBF0;
    }

    .catalog-hero h1 {
        font-size: clamp(29px, 3.5vw, 43px);
        line-height: 1.3;
        margin-top: 16px;
        color: white;
        letter-spacing: -.8px;
    }

    .catalog-hero p {
        max-width: 540px;
        margin-top: 15px;
        font-size: 13px;
        line-height: 1.9;
        color: #D9EAF5;
    }

    /* SEARCH TOOLBAR */

    .catalog-toolbar {
        background: white;
        border: 1px solid #E8EDF1;
        border-radius: 15px;
        margin-top: 28px;
        padding: 23px;
    }

    .catalog-search {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .catalog-search-input {
        flex: 1;
        min-width: 0;
        padding: 14px 17px;
        background: #F8FAFC;
        border: 1px solid #E5EDF2;
        border-radius: 9px;
        font-size: 12px;
        color: #23384A;
        outline: none;
        transition: .3s ease;
    }

    .catalog-search-input:focus,
    .catalog-sort:focus {
        border-color: #78B7D8;
        box-shadow: 0 0 0 3px rgba(50,125,175,.10);
    }

    .catalog-sort {
        min-width: 180px;
        padding: 13px;
        background: white;
        border: 1px solid #E5EDF2;
        border-radius: 9px;
        font-size: 12px;
        color: #23384A;
        outline: none;
    }

    .catalog-search-button {
        padding: 14px 23px;
        border: none;
        background: #102F4B;
        color: white;
        border-radius: 9px;
        font-weight: 700;
        font-size: 12px;
        cursor: pointer;
        white-space: nowrap;
        transition: background .3s ease;
    }

    .catalog-search-button:hover {
        background: #327DAF;
    }

    /* LAYOUT UTAMA */

    .catalog-layout {
        display: grid;
        grid-template-columns: 235px minmax(0,1fr);
        gap: 28px;
        align-items: start;
        margin-top: 32px;
    }

    /* SIDEBAR */

    .catalog-sidebar {
        background: white;
        border: 1px solid #E8EDF1;
        border-radius: 15px;
        padding: 23px;
    }

    .catalog-sidebar h3 {
        color: #102F4B;
        font-size: 15px;
        margin-bottom: 22px;
    }

    .catalog-filter-heading {
        color: #82909D;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .8px;
        margin-bottom: 14px;
        text-transform: uppercase;
    }

    .catalog-category-list {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .catalog-category-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 12px 13px;
        font-size: 12px;
        color: #52677A;
        border-radius: 9px;
        text-decoration: none;
        transition: .3s ease;
    }

    .catalog-category-link:hover {
        background: #F0F6FA;
        color: #102F4B;
    }

    .catalog-category-link.active {
        background: #102F4B;
        color: white;
        font-weight: 700;
    }

    .catalog-category-count {
        font-size: 10px;
        opacity: .7;
    }

    .catalog-sidebar-note {
        border-top: 1px solid #E8EDF1;
        margin-top: 24px;
        padding-top: 20px;
    }

    .catalog-sidebar-note p {
        font-size: 11px;
        line-height: 1.9;
        color: #82909D;
    }

    /* AREA PRODUK */

    .catalog-content {
        min-width: 0;
    }

    .catalog-results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 22px;
    }

    .catalog-results-header h2 {
        color: #102F4B;
        font-size: 22px;
        margin: 0;
    }

    .catalog-results-header p {
        font-size: 12px;
        color: #82909D;
        margin-top: 8px;
    }

    .catalog-result-count {
        background: #EAF3F8;
        color: #327DAF;
        padding: 10px 14px;
        border-radius: 25px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* GRID PRODUK */

    .catalog-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0,1fr));
        gap: 18px;
    }

    /* MENGGUNAKAN PRODUCT CARD LAMA */

    .catalog-grid .fjb-product-card {
        transition:
            transform .35s ease,
            box-shadow .35s ease;
    }

    .catalog-grid .fjb-product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(16,47,75,.10);
    }

    /* HASIL PENCARIAN KOSONG */

    .catalog-empty {
        grid-column: 1 / -1;
        background: white;
        border: 1px solid #E8EDF1;
        border-radius: 15px;
        padding: 65px 25px;
        text-align: center;
    }

    .catalog-empty-icon {
        font-size: 43px;
    }

    .catalog-empty h3 {
        margin-top: 15px;
        font-size: 20px;
        color: #102F4B;
    }

    .catalog-empty p {
        font-size: 13px;
        color: #82909D;
        margin-top: 12px;
        line-height: 1.8;
    }

    .catalog-reset {
        display: inline-block;
        margin-top: 22px;
        background: #102F4B;
        color: white;
        padding: 13px 22px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
    }

    .catalog-reset:hover {
        background: #327DAF;
    }

    /* NOTIFIKASI */

    .catalog-toast {
        position: fixed;
        bottom: 25px;
        right: 25px;
        z-index: 500;
        max-width: calc(100vw - 40px);
        padding: 16px 22px;
        background: #102F4B;
        color: white;
        border-radius: 11px;
        font-size: 12px;
        box-shadow: 0 15px 40px rgba(16,47,75,.2);
        opacity: 0;
        visibility: hidden;
        transform: translateY(15px);
        transition: .3s ease;
    }

    .catalog-toast.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    /* RESPONSIVE TABLET */

    @@media (max-width: 1050px) {

        .catalog-grid {
            grid-template-columns: repeat(2, minmax(0,1fr));
        }

    }

    /* RESPONSIVE MOBILE */

    @@media (max-width: 760px) {

        .catalog-layout {
            grid-template-columns: 1fr;
        }

        .catalog-sidebar {
            padding: 18px;
        }

        .catalog-category-list {
            flex-direction: row;
            flex-wrap: wrap;
        }

        .catalog-category-link {
            background: #F5F8FB;
            padding: 10px 14px;
        }

        .catalog-search {
            flex-direction: column;
            align-items: stretch;
        }

        .catalog-sort {
            width: 100%;
        }

        .catalog-search-button {
            width: 100%;
        }

    }

    @@media (max-width: 600px) {

        .catalog-breadcrumb {
            padding: 20px 0;
        }

        .catalog-hero {
            padding: 42px 25px;
        }

        .catalog-hero h1 {
            font-size: 29px;
        }

        .catalog-toolbar {
            padding: 16px;
        }

        .catalog-layout {
            gap: 24px;
        }

        .catalog-grid {
            gap: 11px;
        }

        .catalog-results-header h2 {
            font-size: 18px;
        }

        .catalog-result-count {
            font-size: 10px;
        }

    }

    @@media (prefers-reduced-motion: reduce) {

        .catalog-toast,
        .catalog-grid .fjb-product-card {
            transition: none;
        }

    }

</style>
@endpush


{{-- ==========================================
     HTML HALAMAN KATALOG
========================================== --}}

@section('content')

<div class="catalog-page">

    <div class="container">

        <!-- BREADCRUMB -->
        <nav class="catalog-breadcrumb"
             aria-label="Navigasi halaman">

            <a href="{{ route('home') }}">
                Beranda
            </a>

            <span>›</span>

            <span>Katalog Produk</span>

        </nav>


        <!-- BANNER KATALOG -->
        <section class="catalog-hero">

            <div class="catalog-hero-content">

                <span class="catalog-eyebrow">
                    EXPLORE FJB UMMI
                </span>

                <h1>
                    Temukan Produk<br>
                    yang Kamu Butuhkan.
                </h1>

                <p>
                    Jelajahi berbagai pilihan produk
                    mulai dari elektronik, fashion,
                    buku kuliah, makanan, hingga
                    perlengkapan sehari-hari.
                </p>

            </div>

        </section>


        <!-- SEARCH TOOLBAR -->
        <div class="catalog-toolbar">

            <form
                action="{{ route('products') }}"
                method="GET"
                class="catalog-search"
            >

                <!-- SEARCH INPUT -->
                <input
                    type="search"
                    name="q"
                    class="catalog-search-input"
                    value="{{ $keyword }}"
                    placeholder="Cari nama produk atau kategori..."
                    aria-label="Cari produk"
                >

                <!-- FILTER KATEGORI -->
                @if ($category !== '')

                    <input
                        type="hidden"
                        name="category"
                        value="{{ $category }}"
                    >

                @endif

                <!-- SORTING -->
                <select
                    name="sort"
                    class="catalog-sort"
                    aria-label="Urutkan produk"
                >

                    <option
                        value="terbaru"
                        @selected($sort === 'terbaru')
                    >
                        Produk Terbaru
                    </option>

                    <option
                        value="harga_terendah"
                        @selected($sort === 'harga_terendah')
                    >
                        Harga Terendah
                    </option>

                    <option
                        value="harga_tertinggi"
                        @selected($sort === 'harga_tertinggi')
                    >
                        Harga Tertinggi
                    </option>

                    <option
                        value="nama_az"
                        @selected($sort === 'nama_az')
                    >
                        Nama A-Z
                    </option>

                </select>

                <!-- SEARCH BUTTON -->
                <button
                    type="submit"
                    class="catalog-search-button"
                >
                    Cari & Terapkan
                </button>

            </form>

        </div>


        <!-- LAYOUT KATALOG -->
        <div class="catalog-layout">

            <!-- SIDEBAR FILTER -->
            <aside class="catalog-sidebar">

                <h3>Filter Produk</h3>

                <div class="catalog-filter-heading">
                    Kategori Produk
                </div>

                <div class="catalog-category-list">

                    <!-- SEMUA KATEGORI -->
                    <a
                        href="{{ route('products', [
                            'q' => $keyword,
                            'sort' => $sort
                        ]) }}"
                        class="catalog-category-link
                        {{ $category === '' ? 'active' : '' }}"
                    >

                        <span>Semua Kategori</span>

                        <span class="catalog-category-count">
                            {{ count($products) }}
                        </span>

                    </a>


                    <!-- KATEGORI LAIN -->
                    @foreach ($categories as $item)

                        <a
                            href="{{ route('products', [
                                'q' => $keyword,
                                'category' => $item,
                                'sort' => $sort
                            ]) }}"
                            class="catalog-category-link
                            {{ $category === $item ? 'active' : '' }}"
                        >

                            <span>{{ $item }}</span>

                            <span class="catalog-category-count">
                                {{ $categoryCounts[$item] ?? 0 }}
                            </span>

                        </a>

                    @endforeach

                </div>


                <!-- INFORMASI -->
                <div class="catalog-sidebar-note">

                    <p>
                        🎓 FJB UMMI merupakan marketplace
                        yang sedang dikembangkan untuk
                        komunitas mahasiswa Universitas
                        Muhammadiyah Sukabumi.
                    </p>

                </div>

            </aside>


            <!-- DAFTAR PRODUK -->
            <section class="catalog-content">

                <div class="catalog-results-header">

                    <div>

                        <h2>Semua Produk</h2>

                        <p>
                            Jelajahi katalog produk FJB UMMI.
                        </p>

                    </div>

                    <span class="catalog-result-count">
                        {{ $totalProducts }} Produk
                    </span>

                </div>


                <!-- GRID PRODUK -->
                <div class="catalog-grid">

                    @forelse ($filteredProducts as $product)

                        <x-product-card
                            :product="$product"
                        />

                    @empty

                        <!-- TIDAK ADA PRODUK -->
                        <div class="catalog-empty">

                            <div class="catalog-empty-icon">
                                🔎
                            </div>

                            <h3>Produk Tidak Ditemukan</h3>

                            <p>
                                Maaf, belum ada produk
                                yang sesuai dengan pencarianmu.
                                Coba gunakan kata kunci atau
                                kategori yang berbeda.
                            </p>

                            <a
                                href="{{ route('products') }}"
                                class="catalog-reset"
                            >
                                Lihat Semua Produk
                            </a>

                        </div>

                    @endforelse

                </div>

            </section>

        </div>

    </div>

</div>


<!-- TOAST NOTIFICATION -->
<div
    id="catalogToast"
    class="catalog-toast"
    role="status"
    aria-live="polite"
></div>

@endsection


{{-- ==========================================
     JAVASCRIPT KATALOG PRODUK
========================================== --}}

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ==================================
    // NOTIFIKASI
    // ==================================

    const toast = document.getElementById('catalogToast');

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
    // PENGATURAN LOCAL STORAGE
    // ==================================

    const cartKey = 'fjb_ummi_demo_cart_v2';

    const favoriteKey = 'fjb_ummi_favorites_v1';

    function readStorage(key) {

        try {

            const saved = JSON.parse(
                localStorage.getItem(key) || '[]'
            );

            return Array.isArray(saved) ? saved : [];

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

            return true;

        } catch (error) {

            console.error(
                'Gagal menyimpan data browser:',
                error
            );

            return false;
        }
    }


    // ==================================
    // KERANJANG BELANJA DEMO
    // ==================================

    let cart = readStorage(cartKey);

    // Menghitung jumlah seluruh barang
    function getTotalCart() {

        return cart.reduce((total, item) => {

            const quantity = Number(item.quantity) || 0;

            return total + Math.max(0, quantity);

        }, 0);
    }


    // Memperbarui angka pada navbar
    function updateNavbarCart() {

        const cartCount = document.getElementById('cartCount');

        if (cartCount) {

            cartCount.textContent = getTotalCart();

        }
    }


    // Fungsi menambahkan produk
    function addToCart(id, name) {

        const existing = cart.find(
            item => String(item.id) === String(id)
        );

        if (existing) {

            existing.quantity =
                (Number(existing.quantity) || 0) + 1;

        } else {

            cart.push({
                id: String(id),
                name: name,
                quantity: 1
            });
        }

        // Simpan data keranjang
        const saved = saveStorage(cartKey, cart);

        // Langsung perbarui badge navbar
        updateNavbarCart();

        // Kirim event agar komponen navbar memperbarui data
        if (saved) {

            window.dispatchEvent(
                new Event('fjb-cart-updated')
            );

            notify(
                name + ' berhasil ditambahkan ke keranjang!'
            );

        } else {

            notify(
                'Keranjang diperbarui sementara, tetapi tidak tersimpan.'
            );

        }
    }


    // Event tombol Tambah ke Keranjang
    document.querySelectorAll('.fjb-add-cart')
        .forEach(button => {

            button.addEventListener('click', function () {

                const id = this.dataset.id;

                const name = this.dataset.name;

                if (!id || !name) return;

                addToCart(id, name);

            });
        });


    // ==================================
    // FITUR FAVORIT DEMO
    // ==================================

    let favorites = readStorage(favoriteKey).map(String);


    function updateFavorites() {

        document.querySelectorAll('.fjb-favorite')
            .forEach(button => {

                const card = button.closest(
                    '.fjb-product-card'
                );

                if (!card) return;

                const cartButton = card.querySelector(
                    '.fjb-add-cart'
                );

                if (!cartButton) return;

                const id = String(cartButton.dataset.id);

                const active = favorites.includes(id);

                button.classList.toggle(
                    'active',
                    active
                );

                button.setAttribute(
                    'aria-pressed',
                    String(active)
                );

                button.setAttribute(
                    'aria-label',
                    active
                        ? 'Hapus dari favorit'
                        : 'Tambah ke favorit'
                );

                button.textContent = active ? '♥' : '♡';

            });
    }


    function toggleFavorite(id) {

        id = String(id);

        if (favorites.includes(id)) {

            favorites = favorites.filter(
                item => item !== id
            );

            notify('Produk dihapus dari favorit.');

        } else {

            favorites.push(id);

            notify('Produk ditambahkan ke favorit.');

        }

        saveStorage(favoriteKey, favorites);

        updateFavorites();
    }


    // Event tombol Favorit
    document.querySelectorAll('.fjb-favorite')
        .forEach(button => {

            button.addEventListener('click', function () {

                const card = this.closest(
                    '.fjb-product-card'
                );

                if (!card) return;

                const cartButton = card.querySelector(
                    '.fjb-add-cart'
                );

                if (!cartButton) return;

                const id = cartButton.dataset.id;

                toggleFavorite(id);

            });
        });


    // ==================================
    // INISIALISASI HALAMAN
    // ==================================

    updateNavbarCart();

    updateFavorites();

});
</script>

@endpush
