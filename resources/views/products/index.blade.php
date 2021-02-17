@extends('layouts.app')
@section('content')
<section  style="padding-top: 60px">
    <div class="container">
    @if(Session::has('status'))
            <div class="alert alert-success" role="alert">
            {{Session::get('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Products
                        <a href="{{ route('products.create') }}" type="button" class="btn btn-primary" >Add Product</a href="">
                    </div>
                    <div class="card-body">
                        @if(isset($products) && !empty($products))
                            <div class="row">
                            @foreach($products as $product)
                                <div class="col-md-4">
                                    <div class="card" style="width: 18rem;">
                                    @if($product->image != null)
                                        <img src="{{asset('images')}}/{{ $product->image }}" class="card-img-top" alt="...">
                                    @else
                                        <img src="{{asset('images/default-placeholder-image.png')}}" class="card-img-top" alt="...">
                                    @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <h6 class="card-title text-danger">{{ $product->price }} XAF</h6>
                                            <p class="card-text">Lorem ipsum</p>
                                            <a class="btn btn-primary" data-toggle="modal" data-target="#viewModal{{ $product->id }}">View</a>
                                            <a href="{{ route('products.show', $product->id ) }}" class="btn btn-warning">Edit</a>
                                            <a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $product->id }}">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                Do you want to delete the product <b>{{ $product->name }}</b>?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('products.destroy', $product->id ) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button method="delete" type="submit" class="btn btn-danger">Confirm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- View Modal -->
                                <div class="modal fade" id="viewModal{{ $product->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="{{ route('products.update', $product->id ) }}">
                                                @csrf
                                                
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            @if($product->image != null)
                                                                <img src="{{asset('images')}}/{{ $product->image }}" class="card-img-top" alt="...">
                                                            @else
                                                                <img src="{{asset('images/default-placeholder-image.png')}}" class="card-img-top" alt="...">
                                                            @endif                                                        
                                                        </div>
                                                        <div class="form-group col-sm-7">
                                                           <p> Name : {{ $product->name }}</p>
                                                           <p>Quantity : {{ $product->stockQuantity }}</p>
                                                           <p>Price(XAF): {{ $product->price }}</p>
                                                           <p>Description : {{ $product->description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        @else
                            <p>There is no product saved</p> 
                        @endif
                        
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection