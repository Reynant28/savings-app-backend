# Savings App - Backend 

Repository ini berisi backend untuk aplikasi **Savings App**, platform pencatat target tabungan. Dibangun menggunakan **Laravel 12**, API ini menyediakan layanan pengelolaan data pengguna, target tabungan, hingga riwayat transaksi tabungan secara real-time.

> **Catatan:** Untuk repositori Frontend (React), silakan kunjungi: [https://github.com/Reynant28/savings-app-frontend]

## Fitur Utama

- **Secure Authentication**: Menggunakan Laravel Sanctum untuk sistem Login & Register yang aman.
- **Custom Goal Management**: CRUD target tabungan lengkap dengan upload foto target.
- **Transaction Tracking**: Pencatatan riwayat setoran (deposit) yang terhubung ke setiap target tabungan.
- **Progress Analytics**: Kalkulasi otomatis persentase progres tabungan dan sisa hari menuju target.
- **File Storage**: Integrasi sistem penyimpanan lokal untuk gambar profil/target tabungan.

## Stack Teknologi

- **Framework:** Laravel 12
- **Database:** PostgreSql
- **Auth:** Laravel Sanctum (Token-based)
- **Image Handling:** Intervention Image / Laravel Storage

## Struktur Database

Backend ini menggunakan struktur tabel relasional sebagai berikut:
- `tb_users`: Menyimpan data kredensial pengguna.
- `tb_tabungan`: Menyimpan data target tabungan (terikat ke `id_user`).
- `tb_transaksi_tabungan`: Detail setiap setoran yang masuk ke tabungan tertentu.



## Instalasi (Localhost)

1. **Clone & Install:**
   ```bash
   git clone [https://github.com/Reynant28/savings-app-backend.git](https://github.com/UsernameAnda/savings-app-backend.git)
   cd savings-app-backend
   composer install
2. **Environment Setup:**

- Duplikat .env.example menjadi .env.
- Jalankan
  ```
  php artisan key:generate.
- Konfigurasi koneksi database Anda di dalam .env.
  ```
  DB_CONNECTION=pgsql
  DB_HOST=127.0.0.1
  DB_PORT=5432
  DB_DATABASE=db_savings
  DB_USERNAME=[your_username]
  DB_PASSWORD=[your_password]
3. **Database Migration:** Lakukan migrasi database dan buka akses folder storage publik (Penting untuk gambar produk):
   ```
   php artisan migrate
   php artisan storage:link
4. **Jalankan Server**:
    ```
    php artisan serve
maka server akan berjalan di: http://127.0.0.1:8000   

## **Video Demonstrasi**
Berikut adalah link video penjelasan kode, struktur database, dan demonstrasi penggunaan aplikasi:

https://drive.google.com/drive/folders/1wRhFe-tW-F0LWSCmZgILfMp3njed78pO?usp=sharing
