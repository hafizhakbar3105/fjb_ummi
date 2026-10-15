
@extends('layouts.app')

@section('title', 'Keranjang Belanja - FJB UMMI')

@php
    /*
    | DATA PRODUK DEMO
    | ID disamakan dengan katalog dan detail produk.
    | Harga di sini hanya untuk simulasi.
    */

    $productCatalog = [
        1 => [
            'name' => 'Headphone Wireless Premium',
            'category' => 'Elektronik',
            'price' => 175000,
            'stock' => 12,
            'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=700&auto=format&fit=crop',
        ],
        2 => [
            'name' => 'Hoodie Casual Mahasiswa',
            'category' => 'Fashion',
            'price' => 135000,
            'stock' => 18,
            'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=700&auto=format&fit=crop',
        ],
        3 => [
            'name' => 'Buku Bacaan dan Referensi',
            'category' => 'Buku',
            'price' => 45000,
            'stock' => 9,
            'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=700&auto=format&fit=crop',
        ],
        4 => [
            'name' => 'Tumbler Minimalis',
            'category' => 'Perlengkapan',
            'price' => 55000,
            'stock' => 20,
            'image' => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=700&auto=format&fit=crop',
        ],
        5 => [
            'name' => 'Keyboard Mechanical RGB',
            'category' => 'Elektronik',
            'price' => 250000,
            'stock' => 7,
            'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=700&auto=format&fit=crop',
        ],
        6 => [
            'name' => 'Tas Fashion Wanita',
            'category' => 'Fashion',
            'price' => 89000,
            'stock' => 14,
            'image' => 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=700&auto=format&fit=crop',
        ],
        7 => [
            'name' => 'Cookies Cokelat Homemade',
            'category' => 'Makanan',
            'price' => 25000,
            'stock' => 25,
            'image' => 'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?w=700&auto=format&fit=crop',
        ],
        8 => [
            'name' => 'Notebook Catatan Kuliah',
            'category' => 'Buku',
            'price' => 28000,
            'stock' => 30,
            'image' => 'https://images.unsplash.com/photo-1531346878377-a5be20888e57?w=700&auto=format&fit=crop',
        ],
    ];
@endphp

