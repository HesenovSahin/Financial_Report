@extends('backend.layouts.master')

@section('title')
    <title>Reports Page</title>
@endsection

@section('content')
    <form class="mb-4" action="{{ route('reports.index') }}" method="GET">
        <div class="row">
            <div class="col-sm-4">
                <label for="from_date">From:</label>
                <input class="form-control" type="date" name="from_date" id="from_date">
            </div>
            <div class="col-sm-4">
                <label for="to_date">To:</label>
                <input class="form-control" type="date" name="to_date" id="to_date">
            </div>
            <div class="col-sm-4">
                <button class="btn btn-primary" type="submit">Generate Report</button>
            </div>
        </div>
    </form>

    @if ($expenses->isNotEmpty() || $revenues->isNotEmpty())
        <h1>Report</h1>

        <h2>Expenses</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Explanation</th>
                    <th>Amount</th>
                    <th>Category</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($expenses as $expense)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</td>
                        <td>{{ $expense->explanation }}</td>
                        <td>{{ $expense->nominal }}</td>
                        <td>{{ $expense->category->title }}</td>
                    </tr>
                @endforeach
                <tr class="table-primary">
                    <td colspan="2"><strong>Total Expenses:</strong></td>
                    <td colspan="2"><strong>{{ $totalExpenses }}</strong></td>
                </tr>
                </tbody>
            </table>
            <div class="text-center">
                <a href="{{ route('expenses.export', ['from_date' => request('from_date'), 'to_date' => request('to_date')]) }}" class="btn btn-success">Export Expenses</a>
                <a href="{{ route('expense.viewpdf', ['from_date' => request('from_date'), 'to_date' => request('to_date')]) }}" target="_blank" class="btn btn-primary">View Expenses PDF</a>
                <a href="{{ route('expense.downloadpdf', ['from_date' => request('from_date'), 'to_date' => request('to_date')]) }}" class="btn btn-primary">Download Expenses PDF</a>
            </div>
        </div>

        <h2>Revenues</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Sources</th>
                    <th>Explanation</th>
                    <th>Amount</th>
                    <th>Category</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($revenues as $revenue)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($revenue->date)->format('d M Y') }}</td>
                        <td>{{ $revenue->sources }}</td>
                        <td>{{ $revenue->explanation }}</td>
                        <td>{{ $revenue->nominal }}</td>
                        <td>{{ $revenue->category->title }}</td>
                    </tr>
                @endforeach
                <tr class="table-primary">
                    <td colspan="2"><strong>Total Revenues:</strong></td>
                    <td colspan="2"><strong>{{ $totalRevenues }}</strong></td>
                </tr>
                </tbody>
            </table>
            <div class="text-center">
                <a href="{{ route('revenues.export' , ['from_date' => request('from_date'), 'to_date' => request('to_date')]) }}" class="btn btn-success">Export Revenues</a>
                <a href="{{ route('revenues.viewpdf', ['from_date' => request('from_date'), 'to_date' => request('to_date')]) }}" target="_blank" class="btn btn-primary">View Revenues PDF</a>
                <a href="{{ route('revenues.downloadpdf', ['from_date' => request('from_date'), 'to_date' => request('to_date')]) }}" class="btn btn-primary">Download Revenues PDF</a>
            </div>
        </div>
    @endif
@endsection


