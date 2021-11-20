# badaso/midtrans-module
Use midtrans payment gateway 

## Installation
- Install badaso first with commerce module installed. Also you can install commerce theme if you want to. After that, you can install the module with the following command.

```bash
composer require badaso/midtrans-module
```

- Run the following command to easily setup the module.

```bash
php artisan migrate
php artisan badaso-midtrans:setup
composer dump-autoload
php artisan db:seed --class=BadasoMidtransModuleSeeder
```

- Add the plugins to your `MIX_BADASO_MODULES` to `.env`. If you have another plugins installed, include them using delimiter comma (,).

```
MIX_BADASO_MODULES=midtrans-module
```

- Add the plugins menu to your `MIX_BADASO_MENU` to `.env`. If you have another menu, include them using delimiter comma (,).

```
MIX_BADASO_MENU=admin,midtrans-module
```

- Fill the other variables in .env file.
  - `MIDTRANS_MERCHANT_ID=` Required. Merchant ID from midtrans dashboard.
  - `MIDTRANS_CLIENT_ID` Required. Client ID from midtrans dashboard.
  - `MIDTRANS_SERVER_ID` Required. Server ID from midtrans dashboard.

- Fill the payment config in `badaso-commerce.php`. For example:
  - `'payments' => ['Uasoft\Badaso\Module\Midtrans\BadasoMidtransModule']`