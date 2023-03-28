@extends('backend.layouts.master')
@section('title')
    <title>Expenses edit Page</title>
@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Expenses Edit</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('expense.update',$expenses->id)}}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="number" name="nominal" class="form-control" value="{{$expenses->nominal}}">
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control" value="{{$formattedDate}}">
                        </div>
                        <div class="form-group">
                            <label for="explanation">Explanation</label>
                            <input type="text" name="explanation" class="form-control" value="{{$expenses->explanation}}" placeholder="Explanation">
                        </div>
                        <div class="form-group">
                            <label for="cat_id">Category</label>
                            <select class="form-control" id="cat_id" name="cat_id">
                                @foreach($categories as $category)
                                    @if($category->id == $expenses->cat_id)
                                        <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endif
                                @endforeach
                            </select>
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
