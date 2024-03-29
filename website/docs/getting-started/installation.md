---
sidebar_position: 1
---

# Installation

1. Install badaso first with commerce module installed. Also you can install commerce theme if you want to. After that, you can install the badaso midtrans-module.

1. Install the badaso midtrans module with the following command.

    ```
    composer require badaso/midtrans-module
    ```

1. (Optional) Run the following command to setup the badaso-core. If you never run it before.

    ```
    php artisan badaso:setup
    ```
1. (Optional) Run the following command to setup the badaso-commerce-module. If you never run it before.

    ```
    php artisan badaso-commerce:setup
    ```

1. Run the following command to setup the badaso midtrans module

    ```
    php artisan badaso-midtrans:setup
    ```

1. Run the following command to migrate database.

    ```
    php artisan migrate
    ```

1. Run the following command

    ```
    composer dump-autoload
    ```

1. (Optional) Run the following command to generate seeder of badaso core, and commerce module. If you never run it before.

    ```
    php artisan db:seed --class="Database\Seeders\Badaso\BadasoSeeder"

    php artisan db:seed --class="Database\Seeders\Badaso\Commerce\BadasoCommerceModuleSeeder"
    ```

1. Run the command to generate seeder of badaso midtrans module.

    ```
    php artisan db:seed --class='Database\Seeders\Badaso\Midtrans\BadasoMidtransModuleSeeder'
    ```

1. Add the plugins menu to your MIX_BADASO_MENU to .env. If you have another menu, include them using delimiter comma (,).
    ```
    MIX_BADASO_MENU=${MIX_DEFAULT_MENU},commerce-module,midtrans-module
    ```
1. Fill the payment config in `badaso-commerce.php`. For example:
    - `'payments' => ['Uasoft\Badaso\Module\Midtrans\BadasoMidtransModule']`

1. Install JS depedency
    ```
    npm install
    ```

1. Build JS dependency.
    ```
    npm run watch
    ```

1. Your midtrans module already installed and you can see the menu at the dashboard.

    