@push('styles')
<style>
    /* ==================================
       CART PAGE FJB UMMI
    ================================== */

    .cart-page {
        padding-bottom: 70px;
        color: #23384A;
    }

    .cart-breadcrumb {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 27px 0;
        font-size: 12px;
        color: #8B9BAB;
    }

    .cart-breadcrumb a {
        color: #327DAF;
    }

    .cart-breadcrumb a:hover {
        color: #102F4B;
    }

    /* PAGE HEADER */

    .cart-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 27px;
    }

    .cart-eyebrow {
        color: #327DAF;
        font-weight: 700;
        font-size: 10px;
        letter-spacing: 2px;
        margin-bottom: 9px;
    }

    .cart-heading h1 {
        color: #102F4B;
        font-size: clamp(25px, 3vw, 34px);
        letter-spacing: -.7px;
    }

    .cart-heading p {
        color: #82909D;
        font-size: 12px;
        margin-top: 9px;
        line-height: 1.7;
    }

    .cart-continue {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border: 1px solid #DCE7EF;
        color: #102F4B;
        background: white;
        border-radius: 9px;
        padding: 12px 17px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        transition: .3s;
    }

    .cart-continue:hover {
        background: #EAF3F8;
    }

    /* MAIN LAYOUT */

    .cart-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 325px;
        align-items: start;
        gap: 24px;
    }

    .cart-left {
        min-width: 0;
    }

    .cart-card {
        background: white;
        border: 1px solid #E8EDF1;
        border-radius: 16px;
        overflow: hidden;
    }

    /* CART HEADER */

    .cart-list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 22px 24px;
        border-bottom: 1px solid #E8EDF1;
    }

    .cart-list-header h2 {
        color: #102F4B;
        font-size: 16px;
    }

    .cart-list-header p {
        margin-top: 6px;
        font-size: 11px;
        color: #82909D;
    }

    .cart-count-label {
        border-radius: 25px;
        padding: 9px 13px;
        font-size: 11px;
        font-weight: 700;
        color: #327DAF;
        background: #EAF3F8;
    }

    .cart-select-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 16px 24px;
        background: #F8FBFD;
        border-bottom: 1px solid #E8EDF1;
    }

    .cart-checkbox-label {
        display: flex;
        align-items: center;
        gap: 11px;
        cursor: pointer;
        color: #536B7E;
        font-size: 12px;
        font-weight: 600;
    }

    .cart-checkbox,
    .cart-select-all {
        width: 17px;
        height: 17px;
        accent-color: #102F4B;
        cursor: pointer;
    }

    .cart-selected-info {
        font-size: 11px;
        color: #82909D;
    }

    /* ITEM PRODUCT */

    .cart-item {
        display: grid;
        grid-template-columns: 20px 105px minmax(0, 1fr);
        gap: 19px;
        align-items: center;
        padding: 23px 24px;
        border-bottom: 1px solid #EEF2F5;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-image {
        display: block;
        width: 105px;
        height: 105px;
        border-radius: 11px;
        overflow: hidden;
        background: #F1F5F8;
    }

    .cart-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cart-item-body {
        min-width: 0;
    }

    .cart-item-category {
        color: #327DAF;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    .cart-item-name {
        display: block;
        margin-top: 7px;
        color: #102F4B;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.5;
    }

    .cart-item-name:hover {
        color: #327DAF;
    }

    .cart-item-location {
        font-size: 11px;
        color: #91A0AD;
        margin-top: 6px;
    }

    .cart-item-bottom {
        display: flex;
        flex-wrap: wrap;
        align-items: end;
        justify-content: space-between;
        gap: 15px;
        margin-top: 15px;
    }

    .cart-item-price {
        color: #102F4B;
        font-size: 16px;
        font-weight: 800;
    }

    .cart-item-unit {
        display: block;
        color: #A0ACB6;
        font-size: 10px;
        font-weight: 400;
        margin-top: 5px;
    }

    /* QUANTITY */

    .cart-item-tools {
        display: flex;
        align-items: center;
        gap: 17px;
    }

    .cart-quantity {
        display: flex;
        align-items: center;
        height: 35px;
        border: 1px solid #DCE6EC;
        border-radius: 8px;
        overflow: hidden;
    }

    .cart-quantity button {
        width: 34px;
        height: 100%;
        border: 0;
        background: #F6F9FB;
        color: #102F4B;
        font-size: 17px;
    }

    .cart-quantity button:hover {
        background: #EAF3F8;
    }

    .cart-quantity span {
        display: grid;
        place-items: center;
        min-width: 35px;
        height: 100%;
        font-size: 12px;
        font-weight: 700;
        color: #102F4B;
    }

    .cart-remove {
        background: none;
        border: 0;
        color: #C56F7A;
        font-size: 11px;
        font-weight: 700;
    }

    .cart-remove:hover {
        color: #A94251;
        text-decoration: underline;
    }

    /* EMPTY CART */

    .cart-empty {
        padding: 75px 24px;
        text-align: center;
    }

    .cart-empty[hidden] {
        display: none;
    }

    .cart-empty-icon {
        width: 88px;
        height: 88px;
        display: grid;
        place-items: center;
        margin: 0 auto 22px;
        border-radius: 50%;
        background: #EAF3F8;
        font-size: 36px;
    }

    .cart-empty h3 {
        font-size: 20px;
        color: #102F4B;
    }

    .cart-empty p {
        max-width: 330px;
        margin: 12px auto 0;
        color: #82909D;
        font-size: 12px;
        line-height: 1.9;
    }

    .cart-empty-link {
        display: inline-block;
        background: #102F4B;
        color: white;
        padding: 13px 23px;
        border-radius: 9px;
        margin-top: 24px;
        font-size: 12px;
        font-weight: 700;
    }

    .cart-empty-link:hover {
        background: #327DAF;
    }

    /* ORDER SUMMARY */

    .cart-summary {
        background: white;
        border: 1px solid #E8EDF1;
        border-radius: 16px;
        padding: 25px;
        position: sticky;
        top: 145px;
    }

    .cart-summary h2 {
        color: #102F4B;
        font-size: 18px;
        margin-bottom: 23px;
    }

    .cart-summary-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 18px;
        font-size: 12px;
    }

    .cart-summary-row span {
        color: #8193A1;
    }

    .cart-summary-row strong {
        color: #31485B;
        font-weight: 700;
        text-align: right;
    }

    .cart-summary-divider {
        border: 0;
        border-top: 1px solid #E8EDF1;
        margin: 22px 0;
    }

    .cart-total-label {
        font-size: 13px;
        color: #102F4B !important;
        font-weight: 700;
    }

    .cart-total {
        font-size: 23px;
        color: #102F4B !important;
        font-weight: 800 !important;
    }

    .cart-checkout {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        width: 100%;
        padding: 15px 12px;
        border: 0;
        border-radius: 10px;
        background: #102F4B;
        color: white;
        font-size: 12px;
        font-weight: 700;
        transition: .3s;
    }

    .cart-checkout:not(:disabled):hover {
        background: #327DAF;
    }

    .cart-checkout:disabled {
        background: #B1C0CB;
        cursor: not-allowed;
    }

    .cart-summary-note {
        color: #91A0AD;
        font-size: 11px;
        line-height: 1.8;
        text-align: center;
        margin-top: 15px;
    }

    /* INFORMATION */

    .cart-information {
        margin-top: 22px;
        border-radius: 15px;
        background: #EAF3F8;
        padding: 23px;
    }

    .cart-information h3 {
        font-size: 13px;
        color: #102F4B;
    }

    .cart-information p {
        margin-top: 10px;
        font-size: 11px;
        color: #648197;
        line-height: 1.9;
    }

    /* TOAST */

    .cart-toast {
        position: fixed;
        bottom: 25px;
        right: 25px;
        z-index: 400;
        max-width: calc(100vw - 40px);
        background: #102F4B;
        color: white;
        padding: 15px 21px;
        border-radius: 11px;
        font-size: 12px;
        box-shadow: 0 15px 35px #102F4B30;
        opacity: 0;
        visibility: hidden;
        transform: translateY(15px);
        transition: .3s ease;
    }

    .cart-toast.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    /* RESPONSIVE */

    @@media(max-width: 950px) {
        .cart-layout {
            grid-template-columns: 1fr;
        }

        .cart-summary {
            position: static;
        }
    }

    @@media(max-width: 600px) {
        .cart-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .cart-item {
            grid-template-columns: 18px 80px minmax(0,1fr);
            gap: 11px;
            padding: 17px 12px;
        }

        .cart-item-image {
            width: 80px;
            height: 90px;
        }

        .cart-item-name {
            font-size: 12px;
        }

        .cart-item-price {
            font-size: 13px;
        }

        .cart-item-tools {
            gap: 10px;
        }

        .cart-quantity {
            height: 31px;
        }

        .cart-quantity button {
            width: 28px;
        }

        .cart-quantity span {
            min-width: 27px;
        }

        .cart-remove {
            font-size: 10px;
        }

        .cart-list-header,
        .cart-select-bar {
            padding: 18px 14px;
        }

        .cart-summary {
            padding: 21px;
        }
    }

    @@media(prefers-reduced-motion: reduce) {
        .cart-toast,
        .cart-checkout {
            transition: none;
        }
    }
