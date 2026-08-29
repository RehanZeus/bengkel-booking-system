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

## Cara ngirim ke dia

- **Paling gampang:** kirim file `index.html`-nya langsung (kalau nggak pakai foto)
- **Biar jadi link:** upload folder `apology-web` ke Netlify Drop, Vercel, atau GitHub Pages,
  terus kirim linknya. Semua isinya statis, jadi nggak perlu server

## Catatan

- Musik baru bisa bunyi setelah tombol "Buka Suratnya" diklik — itu aturan browser,
  bukan bug. Makanya dibikin layar amplop di awal
- Font diambil dari Google Fonts. Kalau dibuka offline, otomatis pakai font bawaan
  dan tampilannya tetap aman
