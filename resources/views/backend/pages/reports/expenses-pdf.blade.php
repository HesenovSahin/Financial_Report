<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Expenses Report</title>

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

<h1>Expenses Report</h1>

<p>From: {{ $fromDate }} To: {{ $toDate }}</p>



<table>

    <thead>

    <tr>

        <th>Date</th>

        <th>Explanation</th>

        <th>Nominal</th>

    </tr>

    </thead>

    <tbody>

    @foreach($expenses as $expense)

        <tr>

            <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</td>

            <td>{{ $expense->explanation }}</td>

            <td>{{ $expense->nominal }}</td>

        </tr>

    @endforeach

    </tbody>

    <tfoot>

    <tr>

        <td class="total" colspan="2">Total Expenses:</td>

        <td class="total">{{ $totalExpenses }}</td>

    </tr>

    </tfoot>

</table>



</body>

</html>
