<?= $this->include('layout/header') ?>

<section class="bg-ink py-14 text-white">
    <div class="mx-auto max-w-3xl px-4">
        <h1 class="font-display text-3xl font-extrabold md:text-4xl">Booking Service</h1>
        <p class="mt-3 max-w-xl leading-relaxed text-slate-300">
            Pilih layanan, tanggal, dan jam kedatangan. Slot yang sudah penuh akan otomatis dinonaktifkan.
        </p>
    </div>
</section>

<section class="mx-auto -mt-8 max-w-3xl px-4 pb-8">
    <div class="rounded-xl bg-white p-6 shadow-lg ring-1 ring-slate-200 md:p-8">

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($validation) && $validation): ?>
            <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="list-inside list-disc space-y-1">
                    <?php foreach ($validation->getErrors() as $err): ?>
                        <li><?= esc($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('booking') ?>" method="post" class="space-y-6">
            <?= csrf_field() ?>

            <!-- Data pelanggan -->
            <fieldset class="space-y-4">
                <legend class="font-display text-lg font-bold text-ink">Data Anda</legend>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="<?= esc($old['name'] ?? '') ?>" required
                            class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/30">
                    </div>
                    <div>
                        <label for="phone" class="mb-1 block text-sm font-medium text-slate-700">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                        <input type="tel" id="phone" name="phone" value="<?= esc($old['phone'] ?? '') ?>" required
                            class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/30">
                    </div>
                </div>

                <div>
                    <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email <span class="text-slate-400">(opsional)</span></label>
                    <input type="email" id="email" name="email" value="<?= esc($old['email'] ?? '') ?>"
                        class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/30">
                </div>
            </fieldset>

            <!-- Detail kendaraan -->
            <fieldset class="space-y-4">
                <legend class="font-display text-lg font-bold text-ink">Detail Kendaraan &amp; Layanan</legend>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="vehicle_model" class="mb-1 block text-sm font-medium text-slate-700">Tipe Mobil</label>
                        <input type="text" id="vehicle_model" name="vehicle_model" placeholder="cth: Toyota Avanza 2019" value="<?= esc($old['vehicle_model'] ?? '') ?>"
                            class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/30">
                    </div>
                    <div>
                        <label for="plate_number" class="mb-1 block text-sm font-medium text-slate-700">No. Plat</label>
                        <input type="text" id="plate_number" name="plate_number" placeholder="cth: B 1234 XYZ" value="<?= esc($old['plate_number'] ?? '') ?>"
                            class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm uppercase focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/30">
                    </div>
                </div>

                <div>
                    <label for="service_id" class="mb-1 block text-sm font-medium text-slate-700">Jenis Layanan <span class="text-red-500">*</span></label>
                    <select id="service_id" name="service_id" required
                        class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/30">
                        <option value="">-- Pilih layanan --</option>
                        <?php foreach ($services as $s): ?>
                            <option value="<?= (int) $s['id'] ?>" <?= (isset($old['service_id']) && (int) $old['service_id'] === (int) $s['id']) ? 'selected' : '' ?>>
                                <?= esc($s['name']) ?> &mdash; Rp <?= number_format((float) $s['price_estimate'], 0, ',', '.') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </fieldset>

            <!-- Jadwal -->
            <fieldset class="space-y-4">
                <legend class="font-display text-lg font-bold text-ink">Pilih Jadwal</legend>

                <div>
                    <label for="booking_date" class="mb-1 block text-sm font-medium text-slate-700">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" id="booking_date" name="booking_date" required min="<?= esc($min_date) ?>" value="<?= esc($old['booking_date'] ?? '') ?>"
                        class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/30">
                </div>

                <div>
                    <span class="mb-2 block text-sm font-medium text-slate-700">Jam Kedatangan <span class="text-red-500">*</span></span>
                    <p id="slot-hint" class="mb-3 text-xs text-slate-500">Pilih tanggal terlebih dahulu untuk melihat ketersediaan jam.</p>
                    <div id="slot-grid" class="grid grid-cols-3 gap-2 sm:grid-cols-4">
                        <?php foreach ($time_slots as $slot): ?>
                            <label class="slot-option relative cursor-pointer">
                                <input type="radio" name="time_slot" value="<?= esc($slot) ?>" class="peer sr-only" disabled
                                    <?= (isset($old['time_slot']) && $old['time_slot'] === $slot) ? 'checked' : '' ?>>
                                <span class="block rounded-md border border-slate-300 py-2 text-center text-sm font-medium text-slate-700 transition peer-checked:border-brand peer-checked:bg-brand peer-checked:text-ink peer-disabled:cursor-not-allowed peer-disabled:opacity-40">
                                    <?= esc($slot) ?>
                                </span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div>
                    <label for="notes" class="mb-1 block text-sm font-medium text-slate-700">Catatan Tambahan</label>
                    <textarea id="notes" name="notes" rows="3" placeholder="Keluhan atau permintaan khusus..."
                        class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/30"><?= esc($old['notes'] ?? '') ?></textarea>
                </div>
            </fieldset>

            <button type="submit" class="w-full rounded-md bg-brand py-3 font-semibold text-ink transition hover:bg-amber-400">
                Kirim Booking
            </button>
        </form>
    </div>
</section>

<script>
(function () {
    const dateInput = document.getElementById('booking_date');
    const slotGrid  = document.getElementById('slot-grid');
    const slotHint  = document.getElementById('slot-hint');
    const slotsUrl  = '<?= site_url('booking/slots') ?>';

    function radios() {
        return slotGrid.querySelectorAll('input[name="time_slot"]');
    }

    function setAllDisabled(disabled) {
        radios().forEach(r => { r.disabled = disabled; });
    }

    async function loadSlots(date) {
        if (!date) { setAllDisabled(true); return; }

        slotHint.textContent = 'Memuat ketersediaan...';
        try {
            const res  = await fetch(slotsUrl + '?date=' + encodeURIComponent(date));
            const data = await res.json();

            if (!data.slots) {
                slotHint.textContent = 'Gagal memuat slot. Coba lagi.';
                return;
            }

            const map = {};
            data.slots.forEach(s => { map[s.time] = s; });

            radios().forEach(radio => {
                const info  = map[radio.value];
                const label = radio.closest('label').querySelector('span');
                if (info && info.available) {
                    radio.disabled = false;
                    label.title = 'Sisa ' + info.remaining + ' slot';
                } else {
                    radio.disabled = true;
                    radio.checked  = false;
                    label.title = 'Penuh';
                }
            });

            slotHint.textContent = 'Jam yang dinonaktifkan berarti sudah penuh.';
        } catch (e) {
            slotHint.textContent = 'Terjadi kesalahan jaringan.';
        }
    }

    dateInput.addEventListener('change', () => loadSlots(dateInput.value));

    // Muat ulang jika tanggal sudah terisi (mis. setelah error validasi).
    if (dateInput.value) loadSlots(dateInput.value);
})();
</script>

<?= $this->include('layout/footer') ?>
