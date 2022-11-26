@extends('Layout')
@section('content')
    <h3> Supplier name: <a href="{{route('Suppliers.show' , ['Supplier'=>$order->supplier_id])}}">
            {{$order->supplier->name }}
        </a>, Order delay: {{$order->delay}}</h3>

    @forelse($order->orderHistory as $estimatedDate)
        <h3> {{$estimatedDate->phase }} {{$estimatedDate->reason }}  {{$estimatedDate->estimated_date}} </h3>
    @empty
        <p> This Order doesn't have order history yet</p>
    @endforelse

    @if( $order->status != "DELIVERED")
        <form method="POST" action="{{route('OrdersEstimatedDates.store' , ['id'=>$order->id])}}">
            <p>

                <label for="phase">Choose the current phase:</label>
                <select id="phase" name="phase">
                    <option value="INITIAL">INITIAL</option>
                    <option value="CONFIRMED">CONFIRMED</option>
                    <option value="DELAY">DELAY</option>
                    <option value="DELIVERED">DELIVERED</option>
                </select>
            </p>

            <p>
                <label>Estimated date: </label>
                <input type="date" name="estimated_date">
            </p>
            <p>
                <label>Reason</label>
                <input type="text" name="reason"/>
            </p>

            <button type="submit">Add phase</button>
        </form>
    @endif
@endsection
