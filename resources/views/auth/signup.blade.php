@extends('includes.master')

@section('content')

@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
    @endforeach
@endif

<form method="POST" action="{{route('auth.postSignup')}}" enctype="multipart/form-data">

    {{csrf_field()}}

    Username:<input type="text" class="form-control" name="username" />
    Password:<input type="password" class="form-control" name="password" />
    Confirm Password: <input type="password" class="form-control" name="confirmPassword" />
    First Name:<input type="text" class="form-control" name="firstname" />
    Last Name: <input type="text" class="form-control" name="lastname" />
    Email: <input type="text" class="form-control" name="email" />
    Phone No: <input type="number" class="form-control" name="phoneNo" />
    Avatar: <input type="file" name="avatar" /><br><hr>

    <input type="checkbox" name="addProduct" class="form-check-input" value="0">Add Product<br>
    <input type="checkbox" name="addUser" class="form-check-input" value="0">Add User<br>
    <input type="checkbox" name="updateProduct" class="form-check-input" value="0">Update Product<br>
    <input type="checkbox" name="deleteProduct" class="form-check-input" value="0">Delete Product<br> 
    <input type="checkbox" name="accessReports" class="form-check-input" value="0">Access Reports<br>

    <input type="submit" class="form-control btn btn-success" value="Add User" />
 
</form>

<script>
$('input[type="checkbox"]').on('change', function(){
   this.value = this.checked ? 1 : 0; 
}).change();
</script>


@endsection