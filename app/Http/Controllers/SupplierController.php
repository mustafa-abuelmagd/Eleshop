<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;

class SupplierController extends Controller
{
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
//     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('Suppliers' , [
            'suppliers' => $suppliers
        ]);
//        return SupplierResource::collection($suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreSupplierRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create(
            $request->validated(),
        );
//        dd($supplier);
        return response()->json([
            'status' => 'success',
            'data' => SupplierResource::make($supplier)
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('SupplierShow' , [
            'supplier' => $supplier
        ]);

//        return response()->json([
//            'status' => 'success',
//            'data' => SupplierResource::make($supplier)
//        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateSupplierRequest $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
