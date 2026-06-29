<?= $this->include('layout/header') ?>

<section class="mx-auto max-w-2xl px-4 py-16">
    <div class="rounded-xl bg-white p-8 text-center shadow-lg ring-1 ring-slate-200">
        <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-green-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
        </div>

        <h1 class="font-display text-2xl font-bold text-ink">Booking Berhasil!</h1>
        <p class="mt-2 leading-relaxed text-slate-600">
            Terima kasih, <strong><?= esc($booking['customer_name']) ?></strong>. Permintaan booking Anda telah kami terima dan berstatus <strong>Pending</strong>. Tim kami akan menghubungi Anda untuk konfirmasi.
        </p>

        <div class="mt-6 inline-block rounded-lg bg-ink px-6 py-4 text-left text-white">
            <div class="text-xs uppercase tracking-wide text-slate-400">Kode Booking</div>
            <div class="font-display text-2xl font-extrabold text-brand"><?= esc($booking['booking_code']) ?></div>
        </div>

        <dl class="mx-auto mt-8 max-w-md space-y-3 text-left text-sm">
            <div class="flex justify-between border-b border-slate-100 pb-2">
                <dt class="text-slate-500">Layanan</dt>
                <dd class="font-medium text-ink"><?= esc($booking['service_name']) ?></dd>
            </div>
            <div class="flex justify-between border-b border-slate-100 pb-2">
                <dt class="text-slate-500">Tanggal</dt>
                <dd class="font-medium text-ink"><?= esc(date('d M Y', strtotime($booking['booking_date']))) ?></dd>
            </div>
            <div class="flex justify-between border-b border-slate-100 pb-2">
                <dt class="text-slate-500">Jam</dt>
                <dd class="font-medium text-ink"><?= esc(substr($booking['time_slot'], 0, 5)) ?> WIB</dd>
            </div>
            <?php if (! empty($booking['vehicle_model'])): ?>
            <div class="flex justify-between border-b border-slate-100 pb-2">
                <dt class="text-slate-500">Kendaraan</dt>
                <dd class="font-medium text-ink"><?= esc($booking['vehicle_model']) ?><?= ! empty($booking['plate_number']) ? ' (' . esc($booking['plate_number']) . ')' : '' ?></dd>
            </div>
            <?php endif; ?>
            <div class="flex justify-between">
                <dt class="text-slate-500">Estimasi Biaya</dt>
                <dd class="font-semibold text-ink">Rp <?= number_format((float) $booking['service_price'], 0, ',', '.') ?></dd>
            </div>
        </dl>

        <div class="mt-8 flex justify-center gap-3">
            <a href="<?= site_url('/') ?>" class="rounded-md border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Kembali ke Beranda</a>
            <a href="<?= site_url('booking') ?>" class="rounded-md bg-brand px-5 py-2.5 text-sm font-semibold text-ink transition hover:bg-amber-400">Booking Lagi</a>
        </div>
    </div>
</section>

<?= $this->include('layout/footer') ?>
