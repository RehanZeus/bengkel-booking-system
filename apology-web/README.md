# 💌 Web Permintaan Maaf

Satu file HTML, tanpa build, tanpa install apa pun. Tinggal buka `index.html` di browser.

## Isinya apa aja

- **Layar amplop** di awal — sekali klik "Buka Suratnya", musiknya langsung jalan
- **Musik romantis** yang dibikin langsung lewat Web Audio API (nggak butuh file mp3, jadi nggak ada masalah file hilang / autoplay diblokir). Tombol 🎵 di pojok kanan atas buat on/off
- **Surat maaf** yang muncul diketik pelan-pelan
- **Kartu kenangan** yang bisa diklik satu-satu, tiap kartu buka cerita kalian
- **Tombol "Kasih Alasan"** — keluar alasan sayang random tiap dipencet
- **Daftar janji** yang bisa dicentang
- **Pertanyaan terakhir** "Boleh aku dimaafin?" — tombol "Belum" kabur kalau didekati 😄
- Hujan hati, hati melayang, dan animasi lucu di mana-mana

## Cara ganti isinya

Buka `index.html`, scroll ke bagian `const CONFIG = { ... }` (ada penandanya:
`BAGIAN YANG BOLEH KAMU EDIT`). Semua teks ada di situ:

| Bagian | Isinya |
|---|---|
| `nama` | nama panggilan dia, muncul di judul besar |
| `surat` | isi surat maaf. Tulis `{nama}` di mana pun kalau mau namanya muncul |
| `kenangan` | daftar kartu kenangan (emoji, judul, tanggal, cerita) |
| `trip` | judul, subjudul, dan daftar klip video trip Jogja |
| `alasan` | alasan random yang muncul pas tombol dipencet |
| `janji` | daftar janji yang bisa dicentang |

### Nambah kartu kenangan

Copy satu blok di dalam `kenangan`, terus ubah isinya:

```js
{ emoji:"🎡", judul:"Ke Pasar Malam", sub:"naik bianglala", tanggal:"bulan lalu",
  foto:"", cerita:"Ceritanya tulis di sini." },
```

### Pakai foto asli

1. Bikin folder `foto/` di sebelah `index.html`
2. Taruh gambarnya, misal `foto/pertama-ketemu.jpg`
3. Isi `foto:"foto/pertama-ketemu.jpg"` di kartu yang mau dipasangin

Kalau `foto` dibiarkan kosong (`foto:""`), yang tampil emoji besar — tetap lucu kok.

Fotonya cuma muncul di dalam pop-up (setelah kartunya diklik), jadi kartunya
tetap emoji dan tetap jadi kejutan buat dia.

Tips foto:

- Format `.jpg`, `.png`, `.webp`, `.gif` semuanya jalan
- Foto landscape atau kotak paling pas. Foto portrait tetap bisa, cuma
  otomatis dipotong di bagian tengah biar ceritanya nggak kedorong keluar layar
- Foto dari HP biasanya 3-5 MB. Kalau file HTML-nya mau dikirim langsung ke dia,
  kompres dulu (misal di squoosh.app) biar nggak berat dibuka

### Masukin video trip Jogja

1. Bikin folder `video/` di sebelah `index.html`
2. Taruh klipnya, misal `video/malioboro.mp4`
3. Di bagian `trip.klip`, isi `video:"video/malioboro.mp4"`

Selama `video` masih kosong, kartunya tetap tampil pakai emoji dan dikasih
label "videonya belum dipasang", jadi gampang ketahuan mana yang belum diisi.

Pas videonya diputar, musik latar otomatis berhenti, terus nyala lagi begitu
pop-up-nya ditutup. Jadi suara video sama musiknya nggak tabrakan.

Tips video:

- `.mp4` paling aman — itu format bawaan rekaman HP, jalan di semua browser.
  `.webm` dan `.mov` juga bisa, tapi `.mov` kadang rewel di HP Android
- Klip pendek (10-30 detik) paling enak. Video panjang bikin halaman berat
- Isi `poster:"video/malioboro.jpg"` kalau mau sampul kartunya pakai gambar.
  Kalau dikosongin, sampulnya pakai emoji dan halamannya justru lebih ringan
- Video HP 1 menit bisa 100 MB lebih. Kalau mau dikirim, kompres dulu
  (misal di handbrake atau kompres bawaan HP) ke ukuran 720p

## Cara ngirim ke dia

- **Paling gampang:** kirim file `index.html`-nya langsung (kalau nggak pakai foto)
- **Biar jadi link:** upload folder `apology-web` ke Netlify Drop, Vercel, atau GitHub Pages,
  terus kirim linknya. Semua isinya statis, jadi nggak perlu server

## Catatan

- Musik baru bisa bunyi setelah tombol "Buka Suratnya" diklik — itu aturan browser,
  bukan bug. Makanya dibikin layar amplop di awal
- Font diambil dari Google Fonts. Kalau dibuka offline, otomatis pakai font bawaan
  dan tampilannya tetap aman
