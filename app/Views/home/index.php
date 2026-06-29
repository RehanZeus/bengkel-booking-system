<?= $this->include('layout/header') ?>

<!-- HERO -->
<section class="relative overflow-hidden bg-ink text-white">
    <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-20 md:grid-cols-2 md:py-28">
        <div>
            <span class="inline-block rounded-full bg-brand/15 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-brand">
                Bengkel Mobil Profesional
            </span>
            <h1 class="mt-5 text-balance font-display text-4xl font-extrabold leading-tight md:text-5xl">
                Solusi Perawatan Mobil <span class="text-brand">Presisi</span>
            </h1>
            <p class="mt-5 max-w-md text-pretty leading-relaxed text-slate-300">
                Kami memastikan kendaraan Anda kembali prima dengan standar teknis terbaik, peralatan diagnostik modern, dan teknisi bersertifikat.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="<?= site_url('booking') ?>" class="rounded-md bg-brand px-6 py-3 font-semibold text-ink transition hover:bg-amber-400">
                    Booking Service Sekarang
                </a>
                <a href="#layanan" class="rounded-md border border-white/20 px-6 py-3 font-semibold text-white transition hover:bg-white/10">
                    Lihat Layanan
                </a>
            </div>
            <p class="mt-4 text-sm text-brand">Diskon 5% khusus booking via web.</p>
        </div>

        <div class="relative">
            <img src="<?= base_url('images/hero-workshop.png') ?>" alt="Suasana bengkel mobil PrimaMotor dengan teknisi melakukan diagnostik" class="w-full rounded-xl border border-white/10 object-cover shadow-2xl">
        </div>
    </div>
</section>

<!-- TENTANG -->
<section id="tentang" class="mx-auto max-w-6xl px-4 py-16 md:py-20">
    <div class="grid gap-10 md:grid-cols-3">
        <div class="md:col-span-1">
            <h2 class="font-display text-3xl font-bold text-ink">Tentang Kami</h2>
        </div>
        <div class="md:col-span-2">
            <p class="text-lg leading-relaxed text-slate-600">
                Berdiri sejak <strong>2014</strong>, <strong>PrimaMotor</strong> berfokus pada layanan perawatan berkala, engine tune-up, dan perbaikan sistem elektronik menggunakan peralatan diagnostik modern. Kami percaya bahwa perawatan mobil yang baik berawal dari diagnosis yang akurat dan komunikasi yang jujur dengan pelanggan.
            </p>
            <div class="mt-8 grid grid-cols-3 gap-4 text-center">
                <div class="rounded-lg bg-slate-100 p-5">
                    <div class="font-display text-3xl font-extrabold text-brand">10+</div>
                    <div class="mt-1 text-sm text-slate-500">Tahun Pengalaman</div>
                </div>
                <div class="rounded-lg bg-slate-100 p-5">
                    <div class="font-display text-3xl font-extrabold text-brand">15rb+</div>
                    <div class="mt-1 text-sm text-slate-500">Mobil Ditangani</div>
                </div>
                <div class="rounded-lg bg-slate-100 p-5">
                    <div class="font-display text-3xl font-extrabold text-brand">100%</div>
                    <div class="mt-1 text-sm text-slate-500">Garansi Pengerjaan</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LAYANAN -->
<section id="layanan" class="bg-white py-16 md:py-20">
    <div class="mx-auto max-w-6xl px-4">
        <div class="mb-12 max-w-2xl">
            <h2 class="font-display text-3xl font-bold text-ink">Layanan Utama</h2>
            <p class="mt-3 leading-relaxed text-slate-600">
                Berbagai layanan profesional untuk menjaga performa kendaraan Anda tetap optimal.
            </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($services as $service): ?>
                <article class="flex flex-col rounded-xl border border-slate-200 p-6 transition hover:border-brand hover:shadow-lg">
                    <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-lg bg-brand/15 text-brand">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg>
                    </div>
                    <h3 class="font-display text-base font-bold text-ink"><?= esc($service['name']) ?></h3>
                    <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-600"><?= esc($service['description']) ?></p>
                    <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-4 text-sm">
                        <span class="text-slate-500"><?= (int) $service['duration_minutes'] ?> menit</span>
                        <span class="font-semibold text-ink">Rp <?= number_format((float) $service['price_estimate'], 0, ',', '.') ?></span>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section id="keunggulan" class="mx-auto max-w-6xl px-4 py-16 md:py-20">
    <div class="mb-12 max-w-2xl">
        <h2 class="font-display text-3xl font-bold text-ink">Mengapa Memilih Kami</h2>
        <p class="mt-3 leading-relaxed text-slate-600">Komitmen kami terhadap kualitas dan kepercayaan pelanggan.</p>
    </div>

    <div class="grid gap-6 md:grid-cols-3">
        <?php
        $benefits = [
            ['Teknisi Bersertifikat', 'Ditangani oleh mekanik berpengalaman dengan sertifikasi resmi industri otomotif.'],
            ['Transparansi Harga', 'Estimasi biaya diberikan di awal. Tidak ada biaya tersembunyi setelah pengerjaan.'],
            ['Garansi Pengerjaan', 'Setiap perbaikan dilengkapi garansi sehingga Anda tenang berkendara.'],
        ];
        foreach ($benefits as $b): ?>
            <div class="rounded-xl bg-ink p-7 text-white">
                <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-brand text-ink">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <h3 class="font-display text-lg font-bold"><?= esc($b[0]) ?></h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-300"><?= esc($b[1]) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- CTA -->
<section class="bg-brand">
    <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-6 px-4 py-12 text-center md:flex-row md:text-left">
        <div>
            <h2 class="font-display text-2xl font-bold text-ink">Siap merawat mobil Anda?</h2>
            <p class="mt-1 text-ink/80">Booking online sekarang dan dapatkan diskon 5%.</p>
        </div>
        <a href="<?= site_url('booking') ?>" class="rounded-md bg-ink px-7 py-3 font-semibold text-white transition hover:bg-steel">
            Booking Service
        </a>
    </div>
</section>

<?= $this->include('layout/footer') ?>
