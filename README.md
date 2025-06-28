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
{
  "success": true,
  "message": "",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john.doe@example.com",
      "email_verified_at": null,
      "created_at": "2023-01-01T00:00:00Z",
      "updated_at": "2023-01-01T00:00:00Z"
    },
    "token": "your_auth_token"
  },
  "timestamp": "2023-01-01T00:00:00Z"
}
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

### Lihat Semua Produk
- Method: GET
- URL: http://127.0.0.1:8000/api/produk

### Lihat Produk Sesuai Id
- Method: GET
- URL: http://127.0.0.1:8000/api/produk/{id}

### Tambah Produk
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
### Update Produk
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
### Delete Produk
memungkinkan pengguna untuk menghapus produk
- Method: DELETE
- URL: http://127.0.0.1:8000/api/produk/{id}

# Lokasi
digunakan untuk mengelola data lokasi penyimpanan produk seperti gudang, rak, atau tempat distribusi lain dan dilindungi oleh otentikasi token.

### Lihat data lokasi
- Method: GET
- URL: http://127.0.0.1:8000/api/lokasi

### Lihat data lokasi dengan ID
- Method: GET
- URL: http://127.0.0.1:8000/api/lokasi{id}

### Tanbah data lokasi
memungkinkan pengguna untuk menambahkan lokasi baru ke sistem
- Method: POST
- URL: http://127.0.0.1:8000/api/lokasi

Example Request Body:
```
{
  "kode_lokasi": "RK02",
  "nama_lokasi": "RAK LANTAI 1"
}
```
### Update data lokasi
memungkinkan pengguna untuk mengupdate lokasi
- Method: PUT
- URL: http://127.0.0.1:8000/api/lokasi{id}

Example Request Body:
```
{
  "kode_lokasi": "RK03",
  "nama_lokasi": "RAK LANTAI 3"
}
```

# ProdukLokasi
digunakan untuk mencatat dan mengelola jumlah produk tertentu yang disimpan di lokasi tertentu dan dilindungi oleh otentikasi token.

### Lihat data ProdukLokasi
- Method: GET
- URL: http://127.0.0.1:8000/produk-lokasi

### Lihat data ProdukLokasi dengan ID
- Method: GET
- URL: http://127.0.0.1:8000/api/produk-lokasi{id}

### Tanbah data ProdukLokasi
memungkinkan pengguna untuk menambahkan Data baru ke sistem
- Method: POST
- URL: http://127.0.0.1:8000/api/produk-lokasi

Example Request Body:
```
{
  "produk_id": 3,
  "lokasi_id": 7,
  "stok": 50
}
```

### Update data ProdukLokasi
memungkinkan pengguna untuk mengupdate data
- Method: PUT
- URL: http://127.0.0.1:8000/api/lokasi{id}

Example Request Body:
```
{
  "stok": 50
}
```

# Mutasi
digunakan untuk mengambil data mutasi yang ada, termasuk detail tentang lokasi pengguna dan produk yang terkait dengan setiap mutasi..

### Lihat data Mutasi
- Method: GET
- URL: http://127.0.0.1:8000/mutasi

### Lihat data Mutasi dengan ID
- Method: GET
- URL: http://127.0.0.1:8000/api/mutasi{id}

### Tambah data Mutasi
memungkinkan pengguna untuk menambahkan Data baru ke sistem
- Method: POST
- URL: http://127.0.0.1:8000/api/mutasi

Example Request Body:
```
{
  "tanggal": "2025-06-27",
  "jenis_mutasi": "masuk",
  "jumlah": 20,
  "keterangan": "Barang Masuk",
  "produk_lokasi_id": 6
}
```

### Update data Mutasi
memungkinkan pengguna untuk mengupdate data
- Method: PUT
- URL: http://127.0.0.1:8000/api/mutasi{id}

Example Request Body:
```
{
  "tanggal": "2025-06-27",
  "jenis_mutasi": "keluar",
  "jumlah": 20,
  "keterangan": "Barang Masuk",
  "produk_lokasi_id": 6
}
```


# Cara Menjalankan

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
