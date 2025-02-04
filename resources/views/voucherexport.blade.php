<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-size: 12px;
        }
        table {
            width: 100%;
            margin: auto;
            text-align: center;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #000;
            word-wrap: break-word;
        }
        th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container text-center">    
        <h3>{{ $shop['name'] }}</h3>
        <h4>{{ $shop['address'] }}</h4>
        <h4>{{ $shop['phone'] }}</h4>
        <h6>Open Daily: {{ $shop_open }} to {{ $shop_close }}</h6>
        <br/>
        <h3>Invoice Number: {{ $invoice['invoice_number'] }}</h3>
        <h6>Check-in: {{ $checkIn }}</h6>
        <h6>Check-out: {{ $checkOut }}</h6>
        <br/>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Table</th>
                    <th>30 min Price</th>
                    <th>Hours</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>{{ $tableData['name'] }}</strong></td>
                    <td><strong>{{ $tableData['amount'] }}</strong></td>
                    <td><strong>{{ $invoice['total_time'] }}</strong></td>
                    <td><strong>{{ $invoice['table_charge'] }}</strong></td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['total'] }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2"><strong>Total </strong></td>
                    <td><strong>{{ $totalQuantity }}</strong></td>
                    <td><strong>{{ $invoice['total'] }}</strong></td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Charge </strong></td>                   
                    <td><strong>{{ $invoice['charge'] }}</strong></td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Refund </strong></td>                   
                    <td><strong>{{ $invoice['refund'] }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
