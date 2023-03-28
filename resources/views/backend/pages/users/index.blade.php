@extends('backend.layouts.master')
@section('title')
    <title>Users Page</title>
@endsection

@section('content')
<section class="contet">
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-info"><a  href="{{route('user.create')}}">New Revenue</a></button>


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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->password}}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $users->links() !!}

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
