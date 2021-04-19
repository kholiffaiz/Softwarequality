# Hands On Day 1
- Clone repository git yang sudah disediakan [di sini](https://gitlab.com/sq_training/softwarequality)
  `git clone https://gitlab.com/sq_training/softwarequality.git nama-folder`
- Masuk ke folder proyek hasil clone
  `cd nama-folder`
- Setelah masuk folder aplikasi, selanjutnya instal dependency proyek dengan perintah
`composer install`
-  Setelah proses instalasi selesai, berikutnya copy file
`.env.example` ke `.env`

	`cp .env.example .env`

- Kemudian buat app key Laravel dengan perintah

	`php artisan key:generate`

- Setelah semua disetup, sekarang checkout branch `first-test` untuk proyek pertama yang akan kita buat unit testnya.