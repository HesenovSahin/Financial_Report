<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Revenues Report</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

        table {

            width: 100%;

            border-collapse: collapse;

        }

        th, td {

            text-align: left;

            padding: 8px;

            border: 1px solid #ddd;

        }

        th {

            background-color: #f2f2f2;

        }

        .total {

            font-weight: bold;

        }

    </style>

</head>

<body>

<h1>Revenues Report</h1>

<p>From: {{ $fromDate }} To: {{ $toDate }}</p>



<table>

    <thead>

    <tr>

        <th>Date</th>

        <th>Source</th>

        <th>Explanation</th>

        <th>Amount</th>

        <th>Category</th>


    </tr>

    </thead>

    <tbody>

    @foreach($revenues as $revenue)

        <tr>

            <td>{{ \Carbon\Carbon::parse($revenue->date)->format('d M Y') }}</td>

            <td>{{ $revenue->sources }}</td>


            <td>{{ $revenue->explanation }}</td>

            <td>{{ $revenue->nominal }}</td>

            <td>{{ $revenue->category->title }}</td>


        </tr>

    @endforeach

    </tbody>

    <tfoot>

    <tr>

        <td class="total" colspan="2">Total Revenues:</td>

        <td class="total">{{ $totalRevenues }}</td>

    </tr>

    </tfoot>

</table>



</body>

</html>
