**Timedoor_Technical_test**
Proyek ini adalah ujian backend Laravel dengan data besar untuk menguji performa query dan fitur pencarian/filter.

#Instalasi
- Clone repository ini

#Install dependency:
- composer install
- Buat file .env dari .env.example dan atur koneksi database
- Generate app key: php artisan key:generate

Migrasi & Seeder Project ini membutuhkan data besar:
1.000 Authors
3.000 Categories
100.000 Books
500.000 Ratings 
**Jalankan: php artisan migrate:fresh --seed**

Fitur 1. List Books
- Pagination (opsi 10–100 per halaman)
- Pencarian berdasarkan judul buku atau nama author
- Menampilkan rata-rata score dan jumlah voters

2. Top Authors
- Menampilkan 10 penulis dengan jumlah voters score > 5 terbanyak

3. Input Rating
- Pilih author, pilih buku, masukkan skor (1–10)
- Validasi bahwa buku milik author yang dipilih
- URL Halaman

List Books: /books
Top Authors: /authors/top
Input Rating: /ratings/create
Testing Query Manual php artisan tinker

DB::table('books')->count(); DB::table('ratings')->count();
