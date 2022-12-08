# Food API

API sederhana mengenai makanan yang dibangun dengan menggunakan Lumen. Pertama, siapkan sebuah database dan jangan lupa untuk menambahkan file .env dengan perintah berikut ini:

```
cp .env.example menjadi .env
```

Setelah itu silakan lakukan penyesuaian database dan jalankan migrasi dengan perintah berikut ini:

```
php artisan migrate
```

Jalankan local development server dengan perintah berikut ini:

```
php -S localhost:8000 -t public
```