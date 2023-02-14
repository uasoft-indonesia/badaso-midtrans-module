---
sidebar_position: 1
---
Sebelum memulai instalasi, Anda perlu membeli lisensi terlebih dahulu. Untuk saat ini, Anda dapat menghubungi admin di sini :

[via Whatsapp Indonesia](https://api.whatsapp.com/send?phone=6282169273195&text=Saya%20ingin%20beli%20Badaso%20Menit%20Theme%20)

[via Whatsapp English](https://api.whatsapp.com/send?phone=6282169273195&text=I%20want%20to%20buy%20Badaso%20Menit%20Theme%20)

[via Telegram](https://t.me/uasoft_support)

# Installation

1. Untuk memulai, tambahkan repositori tema Landpro ke file composer.json aplikasi Anda:

    ```
    "repositories": [
        {
            "type": "vcs",
            "url": "https://your-username:your-license@gitlab.com/uasoft/badaso-landpro-theme.git"
        }
    ],

    ```
1. Anda dapat menginstal tema landpro dengan perintah berikut.

    ```
    composer require badaso/landpro-theme
    ```

1. (Opsional) Jalankan perintah berikut untuk menyiapkan file badaso-core. Jika Anda tidak pernah menjalankannya sebelumnya.

    ```
    php artisan badaso:setup
    ```
1. (Opsional) Jalankan perintah berikut untuk mengatur badaso-content. Jika Anda tidak pernah menjalankannya sebelumnya.

    ```
    php artisan badaso-content:setup
    ```

1. Jalankan perintah berikut untuk mengatur tema

    ```
    php artisan badaso-landpro-theme:setup
    ```

1. Jalankan perintah berikut untuk melakukan migrasi database.

    ```
    php artisan migrate
    ```

1. (Opsional) Jalankan perintah berikut untuk menghasilkan seeder inti badaso, dan modul konten. Jika Anda tidak pernah menjalankannya sebelumnya.

    ```
    php artisan db:seed --class="Database\Seeders\Badaso\BadasoSeeder"

    php artisan db:seed --class="Database\Seeders\Badaso\Content\BadasoContentModuleSeeder"
    ```

1.  Jalankan perintah untuk menghasilkan seeder tema landpro.

    ```
    php artisan db:seed --class='Database\Seeders\Badaso\LandproTheme\BadasoLandproThemeSeeder'
    ```

1. Tambahkan plugin ke MIX_POST_URL_PREFIX Anda ke .env.

    ```
    MIX_BADASO_PLUGINS=content-module,landpro-theme
    ```

1. Tambahkan menu plugin ke MIX_BADASO_MENU Anda ke .env. Jika Anda memiliki menu lain, sertakan menu tersebut menggunakan koma pembatas (,).
    ```
    MIX_BADASO_MENU=${MIX_DEFAULT_MENU},content-module,landpro-theme
    ```

1. Instal ketergantungan JS
    ```
    npm install
    ```

1. Bangun ketergantungan JS.
    ```
    npm run watch
    ```

1. Selesai. Anda dapat mengakses tema landpro
    ```
    http://localhost:8000/landpro
    ```
    

