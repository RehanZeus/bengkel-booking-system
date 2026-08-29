# 💌 Web Permintaan Maaf — panduan edit sendiri

Nggak perlu install apa-apa. Nggak perlu ngerti coding. Cukup 2 file:

```
apology-web/
├── index.html   ← jangan diapa-apain, ini mesinnya
├── config.js    ← INI yang kamu edit (semua tulisan ada di sini)
├── .htaccess    ← setelan buat hosting Apache (Hostinger)
├── foto/        ← isi foto-fotonya
└── video/       ← isi videonya
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

## 5. Upload ke Hostinger

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
├── foto/
└── video/
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

## 6. Ganti isinya setelah online

Cukup edit `config.js` di komputer, terus upload ulang **file itu aja** ke
`public_html` (timpa yang lama). Nggak perlu upload ulang semuanya.

Berkat `.htaccess` yang ikut ke-upload, hasil editnya langsung kelihatan
tanpa harus clear cache browser.

## 7. Nama webnya

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

- **Musiknya dibikin langsung sama halamannya** (bukan file mp3), jadi nggak
  ada file lagu yang bisa hilang. Baru bunyi setelah tombol "Buka Suratnya"
  diklik — itu aturan browser, bukan error
- Pas video diputar, musiknya otomatis berhenti, nyala lagi pas videonya kelar
- Kalau dibuka tanpa internet, fontnya ganti bawaan komputer.
  Tampilannya tetap rapi
