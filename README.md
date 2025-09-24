# 🎓 Sistem Akademik Sederhana - Mission 4

## ✅ Fitur Utama
- **Authentication & Authorization** (Role: Admin, Mahasiswa)
- **Admin**: Kelola mata kuliah & mahasiswa
- **Mahasiswa**: Lihat & enroll course (multi-select + hitung SKS)
- **Validasi Form**: Pesan error jika input kosong
- **Konfirmasi Hapus**: Tampilkan nama & SKS sebelum delete
- **Menu Aktif**: Highlight saat dipilih
- **Interaktivitas JS**: DOM manipulation, event handling, async (`setTimeout`)

## 🛠️ Teknologi yang Digunakan
- **Backend**: Laravel 12
- **Frontend**: Blade, Tailwind CSS, Vanilla JavaScript
- **Database**: MySQL
- **Auth**: Laravel Breeze

## 📸 Screenshot Uji Coba
*(Lampirkan screenshot saat submit ke LMS)*
1. Login sebagai Admin & Mahasiswa
2. Halaman "Kelola Mata Kuliah" (Admin)
3. Halaman "Daftar Mata Kuliah" (Mahasiswa) + multi-select
4. Form validation error
5. Delete confirmation dialog
6. Alert async di dashboard

## 🚀 Cara Menjalankan
1. `composer install`
2. `npm install && npm run build`
3. Salin `.env.example` → `.env`, sesuaikan database
4. `php artisan key:generate`
5. `php artisan migrate --seed`
6. `php artisan serve`