@extends('layouts.app')
@section('content')
    <div class="container" style="padding-top: 60px">
        @if(Session::has('status'))
            <div class="alert alert-success" role="alert">
            {{Session::get('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
        <form method="post" enctype="multipart/form-data" action="{{ route('products.store') }}">
            @csrf
            <div class="col-md-8 offset-md-2">
            <h1>New product</h1>
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{asset('images/default-placeholder-image.png')}}" style="width:100px; heigh:100px" id="previewImg" alt="image"/> 
                        <input type="file" class="form-control" name="file" onchange="previewFile(this)">   
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="stockQuantity">Quantity</label>
                                <input type="number" class="form-control" min=0 id="stockQuantity" name="stockQuantity">
                                @error('stockQuantity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="price">Price(XAF)</label>
                                <input type="number" class="form-control" min=25 step=25 id="price" name="price">
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>

@endsection