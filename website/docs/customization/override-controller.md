---
sidebar_position: 4
---

# Overriding Controller Badaso Midtrans Module
There are times when controller of midtrans module needs adjustments, such as adding logic that is not provided by Badaso. To setting payment option badaso midtrans module, you can follow these steps:

1. Create the new controller for overriding.

```php

php artisan make:controller NewController

```

2. Do extends on the controller that will be customized and import some important code on the new controller. Same steps when you override controller in <a href="https://badaso-docs.uatech.co.id/customization/overriding-controller" target="_blank">badaso</a>



