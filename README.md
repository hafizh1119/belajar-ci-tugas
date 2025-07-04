# Toko Online CodeIgniter 4

Proyek ini adalah platform toko online yang dibangun menggunakan [CodeIgniter 4](https://codeigniter.com/). Sistem ini menyediakan beberapa fungsionalitas untuk toko online, termasuk manajemen produk, keranjang belanja, sistem transaksi, dan pengelolaan diskon.

## Daftar Isi

- [Fitur](#fitur)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Struktur Proyek](#struktur-proyek)

## Fitur

### Katalog Produk

- Tampilan produk dengan gambar, nama, dan harga.
- Pencarian produk berdasarkan kata kunci.

### Keranjang Belanja

- Tambah produk ke keranjang menggunakan external library Cart.
- Hapus produk dari keranjang.
- Update jumlah produk pada keranjang.
- Diskon otomatis diterapkan pada produk jika tersedia diskon aktif.

### Sistem Transaksi

- Proses checkout dengan input alamat dan ongkir.
- Menggunakan integrasi API ongkir dari RajaOngkir.
- Menyimpan data transaksi ke database.
- Menyimpan detail transaksi setiap item, termasuk diskon yang diterapkan.
- Riwayat transaksi pengguna dapat dilihat di halaman profil.

### Sistem Diskon

- Admin dapat menambahkan, mengedit, dan menghapus diskon melalui antarmuka.
- Diskon hanya dapat berlaku pada tanggal yang ditentukan.
- Diskon aktif disimpan ke dalam session saat user login dan digunakan saat transaksi.
- Saat produk ditambahkan ke keranjang, harga produk dikurangi dengan nominal diskon.

### Panel Admin

- Manajemen produk (CRUD).
- Manajemen kategori.
- Manajemen diskon (CRUD) dengan validasi agar tidak ada tanggal duplikat.
- Laporan transaksi.
- Export data ke PDF (jika ditambahkan).

### Sistem Autentikasi

- Login dan Register pengguna dengan validasi form.
- Menyimpan data user di session setelah login.
- Role admin dan user (akses admin difilter berdasarkan role).

### UI Responsif

- Menggunakan template [NiceAdmin](https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/) untuk tampilan modern dan responsif.

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- Web server (disarankan XAMPP)
- MySQL atau MariaDB

## Instalasi

1. **Clone repository ini**

   ```bash
   git clone [URL repository]
   cd belajar-ci-tugas
   ```

2. **Install dependensi dengan Composer**

   ```bash
   composer install
   ```

3. **Konfigurasi Environment (.env)**

   - Copy file `.env.example` menjadi `.env`.
   - Sesuaikan konfigurasi database:
     ```
     database.default.hostname = localhost
     database.default.database = db_ci4
     database.default.username = root
     database.default.password =
     database.default.DBDriver = MySQLi
     ```

4. **Membuat database dan menjalankan migrasi**

   - Buat database `db_ci4` di phpMyAdmin.
   - Jalankan perintah migrasi:
     ```bash
     php spark migrate
     ```
   - Untuk fitur diskon, migration-nya akan membuat tabel `diskon` dengan field: `id`, `tanggal`, `nominal`, `created_at`, `updated_at`.

5. **Menjalankan Seeder Data**

   ```bash
   php spark db:seed ProductSeeder
   php spark db:seed UserSeeder
   # Jika ada DiskonSeeder:
   php spark db:seed DiskonSeeder
   ```

6. **Jalankan server lokal**

   ```bash
   php spark serve
   ```

7. **Akses aplikasi** Buka browser dan kunjungi: `http://localhost:8080`

## Struktur Proyek

### Controllers (`app/Controllers`)

- `AuthController.php` - Mengelola login dan registrasi user.
- `Home.php` - Menampilkan halaman depan, profil, kontak, dan pengecekan diskon aktif.
- `TransaksiController.php` - Menangani keranjang, checkout, transaksi, serta penghitungan ongkir.
- `DiskonController.php` - Menangani CRUD data diskon dan validasi tanggal unik.

### Models (`app/Models`)

- `ProductModel.php` - Interaksi database untuk produk.
- `TransactionModel.php` - Interaksi database untuk transaksi.
- `TransactionDetailModel.php` - Detail transaksi per produk.
- `DiskonModel.php` - Data diskon yang disimpan di database.

### Views (`app/Views`)

- `v_home.php` - Halaman utama toko.
- `v_keranjang.php` - Menampilkan keranjang belanja.
- `v_checkout.php` - Formulir checkout.
- `v_profile.php` - Riwayat transaksi pengguna.
- `v_diskon.php` - Halaman admin untuk mengelola diskon.
- `layout.php` - Template utama UI.

### Diskon Flow:

- Saat user login atau membuka halaman utama, sistem akan mengecek diskon yang berlaku hari ini dan menyimpannya ke dalam session.
- Saat user menambahkan produk ke keranjang, harga produk dikurangi sesuai nominal diskon dari session (jika ada).
- Saat transaksi disimpan, sistem juga menyimpan nilai diskon dan menghitung subtotal setelah diskon.

### API External

- Digunakan untuk mendapatkan data ongkir menggunakan Guzzle dan API RajaOngkir.

### Webservice Dashboard

- Menggunakan cURL untuk menampilkan data transaksi pada dashboard.
- Data ditampilkan dalam bentuk tabel dengan informasi lengkap transaksi.

---

