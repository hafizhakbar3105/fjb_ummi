
<!-- FOOTER FJB UMMI -->

<style>
    .fjb-footer {
        background: #102F4B;
        color: white;
        margin-top: 80px;
    }

    .fjb-footer-content {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 60px;
        padding-top: 60px;
        padding-bottom: 50px;
    }

    .fjb-footer-brand h2 {
        font-size: 25px;
        margin-bottom: 15px;
        color: white;
    }

    .fjb-footer-brand p {
        font-size: 13px;
        line-height: 1.9;
        color: #BFD5E5;
        max-width: 350px;
    }

    .fjb-footer-column h3 {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 20px;
        color: white;
    }

    .fjb-footer-column a,
    .fjb-footer-column p {
        display: block;
        margin-bottom: 13px;
        color: #BFD5E5;
        font-size: 12px;
        text-decoration: none;
        transition: 0.3s;
    }

    .fjb-footer-column a:hover {
        color: white;
        transform: translateX(4px);
    }

    .fjb-footer-bottom {
        border-top: 1px solid rgba(255,255,255,.13);
        text-align: center;
        padding: 20px;
        font-size: 11px;
        color: #BFD5E5;
    }

    @@media (max-width: 700px) {
        .fjb-footer-content {
            grid-template-columns: 1fr;
            gap: 32px;
            padding-top: 45px;
        }

        .fjb-footer {
            margin-top: 55px;
        }
    }
</style>

<footer class="fjb-footer">

    <div class="container fjb-footer-content">

        <!-- IDENTITAS WEBSITE -->
        <div class="fjb-footer-brand">

            <h2>FJB UMMI.</h2>

            <p>
                Forum Jual Beli untuk komunitas mahasiswa
                Universitas Muhammadiyah Sukabumi.
                Tempat menemukan berbagai kebutuhan
                dan mendukung usaha mahasiswa.
            </p>

        </div>

        <!-- MENU MARKETPLACE -->
        <div class="fjb-footer-column">

            <h3>Marketplace</h3>

            <a href="{{ route('home') }}">
                Beranda
            </a>

            <a href="{{ route('home') }}#produk">
                Jelajahi Produk
            </a>

            <a href="{{ route('home') }}#kategori">
                Kategori Produk
            </a>

        </div>

        <!-- INFORMASI -->
        <div class="fjb-footer-column">

            <h3>Informasi</h3>

            <a href="{{ route('home') }}#tentang">
                Tentang FJB UMMI
            </a>

            <p>Sukabumi, Jawa Barat</p>

            <p>Website dalam pengembangan</p>

        </div>

    </div>

    <div class="fjb-footer-bottom">

        &copy; {{ date('Y') }} FJB UMMI.
        Campus Marketplace Project.

    </div>

</footer>
