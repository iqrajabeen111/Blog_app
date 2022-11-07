@extends('layout.master')

@section('content')

<div class="container mt-4">

    <div class="row col-lg-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Task Edit</h2>
            </div>
            <div class="pull-right">

            </div>
        </div>
    </div>
    @if (session('message'))
    <h5 class="alert alert-success">{{ session('message') }}</h5>
    @endif


    <form method="Post" action="{{route('update',$posts->id)}}">
        @method('PATCH')
        @csrf

        <div class="row col-lg-12">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" value="{{ $posts->title }}" placeholder="Title">
                    @if ($errors->has('title'))
                    <strong style="color:red;">{{ $errors->first('title') }}.</strong>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Categories:</strong>
                    <!-- {{$categories}} -->
                  
                    <select  id="categories" name="categories[]" class="js-example-basic-multiple form-control" multiple="multiple">
                        <option value="0">select</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$posts->categories->where('id', $category->id)->first() ? 'selected' : ''}}>{{$category->title}}</option>
                        @endforeach
                    </select>

                </div>
            </div>



            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>

    </form>
</div>
@endsection