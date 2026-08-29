# 💌 Web Permintaan Maaf — panduan edit sendiri

Nggak perlu install apa-apa. Nggak perlu ngerti coding. Cukup 2 file:

```
apology-web/
├── index.html   ← jangan diapa-apain, ini mesinnya
├── config.js    ← INI yang kamu edit (semua tulisan ada di sini)
├── foto/        ← bikin sendiri, isi foto-fotonya
└── video/       ← bikin sendiri, isi videonya
```

---

## 1. Buka dulu halamannya

Klik dua kali `index.html`. Kebuka di browser. Udah, segitu doang.

Kalau nanti abis ngedit tampilannya belum berubah, tekan **Ctrl + Shift + R**
(Mac: **Cmd + Shift + R**) buat refresh paksa.

## 2. Edit tulisannya

Buka `config.js` pakai **Notepad** (Windows), **TextEdit** (Mac), atau
**VS Code** kalau ada. Isinya cuma tulisan-tulisan kamu.

Aturannya cuma 3:

1. Ganti tulisan yang ada **di dalam tanda kutip** `"..."` aja
2. Jangan hapus tanda kutip, koma, atau kurungnya
3. Kalau mau nulis tanda kutip di dalam kalimat, pakai yang miring: `\"`

Contoh — sebelum:

```js
nama: "Sayang",
```

sesudah:

```js
nama: "Dek Ayu",
```

Simpan (Ctrl + S), balik ke browser, refresh. Langsung berubah.

### Apa aja yang bisa diganti di `config.js`

| Bagian | Isinya |
|---|---|
| `nama` | nama panggilan dia, muncul di judul besar |
| `surat` | isi surat maafnya. Tulis `{nama}` di mana pun kalau mau namanya muncul |
| `album` | judul section + kartu-kartu foto (emoji, judul, tanggal, cerita) |
| `trip` | video highlight: video, sampul, durasi, cerita, daftar momen |
| `alasan` | alasan random yang muncul tiap tombol dipencet |
| `janji` | daftar janji yang bisa dicentang |

## 3. Masukin foto

1. Bikin folder baru namanya `foto` di sebelah `index.html`
2. Masukin foto-fotonya ke situ
3. Di `config.js`, cari kartu yang mau dipasangin, isi bagian `foto:`

```js
{ emoji:"🤳", judul:"Selfie Gagal", sub:"nggak ada yang bener", tanggal:"entah percobaan ke berapa",
  foto:"foto/selfie-gagal.jpg", cerita:"..." },
```

**Nama filenya harus sama persis**, termasuk besar-kecil huruf dan
`.jpg` / `.png`-nya. Kalau fotonya nggak muncul, 90% penyebabnya salah ketik nama file.

Kalau `foto:""` dibiarin kosong, yang tampil emoji besar — tetap aman kok.

Tips: foto landscape atau kotak paling pas. Foto portrait tetap bisa,
otomatis dipotong di tengah biar ceritanya nggak kedorong keluar layar.

### Nambah atau ngurangin kartu

Mau nambah: copy satu blok `{ ... },` di dalam `album.kenangan`, tempel di
bawahnya, ganti isinya. Mau ngurangin: hapus satu blok `{ ... },` utuh —
dari kurung buka sampai koma terakhirnya.

## 4. Masukin video

1. Bikin folder `video` di sebelah `index.html`
2. Masukin videonya, misal `trip-jogja.mp4`
3. Di `config.js` bagian `trip`, isi:

```js
video: "video/trip-jogja.mp4",
durasi: "2:14",
```

Selama masih kosong, tampilannya jadi tulisan "videonya belum dipasang".

Tips video:

- `.mp4` paling aman — itu format bawaan rekaman HP, jalan di semua browser
- Video HP 1 menit gampang tembus 100 MB. Kompres dulu ke 720p
  (pakai HandBrake, atau fitur kompres bawaan HP) biar nggak berat dibuka
- Kalau videonya besar, isi juga `poster:"video/sampul.jpg"`. Sampulnya
  kebuka duluan, videonya baru diunduh pas tombol play dipencet

## 5. Kirim ke dia

**Cara paling gampang — jadiin link (gratis, nggak perlu daftar):**

1. Buka [app.netlify.com/drop](https://app.netlify.com/drop)
2. Seret folder `apology-web` ke kotak di halaman itu
3. Tunggu sebentar, langsung dapet link. Kirim linknya ke dia

Foto dan videonya ikut kebawa, jadi aman dibuka dari HP dia.

**Kalau nggak pakai foto/video sama sekali:** kirim `index.html` sama
`config.js` langsung juga bisa, tapi dua-duanya harus ada di folder yang sama.

## 6. Kasih nama webnya

**Nama di tab browser** diatur di `config.js` paling atas:

```js
judulTab: "Amaliarokhaliku 💗",
```

**Nama di link-nya.** Habis di-drop ke Netlify, kamu dapet link acak macam
`fluffy-cat-123.netlify.app`. Bisa diganti gratis:

1. Di dashboard Netlify, buka **Site configuration → Change site name**
2. Isi `amaliarokhaliku`
3. Link-nya jadi `amaliarokhaliku.netlify.app`

Cuma boleh huruf kecil, angka, sama tanda minus — nggak boleh spasi.

**Kalau mau domain beneran** (tanpa embel-embel `.netlify.app`), beli dulu
domainnya di Niagahoster, Domainesia, Rumahweb, atau Cloudflare, terus di
Netlify buka **Domain management → Add a domain** dan ikutin petunjuk DNS-nya.
Netlify ngasih sertifikat HTTPS-nya gratis.

---

## Kalau halamannya jadi putih kosong

Berarti ada tanda kutip atau koma yang kehapus di `config.js`. Caranya balikin:

1. Klik kanan di halaman → **Inspect** → tab **Console**
2. Ada tulisan merah, di situ ketahuan barisnya nomor berapa
3. Cek baris itu di `config.js`, biasanya kurang tanda kutip atau koma

Kalau bingung, simpan dulu backup `config.js` sebelum ngedit banyak-banyak.

## Catatan lain

- **Musiknya dibikin langsung sama halamannya** (bukan file mp3), jadi nggak
  ada file lagu yang bisa hilang. Baru bunyi setelah tombol "Buka Suratnya"
  diklik — itu aturan browser, bukan error
- Pas video diputar, musiknya otomatis berhenti, nyala lagi pas videonya kelar
- Kalau dibuka tanpa internet, fontnya ganti bawaan komputer.
  Tampilannya tetap rapi
