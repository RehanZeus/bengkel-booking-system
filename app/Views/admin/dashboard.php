<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard Admin') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: {
            colors: { brand: '#f59e0b', ink: '#0f172a' },
            fontFamily: { sans: ['Inter','sans-serif'], display: ['Sora','sans-serif'] }
        } } };
    </script>
</head>
<body class="bg-slate-100" style="font-family:Inter,sans-serif;">

<header class="bg-ink text-white">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4">
        <div class="flex items-center gap-2">
            <span class="flex h-9 w-9 items-center justify-center rounded-md bg-brand font-extrabold text-ink" style="font-family:Sora,sans-serif;">PM</span>
            <span class="font-bold" style="font-family:Sora,sans-serif;">Admin PrimaMotor</span>
        </div>
        <div class="flex items-center gap-4 text-sm">
            <span class="hidden text-slate-300 sm:inline">Halo, <?= esc(session()->get('adminName')) ?></span>
            <a href="<?= site_url('/') ?>" class="text-slate-300 transition hover:text-white">Lihat Situs</a>
            <a href="<?= site_url('admin/logout') ?>" class="rounded-md bg-white/10 px-3 py-1.5 font-medium transition hover:bg-white/20">Logout</a>
        </div>
    </div>
</header>

<main class="mx-auto max-w-7xl px-4 py-8">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-5 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="mb-5 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <!-- Statistik -->
    <div class="mb-8 grid grid-cols-2 gap-4 lg:grid-cols-4">
        <?php
        $cards = [
            ['Total Booking', $stats['total'], 'text-ink'],
            ['Pending',       $stats['pending'], 'text-amber-600'],
            ['Confirmed',     $stats['confirmed'], 'text-blue-600'],
            ['Completed',     $stats['completed'], 'text-green-600'],
        ];
        foreach ($cards as $c): ?>
            <div class="rounded-xl bg-white p-5 shadow-sm">
                <div class="text-sm text-slate-500"><?= esc($c[0]) ?></div>
                <div class="mt-1 text-3xl font-extrabold <?= $c[2] ?>" style="font-family:Sora,sans-serif;"><?= (int) $c[1] ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Filter -->
    <div class="mb-4 flex flex-wrap items-center gap-2">
        <span class="text-sm font-medium text-slate-600">Filter:</span>
        <?php
        $filters = ['' => 'Semua', 'pending' => 'Pending', 'confirmed' => 'Confirmed', 'completed' => 'Completed', 'cancelled' => 'Cancelled'];
        foreach ($filters as $key => $label):
            $active = ($filter ?? '') === $key;
        ?>
            <a href="<?= site_url('admin/dashboard') . ($key !== '' ? '?status=' . $key : '') ?>"
               class="rounded-full px-4 py-1.5 text-sm font-medium transition <?= $active ? 'bg-ink text-white' : 'bg-white text-slate-600 hover:bg-slate-200' ?>">
                <?= esc($label) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Tabel booking -->
    <div class="overflow-x-auto rounded-xl bg-white shadow-sm">
        <table class="w-full min-w-[860px] text-left text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-4 py-3">Kode</th>
                    <th class="px-4 py-3">Pelanggan</th>
                    <th class="px-4 py-3">Layanan</th>
                    <th class="px-4 py-3">Kendaraan</th>
                    <th class="px-4 py-3">Jadwal</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if (empty($bookings)): ?>
                    <tr><td colspan="7" class="px-4 py-10 text-center text-slate-400">Belum ada booking.</td></tr>
                <?php else: ?>
                    <?php
                    $badge = [
                        'pending'   => 'bg-amber-100 text-amber-700',
                        'confirmed' => 'bg-blue-100 text-blue-700',
                        'completed' => 'bg-green-100 text-green-700',
                        'cancelled' => 'bg-red-100 text-red-700',
                    ];
                    foreach ($bookings as $b): ?>
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 font-mono font-semibold text-ink"><?= esc($b['booking_code']) ?></td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-ink"><?= esc($b['customer_name']) ?></div>
                                <div class="text-xs text-slate-500"><?= esc($b['customer_phone']) ?></div>
                            </td>
                            <td class="px-4 py-3 text-slate-600"><?= esc($b['service_name']) ?></td>
                            <td class="px-4 py-3 text-slate-600">
                                <?= esc($b['vehicle_model'] ?: '-') ?>
                                <?php if (! empty($b['plate_number'])): ?>
                                    <div class="text-xs text-slate-400"><?= esc($b['plate_number']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-slate-600">
                                <?= esc(date('d M Y', strtotime($b['booking_date']))) ?>
                                <div class="text-xs text-slate-400"><?= esc(substr($b['time_slot'], 0, 5)) ?> WIB</div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="rounded-full px-2.5 py-1 text-xs font-semibold <?= $badge[$b['status']] ?? 'bg-slate-100 text-slate-600' ?>">
                                    <?= esc(ucfirst($b['status'])) ?>
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <form action="<?= site_url('admin/booking/' . $b['id'] . '/status') ?>" method="post" class="flex items-center gap-1">
                                    <?= csrf_field() ?>
                                    <select name="status" class="rounded-md border border-slate-300 px-2 py-1 text-xs focus:border-brand focus:outline-none">
                                        <?php foreach (['pending','confirmed','completed','cancelled'] as $st): ?>
                                            <option value="<?= $st ?>" <?= $b['status'] === $st ? 'selected' : '' ?>><?= ucfirst($st) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="rounded-md bg-brand px-2.5 py-1 text-xs font-semibold text-ink transition hover:bg-amber-400">Simpan</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
