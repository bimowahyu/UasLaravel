-composer install<br>
-npm install<br>
-cp .env.example .env<br>
-php artisan key:generate<br>
-buat database sesuai dengan file .env<br>
-php artisan migrate<br>
-npm run dev<br>
-php artisan serve<br>
-setting key midtrans pada file. env,sesuai dashboard sandbox<br>
-jalankan php artisan serve pada terminal vscode dan ngrok http 8000 pada terminal ngrok<br>
-copy url ngrok yg https://346e-103-18-35-99.ngrok-free.app/ url tersebut sebagai contoh
<br>
-tambahkan url notifikasi ngrok di dalam dashboard midtrans sebagai contoh berikut https://346e-103-18-35-99.ngrok-free.app/payments/midtrans-notification untuk url ngrok bisa di ubah sesuai url server saat di jalankan<br>
-tambahkan https://346e-103-18-35-99.ngrok-free.app/pesanan/baru pada url ngrok tadi<br>
-buat pesanan,lakukan pembayaran pada https://simulator.sandbox.midtrans.com<br>
-ketika berhasil status pesanan pada database akan menjadi terbayar
