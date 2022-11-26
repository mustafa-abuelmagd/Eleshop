@extends('Layout')
@section('content')

    <table style="width:100%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Performance</th>
        </tr>

        @foreach($suppliers as $supplier)

            <tr>
                <td>{{$supplier->id }}</td>
                <td><a href="{{route('Suppliers.show' , ['Supplier'=>$supplier->id])}}">{{$supplier->name }}  </a></td>
                <td>{{$supplier->performancec }}</td>
            </tr>

        @endforeach
    </table>
@endsection
