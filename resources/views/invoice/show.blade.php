@extends('layouts.master')


@section('content')

    <h1>Invoice</h1>

    @if($invoice)


        <div class="table">
            <table class="table table-striped">
                <thead>
                    <th>Product Code</th>
                    <th>Product Price</th>
                    <th>Number of Items Sold</th>
                    <th>Product Category</th>
                    <th>Product Location</th>
                    <th>Brand</th>
                </thead>
                <tbody>
                @foreach($invoice->sales as $sale)
                    <tr>
                        <td>{{$sale->product_code}}</td>
                        <td>{{$sale->product->price_to_be_sold}}</td>
                        <td>{{$sale->number}}</td>
                        <td>{{$sale->product->product_category}}</td>
                        <td>{{$sale->product->location_in_shelf}}</td>
                        <td>{{$sale->product->brand}}</td>
                    </tr>
                @endforeach
                    <tr>
                        <td>Total</td>
                        <td colspan="5">{{$invoice->total()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>


    @else
        <p>no invoice</p>
    @endif


@endsection