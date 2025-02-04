<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            font-size: 5px;
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
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Invoice No</th>
                    <th scope="col">Shop</th>
                    <th scope="col">Table</th>   
                    <th scope="col">Table Charge</th>
                    <th scope="col">Item Charge</th>
                    <th scope="col">Total Time</th>
                    <th scope="col">Total</th>
                    <th scope="col">Charge</th>
                    <th scope="col">Refund</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check Out</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Created By</th>                    
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>  
                    <td>{{ $item->invoice_number }}</td>                                     
                    <td>{{ $item->shop ? $item->shop->name : 'Unknown' }}</td>
                    <td>{{ $item->table ? $item->table->name : 'Unknown' }}</td>
                    <td>{{ $item->table_charge }}</td>
                    <td>{{ $item->items_charge }}</td>
                    <td>{{ $item->total_time }}</td>
                    <td>{{ $item->total }}</td>
                    <td>{{ $item->charge }}</td>
                    <td>{{ $item->refund }}</td>
                    <td>{{ $item->checkin }}</td>
                    <td>{{ $item->checkout }}</td>                    
                    <td>{{ $item->payment ? $item->payment->name : 'Unknown' }}</td>
                    <td>{{ $item->customer ? $item->customer->name : 'Unknown' }}</td>                    
                    <td>{{ $item->creator ? $item->creator->name : 'Unknown' }}</td>                   
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
