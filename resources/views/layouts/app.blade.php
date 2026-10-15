
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'FJB UMMI - Marketplace Mahasiswa')
    </title>

    <!-- Google Fonts -->
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- CSS UTAMA -->
    <style>
        :root {
            --primary: #102F4B;
            --secondary: #327DAF;
            --sky: #78B7D8;
            --light-blue: #EAF3F8;
            --background: #F8FAFB;
            --white: #FFFFFF;
            --text: #23384A;
            --muted: #82909D;
            --border: #E8EDF1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--background);
            color: var(--text);
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

        .container {
            width: min(1220px, calc(100% - 48px));
            margin: auto;
        }

        
        /* HERO BANNER FJB UMMI */

        .hero-banner {
            min-height: 450px;
            margin-top: 25px;
            padding: 75px 65px;

            display: flex;
            align-items: center;

            background:
                linear-gradient(
                    90deg,
                    rgba(8, 35, 59, 0.94),
                    rgba(12, 57, 94, 0.73),
                    rgba(20, 83, 130, 0.12)
                ),
                url("/images/ummi-campus.jpeg");

            background-size: cover;
            background-position: center;

            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 18px 45px rgba(16, 47, 75, 0.12);
        }

        .hero-content {
            max-width: 600px;
            color: white;
        }

        .hero-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 2px;
            color: #B9DDF2;
        }

        .hero-content h1 {
            font-size: clamp(32px, 4vw, 54px);
            line-height: 1.2;
            margin: 20px 0;
        }

        .hero-content p {
            font-size: 15px;
            line-height: 1.9;
            color: #E4EDF5;
        }

        .hero-button {
            display: inline-block;
            margin-top: 25px;
            padding: 14px 25px;
            background: white;
            color: #102F4B;
            border-radius: 9px;
            font-weight: 700;
            transition: 0.3s ease;
        }

        .hero-button:hover {
            background: #EAF3F8;
            transform: translateY(-3px);
        }

        @media (max-width: 600px) {
            .hero-banner {
                min-height: 430px;
                padding: 55px 25px;
            }
        }


        /* ==========================
        CATEGORY SECTION FJB UMMI
        ========================== */

        .section {
            padding-top: 65px;
            padding-bottom: 25px;
        }

        .section h2 {
            font-size: 27px;
            font-weight: 700;
            color: #102F4B;
            margin-bottom: 25px;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 16px;
        }

        .category-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 15px;

            background: #FFFFFF;
            border: 1px solid #E8EDF1;
            border-radius: 18px;

            padding: 26px 12px;
            text-decoration: none;

            transition: all 0.35s ease;
        }

        .category-card:hover {
            transform: translateY(-6px);
            border-color: #B8D8EC;
            box-shadow: 0 14px 35px rgba(16, 47, 75, 0.09);
        }

        .category-icon {
            width: 68px;
            height: 68px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #EAF3F8;
            border-radius: 50%;

            font-size: 29px;
            transition: transform 0.35s ease;
        }

        .category-card:hover .category-icon {
            transform: scale(1.08);
        }

        .category-name {
            font-size: 13px;
            font-weight: 600;
            color: #102F4B;
            text-align: center;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .category-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 600px) {
            .category-grid {
                gap: 10px;
            }

            .category-card {
                padding: 20px 8px;
            }

            .category-icon {
                width: 54px;
                height: 54px;
                font-size: 24px;
            }

            .category-name {
                font-size: 11px;
            }
        }


        
        /* ==================================
        PRODUCT CARD - FJB UMMI
        ================================== */

        .product-grid,
        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
        }

        /* KARTU PRODUK */
        .fjb-product-card {
            background: #FFFFFF;
            border: 1px solid #E8EDF1;
            border-radius: 18px;
            overflow: hidden;
            transition: all 0.35s ease;
        }

        .fjb-product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(16, 47, 75, 0.10);
        }

        /* GAMBAR */
        .fjb-product-image {
            position: relative;
            width: 100%;
            height: 210px;
            overflow: hidden;
            background: #F1F5F8;
        }

        .fjb-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .fjb-product-card:hover .fjb-product-image img {
            transform: scale(1.07);
        }

        /* DISKON */
        .fjb-discount {
            position: absolute;
            top: 13px;
            left: 13px;
            padding: 7px 11px;
            font-size: 11px;
            font-weight: 700;
            color: #FFFFFF;
            background: #D76D70;
            border-radius: 7px;
        }

        /* FAVORIT */
        .fjb-favorite {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 50%;
            background: #FFFFFF;
            color: #102F4B;
            font-size: 24px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .fjb-favorite:hover {
            color: #D76D70;
            transform: scale(1.1);
        }

        .fjb-favorite.active {
            color: #D76D70;
        }

        /* INFORMASI PRODUK */
        .fjb-product-content {
            padding: 19px;
        }

        .fjb-product-category {
            font-size: 11px;
            font-weight: 700;
            color: #327DAF;
            letter-spacing: 0.5px;
        }

        .fjb-product-title {
            font-size: 14px;
            line-height: 1.6;
            color: #102F4B;
            margin-top: 9px;
            min-height: 45px;
        }

        .fjb-product-location {
            color: #8899A7;
            font-size: 11px;
            margin-top: 9px;
        }

        /* HARGA PRODUK */
        .fjb-product-price {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-top: 15px;
        }

        .fjb-product-price strong {
            font-size: 18px;
            color: #102F4B;
        }

        .fjb-product-price del {
            font-size: 12px;
            color: #A5B0BA;
        }

        /* TOMBOL KERANJANG */
        .fjb-add-cart {
            width: 100%;
            border: none;
            border-radius: 9px;
            background: #102F4B;
            color: white;
            margin-top: 17px;
            padding: 13px 10px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .fjb-add-cart:hover {
            background: #327DAF;
        }

        /* RESPONSIVE TABLET */
        @@media (max-width: 900px) {
            .product-grid,
            .products-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        /* RESPONSIVE SMARTPHONE */
        @@media (max-width: 600px) {
            .product-grid,
            .products-grid {
                gap: 12px;
            }

            .fjb-product-image {
                height: 145px;
            }

            .fjb-product-content {
                padding: 12px;
            }

            .fjb-product-title {
                font-size: 12px;
            }

            .fjb-product-price strong {
                font-size: 15px;
            }

            .fjb-add-cart {
                font-size: 10px;
                padding: 11px 5px;
            }
        }


    </style>

    @stack('styles')

</head>

<body>

    <!-- NAVBAR -->
    <x-navbar />

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <x-footer />

    <!-- JAVASCRIPT UTAMA -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('FJB UMMI Marketplace Ready!');
        });
    </script>

    @stack('scripts')

</body>
</html>
