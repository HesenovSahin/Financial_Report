@extends('backend.layouts.master')
@section('title')
    <title>Category edit Page</title>
@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Category Edit</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('category.update',$categories->id)}}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="{{$categories->title}}">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="number" min="0" max="1" name="status" class="form-control" value="{{$categories->status}}" placeholder="Explanation">
                        </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
    </div>

    @endsection
