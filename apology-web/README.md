# 💌 Web Permintaan Maaf — panduan edit sendiri

Nggak perlu install apa-apa. Nggak perlu ngerti coding. Cukup 2 file:

```
apology-web/
├── index.html   ← jangan diapa-apain, ini mesinnya
├── config.js    ← INI yang kamu edit (semua tulisan ada di sini)
├── .htaccess    ← setelan buat hosting Apache (Hostinger)
├── preview.jpg  ← gambar yang muncul pas link-nya dikirim ke WhatsApp
├── robots.txt   ← biar nggak muncul di pencarian Google
├── foto/        ← isi foto-fotonya
├── video/       ← isi videonya
└── musik/       ← isi lagunya (kalau mau ganti musik bawaan)
```

Web ini dipasang di **amaliarokhaliku.xyz** (Hostinger).

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

Ada dua cara. Pilih sesuai ukuran videonya.

### Cara A — file sendiri (buat video di bawah ~50 MB)

1. Bikin folder `video` di sebelah `index.html`
2. Masukin videonya, misal `trip-jogja.mp4`
3. Di `config.js` bagian `trip`, isi:

```js
video: "video/trip-jogja.mp4",
durasi: "2:14",
```

### Cara B — YouTube (buat video gede)

Kalau videonya ratusan MB, jangan ditaruh di hosting. Upload ke YouTube,
set jadi **Unlisted** (cuma yang punya link yang bisa nonton, nggak muncul
di pencarian), terus ambil ID-nya dari alamatnya:

```
https://youtu.be/dQw4w9WgXcQ
                 ^^^^^^^^^^^  ini ID-nya
```

Isi di `config.js`:

```js
youtube: "dQw4w9WgXcQ",
```

Kalau `video` dan `youtube` dua-duanya diisi, yang dipakai YouTube.

Bedanya: kalau pakai YouTube, musiknya berhenti pas videonya dibuka, tapi
nyalainnya lagi harus lewat tombol **"Udah nonton, nyalain musiknya lagi"**
yang muncul di bawah videonya. Soalnya YouTube nggak ngasih tau halaman ini
kapan videonya kelar.

### Soal ukuran video

Patokan kasar: **720p ≈ 15 MB per menit**.

| Ukuran | Hasilnya di HP dia |
|---|---|
| Di bawah 50 MB | Aman, muter hampir langsung |
| 100 MB | Masih jalan, tapi makan kuota dia dan suka macet kalau sinyal jelek |
| Di atas 200 MB | Pakai cara B (YouTube) aja |

Video nggak perlu kedownload penuh baru bisa diputer — dia nge-buffer sambil
jalan. Tapi kuota dan sinyal jelek tetap masalah.

Cara ngecilin: pakai **HandBrake** (gratis, handbrake.fr) → preset
**Fast 720p30** → tab Video, Quality **RF 24** → Start Encode. Mau motong
bagian tertentu, pakai tab **Range**. Kalau ngerjainnya dari HP, pakai
**CapCut** terus export **720p**.

Highlight 2-3 menit biasanya ketemu di angka 30-45 MB, dan sejujurnya lebih
enak ditonton daripada video 10 menit.

Tips lain:

- `.mp4` paling aman, jalan di semua browser. `.mov` kadang rewel di Android
- Isi `poster:"video/sampul.jpg"` kalau videonya besar. Sampulnya kebuka
  duluan, videonya baru diunduh pas tombol play dipencet
- Selama `video` dan `youtube` dua-duanya kosong, tampilannya jadi tulisan
  "videonya belum dipasang"

## 5. Ganti lagunya

Bawaannya, musiknya dibikin sendiri sama halamannya (nada lembut, muter terus).
Kalau mau diganti lagu sendiri:

1. Bikin folder `musik` di sebelah `index.html`
2. Taruh lagunya di situ, misal `cherry.mp3`
3. Di `config.js` bagian `musik`, isi nama filenya:

```js
musik: {
  file: "musik/cherry.mp3",
  volume: 0.8,
  mulaiDetik: 0,
},
```

| Isian | Fungsinya |
|---|---|
| `file` | nama file lagunya. Kosongin (`""`) buat balik ke musik bawaan |
| `volume` | dari `0` (sunyi) sampai `1` (paling keras). `0.8` udah pas |
| `mulaiDetik` | mulai dari detik ke berapa. Isi `12` kalau mau lompat intronya |

Lagunya muter terus (ngulang sendiri), pelan-pelan naik pas pertama nyala,
dan otomatis berhenti pas video diputar.

Tips lagu:

- `.mp3` paling aman, jalan di semua browser. `.m4a` dan `.ogg` juga bisa,
  tapi `.m4a` kadang rewel di HP Android
- Ukurannya biasanya 3-8 MB per lagu, masih aman
- **Kalau nama filenya salah ketik, halamannya nggak bakal sunyi** — otomatis
  balik ke musik bawaan. Cek Console browser, ada peringatannya di situ
- Lagunya lagu orang, jadi simpen buat berdua aja — jangan didaftarin ke
  Google atau disebar ke publik

## 6. Upload ke Hostinger

Domain: **amaliarokhaliku.xyz**

1. Login hPanel Hostinger → menu **Websites** → pilih domainnya → **File Manager**
2. Masuk ke folder **`public_html`**
3. **Hapus dulu file bawaannya** kalau ada — biasanya `default.php`,
   `index.php`, atau halaman "Coming Soon". Kalau nggak dihapus, yang kebuka
   malah halaman itu, bukan web kamu
