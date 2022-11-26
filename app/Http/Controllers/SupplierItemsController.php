<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierItemsRequest;
use App\Http\Requests\UpdateSupplierItemsRequest;
use App\Http\Resources\SupplierItemsResource;
use App\Models\MenuItems;
use App\Models\Supplier;
use App\Models\SupplierItems;

class SupplierItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier_items = SupplierItems::all();
        return SupplierItemsResource::collection($supplier_items);
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
     * @param \App\Http\Requests\StoreSupplierItemsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSupplierItemsRequest $request)
    {

        $supplier_item = SupplierItems::create(
            $request->validated(),
        );

        return response()->json([
            'status' => 'success',
            'data' => $supplier_item
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SupplierItems $supplierItems
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierItems $supplierItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SupplierItems $supplierItems
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierItems $supplierItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateSupplierItemsRequest $request
     * @param \App\Models\SupplierItems $supplierItems
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierItemsRequest $request, SupplierItems $supplierItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SupplierItems $supplierItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierItems $supplierItems)
    {
        //
    }
}
