@extends('Layout')
@section('content')
    <table style="width:100%">
        <tr>
            <th>Supplier name</th>
            <th>Supplier performance</th>

        </tr>
        <tr>

            <td>{{$supplier->name }}</td>
            <td>{{$supplier->performance}}</td>
        </tr>
    </table>

    </br>
    </br>
    </br>


    <table style="width:100%">
        <tr>
            <th>ID</th>
            <th>Total price</th>
            <th>Status</th>
            <th>Delay</th>
        </tr>
        @forelse($supplier->orders as $order)
            <tr>
                <td><a href="{{route('Orders.show' , ['Order'=>$order->id])}}">
                        {{$order->id }}
                    </a></td>
                <td>{{$order->total_price }}</td>
                <td>{{$order->status}}</td>
                <td>{{$order->delay}}</td>
            </tr>

        @empty
            <p> This Supplier doesn't have order history</p>
        @endforelse
    </table>

@endsection
