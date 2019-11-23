@extends('includes.master')


@section('content')
<form method="POST" action="{{ route('auth.signin') }}" >

{{csrf_field()}}
Username: <input type="text" class="form-control" name="username" />
Password: <input type="password" class="form-control" name="password" />

<input type="submit" class="form-control btn btn-primary" value="Sign In" />


</form>

@endsection