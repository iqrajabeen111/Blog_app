@extends('layout.master')

@section('content')

<div class="container mt-4">

    <div class="row col-lg-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add Category</h2>
            </div>
            <div class="pull-right">
            </div>
        </div>
    </div>
    @if (session('message'))
    <h5 class="alert alert-success">{{ session('message') }}</h5>
    @endif
  

    <form action="{{ route('categorystore') }}" method="POST">

        @csrf
        <div class="row col-lg-12">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                    @if ($errors->has('title'))
                        <strong style="color:red;">{{ $errors->first('title') }}.</strong>
                    @endif
                </div>
            </div>
           
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>

    </form>
</div>
@endsection