<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Login Admin') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: {
            colors: { brand: '#f59e0b', ink: '#0f172a' },
            fontFamily: { sans: ['Inter','sans-serif'], display: ['Sora','sans-serif'] }
        } } };
    </script>
</head>
<body class="flex min-h-screen items-center justify-center bg-ink px-4" style="font-family:Inter,sans-serif;">
    <div class="w-full max-w-sm">
        <div class="mb-6 text-center">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-lg bg-brand font-extrabold text-ink" style="font-family:Sora,sans-serif;">PM</span>
            <h1 class="mt-3 text-xl font-bold text-white" style="font-family:Sora,sans-serif;">Dashboard Admin</h1>
            <p class="text-sm text-slate-400">Bengkel PrimaMotor</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-xl">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-4 rounded-md border border-green-200 bg-green-50 px-3 py-2 text-sm text-green-700">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('admin/login') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>
                <div>
                    <label for="username" class="mb-1 block text-sm font-medium text-slate-700">Username</label>
                    <input type="text" id="username" name="username" required autofocus
                        class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/30">
                </div>
                <div>
                    <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/30">
                </div>
                <button type="submit" class="w-full rounded-md bg-brand py-2.5 font-semibold text-ink transition hover:bg-amber-400">
                    Masuk
                </button>
            </form>
        </div>

        <p class="mt-5 text-center text-xs text-slate-500">
            <a href="<?= site_url('/') ?>" class="hover:text-brand">&larr; Kembali ke situs</a>
        </p>
    </div>
</body>
</html>
