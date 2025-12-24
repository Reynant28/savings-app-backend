# Savings App Backend

Repository ini berisi **Backend** untuk aplikasi **Savings App**, sebuah platform pencatat dan pengelola target tabungan pengguna.

Backend dibangun menggunakan **Laravel 12** dan berfungsi sebagai penyedia layanan REST API untuk autentikasi, pengelolaan target tabungan, serta riwayat transaksi secara real-time.

> **Frontend Repository (React):**  
> https://github.com/Reynant28/savings-app-frontend

---

## Fitur Utama

- **Secure Authentication**  
  Sistem login dan register menggunakan **Laravel Sanctum (token-based authentication)**.

- **Goal Management**  
  CRUD target tabungan lengkap dengan **upload foto target**.

- **Transaction Tracking**  
  Pencatatan riwayat setoran (deposit) yang terhubung ke setiap target tabungan.

- **Progress Analytics**  
  Perhitungan otomatis:
  - total tabungan
  - persentase progres
  - sisa hari menuju target

- **File Storage**  
  Penyimpanan gambar menggunakan **Laravel Storage**.

---

## Tech Stack

- **Framework**: Laravel 12  
- **Database**: PostgreSQL  
- **Authentication**: Laravel Sanctum  
- **File Handling**: Laravel Storage

---

## Struktur Database

Backend ini menggunakan struktur tabel relasional:

- `tb_users`  
  Menyimpan data pengguna.

- `tb_tabungan`  
  Menyimpan data target tabungan (relasi ke `id_user`).

- `tb_transaksi_tabungan`  
  Menyimpan riwayat setoran (deposit) tiap tabungan.

---

## Instalasi (Localhost)

### 1️. Clone & Install Dependency
```bash
git clone https://github.com/Reynant28/savings-app-backend.git
cd savings-app-backend
composer install
````

### 2️. Konfigurasi Environment

* Duplikat file `.env.example` menjadi `.env`
* Generate application key:

```bash
php artisan key:generate
```

* Atur konfigurasi database di `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=db_savings
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. Migrasi Database & Storage

```bash
php artisan migrate
php artisan storage:link
```

### 4️. Jalankan Server

```bash
php artisan serve
```

Server akan berjalan di:

```
http://127.0.0.1:8000
```

---

## Video Demonstrasi

Video berisi:

* Penjelasan kode backend
* Struktur database
* Demonstrasi

Link:
[https://drive.google.com/drive/folders/1wRhFe-tW-F0LWSCmZgILfMp3njed78pO](https://drive.google.com/drive/folders/1wRhFe-tW-F0LWSCmZgILfMp3njed78pO)