4. Klik **Upload**, pilih file zip-nya
5. Klik kanan zip-nya → **Extract**, terus zip-nya dihapus

Isi `public_html` harus jadi kayak gini — **langsung di root, jangan
dibungkus folder lagi**:

```
public_html/
├── index.html
├── config.js
├── .htaccess
├── preview.jpg
├── robots.txt
├── foto/
├── video/
└── musik/
```

Kalau file-nya kebungkus folder, alamatnya jadi
`amaliarokhaliku.xyz/apology-web/` — bukan yang kita mau.

Buka `https://amaliarokhaliku.xyz`. Selesai.

### Kalau videonya gede

File Manager kadang gagal upload file besar. Pakai FTP:

1. hPanel → **Files → FTP Accounts**, catat host, username, password
2. Download **FileZilla** (gratis), masukin data tadi
3. Seret videonya ke `public_html/video/`

### Aktifin HTTPS

hPanel → **Security → SSL**. Biasanya udah otomatis, tapi cek aja. Kalau ada
opsi **Force HTTPS**, nyalain — biar yang buka `http://` otomatis dialihin
ke `https://`.

Domain baru kadang butuh beberapa jam sampai bisa diakses di mana-mana.
Kalau belum kebuka, tunggu dulu, jangan buru-buru diutak-atik.

## 7. Cek dulu sebelum dikirim

Buka `https://amaliarokhaliku.xyz` **di HP**, bukan cuma di laptop — dia
bakal bukanya di HP.

Cek satu-satu:

- [ ] Layar amplop muncul, tombol "Buka Suratnya" bisa diklik
- [ ] **Musiknya bunyi** setelah tombol diklik (jangan lupa volume HP-nya)
- [ ] Suratnya ngetik sendiri sampai habis
- [ ] Kartu foto bisa diklik, fotonya muncul (bukan ikon gambar rusak)
- [ ] Videonya bisa diputar, dan musiknya berhenti pas video jalan
- [ ] Tombol "Kasih Alasan" ngeluarin tulisan
- [ ] Tombol "Belum" kabur pas mau dipencet
- [ ] Tombol "Iya, dimaafin" ngeluarin hujan hati

Coba juga buka pakai **data seluler** (matiin WiFi), buat mastiin bukan cuma
jalan di jaringan kamu.

### Kalau ada yang nggak beres

| Kejadiannya | Penyebab & solusinya |
|---|---|
| Muncul halaman Hostinger / "Coming Soon" | Masih ada `index.php` atau `default.php` di `public_html`. Hapus |
| Muncul daftar folder | `index.html` kebungkus folder lain. Pindahin ke `public_html` langsung |
| Halaman putih kosong | Ada tanda kutip/koma kehapus di `config.js`. Cek Console browser |
| Foto ikon rusak | Nama file di `config.js` beda sama nama file aslinya. Cek huruf besar-kecilnya |
| Musik nggak bunyi | Belum klik "Buka Suratnya", volume HP mati, atau nama file lagunya salah |
| Tampilan lama terus | Buka pakai mode penyamaran (incognito) buat mastiin bukan cache |
| "Not secure" / gembok merah | SSL belum aktif. hPanel → Security → SSL |

## 8. Kirim ke dia

Tinggal kirim link-nya: **https://amaliarokhaliku.xyz**

Pas dikirim di WhatsApp, yang muncul preview kartu pink bertulisan
"Ada surat buat kamu 💌" — itu dari file `preview.jpg` sama tag `og:` di
`index.html`. Kalau mau ganti tulisannya, edit bagian `og:title` sama
`og:description` di `index.html` paling atas.

Kalau preview-nya belum muncul padahal filenya udah keupload, WhatsApp lagi
nyimpen versi lama link itu. Akalin dengan kirim `https://amaliarokhaliku.xyz/?a=1`
sekali, atau tunggu beberapa jam.

Saran kecil: kasih tau dia buat **pakai earphone** dan bukanya pas lagi
sendirian. Ada musik sama videonya, sayang kalau dibuka sambil buru-buru.

## 9. Ganti isinya setelah online

Cukup edit `config.js` di komputer, terus upload ulang **file itu aja** ke
`public_html` (timpa yang lama). Nggak perlu upload ulang semuanya.

Berkat `.htaccess` yang ikut ke-upload, hasil editnya langsung kelihatan
tanpa harus clear cache browser.

## 10. Nama webnya

Nama yang muncul di tab browser diatur di `config.js` paling atas:

```js
judulTab: "Amaliarokhaliku 💗",
```

---

## Kalau halamannya jadi putih kosong

Berarti ada tanda kutip atau koma yang kehapus di `config.js`. Caranya balikin:

1. Klik kanan di halaman → **Inspect** → tab **Console**
2. Ada tulisan merah, di situ ketahuan barisnya nomor berapa
3. Cek baris itu di `config.js`, biasanya kurang tanda kutip atau koma

Kalau bingung, simpan dulu backup `config.js` sebelum ngedit banyak-banyak.

## Catatan lain

- **Musiknya baru bunyi setelah tombol "Buka Suratnya" diklik** — itu aturan
  browser (nggak boleh ada suara sebelum orangnya klik sesuatu), bukan error.
  Makanya dibikin layar amplop di awal
- Kalau `musik.file` dikosongin, musiknya dibikin langsung sama halamannya,
  jadi nggak ada file lagu yang bisa hilang
- Pas video diputar, musiknya otomatis berhenti, nyala lagi pas videonya kelar
- Kalau dibuka tanpa internet, fontnya ganti bawaan komputer.
  Tampilannya tetap rapi
