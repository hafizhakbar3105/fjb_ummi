
@props(['slides' => []])

<section class="container" id="beranda">

    <div class="hero-banner">

        @forelse ($slides as $slide)

            <div class="hero-content">

                <span class="hero-label">
                    {{ $slide['label'] ?? 'FJB UMMI' }}
                </span>

                <h1>
                    {{ $slide['title'] ?? 'Marketplace Mahasiswa' }}
                </h1>

                <p>
                    {{ $slide['description'] ?? '' }}
                </p>

                <a href="{{ $slide['target'] ?? '#produk' }}"
                   class="hero-button">
                    {{ $slide['button'] ?? 'Jelajahi Produk' }}
                    →
                </a>

            </div>

            @break

        @empty

            <div class="hero-content">
                <h1>Selamat Datang di FJB UMMI</h1>
                <p>Marketplace komunitas mahasiswa UMMI.</p>
            </div>

        @endforelse

    </div>

</section>
