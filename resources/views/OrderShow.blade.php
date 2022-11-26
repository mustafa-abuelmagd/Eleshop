@extends('Layout')
@section('content')

<table style="width:100%">
    <tr>
        <th>Supplier name</th>
        <th>Order delay</th>

    </tr>
    <tr>

        <td><a href="{{route('Suppliers.show' , ['Supplier'=>$order->supplier_id])}}">
                {{$order->supplier->name }}
            </a></td>
        <td>{{$order->delay}}</td>
    </tr>
</table>

</br>
</br>
</br>

<table style="width:100%">
    <tr>
        <th>Order phase</th>
        <th>Delay reason</th>
        <th>Estimated delivery date</th>
    </tr>

    @forelse($order->orderHistory as $estimatedDate)
        {{--            <h3> {{$estimatedDate->phase }} {{$estimatedDate->reason }}  {{$estimatedDate->estimated_date}} </h3>--}}
        <tr>
            <td>{{$estimatedDate->phase }} </td>
            <td>{{$estimatedDate->reason }}</td>
            <td>{{$estimatedDate->estimated_date}}</td>
        </tr>
    @empty
        <p> This Order doesn't have order history yet</p>
    @endforelse

</table>


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
