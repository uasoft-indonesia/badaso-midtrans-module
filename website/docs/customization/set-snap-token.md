---
sidebar_position: 3
---

# Use Snap Payment Badaso Midtrans Module

To use snap payments badaso midtrans module, you can follow these steps:

1. Initialize snap JS in frontend(PHP)

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

2. Add this code in your file js

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




