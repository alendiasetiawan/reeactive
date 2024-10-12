<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        .row {
          margin-left: 3px;
          margin-top: -1px;
        }

        /* Clear floats after the columns */
        .row:after {
          content: "";
          display: table;
          clear: both;
        }

        .page-break {
            page-break-after: always;
        }

        @page {
        margin-top: 2px;
        margin-bottom : 2px;
        }
    </style>
</head>

<body style="font-family: Calibri, sans-serif;">
    <div style="width: 100%; text-align: center; padding-top: 2px;">
        <img src="voucher.png" width="560" height="105"/>
    </div>
    <br/>
    <div style="text-align: center">
        <img src="data:image/png;base64,{{ $qr }}">
        <br/>
        <p>
            Tukar voucher dan dapatkan diskon sebesar <strong>{{ $voucherAmount }}</strong> untuk setiap pembelian merchandise Reeactive
            <br/>
            Berlaku sampai : <strong>{{ $validDate }}</strong>
            <br/>
            <b style="color:#f8538d">{{ $batchName }} - reective.com</b>
        </p>
    </div>
</body>
</html>
