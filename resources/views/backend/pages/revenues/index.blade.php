@extends('backend.layouts.master')
@section('title')
    <title>Revenues Page</title>
@endsection

@section('content')
<section class="contet">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-info"><a  href="{{route('revenue.create')}}">New Revenue</a></button>


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
                                <th>Sources</th>
                                <th>Nominal</th>
                                <th>Date</th>
                                <th>Explanation</th>
                                <th>Cat_id</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($revenues as $revenue)
                                <tr>
                                    <td>{{$revenue->id}}</td>
                                    <td>{{$revenue->sources}}</td>
                                    <td>{{$revenue->nominal}}</td>
                                    <td>{{ date('Y-m-d', strtotime($revenue->date)) }}</td>
                                    <td>{{$revenue->explanation}}</td>
                                    <td>{{$revenue->category->title}}</td>
                                    <td>
                                        <a href="{{ route('revenue.edit', $revenue->id) }}" class="btn btn-info">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('revenue.destroy', $revenue->id) }}" method="POST">
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
                        {!! $revenues->links() !!}

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
