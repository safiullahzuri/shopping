@extends('includes.master')


@section('content')

<div class="col-md-">
    <fieldset>  
        <legend>Product Information</legend>

            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="text" class="form-control {{ $errors->has('product_name') ? ' is-invalid': '' }}" name="product_name" value="{{ old('product_name')}}" />
                <input type="text" class="form-control {{ $errors->has('product_code') ? ' is-invalid': '' }}" name="product_code" />
                <input type="text" class="form-control {{ $errors->has('product_category') ? ' is-invalid': '' }}" name="product_category" />
                <input type="text" class="form-control {{ $errors->has('location_in_shelf') ? ' is-invalid': '' }}" name="location_in_shelf" />
                <input type="text" class="form-control {{ $errors->has('brand') ? ' is-invalid': '' }}" name="brand" />
                <input type="number" class="form-control {{ $errors->has('price_bought') ? ' is-invalid': '' }}" name="price_bought" />
                <input type="number" class="form-control {{ $errors->has('price_to_be_sold') ? ' is-invalid': '' }}" name="price_to_be_sold" />
                <input type="file" name="product_image" type="image/*" />
                <input type="submit" class="form-control btn btn-lg btn-success" value="Add Product" />
        </form>
    </fieldset>
 
</div>

 
@endsection