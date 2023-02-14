---
sidebar_position: 4
---

# Overriding Controller Modul Badaso Midtrans

Ada kalanya pengontrol modul midtrans perlu penyesuaian, seperti menambahkan logika yang tidak disediakan oleh Badaso. Untuk mengatur opsi pembayaran modul badaso midtrans, Anda dapat mengikuti langkah-langkah berikut:

1. Buat pengontrol baru untuk ditimpa.

```php

php artisan make:controller NewController

```

2. Lakukan ekstensi pada pengontrol yang akan dikustomisasi dan impor beberapa kode penting pada pengontrol baru. Langkah yang sama saat Anda mengganti pengontrol di <a href="https://badaso-docs.uatech.co.id/customization/overriding-controller" target="_blank">badaso</a>



