@extends('backend.layouts.master')
@section('title')
    <title>Expenses Page</title>
@endsection

@section('content')
<section class="contet">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-info"><a  href="{{route('expense.create')}}">New Expense</a></button>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nominal</th>
                                <th>Date</th>
                                <th>Explanation</th>
                                <th>Cat_id</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expenses as $expense)
                                <tr>
                                    <td>{{$expense->id}}</td>
                                    <td>{{$expense->nominal}}</td>
                                    <td>{{ date('Y-m-d', strtotime($expense->date)) }}</td>
                                    <td>{{$expense->explanation}}</td>
                                    <td>{{$expense->category->title}}</td>
                                    <td>
                                        <a href="{{ route('expense.edit', $expense->id) }}" class="btn btn-info">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('expense.destroy', $expense->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $expenses->links() !!}

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!-- /.content -->
    </div>
</section>
@endsection
