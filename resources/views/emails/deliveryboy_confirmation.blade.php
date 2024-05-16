<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css"
    />

    <!-- Icons: https://getbootstrap.com/docs/5.0/extend/icons/ -->
    <!-- https://cdnjs.com/libraries/font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    />

    <title>Multi Vendors Ecommerce</title>
  </head>
  <body class="d-flex vw-100 vh-100 align-items-center justify-content-center">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <tr><td>Dear {{$name}}! </td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>Please Click on Below Link To Confirm Your Delivery Account :-</td></tr><br><br>
            </div>
            <div class="col-sm-12">
                <tr><td><a href="{{ url('deliveryboy/confirm/'.$code)}}">{{ url('deliveryboy/confirm/'.$code)}}</a></td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>Thanks & Regrads,</td></tr>
            </div>
        </div>
        <tr><td>Multi Vendor Ecommerce</td></tr>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <!-- https://cdnjs.com/libraries/popper.js/2.5.4 -->
    <!-- <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.min.js"
    ></script> -->

    <!-- More: https://getbootstrap.com/docs/5.0/getting-started/introduction/ -->
  </body>
</html>