</style>
@endpush

@section('content')

<div class="cart-page">

    <div class="container">

        <!-- BREADCRUMB -->
        <nav class="cart-breadcrumb"
             aria-label="Navigasi halaman">

            <a href="{{ route('home') }}">Beranda</a>
            <span>›</span>

            <a href="{{ route('products') }}">Katalog</a>
            <span>›</span>

            <span>Keranjang Belanja</span>

        </nav>

        <!-- TITLE -->
        <div class="cart-heading">

            <div>
                <div class="cart-eyebrow">
                    YOUR SHOPPING CART
                </div>

                <h1>Keranjang Belanja.</h1>

                <p>
                    Periksa kembali produk yang ingin
                    kamu beli sebelum melanjutkan.
                </p>
            </div>

            <a href="{{ route('products') }}"
               class="cart-continue">
                ← Lanjut Belanja
            </a>

        </div>

        <!-- CART LAYOUT -->
        <div class="cart-layout">

            <!-- BAGIAN KIRI -->
            <div class="cart-left">

                <section class="cart-card">

                    <!-- HEADER KERANJANG -->
                    <div class="cart-list-header">

                        <div>
                            <h2>Produk di Keranjang</h2>
                            <p>
                                Kelola barang yang
                                sudah kamu tambahkan.
                            </p>
                        </div>

                        <span class="cart-count-label"
                              id="cartItemCount">
                            0 Produk
                        </span>

                    </div>

                    <!-- PILIH SEMUA -->
                    <div class="cart-select-bar"
                         id="cartSelectBar">

                        <label class="cart-checkbox-label">

                            <input
                                type="checkbox"
                                id="selectAll"
                                class="cart-select-all"
                                checked
                            >

                            Pilih Semua

                        </label>

                        <span class="cart-selected-info"
                              id="selectedInfo">
                            0 produk dipilih
                        </span>

                    </div>

                    <!-- DAFTAR PRODUK -->
                    <div id="cartItems"></div>

                    <!-- KERANJANG KOSONG -->
                    <div class="cart-empty"
                         id="cartEmpty"
                         hidden>

                        <div class="cart-empty-icon">
                            🛒
                        </div>

                        <h3>Keranjangmu Masih Kosong</h3>

                        <p>
                            Belum ada produk yang dimasukkan.
                            Yuk, jelajahi berbagai kebutuhan
                            di FJB UMMI!
                        </p>

                        <a href="{{ route('products') }}"
                           class="cart-empty-link">
                            Jelajahi Produk →
                        </a>

                    </div>

                </section>

                <!-- INFORMASI -->
                <div class="cart-information">

                    <h3>💙 Belanja di FJB UMMI</h3>

                    <p>
                        Ini adalah keranjang belanja versi
                        pengembangan. Produk dan harga masih
                        berupa data demo, sehingga belum ada
                        pembayaran maupun pesanan sungguhan.
                    </p>

                </div>

            </div>

            <!-- BAGIAN KANAN -->
            <aside class="cart-summary">

                <h2>Ringkasan Belanja</h2>

                <div class="cart-summary-row">
                    <span>Jumlah Barang</span>

                    <strong id="summaryQuantity">
                        0 Barang
                    </strong>
                </div>

                <div class="cart-summary-row">
                    <span>Subtotal Produk</span>

                    <strong id="summarySubtotal">
                        Rp0
                    </strong>
                </div>

                <div class="cart-summary-row">
                    <span>Pengiriman</span>

                    <strong>Belum dihitung</strong>
                </div>

                <hr class="cart-summary-divider">

                <div class="cart-summary-row">
                    <span class="cart-total-label">
                        Total Produk
                    </span>

                    <strong class="cart-total"
                            id="summaryTotal">
                        Rp0
                    </strong>
                </div>

                <button
                    type="button"
                    class="cart-checkout"
                    id="checkoutButton"
                    disabled
                >
                    Lanjut ke Checkout →
                </button>

                <p class="cart-summary-note">
                    Total belum termasuk pengiriman.
                    Checkout dan pembayaran belum tersedia.
                </p>

            </aside>

        </div>

    </div>

