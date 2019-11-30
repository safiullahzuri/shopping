@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-md-5">
        <h1>All Invoices</h1>
        <div class="table table-striped">
            <table>
                <thead>
                <th>ID</th>
                <th>Date</th>
                <th>Total</th>
                <th>See Sales</th>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{$invoice->id}}</td>
                        <td>{{$invoice->updated_at}}</td>
                        <td>{{$invoice->total()}}</td>
                        <td><a class="btn btn-info" href="{{route('invoice.show', $invoice->id)}}">See Products</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-5">
        <h1>Invoices Today</h1>
        <div class="table table-striped">
            <table>
                <thead>
                <th>ID</th>
                <th>Date</th>
                <th>Total</th>
                <th>See Sales</th>
                </thead>
                <tbody>
                @foreach($invoicesToday as $invoice)
                    <tr>
                        <td>{{$invoice->id}}</td>
                        <td>{{$invoice->updated_at}}</td>
                        <td>{{$invoice->total()}}</td>
                        <td><a class="btn btn-info" href="{{route('invoice.show', $invoice->id)}}">See Products</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="col-md-5">
        <h1>Invoices this week</h1>
        <div class="table table-striped">
            <table>
                <thead>
                <th>ID</th>
                <th>Date</th>
                <th>Total</th>
                <th>See Sales</th>
                </thead>
                <tbody>
                @foreach($invoicesThisWeek as $invoice)
                    <tr>
                        <td>{{$invoice->id}}</td>
                        <td>{{$invoice->updated_at}}</td>
                        <td>{{$invoice->total()}}</td>
                        <td><a class="btn btn-info" href="{{route('invoice.show', $invoice->id)}}">See Products</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-5">
        <h1>Invoices this month</h1>
        <div class="table table-striped">
            <table>
                <thead>
                <th>ID</th>
                <th>Date</th>
                <th>Total</th>
                <th>See Sales</th>
                </thead>
                <tbody>
                @foreach($invoicesThisMonth as $invoice)
                    <tr>
                        <td>{{$invoice->id}}</td>
                        <td>{{$invoice->updated_at}}</td>
                        <td>{{$invoice->total()}}</td>
                        <td><a class="btn btn-info" href="{{route('invoice.show', $invoice->id)}}">See Products</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-5">
        <h1>Invoices this year</h1>
            <div class="table table-striped">
                <table>
                    <thead>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>See Sales</th>
                    </thead>
                    <tbody>
                    @foreach($invoicesThisYear as $invoice)
                        <tr>
                            <td>{{$invoice->id}}</td>
                            <td>{{$invoice->updated_at}}</td>
                            <td>{{$invoice->total()}}</td>
                            <td><a class="btn btn-info" href="{{route('invoice.show', $invoice->id)}}">See Products</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>

@endsection