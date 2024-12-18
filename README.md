# Dashboard Pengelolaan dan Monitoring UMKM Jasa Perjalanan

Proyek ini adalah sebuah aplikasi berbasis web yang dikembangkan untuk Dinas Pariwisata dan Kebudayaan Provinsi Jawa Barat. Aplikasi ini bertujuan untuk mempermudah pengelolaan dan monitoring Usaha Mikro, Kecil, dan Menengah (UMKM) yang bergerak di sektor jasa perjalanan wisata di wilayah Jawa Barat.

## Fitur Utama

**Autentikasi dan Hak Akses**
Pengguna dapat melakukan login menggunakan akun yang valid, memiliki hak akses sesuai dengan perannya, serta mereset kata sandi jika lupa saat login.

**Manajemen Akun dan Verifikasi**
Staf Industri Pariwisata dapat memverifikasi akun yang didaftarkan oleh agen perjalanan. Kasubag TU dapat mengelola akun pegawai seperti melihat, menambahkan, dan menghapus data pegawai.

**Manajemen Aduan dan Kerjasama**
Staf Humas dapat memverifikasi dan menyelesaikan aduan dari wisatawan. Pengguna dapat mengajukan persetujuan untuk kegiatan, dokumen kerjasama, tindak lanjut aduan, atau publikasi informasi. Selain itu, pengguna juga dapat meninjau dan menetapkan keputusan atas pengajuan staf, mengirimkan pemberitahuan kepada agen perjalanan, serta melihat tanggapan agen terkait kerjasama atau keluhan.

**Monitoring dan Pengelolaan UMKM**
Staf Industri Pariwisata dapat memantau agen perjalanan untuk memastikan kepatuhan dan kualitas layanan.

**Manajemen Konten**
Staf Humas dapat mengelola pembuatan artikel dan konten terkait destinasi atau objek wisata seperti membuat, mengubah, dan menghapus artikel.

## Teknologi yang Digunakan

-   **Framework Backend:** Laravel 10
-   **Database:** MySQL
-   **Frontend:** Blade Template Engine
-   **Library Tambahan:**
    -   Laravel Breeze (untuk autentikasi)
    -   ApexCharts (untuk visualisasi data)
-   **Server Lokal:** Laragon

## Instalasi

1. **Clone Repository**

    ```bash
    git clone <repository-url>
    cd pariwisata-main
    ```

2. **Instal Dependensi**

    ```bash
    composer install
    npm install
    ```

3. **Konfigurasi Environment**

    - Salin file `.env.example` menjadi `.env`
        ```bash
        cp .env.example .env
        ```
    - Sesuaikan konfigurasi database pada file `.env`

4. **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

5. **Migrasi dan Seed Database**

    ```bash
    php artisan migrate --seed
    ```

6. **Jalankan Server**
    ```bash
    php artisan serve
    ```

## Penggunaan

1. Akses dashboard melalui browser pada URL:
    ```
    http://localhost:8000/dinas/login
    ```
2. Login dengan akun admin untuk mengelola data dan memonitor UMKM.

## Struktur Folder Utama

-   **app/**: Berisi logika bisnis aplikasi.
-   **database/**: Berisi file migrasi dan seed untuk pengelolaan database.
-   **resources/views/**: Berisi file Blade untuk frontend.
-   **routes/**: Berisi definisi rute aplikasi.

## Kontribusi

Silakan ajukan pull request atau saran untuk pengembangan lebih lanjut. Proyek ini dirancang untuk terus berkembang sesuai kebutuhan Dinas Pariwisata dan Kebudayaan Provinsi Jawa Barat.

## Lisensi

Proyek ini dilisensikan untuk penggunaan internal oleh Dinas Pariwisata dan Kebudayaan Provinsi Jawa Barat.

---

**Pengembang:** Jeremia Pane
