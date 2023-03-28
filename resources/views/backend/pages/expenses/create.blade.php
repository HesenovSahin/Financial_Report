@extends('backend.layouts.master')
@section('title')
    <title>Expense create Page</title>
@endsection

@section('content')
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Expense Create</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('expense.store')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nominal">nominal</label>
                                <input type="number" name="nominal" class="form-control" placeholder="Enter a nominal">
                                @error('nominal')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" name="date" class="form-control" >
                                @error('date')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="explanation">Explanation</label>
                                <input type="text" name="explanation" class="form-control" placeholder="Enter explanation" >
                                @error('explanation')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="cat_id" id="cat_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection
