<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .invoice {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #f9f9f9;
            box-sizing: border-box;
        }

        .invoice h1 {
            text-align: center;
        }

        .invoice .details {
            margin-top: 20px;
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice table th,
        .invoice table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice table th {
            background-color: #f2f2f2;
        }

        .invoice .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <h1>Invoice</h1>
        <div class="details">
            <p>Invoice Number: <strong>INV-2022001</strong></p>
            <p>Date: <strong>2023-01-01</strong></p>
            <p>Customer: <strong>John Doe</strong></p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Product 1</td>
                    <td>2</td>
                    <td>$50.00</td>
                    <td>$100.00</td>
                </tr>
                <tr>
                    <td>Product 2</td>
                    <td>1</td>
                    <td>$75.00</td>
                    <td>$75.00</td>
                </tr>
            </tbody>
        </table>
        <div class="total">
            <p><strong>Total: $175.00</strong></p>
        </div>
    </div>
</body>

</html>
