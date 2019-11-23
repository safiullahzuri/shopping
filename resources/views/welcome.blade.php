@extends('layouts.master')

@section('content')

    @include('includes.messages_block')


    <div class="row">
        <div class="col-md-6">
            <h3>Sign Up</h3>

            <form method="POST" action="{{route('auth.postSignup')}}" enctype="multipart/form-data">

                {{csrf_field()}}

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" />
                    <label for="username">Confirm Password</label>
                    <input type="text" class="form-control" name="confirmPassword" />
                </div>
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" class="form-control" name="firstname" />
                </div>
                <div class="form-group">
                    <label for="username">Last Name</label>
                    <input type="text" class="form-control" name="lastname" />
                </div>
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" class="form-control" name="email" />
                </div>
                <div class="form-group">
                    <label for="username">Phone No</label>
                    <input type="text" class="form-control" name="phoneNo" />
                </div>
                <div class="form-group">
                    <label for="username">Avatar</label>
                    <input type="file" class="form-control" name="avatar" accept="image/*" />
                </div>
                <fieldset>
                    <div class="form-group">
                        <input type="checkbox" name="addProduct" class="form-check-input" value="0">Add Product<br>
                        <input type="checkbox" name="addUser" class="form-check-input" value="0">Add User<br>
                        <input type="checkbox" name="updateProduct" class="form-check-input" value="0">Update Product<br>
                        <input type="checkbox" name="deleteProduct" class="form-check-input" value="0">Delete Product<br>
                        <input type="checkbox" name="accessReports" class="form-check-input" value="0">Access Reports<br>
                    </div>
                </fieldset>


                <input type="submit" class="form-control btn btn-success" value="Register" />

            </form>
        </div>

        <div class="col-md-6">
            <h3>Sign In</h3>
            <form  method="POST" action="{{route('signin')}}">

                <div class="form-group">
                    <label for="email">Your Username</label>
                    <input type="text" class="form-control" name="username" id="username" >
                </div>


                <div class="form-group">
                    <label for="password">Your Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                {{csrf_field()}}
                <button type="submit" class="btn btn-primary">Sign In</button>
            </form>
        </div>

    </div>



@endsection