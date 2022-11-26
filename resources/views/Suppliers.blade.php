@extends('Layout')
@section('content')
    @foreach($suppliers as $supplier)
        <a href="{{route('Suppliers.show' , ['Supplier'=>$supplier->id])}}">
            <h3> {{$supplier->id }} {{$supplier->name }}</h3>
        </a>

    @endforeach
@endsection
