/* =========================================================================
   SEMUA TULISAN ADA DI FILE INI — tinggal ganti yang di dalam tanda kutip.

   Aturan mainnya cuma 3:
     1. Ganti tulisan yang ada DI DALAM tanda kutip "..." aja
     2. Jangan hapus tanda kutip, koma, atau kurungnya
     3. Kalau mau nulis tanda kutip di dalam kalimat, pakai yang miring: \"

   Habis diedit, simpan filenya, terus refresh halamannya di browser.
   ========================================================================= */

const CONFIG = {
  // Nama panggilan dia (muncul di judul besar)
  nama: "Sayang",

  // Isi surat maaf. Tulis {nama} kalau mau nama dia muncul di situ.
  surat:
`Hai {nama}...

Aku tau kemarin aku salah, dan aku nggak mau cari alasan apa pun.
Aku minta maaf udah bikin kamu kecewa, bikin kamu nangis, dan bikin
kamu ngerasa nggak dianggap. Itu bukan yang kamu pantas dapetin.

Kamu selalu ada waktu aku lagi berantakan, dan aku malah lupa jaga
perasaan kamu waktu kamu butuh aku. Maafin aku ya.

Aku nggak minta kamu langsung baik-baik aja. Marah dulu nggak apa-apa,
diem dulu juga nggak apa-apa. Aku cuma mau kamu tau: aku nggak
ke mana-mana, dan aku bakal belajar jadi lebih baik buat kamu.

Makasih udah sabar sama aku sejauh ini ${'💝'}`,

  // Album foto kebersamaan di Purwokerto.
  // Mau nambah kartu? tinggal copy satu blok { ... }, terus ubah isinya.
  // foto: "" -> tampil emoji besar. foto: "foto/kita.jpg" -> tampil gambar.
  album: {
    judul: "📸 Kebersamaan Kita di Purwokerto",
    sub: "foto-foto random yang nggak ada bagus-bagusnya, tapi semuanya aku simpen",
    kenangan: [
      { emoji:"🤳", judul:"Selfie Gagal", sub:"nggak ada yang bener", tanggal:"entah percobaan ke berapa",
        foto:"", cerita:"Dari sekian kali nyoba, nggak ada satu pun yang rapi. Mata kamu merem, tangan aku kepotong. Tapi justru ini yang paling sering aku buka." },
      { emoji:"😋", judul:"Lagi Ngunyah", sub:"kena candid", tanggal:"pas lagi makan",
        foto:"", cerita:"Kamu marah pas tau aku foto diem-diem. Padahal ini salah satu favorit aku, soalnya kamu lagi nggak jaim sama sekali." },
      { emoji:"😴", judul:"Ketiduran di Jalan", sub:"kepala miring gitu aja", tanggal:"di perjalanan",
        foto:"", cerita:"Aku sengaja nggak bangunin, malah sempet-sempetnya foto dulu. Terus diomelin pas kamu melek." },
      { emoji:"😂", judul:"Ketawa Ngakak", sub:"sampai merem", tanggal:"lupa gara-gara apa",
        foto:"", cerita:"Aku beneran lupa apa yang lucu waktu itu. Tapi ketawa kamu di foto ini masih bikin aku senyum sendiri." },
      { emoji:"📷", judul:"Blur tapi Nggak Aku Hapus", sub:"goyang parah", tanggal:"buru-buru motret",
        foto:"", cerita:"Fotonya jelek, buram, nggak jelas bentuknya. Tiap mau aku hapus selalu nggak jadi." },
      { emoji:"😤", judul:"Pas Kamu Ngambek", sub:"bertahan 5 menit doang", tanggal:"sempet aku abadikan",
        foto:"", cerita:"Ngambeknya nggak lama, tapi keburu aku foto. Maaf ya, soalnya lucu banget." },
      { emoji:"👟", judul:"Foto Kaki Berdua", sub:"nggak jelas maksudnya apa", tanggal:"random banget",
        foto:"", cerita:"Sampai sekarang aku nggak tau kenapa kita foto ini. Tapi malah jadi salah satu yang paling aku suka." },
      { emoji:"🫣", judul:"Kamu Nggak Sadar Difoto", sub:"lagi sibuk sendiri", tanggal:"diem-diem",
        foto:"", cerita:"Kamu lagi anteng sendiri, nggak nyadar aku motret. Muka kamu pas lagi nggak mikirin apa-apa itu yang paling aku suka." },
    ],
  },

  // Satu video highlight trip Jogja (gabungan potongan-potongan random).
  // video : "video/trip-jogja.mp4" -> taruh filenya di folder video/
  // poster: "" -> sampulnya pakai emoji. Isi "video/trip-jogja.jpg" kalau mau
  //         sampulnya foto (halaman jadi lebih cepat kebuka).
  trip: {
    judul: "🛵 Random Trip Jogja",
    sub: "satu video, isinya potongan-potongan random selama kita di sana",
    emoji: "🛵",
    video: "",
    poster: "",
    durasi: "",            // opsional, misal "2:14"
    cerita: "Aku gabungin rekaman-rekaman nggak penting yang aku simpen diem-diem. Nggak ada yang bagus, kamera goyang semua, tapi tiap kali aku buka lagi rasanya kayak balik ke hari itu.",
    // Daftar momen yang ada di dalam videonya (cuma buat dipajang)
    momen: [
      "turun di Tugu",
      "Malioboro malem",
      "nyasar naik motor",
      "maksa nunggu sunrise",
      "angkringan tengah malam",
    ],
  },

  // Alasan random yang muncul tiap tombol dipencet
  alasan: [
    "Ketawa kamu itu obat paling murah dan paling manjur 😄",
    "Kamu peduli sama hal kecil yang orang lain nggak notice 🥹",
    "Kamu bikin hari yang biasa jadi kerasa spesial ✨",
    "Kamu sabar banget sama aku, kadang kelewat sabar 🥺",
    "Cara kamu cerita hal yang kamu suka itu lucu banget 🐣",
    "Kamu jujur, walaupun jujurnya kadang nyelekit 😅",
    "Kamu selalu inget hal-hal yang aku sendiri lupa 💭",
    "Kamu bikin aku pengin jadi orang yang lebih baik 🌱",
    "Marah kamu aja masih lucu, apalagi senyum kamu 💗",
    "Karena tanpa kamu, semuanya kerasa sepi aja 🫶",
    "Kamu kuat, tapi kamu tetep mau bersandar ke aku 🤍",
    "Karena kamu... ya kamu. Nggak perlu alasan lain 💞",
  ],

  // Janji-janji yang bisa dicentang
  janji: [
    "Lebih dengerin kamu sebelum sibuk ngebela diri",
    "Nggak ngulangin kesalahan yang sama",
    "Bales chat kamu lebih cepet, nggak dicuekin",
    "Minta maaf duluan kalau aku salah, tanpa gengsi",
    "Lebih sering bilang sayang, bukan cuma mikirin",
  ],
};
