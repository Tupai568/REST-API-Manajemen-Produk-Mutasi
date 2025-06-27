# REST API Manajemen Produk & Mutasi

Aplikasi berbasis Laravel 11 untuk manajemen produk, lokasi penyimpanan, dan mutasi stok barang. Didesain untuk integrasi mudah dengan sistem frontend atau mobile melalui RESTful API. Dilengkapi dokumentasi Postman dan siap dijalankan dengan Docker.

#### Fitur Unggulan

-   Autentikasi API dengan Laravel Sanctum
-   CRUD: Produk, Lokasi, Produk-Lokasi, Mutasi
-   Validasi dan penanganan error terstruktur (helper ApiResponse)
-   Dokumentasi interaktif via Postman
-   Dukungan Docker untuk kemudahan deployment

### Struktur Modul

-   Produk Informasi produk seperti nama, kode, kategori, satuan
-   Lokasi Lokasi penyimpanan produk seperti gudang atau cabang
-   ProdukLokasi Relasi banyak-ke-banyak antara produk dan lokasi
-   Mutasi Pergerakan stok masuk dan keluar antar lokasi

### Autentikasi

Gunakan endpoint login untuk memperoleh token:

```
POST /api/login
```

Kemudian, gunakan token sebagai Bearer Token:

```
Authorization: Bearer your_token_here
```

### Cara Menjalankan

1. Clone Repositori

```
git clone https://github.com/username/nama-proyek.git
```

```
cd nama-proyek
```

2. Install Dependensi

```
composer install
```

3. Setup Environment

```
cp .env.example .env
```

```
php artisan key:generate
```

4. Jalankan Migrasi & Data Dumy

```
php artisan migrate:fresh --seed
```

5. Jalankan Server Lokal

```
php artisan serve
```

### Menjalankan dengan Docker

```
docker build -t nama-proyek .
docker run -p 8000:8000 nama-proyek
```

Atau jika menggunakan docker-compose:

```
docker-compose up -d
```

### Dokumentasi API

📄 Klik untuk melihat → [Dokumen Api Postman](https://documenter.getpostman.com/view/31094366/2sB2xFf88q)

### Developer

ISMAIL

📄 Lisensi
Proyek ini dilisensikan di bawah MIT License