</div>

<!-- NOTIFIKASI -->
<div class="cart-toast"
     id="cartToast"
     role="status"
     aria-live="polite"></div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    ==========================================
    PRODUK DEMO DARI BLADE
    ==========================================
    */

    const catalog = @json($productCatalog);

    const cartKey = 'fjb_ummi_demo_cart_v2';

    const cartItems = document.getElementById('cartItems');
    const cartEmpty = document.getElementById('cartEmpty');
    const selectAll = document.getElementById('selectAll');
    const selectBar = document.getElementById('cartSelectBar');

    const detailBaseUrl = @json(url('/produk'));

    const rupiah = value => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(value);
    };

    /*
    ==========================================
    LOCAL STORAGE
    ==========================================
    */

    function loadCart() {
        try {
            const saved = JSON.parse(
                localStorage.getItem(cartKey) || '[]'
            );

            return Array.isArray(saved) ? saved : [];
        } catch (error) {
            return [];
        }
    }

    function saveCart() {
        try {
            localStorage.setItem(
                cartKey,
                JSON.stringify(cart)
            );
        } catch (error) {
            notify('Penyimpanan browser tidak tersedia.');
        }
    }

    /*
    ==========================================
    NORMALISASI DATA KERANJANG
    ==========================================
    */

    function normalizeCart(items) {
        const combined = new Map();

        items.forEach(item => {
            const id = String(item?.id ?? '');
            const product = catalog[id];

            if (!product) return;

            const quantity = Math.max(
                1,
                Math.min(
                    product.stock,
                    Math.floor(Number(item.quantity) || 1)
                )
            );

            const previous = combined.get(id) || 0;

            combined.set(
                id,
                Math.min(product.stock, previous + quantity)
            );
        });

        return Array.from(combined.entries()).map(
            ([id, quantity]) => ({
                id,
                name: catalog[id].name,
                quantity
            })
        );
    }

    let cart = normalizeCart(loadCart());

    // Secara default semua produk dipilih.
    let selectedIds = new Set(
        cart.map(item => item.id)
    );

    /*
    ==========================================
    NOTIFIKASI
    ==========================================
    */

    const toast = document.getElementById('cartToast');
    let toastTimer;

    function notify(message) {
        toast.textContent = message;
        toast.classList.add('show');

        clearTimeout(toastTimer);

        toastTimer = setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }

    /*
    ==========================================
    RENDER ITEM KERANJANG
    ==========================================
    */

    function renderCart() {

        if (cart.length === 0) {
            cartItems.innerHTML = '';
            cartEmpty.hidden = false;
            selectBar.hidden = true;
        } else {
            cartEmpty.hidden = true;
            selectBar.hidden = false;

            cartItems.innerHTML = cart.map(item => {

                const product = catalog[item.id];

                const selected = selectedIds.has(item.id);

                return `
                    <article class="cart-item">

                        <input
                            type="checkbox"
                            class="cart-checkbox"
                            data-select-id="${item.id}"
                            ${selected ? 'checked' : ''}
                            aria-label="Pilih ${product.name}"
                        >

                        <a
                            href="${detailBaseUrl}/${item.id}"
                            class="cart-item-image"
                        >
                            <img
                                src="${product.image}"
                                alt="${product.name}"
                                loading="lazy"
                            >
                        </a>

                        <div class="cart-item-body">

                            <span class="cart-item-category">
                                ${product.category}
                            </span>

                            <a
                                class="cart-item-name"
                                href="${detailBaseUrl}/${item.id}"
                            >
                                ${product.name}
                            </a>

                            <div class="cart-item-location">
                                📍 Sukabumi · Produk Demo
                            </div>

                            <div class="cart-item-bottom">

                                <div class="cart-item-price">

                                    ${rupiah(product.price)}

                                    <span class="cart-item-unit">
                                        Harga per barang
                                    </span>

                                </div>

                                <div class="cart-item-tools">

                                    <div class="cart-quantity">

                                        <button
                                            type="button"
                                            data-action="minus"
                                            data-id="${item.id}"
                                            aria-label="Kurangi jumlah ${product.name}"
                                        >−</button>

                                        <span>${item.quantity}</span>

                                        <button
                                            type="button"
                                            data-action="plus"
                                            data-id="${item.id}"
                                            aria-label="Tambah jumlah ${product.name}"
                                        >+</button>

                                    </div>

                                    <button
                                        type="button"
                                        class="cart-remove"
                                        data-action="remove"
                                        data-id="${item.id}"
                                    >
                                        Hapus
                                    </button>

                                </div>

                            </div>

                        </div>

                    </article>
                `;

            }).join('');
        }

        updateSummary();
    }

    /*
    ==========================================
    HITUNG TOTAL BELANJA
    ==========================================
    */

    function updateSummary() {

        const selectedItems = cart.filter(
            item => selectedIds.has(item.id)
        );

        const totalQuantity = selectedItems.reduce(
            (sum, item) => sum + item.quantity, 0
        );

        const subtotal = selectedItems.reduce(
            (sum, item) => {
                return sum +
                    catalog[item.id].price * item.quantity;
            },
            0
        );

        document.getElementById('cartItemCount')
            .textContent = cart.length + ' Produk';

        document.getElementById('selectedInfo')
            .textContent =
                selectedItems.length + ' produk dipilih';

        document.getElementById('summaryQuantity')
            .textContent = totalQuantity + ' Barang';

        document.getElementById('summarySubtotal')
            .textContent = rupiah(subtotal);

        document.getElementById('summaryTotal')
            .textContent = rupiah(subtotal);

        const checkoutButton =
            document.getElementById('checkoutButton');

        checkoutButton.disabled = selectedItems.length === 0;

        const allSelected =
            cart.length > 0 &&
            selectedItems.length === cart.length;

        selectAll.checked = allSelected;

        selectAll.indeterminate =
            selectedItems.length > 0 && !allSelected;

        // Perbarui badge keranjang pada navbar jika tersedia.
        const navbarCount =
            document.getElementById('cartCount');

        if (navbarCount) {
            const totalCart = cart.reduce(
                (sum, item) => sum + item.quantity, 0
            );

            navbarCount.textContent = totalCart;
        }
    }

    /*
    ==========================================
    TAMBAH / KURANGI JUMLAH
    ==========================================
    */

    function changeQuantity(id, amount) {

        const item = cart.find(
            row => row.id === id
        );

        if (!item) return;

        const stock = catalog[id].stock;
        const nextQuantity = item.quantity + amount;

        if (nextQuantity < 1) {
            notify('Gunakan tombol Hapus untuk menghapus produk.');
            return;
        }

        if (nextQuantity > stock) {
            notify('Jumlah melebihi stok demo.');
            return;
        }

        item.quantity = nextQuantity;

        saveCart();
        renderCart();
    }

    /*
    ==========================================
    HAPUS PRODUK
    ==========================================
    */

    function removeProduct(id) {

        const product = catalog[id];

        cart = cart.filter(
            item => item.id !== id
        );

        selectedIds.delete(id);

        saveCart();
        renderCart();

        notify(
            product.name + ' dihapus dari keranjang.'
        );
    }

    /*
    ==========================================
    EVENT TOMBOL ITEM
    ==========================================
    */

    cartItems.addEventListener('click', function(event) {

        const button = event.target.closest(
            'button[data-action]'
        );

        if (!button) return;

        const id = button.dataset.id;
        const action = button.dataset.action;

        if (action === 'plus') {
            changeQuantity(id, 1);
        }

        if (action === 'minus') {
            changeQuantity(id, -1);
        }

        if (action === 'remove') {
            removeProduct(id);
        }
    });

    /*
    ==========================================
    PILIH PRODUK
    ==========================================
    */

    cartItems.addEventListener('change', function(event) {

        if (!event.target.matches('[data-select-id]')) {
            return;
        }

        const id = event.target.dataset.selectId;

        if (event.target.checked) {
            selectedIds.add(id);
        } else {
            selectedIds.delete(id);
        }

        updateSummary();
    });

    /*
    ==========================================
    PILIH SEMUA
    ==========================================
    */

    selectAll.addEventListener('change', function() {

        if (this.checked) {
            selectedIds = new Set(
                cart.map(item => item.id)
            );
        } else {
            selectedIds.clear();
        }

        renderCart();
    });

    /*
    ==========================================
    CHECKOUT DEMO
    ==========================================
    */

    document.getElementById('checkoutButton')
        .addEventListener('click', function() {

            const selectedItems = cart.filter(
                item => selectedIds.has(item.id)
            );

            if (selectedItems.length === 0) return;

            notify(
                'Checkout akan dibuat pada tahap berikutnya. ' +
                'Belum ada transaksi yang diproses.'
            );
        });

    /*
    ==========================================
    TAMPILKAN KERANJANG
    ==========================================
    */

    renderCart();

});
</script>
@endpush
