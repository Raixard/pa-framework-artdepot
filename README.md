<div align="center">
    <img src="./public/img/ui/ArtDepot_LogoFull.png" alt="ArtDepot" width="50%">
</div>

# ArtDepot
Sebuah website *art community*, yaitu komunitas yang berfokus pada karya seni visual. Di ArtDepot, pengguna dapat membagikan karya mereka, melihat karya orang lain, serta berinteraksi dengan menyukai dan mengomentari karya, serta mengikuti *artist* (pengguna) lain. ArtDepot dibuat sebagai pemenuhan projek akhir dari Praktikum Framework-Based Programming semester ganjil tahun 2022 dengan anggota kelompok:
- 2009106051 - Ferry Fathurrahman
- 2009106071 - Muhammad Basith Algiffari

# Development (Pengaturan Awal)
- *Clone repository*
```
git clone https://github.com/Raixard/pa-framework-artdepot.git
cd pa-framework-artdepot
```
- *Install dependency* yang diperlukan
```
composer upgrade
npm install
```
- Buat .env (bisa dengan menyalin isi .env.example) juga nyalakan dan atur *database*
- Atur *key*, *migration*, dan *seeder*
```
php artisan key:generate
php artisan migrate:fresh --seed
```
- Jalankan website dengan
```
npm run dev
```
