
<!-- NAVBAR FJB UMMI -->

<style>
    .fjb-topbar {
        background: #102F4B;
        color: #EAF3F8;
        text-align: center;
        padding: 10px 15px;
        font-size: 11px;
    }

    .fjb-navbar {
        position: sticky;
        top: 0;
        z-index: 100;
        background: rgba(255, 255, 255, 0.97);
        border-bottom: 1px solid #E8EDF1;
        box-shadow: 0 5px 25px rgba(16, 47, 75, 0.04);
    }

    .fjb-nav-main {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        padding-top: 22px;
        padding-bottom: 22px;
    }

    .fjb-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        flex-shrink: 0;
    }

    .fjb-logo-icon {
        width: 45px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #102F4B;
        color: white;
        border-radius: 13px;
    }

    .fjb-logo-text h2 {
        color: #102F4B;
        font-size: 23px;
        font-weight: 800;
        letter-spacing: -0.7px;
        margin: 0;
    }

    .fjb-logo-text p {
        color: #327DAF;
        font-size: 9px;
        letter-spacing: 1.5px;
        margin-top: 4px;
    }

    .fjb-nav-search {
        display: flex;
        flex: 1;
        max-width: 470px;
        border: 1px solid #E8EDF1;
        border-radius: 40px;
        background: #F6F9FB;
        overflow: hidden;
        transition: 0.3s ease;
    }

    .fjb-nav-search:focus-within {
        border-color: #78B7D8;
        box-shadow: 0 0 0 4px rgba(50,125,175,.09);
    }

    .fjb-nav-search input {
        flex: 1;
        width: 100%;
        min-width: 0;
        border: none;
        outline: none;
        background: transparent;
        padding: 13px 19px;
        font-size: 12px;
    }

    .fjb-nav-search button {
        border: 0;
        background: #102F4B;
        color: white;
        padding: 0 22px;
        font-size: 12px;
        font-weight: 600;
        transition: 0.3s;
    }

    .fjb-nav-search button:hover {
        background: #327DAF;
    }

    .fjb-nav-actions {
        display: flex;
        align-items: center;
        gap: 22px;
    }

    .fjb-nav-action {
        position: relative;
        display: flex;
        align-items: center;
        flex-direction: column;
        gap: 6px;
        background: none;
        border: none;
        color: #102F4B;
        font-size: 11px;
        transition: transform 0.3s;
    }

    .fjb-nav-action:hover {
        transform: translateY(-3px);
    }

    .fjb-nav-action svg {
        width: 22px;
        height: 22px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .fjb-cart-count {
        position: absolute;
        top: -7px;
        right: 0;
        background: #327DAF;
        color: white;
        font-size: 9px;
        border-radius: 20px;
        padding: 3px 6px;
    }

    .fjb-nav-links {
        display: flex;
        align-items: center;
        gap: 30px;
        padding-bottom: 16px;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .fjb-nav-links a {
        font-size: 12px;
        color: #102F4B;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: 0.3s;
    }

    .fjb-nav-links a:hover {
        color: #327DAF;
    }

    .fjb-nav-links .fjb-menu-category {
        background: #102F4B;
        color: white;
        border-radius: 8px;
        padding: 11px 17px;
    }

    .fjb-nav-links .fjb-menu-category:hover {
        background: #327DAF;
        color: white;
    }

    /* RESPONSIVE */
    @@media (max-width: 900px) {
        .fjb-nav-main {
            flex-wrap: wrap;
            gap: 15px;
        }

        .fjb-nav-search {
            order: 3;
            flex-basis: 100%;
            max-width: 100%;
        }

        .fjb-nav-actions {
            gap: 16px;
        }
    }

    @@media (max-width: 600px) {
        .fjb-logo-text h2 {
            font-size: 19px;
        }

        .fjb-logo-icon {
            width: 39px;
            height: 39px;
        }

        .fjb-nav-action {
            font-size: 9px;
        }

        .fjb-nav-actions {
            gap: 12px;
        }

        .fjb-nav-links {
            gap: 20px;
        }
    }
</style>

<!-- TOP BAR -->
<div class="fjb-topbar">
    🎓 Marketplace Mahasiswa UMMI
    &nbsp; | &nbsp;
    Belanja Mudah & Dukung Usaha Mahasiswa
</div>

<!-- HEADER -->
<header class="fjb-navbar">

    <div class="container fjb-nav-main">

        <!-- LOGO -->
        <a href="{{ route('home') }}" class="fjb-logo">

            <div class="fjb-logo-icon">
                <svg width="24" height="24"
                     viewBox="0 0 24 24">
                    <path
                        d="M4 8h16l-1 12H5L4 8Z
                           M9 9V6a3 3 0 0 1 6 0v3"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </div>

            <div class="fjb-logo-text">
                <h2>FJB UMMI</h2>
                <p>CAMPUS MARKETPLACE</p>
            </div>

        </a>

        <!-- PENCARIAN -->
        <form
            class="fjb-nav-search"
            action="{{ route('products') }}"
            method="GET"
        >

            <input
                type="search"
                name="q"
                value="{{ request('q') }}"
                placeholder="Cari produk mahasiswa..."
                aria-label="Cari produk"
            >

            <button type="submit">
                Cari
            </button>

        </form>

        <!-- MENU AKUN -->
        <div class="fjb-nav-actions">

            <!-- AKUN -->
            <button
                type="button"
                class="fjb-nav-action"
                onclick="alert('Fitur login akan segera dibuat.')"
            >
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="7.5" r="3.5"/>
                    <path d="M4.5 20v-1.5a7.5 7.5 0 0 1 15 0V20"/>
                </svg>
                <span>Akun</span>
            </button>

            <!-- FAVORIT -->
            <button
                type="button"
                class="fjb-nav-action"
                onclick="alert('Halaman favorit sedang dikembangkan.')"
            >
                <svg viewBox="0 0 24 24">
                    <path d="M20.5 8.5c0 4.3-8.5 10.5-8.5 10.5S3.5 12.8 3.5 8.5a4.5 4.5 0 0 1 8.5-2 4.5 4.5 0 0 1 8.5 2Z"/>
                </svg>
                <span>Favorit</span>
            </button>

            
            <!-- KERANJANG -->
            <a
                href="{{ route('cart') }}"
                class="fjb-nav-action"
                aria-label="Buka Keranjang Belanja"
            >
                <svg viewBox="0 0 24 24">
                    <path d="M2 4h2l2.5 12H19l2-9H5"/>
                    <circle cx="8.5" cy="20" r="1"/>
                    <circle cx="18" cy="20" r="1"/>
                </svg>

                <span>Keranjang</span>
                <span id="cartCount">0</span>
            </a>


        </div>

    </div>

    <!-- NAVIGATION MENU -->
    <nav class="container fjb-nav-links">

        <a href="{{ route('home') }}#kategori"
           class="fjb-menu-category">
            ☰ Semua Kategori
        </a>

        <a href="{{ route('home') }}">
            Beranda
        </a>

        <a href="{{ route('products') }}">
            Belanja
        </a>

        <a href="{{ route('home') }}#kategori">
            Kategori
        </a>

        <a href="{{ route('home') }}#tentang">
            Tentang Kami
        </a>

    </nav>
    
<script>
document.addEventListener('DOMContentLoaded', function () {

    const cartCount = document.getElementById('cartCount');
    const cartKey = 'fjb_ummi_demo_cart_v2';

    function updateNavbarCart() {
        try {
            const data = JSON.parse(
                localStorage.getItem(cartKey) || '[]'
            );

            const items = Array.isArray(data) ? data : [];

            const total = items.reduce((sum, item) => {
                return sum + Math.max(
                    0,
                    Number(item.quantity) || 0
                );
            }, 0);

            if (cartCount) {
                cartCount.textContent = total;
            }

        } catch (error) {
            if (cartCount) cartCount.textContent = '0';
        }
    }

    updateNavbarCart();

    window.addEventListener('storage', updateNavbarCart);
    window.addEventListener('fjb-cart-updated', updateNavbarCart);

});
</script>

    

</header>
