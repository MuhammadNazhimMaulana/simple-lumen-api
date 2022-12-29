# Simple Lumen API

Sebuah API sederhana yang dibangun dengan menggunakan Lumen. Pertama, siapkan sebuah database dan jangan lupa untuk menambahkan file .env dengan perintah berikut ini:

```
cp .env.example menjadi .env
```

Setelah itu silakan lakukan penyesuaian database dan jalankan migrasi dengan perintah berikut ini:

```
php artisan migrate
```

Jalankan server lokal dengan perintah berikut ini:

```
php -S localhost:8000 -t public
```

### Extra
Sebagai tambahan, diberikan juga contoh penerapan dari sebuah package untuk membuat sebuah barcode atau qrcode. Untuk melihat hasilnya silakan kunjungi `url_aplikasi/qr`.