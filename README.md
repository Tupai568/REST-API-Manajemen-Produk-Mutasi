# REST API Manajemen Produk & Mutasi

REST API ini dirancang untuk menjadi antarmuka backend dari sistem Manajemen Produk & Mutasi Barang. API ini menyediakan berbagai endpoint yang memungkinkan pengguna untuk melakukan operasi CRUD (Create, Read, Update, Delete) terhadap entitas utama seperti User, Produk, Lokasi, dan Mutasi.

#### Tujuan API

- Memungkinkan integrasi sistem dengan frontend atau aplikasi pihak ketiga.
- Menyediakan mekanisme otentikasi dan otorisasi menggunakan token (via Laravel Sanctum).
- Menyediakan endpoint yang dapat digunakan untuk mengelola data produk, lokasi penyimpanan, dan pencatatan mutasi barang masuk dan keluar.


### Teknologi yang Digunakan

- Laravel 11 sebagai kerangka kerja utama backend
- Laravel Sanctum untuk otentikasi token
- MySQL untuk penyimpanan data
- Postman untuk pengujian dan dokumentasi endpoint
- JSON sebagai format data komunikasi


### Autentikasi

semua endpoint dilindungi dan hanya dapat diakses setelah proses login berhasil. Setelah login, sistem akan memberikan

```
POST /api/login
```

Kemudian, gunakan token sebagai Bearer Token:

```
Content-Type: application/json
Authorization: Bearer your_token_here
```


# Login
untuk melakukan autentikasi dan masuk ke dalam aplikasi dengan memberikan kredensial mereka. Setelah autentikasi berhasil, server akan merespons dengan objek pengguna dan token autentikasi.
- Method: POST
- URL: http://127.0.0.1:8000/api/login
  
Example Request Body:
```
{
  "email": "user@example.com",
  "password": "your_password"
}
```


# Produk

digunakan untuk mengelola data produk. Operasi CRUD (Create, Read, Update, Delete) tersedia sepenuhnya dan dilindungi oleh otentikasi token.

#### Lihat Semua Produk
- Method: GET
- URL: http://127.0.0.1:8000/api/produk

### Lihat Produk Sesuai Id
- Method: GET
- URL: http://127.0.0.1:8000/api/produk/{id}

#### Tambah Produk
memungkinkan pengguna untuk menambahkan produk baru ke sistem
- Method: POST
- URL: http://127.0.0.1:8000/api/produk

Example Request Body:
```
{
  "nama_produk": "Ayam Super mangon",
  "kode_produk": "aym1",
  "kategori": "Peternakan",
  "satuan": "ekor"
}
```

Example Response 
```
{
    "success": true,
    "message": "Produk berhasil ditambahkan",
    "data": {
        "nama_produk": "Ayam Super mangon",
        "kode_produk": "aym8",
        "kategori": "Peternakan",
        "satuan": "ekor",
        "updated_at": "2025-06-27T19:47:21.000000Z",
        "created_at": "2025-06-27T19:47:21.000000Z",
        "id": 14
    },
    "timestamp": "2025-06-27 19:47:21"
}
```
#### Update Produk
memungkinkan pengguna untuk mengupdate produk
- Method: PUT
- URL: http://127.0.0.1:8000/api/produk/{id}
Example Request Body:
```
{
  "nama_produk": "Ayam Super mangon",
  "kode_produk": "a88b",
  "kategori": "Peternakan",
  "satuan": "ekor"
}
```
#### Delete Produk
memungkinkan pengguna untuk menghapus produk
- Method: DELETE
- URL: http://127.0.0.1:8000/api/produk/{id}


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
