
@php
    // DATA CONTOH - NANTINYA DARI MYSQL
    $categories = [
        ['name' => 'Elektronik', 'icon' => '💻'],
        ['name' => 'Fashion', 'icon' => '👕'],
        ['name' => 'Buku', 'icon' => '📚'],
        ['name' => 'Makanan', 'icon' => '🍪'],
        ['name' => 'Perlengkapan', 'icon' => '🎒'],
        ['name' => 'Lainnya', 'icon' => '✨'],
    ];

    $products = [
        [
            'id' => 1,
            'name' => 'Headphone Wireless Premium',
            'category' => 'Elektronik',
            'price' => 175000,
            'old' => 220000,
            'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=700&auto=format&fit=crop'
        ],
        [
            'id' => 2,
            'name' => 'Hoodie Casual Mahasiswa',
            'category' => 'Fashion',
            'price' => 135000,
            'old' => 180000,
            'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=700&auto=format&fit=crop'
        ],
        [
            'id' => 3,
            'name' => 'Buku Bacaan dan Referensi',
            'category' => 'Buku',
            'price' => 45000,
            'old' => 60000,
            'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=700&auto=format&fit=crop'
        ],
        [
            'id' => 4,
            'name' => 'Tumbler Minimalis',
            'category' => 'Perlengkapan',
            'price' => 55000,
            'old' => 79000,
            'image' => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=700&auto=format&fit=crop'
        ],
        [
            'id' => 5,
            'name' => 'Keyboard Mechanical',
            'category' => 'Elektronik',
            'price' => 250000,
            'old' => 310000,
            'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=700&auto=format&fit=crop'
        ],
        [
            'id' => 6,
            'name' => 'Tas Fashion Wanita',
            'category' => 'Fashion',
            'price' => 89000,
            'old' => 120000,
            'image' => 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=700&auto=format&fit=crop'
        ],
        [
            'id' => 7,
            'name' => 'Cookies Cokelat Homemade',
            'category' => 'Makanan',
            'price' => 25000,
            'old' => 30000,
            'image' => 'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?w=700&auto=format&fit=crop'
        ],
        [
            'id' => 8,
            'name' => 'Notebook Catatan Kuliah',
            'category' => 'Buku',
            'price' => 28000,
            'old' => 35000,
            'image' => 'https://images.unsplash.com/photo-1531346878377-a5be20888e57?w=700&auto=format&fit=crop'
        ],
    ];

    $slides = [
        [
            'label' => 'MARKETPLACE MAHASISWA UMMI',
            'title' => 'Satu Kampus,',
            'accent' => 'Banyak Cerita Belanja.',
            'description' => 'Temukan kebutuhan kuliah, gaya hidup, dan berbagai produk pilihan dalam satu ruang jual beli untuk komunitas mahasiswa.',
            'button' => 'Mulai Jelajahi'
        ],
        [
            'label' => 'BELANJA LEBIH PRAKTIS',
            'title' => 'Temukan Barang,',
            'accent' => 'Dari Teman Sekampus.',
            'description' => 'Mulai dari buku, fashion, hingga kebutuhan sehari-hari. Jelajahi berbagai pilihan produk dengan lebih mudah.',
            'button' => 'Lihat Produk'
        ],
        [
            'label' => 'DUKUNG KREATIVITAS MAHASISWA',
            'title' => 'Karya Mahasiswa,',
            'accent' => 'Untuk Semua.',
            'description' => 'FJB UMMI dirancang untuk menjadi ruang digital bagi mahasiswa yang ingin berbelanja maupun mengembangkan usaha.',
            'button' => 'Jelajahi Marketplace'
        ]
    ];

    $keyword = trim((string) request('q', ''));
    $activeCategory = trim((string) request('category', ''));

    $filteredProducts = array_values(array_filter(
        $products,
        function ($product) use ($keyword, $activeCategory) {
            $matchKeyword = $keyword === ''
                || stripos($product['name'], $keyword) !== false
                || stripos($product['category'], $keyword) !== false;

            $matchCategory = $activeCategory === ''
                || $product['category'] === $activeCategory;

            return $matchKeyword && $matchCategory;
        }
    ));
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#102F4B">

    <title>FJB UMMI | Marketplace Mahasiswa</title>

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ============================
           GLOBAL DESIGN
        ============================ */

        :root {
            --navy: #102F4B;
            --navy-dark: #0B2339;
            --blue: #327DAF;
            --sky: #78B7D8;
            --light-blue: #EAF3F8;
            --background: #F8FAFB;
            --white: #FFFFFF;
            --text: #23384A;
            --muted: #82909D;
            --border: #E8EDF1;
            --gold: #EAC58C;
            --shadow: 0 14px 40px rgba(22, 58, 85, .06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 155px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--background);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button, input {
            font: inherit;
        }

        button {
            cursor: pointer;
        }

        button:focus-visible,
        a:focus-visible,
        input:focus-visible {
            outline: 3px solid var(--sky);
            outline-offset: 3px;
        }

        img {
            display: block;
            max-width: 100%;
        }

        .container {
            width: min(1220px, calc(100% - 48px));
            margin-inline: auto;
        }

        .icon {
            width: 21px;
            height: 21px;
            stroke-width: 1.8;
            flex-shrink: 0;
        }

        /* ============================
           TOPBAR
        ============================ */

        .topbar {
            background: var(--navy-dark);
            color: #DBE9F2;
            font-size: 11px;
            letter-spacing: .3px;
        }

        .topbar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 35px;
            gap: 12px;
        }

        .topbar-highlight {
            color: var(--gold);
        }

        /* ============================
           HEADER
        ============================ */

        .site-header {
            background: rgba(255,255,255,.97);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border);
            transition: box-shadow .3s ease;
        }

        .site-header.scrolled {
            box-shadow: 0 10px 35px rgba(17,48,75,.09);
        }

        .header-main {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            padding-top: 21px;
            padding-bottom: 21px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 11px;
            flex-shrink: 0;
        }

        .logo-mark {
            display: grid;
            place-items: center;
            background: var(--navy);
            color: white;
            width: 48px;
            height: 48px;
            border-radius: 15px;
        }

        .logo-mark .icon {
            width: 25px;
            height: 25px;
        }

        .logo-name {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 23px;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: -.9px;
        }

        .logo-sub {
            font-size: 9px;
            font-weight: 700;
            color: var(--blue);
            letter-spacing: 2px;
            margin-top: 4px;
        }

        /* SEARCH BAR */

        .search-form {
            display: flex;
            align-items: center;
            flex: 1;
            max-width: 480px;
            background: #F6F9FB;
            border: 1px solid var(--border);
            border-radius: 40px;
            padding: 5px 5px 5px 19px;
            transition: .3s ease;
        }

        .search-form:focus-within {
            background: white;
            border-color: var(--sky);
            box-shadow: 0 0 0 4px rgba(78,151,199,.10);
        }

        .search-form > .icon {
            color: #8B9CAA;
            width: 18px;
        }

        .search-form input {
            background: transparent;
            border: 0;
            outline: 0;
            min-width: 0;
            flex: 1;
            padding: 10px 13px;
            font-size: 12px;
            color: var(--text);
        }

        .search-form button {
            border: 0;
            background: var(--navy);
            color: white;
            border-radius: 28px;
            padding: 11px 22px;
            font-size: 11px;
            font-weight: 700;
            transition: .25s;
        }

        .search-form button:hover {
            background: var(--blue);
        }

        /* HEADER ACTIONS */

        .header-actions {
            display: flex;
            align-items: center;
            gap: 23px;
        }

        .header-action {
            position: relative;
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 7px;
            background: none;
            border: 0;
            color: var(--navy);
            transition: transform .25s ease;
        }

        .header-action:hover {
            transform: translateY(-2px);
        }

        .header-action span {
            font-size: 10px;
            font-weight: 600;
        }

        .cart-count {
            position: absolute;
            right: -7px;
            top: -7px;
            background: var(--blue);
            color: white;
            min-width: 18px;
            padding: 3px 5px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: 700;
        }

        /* NAVIGATION */

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 31px;
            padding-bottom: 15px;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .nav-menu::-webkit-scrollbar {
            display: none;
        }

        .nav-menu a {
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
            transition: color .25s;
        }

        .nav-menu a:hover {
            color: var(--blue);
        }

        .nav-menu .menu-category {
            display: flex;
            align-items: center;
            gap: 9px;
            background: var(--navy);
            color: white;
            padding: 11px 18px;
            border-radius: 9px;
        }

        .menu-category .icon {
            width: 16px;
            height: 16px;
        }

        /* ============================
           HERO BANNER
        ============================ */

        .hero {
            margin-top: 26px;
            position: relative;
            min-height: 500px;
            border-radius: 22px;
            overflow: hidden;
            background:
                linear-gradient(
                    90deg,
                    rgba(6,28,48,.96) 0%,
                    rgba(12,48,78,.89) 33%,
                    rgba(17,66,103,.45) 70%,
                    rgba(16,58,95,.15) 100%
                ),
                url("{{ asset('images/ummi-campus.jpeg') }}");

            background-size: cover;
            background-position: center 54%;
            box-shadow: 0 22px 50px rgba(16,47,75,.13);
        }

        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: linear-gradient(
                0deg,
                rgba(5,22,40,.23),
                transparent 35%
            );
        }

        .hero-inner {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            min-height: 500px;
            padding: 66px 76px 83px;
        }

        .hero-slide {
            display: none;
            max-width: 670px;
            color: white;
        }

        .hero-slide.active {
            display: block;
            animation: slideEnter .65s ease both;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #DEEDF7;
        }

        .hero-eyebrow::before {
            content: '';
            width: 22px;
            height: 1px;
            background: var(--gold);
        }

        .hero-title {
            margin-top: 22px;
            font-size: clamp(36px, 4.5vw, 62px);
            line-height: 1.17;
            letter-spacing: -2px;
            font-weight: 800;
        }

        .hero-title em {
            display: block;
            font-style: normal;
            color: #BDDFF3;
        }

        .hero-description {
            margin-top: 22px;
            color: #DBE8F0;
            max-width: 445px;
            font-size: 14px;
            line-height: 1.9;
        }

        .hero-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .btn-primary,
        .btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 11px;
            border-radius: 9px;
            padding: 15px 23px;
            font-size: 12px;
            font-weight: 700;
            transition: transform .3s, background .3s;
        }

        .btn-primary {
            background: white;
            color: var(--navy);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            background: #EAF3F8;
        }

        .btn-outline {
            background: rgba(255,255,255,.08);
            color: white;
            border: 1px solid rgba(255,255,255,.35);
        }

        .btn-outline:hover {
            background: rgba(255,255,255,.2);
        }

        .hero-location {
            position: absolute;
            right: 30px;
            top: 30px;
            z-index: 3;
            display: flex;
            gap: 9px;
            align-items: center;
            color: white;
            background: rgba(14,45,73,.45);
            border: 1px solid rgba(255,255,255,.30);
            backdrop-filter: blur(10px);
            padding: 11px 15px;
            border-radius: 30px;
            font-size: 11px;
        }

        /* HERO CONTROLS */

        .slider-controls {
            position: absolute;
            z-index: 4;
            left: 76px;
            bottom: 30px;
            display: flex;
            gap: 8px;
        }

        .slider-dot {
            border: 0;
            width: 8px;
            height: 8px;
            background: rgba(255,255,255,.45);
            border-radius: 20px;
            transition: .35s;
        }

        .slider-dot.active {
            width: 29px;
            background: white;
        }

        .slider-arrows {
            position: absolute;
            right: 27px;
            bottom: 26px;
            z-index: 4;
            display: flex;
            gap: 8px;
        }

        .slider-arrow {
            display: grid;
            place-items: center;
            width: 39px;
            height: 39px;
            border-radius: 50%;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.4);
            color: white;
            transition: .3s;
        }

        .slider-arrow:hover {
            background: white;
            color: var(--navy);
        }

        /* ============================
           SECTIONS
        ============================ */

        .section {
            padding-top: 72px;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 27px;
        }

        .section-eyebrow {
            font-size: 10px;
            color: var(--blue);
            letter-spacing: 2px;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .section-header h2 {
            font-size: clamp(23px,3vw,30px);
            letter-spacing: -.8px;
            color: var(--navy);
        }

        .section-header p {
            margin-top: 9px;
            font-size: 13px;
            color: var(--muted);
            line-height: 1.7;
        }

        .section-link {
            font-size: 12px;
            font-weight: 700;
            color: var(--blue);
            white-space: nowrap;
        }

        /* ============================
           CATEGORY CARDS
        ============================ */

        .category-grid {
            display: grid;
            grid-template-columns: repeat(6, minmax(0,1fr));
            gap: 15px;
        }

        .category-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 27px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            transition: .35s ease;
        }

        .category-card:hover {
            transform: translateY(-6px);
            border-color: #BCD9E9;
            box-shadow: var(--shadow);
        }

        .category-icon {
            display: grid;
            place-items: center;
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background: #EDF5F9;
            font-size: 29px;
        }

        .category-card:nth-child(2) .category-icon {
            background: #F6EDF1;
        }

        .category-card:nth-child(3) .category-icon {
            background: #F7F2E7;
        }

        .category-card:nth-child(4) .category-icon {
            background: #FFF2E7;
        }

        .category-card:nth-child(5) .category-icon {
            background: #EDF2ED;
        }

        .category-card:nth-child(6) .category-icon {
            background: #F0EEF7;
        }

        .category-name {
            font-size: 12px;
            font-weight: 700;
            color: var(--navy);
        }

        /* ============================
           PRODUCT CARDS
        ============================ */

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-bottom: 23px;
        }

        .filter-chip {
            font-size: 11px;
            padding: 10px 17px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 30px;
            color: #708394;
            transition: .25s;
        }

        .filter-chip:hover,
        .filter-chip.active {
            color: white;
            background: var(--navy);
            border-color: var(--navy);
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0,1fr));
            gap: 20px;
        }

        .product-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 17px;
            overflow: hidden;
            transition: .35s ease;
        }

        .product-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 18px 40px rgba(26,62,86,.09);
        }

        .product-image {
            position: relative;
            height: 214px;
            background: #F0F4F6;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .65s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.07);
        }

        .product-badge {
            position: absolute;
            top: 13px;
            left: 13px;
            background: rgba(255,255,255,.94);
            color: var(--navy);
            padding: 7px 11px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
        }

        .favorite-btn {
            position: absolute;
            right: 12px;
            top: 12px;
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 50%;
            background: white;
            color: var(--navy);
            display: grid;
            place-items: center;
            transition: .3s;
        }

        .favorite-btn:hover {
            transform: scale(1.1);
        }

        .favorite-btn.active {
            color: #D45D6F;
            background: #FFF1F3;
        }

        .favorite-btn.active .icon {
            fill: #D45D6F;
        }

        .product-info {
            padding: 19px;
        }

        .product-category {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--blue);
            font-weight: 700;
        }

        .product-info h3 {
            margin-top: 10px;
            font-size: 14px;
            line-height: 1.6;
            font-weight: 700;
            min-height: 46px;
        }

        .product-meta {
            color: #9AA6B0;
            font-size: 11px;
            margin-top: 6px;
        }

        .product-pricing {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-top: 16px;
        }

        .product-pricing strong {
            font-size: 18px;
            color: var(--navy);
        }

        .product-pricing del {
            color: #A3AFB8;
            font-size: 11px;
        }

        .add-cart {
            margin-top: 17px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            background: var(--navy);
            color: white;
            border: 0;
            border-radius: 9px;
            padding: 12px;
            font-size: 11px;
            font-weight: 700;
            transition: .3s;
        }

        .add-cart:hover {
            background: var(--blue);
        }

        .add-cart .icon {
            width: 16px;
            height: 16px;
        }

        .empty-state {
            grid-column: 1/-1;
            text-align: center;
            background: white;
            padding: 55px 20px;
            border-radius: 15px;
            color: var(--muted);
        }

        .empty-state h3 {
            color: var(--navy);
            margin-bottom: 12px;
        }

        /* ============================
           PROMO BANNERS
        ============================ */

        .promo-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .promo-card {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 205px;
            border-radius: 18px;
            padding: 33px;
            overflow: hidden;
        }

        .promo-card:first-child {
            background: #E3EEF4;
        }

        .promo-card:last-child {
            background: #F5EBDF;
        }

        .promo-card small {
            letter-spacing: 1.5px;
            font-weight: 800;
            font-size: 10px;
            color: var(--blue);
        }

        .promo-card h3 {
            margin: 11px 0 20px;
            font-size: 25px;
            line-height: 1.35;
            color: var(--navy);
        }

        .promo-card a {
            font-size: 12px;
            font-weight: 700;
            border-bottom: 1px solid var(--navy);
            padding-bottom: 5px;
        }

        .promo-visual {
            font-size: 85px;
            transform: rotate(-12deg);
            transition: transform .4s;
        }

        .promo-card:hover .promo-visual {
            transform: rotate(-5deg) scale(1.08);
        }

        /* ============================
           ABOUT SECTION
        ============================ */

        .about-panel {
            background: var(--navy);
            border-radius: 20px;
            padding: 51px 55px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            overflow: hidden;
            position: relative;
        }

        .about-panel::after {
            content: '';
            position: absolute;
            width: 280px;
            height: 280px;
            right: -100px;
            top: -100px;
            border: 1px solid #FFFFFF22;
            border-radius: 50%;
            box-shadow:
                0 0 0 55px #FFFFFF08,
                0 0 0 110px #FFFFFF06;
        }

        .about-content {
            z-index: 1;
            max-width: 560px;
        }

        .about-content small {
            color: #A9CEE5;
            font-size: 11px;
            letter-spacing: 2px;
        }

        .about-content h2 {
            font-size: 30px;
            margin-top: 14px;
            line-height: 1.4;
        }

        .about-content p {
            margin-top: 14px;
            color: #C7DCE9;
            font-size: 13px;
            line-height: 1.9;
        }

        .about-action {
            position: relative;
            z-index: 2;
            border: 1px solid #FFFFFF66;
            padding: 14px 24px;
            border-radius: 9px;
            color: white;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            transition: .3s;
        }

        .about-action:hover {
            background: white;
            color: var(--navy);
        }

        /* ============================
           BENEFITS
        ============================ */

        .benefits {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 17px;
        }

        .benefit {
            background: white;
            padding: 28px 20px;
            border: 1px solid var(--border);
            border-radius: 15px;
            text-align: center;
        }

        .benefit-icon {
            font-size: 28px;
        }

        .benefit h4 {
            margin-top: 13px;
            color: var(--navy);
            font-size: 13px;
        }

        .benefit p {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.8;
            margin-top: 8px;
        }

        /* ============================
           FOOTER
        ============================ */

        .footer {
            background: var(--navy-dark);
            color: white;
            margin-top: 80px;
        }

        .footer-grid {
            padding: 60px 0 50px;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 60px;
        }

        .footer h3 {
            font-size: 15px;
            margin-bottom: 17px;
        }

        .footer-brand h2 {
            font-size: 24px;
            letter-spacing: -.5px;
        }

        .footer-brand p {
            max-width: 300px;
            font-size: 12px;
            line-height: 2;
            margin-top: 14px;
            color: #AFC8D9;
        }

        .footer-links a,
        .footer-links p {
            display: block;
            color: #AFC8D9;
            font-size: 12px;
            margin-bottom: 13px;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            text-align: center;
            padding: 21px;
            border-top: 1px solid #FFFFFF18;
            font-size: 11px;
            color: #AFC8D9;
        }

        /* ============================
           TOAST
        ============================ */

        .toast {
            position: fixed;
            right: 25px;
            bottom: 25px;
            z-index: 300;
            background: var(--navy);
            color: white;
            border-radius: 12px;
            padding: 15px 21px;
            font-size: 12px;
            box-shadow: 0 15px 40px #102F4B40;
            max-width: calc(100vw - 40px);
            opacity: 0;
            visibility: hidden;
            transform: translateY(15px);
            transition: .35s ease;
        }

        .toast.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* ============================
           ANIMATIONS
        ============================ */

        @@keyframes slideEnter {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .js-animate .reveal {
            opacity: 0;
            transform: translateY(25px);
            transition: opacity .75s ease, transform .75s ease;
        }

        .js-animate .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ============================
           RESPONSIVE
        ============================ */

        @@media(max-width: 950px) {
            .header-main {
                flex-wrap: wrap;
                gap: 17px;
            }

            .search-form {
                order: 3;
                max-width: none;
                flex-basis: 100%;
            }

            .hero-inner {
                padding: 65px 50px 85px;
            }

            .slider-controls {
                left: 50px;
            }

            .category-grid {
                grid-template-columns: repeat(3,1fr);
            }

            .product-grid {
                grid-template-columns: repeat(2,1fr);
            }
        }

        @@media(max-width: 600px) {
            .container {
                width: calc(100% - 28px);
            }

            .topbar-inner {
                justify-content: center;
                text-align: center;
            }

            .topbar-extra {
                display: none;
            }

            .header-main {
                gap: 13px;
                padding-top: 15px;
                padding-bottom: 15px;
            }

            .logo-mark {
                width: 40px;
                height: 40px;
            }

            .logo-name {
                font-size: 19px;
            }

            .logo-sub {
                font-size: 8px;
            }

            .header-actions {
                gap: 13px;
            }

            .header-action .icon {
                width: 19px;
                height: 19px;
            }

            .header-action span {
                font-size: 9px;
            }

            .nav-menu {
                gap: 20px;
                padding-bottom: 12px;
            }

            .hero, .hero-inner {
                min-height: 490px;
            }

            .hero {
                margin-top: 15px;
                border-radius: 17px;
                background-position: 55% center;
                background-image:
                    linear-gradient(
                        90deg,
                        rgba(6,28,48,.92),
                        rgba(9,44,76,.70)
                    ),
                    url("{{ asset('images/ummi-campus.jpeg') }}");
            }

            .hero-inner {
                padding: 82px 27px 90px;
            }

            .hero-title {
                font-size: 35px;
                letter-spacing: -1.4px;
            }

            .hero-description {
                font-size: 12px;
                line-height: 1.85;
            }

            .hero-location {
                top: 19px;
                right: 17px;
                font-size: 9px;
            }

            .slider-controls {
                left: 27px;
            }

            .slider-arrows {
                right: 15px;
            }

            .btn-primary, .btn-outline {
                font-size: 11px;
                padding: 13px 16px;
            }

            .section {
                padding-top: 52px;
            }

            .section-header h2 {
                font-size: 22px;
            }

            .category-grid {
                gap: 9px;
            }

            .category-card {
                padding: 18px 5px;
                gap: 12px;
            }

            .category-icon {
                width: 52px;
                height: 52px;
                font-size: 24px;
            }

            .category-name {
                font-size: 10px;
            }

            .product-grid {
                gap: 11px;
            }

            .product-image {
                height: 145px;
            }

            .product-info {
                padding: 12px;
            }

            .product-info h3 {
                font-size: 12px;
                min-height: 42px;
            }

            .product-pricing strong {
                font-size: 15px;
            }

            .product-badge {
                font-size: 9px;
            }

            .promo-grid,
            .benefits,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .promo-card {
                min-height: 175px;
                padding: 25px;
            }

            .promo-visual {
                font-size: 60px;
            }

            .about-panel {
                padding: 35px 26px;
                flex-direction: column;
                align-items: flex-start;
            }

            .about-content h2 {
                font-size: 23px;
            }

            .footer-grid {
                gap: 30px;
                padding: 45px 0;
            }
        }

        @@media(prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
            .js-animate .reveal {
                opacity: 1;
                transform: none;
            }
        }
    </style>
</head>

<body>

    <!-- ICON LIBRARY -->
    <svg xmlns="http://www.w3.org/2000/svg"
         style="position:absolute;width:0;height:0;overflow:hidden"
         aria-hidden="true">
        <symbol id="icon-bag" viewBox="0 0 24 24">
            <path d="M4 8h16l-1 12H5L4 8Z M9 9V6a3 3 0 0 1 6 0v3"
                  fill="none" stroke="currentColor"
                  stroke-linecap="round" stroke-linejoin="round"/>
        </symbol>
        <symbol id="icon-search" viewBox="0 0 24 24">
            <circle cx="10.8" cy="10.8" r="6.8"
                    fill="none" stroke="currentColor"/>
            <path d="m16 16 5 5"
                  fill="none" stroke="currentColor"
                  stroke-linecap="round"/>
        </symbol>
        <symbol id="icon-user" viewBox="0 0 24 24">
            <circle cx="12" cy="7.5" r="3.5"
                    fill="none" stroke="currentColor"/>
            <path d="M4.5 20v-1.5a7.5 7.5 0 0 1 15 0V20"
                  fill="none" stroke="currentColor"
                  stroke-linecap="round"/>
        </symbol>
        <symbol id="icon-heart" viewBox="0 0 24 24">
            <path d="M20.5 8.5c0 4.3-8.5 10.5-8.5 10.5S3.5 12.8 3.5 8.5a4.5 4.5 0 0 1 8.5-2 4.5 4.5 0 0 1 8.5 2Z"
                  fill="none" stroke="currentColor"
                  stroke-linejoin="round"/>
        </symbol>
        <symbol id="icon-cart" viewBox="0 0 24 24">
            <path d="M2 4h2l2.5 12H19l2-9H5"
                  fill="none" stroke="currentColor"
                  stroke-linejoin="round"
                  stroke-linecap="round"/>
            <circle cx="8.5" cy="20" r="1" fill="currentColor"/>
            <circle cx="18" cy="20" r="1" fill="currentColor"/>
        </symbol>
        <symbol id="icon-menu" viewBox="0 0 24 24">
            <path d="M4 7h16 M4 12h16 M4 17h16"
                  fill="none" stroke="currentColor"
                  stroke-linecap="round"/>
        </symbol>
        <symbol id="icon-chevron-left" viewBox="0 0 24 24">
            <path d="m15 5-7 7 7 7"
                  fill="none" stroke="currentColor"
                  stroke-linecap="round" stroke-linejoin="round"/>
        </symbol>
        <symbol id="icon-chevron-right" viewBox="0 0 24 24">
            <path d="m9 5 7 7-7 7"
                  fill="none" stroke="currentColor"
                  stroke-linecap="round" stroke-linejoin="round"/>
        </symbol>
    </svg>

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="container topbar-inner">
            <span>
                Ruang belanja digital untuk
                <strong class="topbar-highlight">komunitas mahasiswa UMMI</strong>
            </span>
            <span class="topbar-extra">
                Sukabumi, Jawa Barat &nbsp; • &nbsp; Versi Pengembangan
            </span>
        </div>
    </div>

    <!-- HEADER -->
    <header class="site-header" id="siteHeader">
        <div class="container header-main">

            <a href="{{ route('home') }}" class="logo">
                <div class="logo-mark">
                    <svg class="icon"><use href="#icon-bag"/></svg>
                </div>
                <div>
                    <div class="logo-name">FJB UMMI</div>
                    <div class="logo-sub">CAMPUS MARKETPLACE</div>
                </div>
            </a>

            <!-- SEARCH -->
            <form class="search-form" method="GET"
                  action="{{ route('home') }}">
                <svg class="icon"><use href="#icon-search"/></svg>
                <input type="search"
                       name="q"
                       value="{{ $keyword }}"
                       placeholder="Cari barang yang kamu butuhkan..."
                       aria-label="Cari produk">
                <button type="submit">Cari</button>
            </form>

            <!-- ACTIONS -->
            <div class="header-actions">
                <button class="header-action demo-action"
                        type="button"
                        data-message="Fitur akun sedang dikembangkan.">
                    <svg class="icon"><use href="#icon-user"/></svg>
                    <span>Akun</span>
                </button>

                <button class="header-action" type="button"
                        id="favoriteHeader"
                        aria-label="Lihat favorit demo">
                    <svg class="icon"><use href="#icon-heart"/></svg>
                    <span>Favorit</span>
                </button>

                <button class="header-action" type="button"
                        id="cartButton"
                        aria-label="Lihat keranjang demo">
                    <svg class="icon"><use href="#icon-cart"/></svg>
                    <span class="cart-count" id="cartCount">0</span>
                    <span>Keranjang</span>
                </button>
            </div>
        </div>

        <!-- NAVIGATION -->
        <nav class="container nav-menu" aria-label="Navigasi utama">
            <a href="#kategori" class="menu-category">
                <svg class="icon"><use href="#icon-menu"/></svg>
                Semua Kategori
            </a>
            <a href="{{ route('home') }}">Beranda</a>
            <a href="#produk">Belanja</a>
            <a href="#kategori">Kategori</a>
            <a href="#promo">Koleksi Pilihan</a>
            <a href="#tentang">Tentang Kami</a>
        </nav>
    </header>

    <main>

        <!-- HERO BANNER -->
        <section class="container" id="beranda">
            <div class="hero" id="heroSlider">

                <div class="hero-location">
                    📍 Universitas Muhammadiyah Sukabumi
                </div>

                <div class="hero-inner">
                    @foreach ($slides as $index => $slide)
                        <div
                            class="hero-slide {{ $index === 0 ? 'active' : '' }}"
                            aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
                        >
                            <span class="hero-eyebrow">
                                {{ $slide['label'] }}
                            </span>

                            <h1 class="hero-title">
                                {{ $slide['title'] }}
                                <em>{{ $slide['accent'] }}</em>
                            </h1>

                            <p class="hero-description">
                                {{ $slide['description'] }}
                            </p>

                            <div class="hero-buttons">
                                <a href="#produk" class="btn-primary">
                                    {{ $slide['button'] }} &rarr;
                                </a>
                                <a href="#tentang" class="btn-outline">
                                    Tentang FJB UMMI
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="slider-controls">
                    @foreach ($slides as $index => $slide)
                        <button
                            type="button"
                            class="slider-dot {{ $index === 0 ? 'active' : '' }}"
                            data-slide="{{ $index }}"
                            aria-label="Banner {{ $index + 1 }}"
                            aria-pressed="{{ $index === 0 ? 'true' : 'false' }}">
                        </button>
                    @endforeach
                </div>

                <div class="slider-arrows">
                    <button type="button" class="slider-arrow"
                            id="prevSlide" aria-label="Banner sebelumnya">
                        <svg class="icon">
                            <use href="#icon-chevron-left"/>
                        </svg>
                    </button>
                    <button type="button" class="slider-arrow"
                            id="nextSlide" aria-label="Banner berikutnya">
                        <svg class="icon">
                            <use href="#icon-chevron-right"/>
                        </svg>
                    </button>
                </div>

            </div>
        </section>

        <!-- CATEGORY -->
        <section class="container section reveal" id="kategori">
            <div class="section-header">
                <div>
                    <div class="section-eyebrow">SHOP BY CATEGORY</div>
                    <h2>Jelajahi Kategori</h2>
                    <p>Temukan berbagai kebutuhan yang sesuai dengan aktivitasmu.</p>
                </div>
                <a href="#produk" class="section-link">
                    Lihat Produk &rarr;
                </a>
            </div>

            <div class="category-grid">
                @foreach ($categories as $category)
                    <a
                        class="category-card"
                        href="{{ route('home', ['category' => $category['name']]) }}#produk"
                    >
                        <div class="category-icon">
                            {{ $category['icon'] }}
                        </div>
                        <span class="category-name">
                            {{ $category['name'] }}
                        </span>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- PRODUCTS -->
        <section class="container section reveal" id="produk">
            <div class="section-header">
                <div>
                    <div class="section-eyebrow">CURATED FOR STUDENTS</div>
                    <h2>Temukan Favoritmu.</h2>
                    <p>Berbagai pilihan produk untuk kebutuhan sehari-hari.</p>
                </div>

                <a href="{{ route('home') }}#produk" class="section-link">
                    Semua Produk &rarr;
                </a>
            </div>

            <!-- FILTER CATEGORY -->
            <div class="filter-row">
                <a
                    href="{{ route('home') }}#produk"
                    class="filter-chip {{ $activeCategory === '' ? 'active' : '' }}"
                >
                    Semua Produk
                </a>

                @foreach ($categories as $category)
                    <a
                        class="filter-chip {{ $activeCategory === $category['name'] ? 'active' : '' }}"
                        href="{{ route('home', ['category' => $category['name']]) }}#produk"
                    >
                        {{ $category['name'] }}
                    </a>
                @endforeach
            </div>

            <!-- PRODUCT GRID -->
            <div class="product-grid">

                @forelse ($filteredProducts as $product)
                    <article class="product-card">

                        <div class="product-image">
                            <img src="{{ $product['image'] }}"
                                 alt="{{ $product['name'] }}"
                                 loading="lazy">

                            <span class="product-badge">DEMO</span>

                            <button
                                type="button"
                                class="favorite-btn"
                                data-id="{{ $product['id'] }}"
                                data-name="{{ $product['name'] }}"
                                aria-label="Tambah {{ $product['name'] }} ke favorit"
                                aria-pressed="false"
                            >
                                <svg class="icon">
                                    <use href="#icon-heart"/>
                                </svg>
                            </button>
                        </div>

                        <div class="product-info">
                            <div class="product-category">
                                {{ $product['category'] }}
                            </div>

                            <h3>{{ $product['name'] }}</h3>

                            <div class="product-meta">
                                Produk contoh • FJB UMMI
                            </div>

                            <div class="product-pricing">
                                <strong>
                                    Rp{{ number_format($product['price'], 0, ',', '.') }}
                                </strong>
                                <del>
                                    Rp{{ number_format($product['old'], 0, ',', '.') }}
                                </del>
                            </div>

                            <button
                                type="button"
                                class="add-cart"
                                data-id="{{ $product['id'] }}"
                                data-name="{{ $product['name'] }}"
                            >
                                <svg class="icon">
                                    <use href="#icon-cart"/>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>

                    </article>

                @empty
                    <div class="empty-state">
                        <h3>Produk belum ditemukan</h3>
                        <p>
                            Belum ada produk contoh yang sesuai
                            dengan pencarian atau kategori ini.
                        </p>
                        <p style="margin-top:16px">
                            <a href="{{ route('home') }}#produk"
                               class="section-link">
                                Lihat semua produk &rarr;
                            </a>
                        </p>
                    </div>
                @endforelse

            </div>
        </section>

        <!-- PROMOTIONAL BANNERS -->
        <section class="container section reveal" id="promo">
            <div class="section-header">
                <div>
                    <div class="section-eyebrow">EXPLORE MORE</div>
                    <h2>Inspirasi untuk Mahasiswa.</h2>
                </div>
            </div>

            <div class="promo-grid">
                <div class="promo-card">
                    <div>
                        <small>FASHION & LIFESTYLE</small>
                        <h3>
                            Gaya Kampus<br>
                            Jadi Lebih Personal.
                        </h3>
                        <a href="{{ route('home', ['category' => 'Fashion']) }}#produk">
                            Jelajahi Fashion &rarr;
                        </a>
                    </div>
                    <div class="promo-visual">👟</div>
                </div>

                <div class="promo-card">
                    <div>
                        <small>CAMPUS ESSENTIALS</small>
                        <h3>
                            Lengkapi Harimu,<br>
                            Mulai dari Kuliah.
                        </h3>
                        <a href="{{ route('home', ['category' => 'Buku']) }}#produk">
                            Cari Buku &rarr;
                        </a>
                    </div>
                    <div class="promo-visual">📚</div>
                </div>
            </div>
        </section>

        <!-- ABOUT FJB -->
        <section class="container section reveal" id="tentang">
            <div class="about-panel">
                <div class="about-content">
                    <small>MORE THAN JUST A MARKETPLACE</small>
                    <h2>
                        Lebih dari Sekadar Jual Beli.
                        Ini Ruang untuk Bertumbuh.
                    </h2>
                    <p>
                        FJB UMMI dirancang sebagai platform
                        untuk mempertemukan kebutuhan,
                        kreativitas, dan peluang usaha
                        di lingkungan mahasiswa
                        Universitas Muhammadiyah Sukabumi.
                    </p>
                </div>

                <a href="#produk" class="about-action">
                    Mulai Jelajahi &rarr;
                </a>
            </div>
        </section>

        <!-- BENEFITS -->
        <section class="container section reveal">
            <div class="benefits">
                <div class="benefit">
                    <div class="benefit-icon">🎓</div>
                    <h4>Dibuat untuk Mahasiswa</h4>
                    <p>
                        Marketplace yang dirancang dengan
                        kebutuhan komunitas kampus.
                    </p>
                </div>

                <div class="benefit">
                    <div class="benefit-icon">🛍️</div>
                    <h4>Beragam Pilihan Produk</h4>
                    <p>
                        Jelajahi produk kuliah, fashion,
                        elektronik, dan kebutuhan lainnya.
                    </p>
                </div>

                <div class="benefit">
                    <div class="benefit-icon">🤝</div>
                    <h4>Dukung Usaha Mahasiswa</h4>
                    <p>
                        Menjadi ruang bagi mahasiswa
                        untuk mengembangkan usaha.
                    </p>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container footer-grid">

            <div class="footer-brand">
                <h2>FJB UMMI.</h2>
                <p>
                    Forum Jual Beli untuk komunitas mahasiswa
                    Universitas Muhammadiyah Sukabumi.
                    Satu kampus, banyak peluang.
                </p>
            </div>

            <div class="footer-links">
                <h3>Marketplace</h3>
                <a href="#produk">Jelajahi Produk</a>
                <a href="#kategori">Kategori</a>
                <a href="#promo">Koleksi Pilihan</a>
            </div>

            <div class="footer-links">
                <h3>Informasi</h3>
                <a href="#tentang">Tentang Kami</a>
                <p>Sukabumi, Jawa Barat</p>
                <p>Proyek dalam pengembangan</p>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; {{ date('Y') }} FJB UMMI —
            Campus Marketplace Project.
        </div>
    </footer>

    <!-- TOAST NOTIFICATION -->
    <div id="toast" class="toast"
         role="status" aria-live="polite"></div>

    <!-- ============================
         JAVASCRIPT
    ============================ -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // HEADER SCROLL EFFECT
            const header = document.getElementById('siteHeader');

            function updateHeader() {
                header.classList.toggle(
                    'scrolled',
                    window.scrollY > 25
                );
            }

            window.addEventListener('scroll', updateHeader, {
                passive: true
            });
            updateHeader();

            // HERO SLIDER
            const slides = [...document.querySelectorAll('.hero-slide')];
            const dots = [...document.querySelectorAll('.slider-dot')];
            const hero = document.getElementById('heroSlider');

            let currentSlide = 0;
            let sliderTimer;

            function showSlide(index) {
                currentSlide = (index + slides.length) % slides.length;

                slides.forEach((slide, i) => {
                    const active = i === currentSlide;
                    slide.classList.toggle('active', active);
                    slide.setAttribute('aria-hidden', String(!active));

                    slide.querySelectorAll('a').forEach(link => {
                        link.tabIndex = active ? 0 : -1;
                    });
                });

                dots.forEach((dot, i) => {
                    const active = i === currentSlide;
                    dot.classList.toggle('active', active);
                    dot.setAttribute('aria-pressed', String(active));
                });
            }

            const reducedMotion = window.matchMedia(
                '(prefers-reduced-motion: reduce)'
            ).matches;

            function stopSlider() {
                clearInterval(sliderTimer);
            }

            function startSlider() {
                stopSlider();

                if (reducedMotion || slides.length < 2) return;

                sliderTimer = setInterval(() => {
                    showSlide(currentSlide + 1);
                }, 6000);
            }

            document.getElementById('nextSlide')
                ?.addEventListener('click', () => {
                    showSlide(currentSlide + 1);
                    startSlider();
                });

            document.getElementById('prevSlide')
                ?.addEventListener('click', () => {
                    showSlide(currentSlide - 1);
                    startSlider();
                });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    showSlide(index);
                    startSlider();
                });
            });

            hero?.addEventListener('mouseenter', stopSlider);
            hero?.addEventListener('mouseleave', startSlider);
            hero?.addEventListener('focusin', stopSlider);
            hero?.addEventListener('focusout', () => {
                if (!hero.contains(document.activeElement)) {
                    startSlider();
                }
            });

            document.addEventListener('visibilitychange', () => {
                document.hidden ? stopSlider() : startSlider();
            });

            if (slides.length) {
                showSlide(0);
                startSlider();
            }

            // SMOOTH REVEAL ANIMATION
            if (
                !reducedMotion &&
                'IntersectionObserver' in window
            ) {
                document.body.classList.add('js-animate');

                const observer = new IntersectionObserver(
                    entries => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('visible');
                                observer.unobserve(entry.target);
                            }
                        });
                    },
                    { threshold: 0.08 }
                );

                document.querySelectorAll('.reveal')
                    .forEach(element => observer.observe(element));
            }

            // TOAST NOTIFICATION
            const toast = document.getElementById('toast');
            let toastTimer;

            function notify(message) {
                toast.textContent = message;
                toast.classList.add('show');

                clearTimeout(toastTimer);

                toastTimer = setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            }

            // DEMO LOCAL STORAGE
            function readStorage(key, fallback) {
                try {
                    const value = JSON.parse(
                        localStorage.getItem(key) || 'null'
                    );
                    return value ?? fallback;
                } catch (e) {
                    return fallback;
                }
            }

            function saveStorage(key, value) {
                try {
                    localStorage.setItem(key, JSON.stringify(value));
                } catch (e) {
                    // Data tetap disimpan selama halaman aktif.
                }
            }

            // DEMO CART
            const cartKey = 'fjb_ummi_demo_cart_v2';
            let cart = readStorage(cartKey, []);

            if (!Array.isArray(cart)) cart = [];

            function updateCartCount() {
                const count = cart.reduce(
                    (sum, item) => sum + item.quantity, 0
                );

                document.getElementById('cartCount')
                    .textContent = count;

                return count;
            }

            document.querySelectorAll('.add-cart')
                .forEach(button => {
                    button.addEventListener('click', () => {
                        const id = button.dataset.id;
                        const name = button.dataset.name;

                        const item = cart.find(p => p.id === id);

                        if (item) {
                            item.quantity += 1;
                        } else {
                            cart.push({ id, name, quantity: 1 });
                        }

                        saveStorage(cartKey, cart);
                        updateCartCount();

                        notify(name + ' berhasil ditambahkan ke keranjang demo.');
                    });
                });

            document.getElementById('cartButton')
                ?.addEventListener('click', () => {
                    notify(
                        'Keranjang demo: ' +
                        updateCartCount() +
                        ' barang. Checkout belum tersedia.'
                    );
                });

            updateCartCount();

            // FAVORITES
            const favoriteKey = 'fjb_ummi_favorites_v1';
            let favorites = readStorage(favoriteKey, []);

            if (!Array.isArray(favorites)) favorites = [];

            function updateFavorites() {
                document.querySelectorAll('.favorite-btn')
                    .forEach(button => {
                        const active = favorites.includes(button.dataset.id);
                        button.classList.toggle('active', active);
                        button.setAttribute('aria-pressed', String(active));
                    });
            }

            document.querySelectorAll('.favorite-btn')
                .forEach(button => {
                    button.addEventListener('click', () => {
                        const id = button.dataset.id;

                        if (favorites.includes(id)) {
                            favorites = favorites.filter(x => x !== id);
                            notify('Produk dihapus dari favorit demo.');
                        } else {
                            favorites.push(id);
                            notify('Produk ditambahkan ke favorit demo.');
                        }

                        saveStorage(favoriteKey, favorites);
                        updateFavorites();
                    });
                });

            document.getElementById('favoriteHeader')
                ?.addEventListener('click', () => {
                    notify(
                        'Kamu memiliki ' +
                        favorites.length +
                        ' produk favorit demo.'
                    );
                });

            updateFavorites();

            // UNFINISHED FEATURES
            document.querySelectorAll('.demo-action')
                .forEach(button => {
                    button.addEventListener('click', () => {
                        notify(button.dataset.message);
                    });
                });

        });
    </script>

</body>
</html>
