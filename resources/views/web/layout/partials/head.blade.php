<link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
<!-- endinject -->
<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
<!-- End plugin css for this page -->
<!-- inject:css -->
<link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">
<!-- endinject -->
<link rel="shortcut icon" href="{{ asset('assets/logos/favicon.png') }}" />

<script src="{{ asset('assets/js/QR/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/QR/qrcode.js') }}"></script>

<link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

   <script src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.5/JsBarcode.all.min.js" integrity="sha512-QEAheCz+x/VkKtxeGoDq6nsGyzTx/0LMINTgQjqZ0h3+NjP+bCsPYz3hn0HnBkGmkIFSr7QcEZT+KyEM7lbLPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<meta name="_token" content="{{csrf_token()}}" />






<style>
    input.error.fail-alert {
/* border: 1px solid #c84332; */

line-height: 1;
padding: 2px 0 6px 6px;
background: #ffffff;

}

label.error.fail-alert{
    color:#c84332;
}

input.valid.success-alert {
border: 2px solid #4CAF50;
color: green;
}


</style>
