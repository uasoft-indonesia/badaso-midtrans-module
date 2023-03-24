---
sidebar_position: 3
---

# Gunakan Snap Payment Modul Badaso Midtrans

Tuntuk menggunakan modul midtrans badaso pembayaran snap, Anda dapat mengikuti langkah-langkah ini:

1. Inisialisasi snap JS di frontend (PHP)

```php
<!DOCTYPE html>
<html lang="en">

<head>
  ...

  <!-- Initial script js -->
 <script type="text/javascript" src="" data-client-key="" id="snapurl"></script>
  <!-- End script js -->

  ...

</head>
...
</html>
```

2. Tambahkan kode ini di file js Anda

```php

<script>
    function getSnapUrl(){
     fetch("/badaso-api/module/midtrans/v1/snap/configuration", {
       method: "GET",
     })
       .then((res) => res.json())
       .then(({ data: { baseUrl, clientKey } }) => {

          var scriptTag = document.createElement('script')
          scriptTag.src = baseUrl
          document.body.appendChild(scriptTag)
          const inputSnaps = document.querySelectorAll('script[id="snapurl"]');

         for (const inputSnap of inputSnaps) {
           inputSnap.setAttribute("src", baseUrl);
           inputSnap.setAttribute("data-client-key", clientKey);
         }
       })
       .catch((error) => console.error(error));

}

getSnapUrl();

</script>
```




