<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Bengkel PrimaMotor') ?></title>
    <meta name="description" content="Bengkel PrimaMotor - solusi perawatan mobil presisi dengan teknisi bersertifikat, transparansi harga, dan garansi pengerjaan.">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand:   '#f59e0b', // amber
                        ink:     '#0f172a', // slate-900
                        steel:   '#1e293b', // slate-800
                    },
                    fontFamily: {
                        sans:    ['Inter', 'system-ui', 'sans-serif'],
                        display: ['Sora', 'Inter', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
        h1, h2, h3, .font-display { font-family: 'Sora', 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

<header class="sticky top-0 z-50 bg-ink/95 backdrop-blur border-b border-white/10">
    <nav class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
        <a href="<?= site_url('/') ?>" class="flex items-center gap-2">
            <span class="flex h-9 w-9 items-center justify-center rounded-md bg-brand text-ink font-display font-extrabold">PM</span>
            <span class="font-display text-lg font-bold text-white">Prima<span class="text-brand">Motor</span></span>
        </a>

        <div class="hidden items-center gap-8 md:flex">
            <a href="<?= site_url('/') ?>#layanan" class="text-sm font-medium text-slate-300 transition hover:text-white">Layanan</a>
            <a href="<?= site_url('/') ?>#tentang" class="text-sm font-medium text-slate-300 transition hover:text-white">Tentang</a>
            <a href="<?= site_url('/') ?>#keunggulan" class="text-sm font-medium text-slate-300 transition hover:text-white">Keunggulan</a>
            <a href="<?= site_url('booking') ?>" class="rounded-md bg-brand px-4 py-2 text-sm font-semibold text-ink transition hover:bg-amber-400">Booking Service</a>
        </div>

        <a href="<?= site_url('booking') ?>" class="rounded-md bg-brand px-3 py-2 text-sm font-semibold text-ink md:hidden">Booking</a>
    </nav>
</header>

<main>
