
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.5/JsBarcode.all.min.js" integrity="sha512-QEAheCz+x/VkKtxeGoDq6nsGyzTx/0LMINTgQjqZ0h3+NjP+bCsPYz3hn0HnBkGmkIFSr7QcEZT+KyEM7lbLPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <svg id="barcode"></svg>
    <span id="package_number" hidden>{{ $id }}</span>
    <script type="text/javascript">
        console.log(document.getElementById("package_number").textContent)
        JsBarcode("#barcode", document.getElementById("package_number").textContent);
        window.print()
    </script>
</body>
</html>

