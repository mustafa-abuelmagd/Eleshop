@extends('Layout')
@section('content')
    <h3> Supplier name: {{$supplier->name }} {{$supplier->performance}}</h3>
    @forelse($supplier->orders as $order)

            <a href="{{route('Orders.show' , ['Order'=>$order->id])}}">
            <h3> {{$order->id }} {{$order->total_price }}  {{$order->status}} {{$order->delay}} {{count($supplier->orders) > 0 ? array_sum($supplier->orders->pluck('delay')->toArray()) / count($supplier->orders) : 0}}</h3>
           </a>

    @empty
        <p> This Supplier doesn't have order history</p>
    @endforelse

@endsection
