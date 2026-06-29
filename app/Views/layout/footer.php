</main>

<footer class="mt-20 bg-ink text-slate-300">
    <div class="mx-auto grid max-w-6xl gap-10 px-4 py-14 md:grid-cols-3">
        <div>
            <div class="mb-3 flex items-center gap-2">
                <span class="flex h-9 w-9 items-center justify-center rounded-md bg-brand text-ink font-display font-extrabold">PM</span>
                <span class="font-display text-lg font-bold text-white">Prima<span class="text-brand">Motor</span></span>
            </div>
            <p class="text-sm leading-relaxed text-slate-400">
                Solusi perawatan mobil presisi dengan standar teknis terbaik. Teknisi bersertifikat, harga transparan, dan garansi pengerjaan.
            </p>
        </div>

        <div>
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wide text-white">Kontak</h3>
            <ul class="space-y-2 text-sm text-slate-400">
                <li>Jl. Otomotif Raya No. 17, Jakarta</li>
                <li>Telp / WA: 0812-3456-7890</li>
                <li>Email: halo@primamotor.id</li>
            </ul>
        </div>

        <div>
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wide text-white">Jam Operasional</h3>
            <ul class="space-y-2 text-sm text-slate-400">
                <li>Senin - Sabtu: 08.00 - 17.00</li>
                <li>Minggu &amp; Libur: Tutup</li>
            </ul>
            <a href="<?= site_url('admin/login') ?>" class="mt-4 inline-block text-xs text-slate-500 transition hover:text-brand">Login Admin</a>
        </div>
    </div>

    <div class="border-t border-white/10">
        <p class="mx-auto max-w-6xl px-4 py-5 text-center text-xs text-slate-500">
            &copy; <?= date('Y') ?> Bengkel PrimaMotor. Dibuat dengan CodeIgniter 4.
        </p>
    </div>
</footer>

</body>
</html>
