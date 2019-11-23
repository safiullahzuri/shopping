@extends('layouts.master')
<head><meta name="csrf-token" content="{{ csrf_token() }}"></head>

@section('content')
 

@if(session('product_added'))
<div class="alert alert-success">{{session('product_added')}}</div>
@endif

@if(session('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif


 

<!-- Modal -->
<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete Product</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to delete this record?</p>
      </div>
      <div class="modal-footer">
        <button type="delete" id="deleteBtn" class="btn btn-danger" >Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1"  >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form enctype="multipart/form-data" method="POST" action="{{route('product.store')}}" >
              {{csrf_field()}}
              <input type="text" class="form-control {{ $errors->has('product_name') ? ' is-invalid': '' }}" name="product_name" value="{{ old('product_name')}}" />
              <input type="text" class="form-control {{ $errors->has('product_code') ? ' is-invalid': '' }}" name="product_code" value="{{ old('product_code')}}" />
              <input type="text" class="form-control {{ $errors->has('product_category') ? ' is-invalid': '' }}" name="product_category" value="{{ old('product_category')}}" />
              <input type="text" class="form-control {{ $errors->has('location_in_shelf') ? ' is-invalid': '' }}" name="location_in_shelf" value="{{ old('location_in_shelf')}}" />
              <input type="text" class="form-control {{ $errors->has('brand') ? ' is-invalid': '' }}" name="brand" value="{{ old('brand')}}" />
              <input type="number" class="form-control {{ $errors->has('price_bought') ? ' is-invalid': '' }}" name="price_bought" value="{{ old('price_bought')}}" />
              <input type="number" class="form-control {{ $errors->has('price_to_be_sold') ? ' is-invalid': '' }}" name="price_to_be_sold" value="{{ old('price_to_be_sold')}}" />
              <input type="file" name="product_image" accept="image/*" />
              <input  class="btn btn-lg btn-success" type="submit" value="Add Product" />
          </form>
      </div>
      <div class="modal-footer">
        @foreach($errors->all() as $error)
            <div class="alert alert-warning">{{$error}}</div>
        @endforeach
      </div>
    </div>
  </div>
</div>

 
<table class="table table-striped table-bordered" id="productsTable">
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Brand</th>
        <th>Category</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{$product->product_id}}</td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->brand}}</td>
                <td>{{$product->product_category}}</td>
                <td><button class="btn btn-primary edit" data-id="{{$product->product_id}}">Edit</button></td>
                <td><button class="btn btn-danger delete" data-id="{{$product->product_id}}">Delete</button>
                <td><button class="btn btn-info show" data-id="{{$product->product_id}}">Show</button>
                </td>
            </tr>
            <!-- Edit modal for each row -->
            <div class="modal fade edit" tabindex="-1" role="dialog" id="{{$product->product_id}}" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form enctype="multipart/form-data" method="POST" action="{{route('product.update')}}" >
                            {{csrf_field()}}
                            <input type="hidden" name="product_id" value="{{$product->product_id}}" />
                            <input type="text" class="form-control {{ $errors->has('product_name') ? ' is-invalid': '' }}" name="product_name" value="{{ $product->product_name }}" />
                            <input type="text" class="form-control {{ $errors->has('product_code') ? ' is-invalid': '' }}" name="product_code" value="{{ $product->product_code }}" />
                            <input type="text" class="form-control {{ $errors->has('product_category') ? ' is-invalid': '' }}" name="product_category" value="{{ $product->product_category }}" />
                            <input type="text" class="form-control {{ $errors->has('location_in_shelf') ? ' is-invalid': '' }}" name="location_in_shelf" value="{{ $product->location_in_shelf }}" />
                            <input type="text" class="form-control {{ $errors->has('brand') ? ' is-invalid': '' }}" name="brand" value="{{ $product->brand}}" />
                            <input type="number" class="form-control {{ $errors->has('price_bought') ? ' is-invalid': '' }}" name="price_bought" value="{{ $product->price_bought}}" />
                            <input type="number" class="form-control {{ $errors->has('price_to_be_sold') ? ' is-invalid': '' }}" name="price_to_be_sold" value="{{ $product->price_to_be_sold}}" />
                            <input type="file" name="product_image" accept="image/*" />
                            <input  class="btn btn-lg btn-success" type="submit" value="Update Product" />
                        </form>
                    </div>
                </div>
            </div>
            <!-- End edit modal -->

        @endforeach
    </tbody>
</table>

@if (count($errors) > 0)
    <script>
        $( document ).ready(function() {
            $('#exampleModal').modal('show');
        });
    </script>
@endif

<script type="text/javascript">


$(".edit").click(function(){
    var id = $(this).attr("data-id");
  $(".modal#"+id).modal("show");
});

$(".delete").click(function(){
  var id = $(this).attr("data-id");
  $("#deleteBtn").attr("data-id", id);
  $("#deleteModal").modal("show");
});

$("#deleteBtn").click(function(){
  var id = $(this).attr("data-id"); 
  $.ajax({ 
    type: 'get', 
    url: '/product/delete/'+id,
    data: {id: id},
    beforeSend: function(){
      $("#deleteBtn").text("Deleting...");
    },
    success: function(response){
        setTimeout(function(){
          $("#deleteModal").modal("hide");
        }, 500);
        $("#deleteBtn").text("Delete");

        window.location.href="";

    },
    error: function(a, b, c){
        console.log(a); console.log(b); console.log(c);
    }

  })

});

</script>

@endsection