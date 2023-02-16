---
sidebar_position: 1
---

# Installation

1. Anda juga dapat menginstal tema commerce jika Anda mau. Setelah itu, Anda dapat menginstal modul badaso midtrans.

1. Instal modul badaso midtrans dengan perintah berikut

    ```
    composer require badaso/midtrans-module
    ```

1. (Optional) Jalankan perintah berikut untuk mengatur badaso-core. Jika Anda tidak pernah menjalankannya sebelumnya.

    ```
    php artisan badaso:setup
    ```
1. (Optional) Jalankan perintah berikut untuk menyiapkan modul badaso-commerce. Jika Anda tidak pernah menjalankannya sebelumnya.

    ```
    php artisan badaso-commerce:setup
    ```

1. Jalankan perintah berikut untuk mengatur modul badaso midtrans

    ```
    php artisan badaso-midtrans:setup
    ```

1. Jalankan perintah berikut untuk memigrasi database.

    ```
    php artisan migrate
    ```

1. Jalankan perintah berikut

    ```
    composer dump-autoload
    ```

1. (Optional) Jika Anda tidak pernah menjalankannya sebelumnya.

    ```
    php artisan db:seed --class="Database\Seeders\Badaso\BadasoSeeder"

    php artisan db:seed --class="Database\Seeders\Badaso\Commerce\BadasoCommerceModuleSeeder"
    ```

1. Jalankan perintah untuk menghasilkan seeder dari modul badaso midtrans.

    ```
    php artisan db:seed --class='Database\Seeders\Badaso\Midtrans\BadasoMidtransModuleSeeder'
    ```

1. Tambahkan menu plugin ke MIX_BADASO_MENU Anda ke .env. Jika Anda memiliki menu lain, sertakan dengan menggunakan koma pembatas(,).
    ```
    MIX_BADASO_MENU=${MIX_DEFAULT_MENU},commerce-module,midtrans-module
    ```

1. Isi konfigurasi pembayaran di `badaso-commerce.php`. Misalnya:
    - `'payments' => ['Uasoft\Badaso\Module\Midtrans\BadasoMidtransModule']`

1. Instal ketergantungan JS
    ```
    npm install
    ```

1. Bangun ketergantungan JS.
    ```
    npm run watch
    ```

1. Modul midtrans Anda sudah terpasang dan Anda dapat melihat menu di dashboard.

    





