@if(session('success'))
    <div class="row alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('message'))
    <div class="row alert alert-success">
        {{session('message')}}
    </div>
@endif

@if(session('err'))
    <div class="row alert alert-warning">
        {{session('err')}}
    </div>
@endif


@if(count($errors) > 0)
    <div class="col-md-6">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>


@endif