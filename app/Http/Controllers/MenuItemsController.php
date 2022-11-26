<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuItemsRequest;
use App\Http\Requests\UpdateMenuItemsRequest;
use App\Http\Resources\MenuItemResource;
use App\Models\MenuItems;

class MenuItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_items = MenuItems::all();
        return MenuItemResource::collection($menu_items);
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
     * @param  \App\Http\Requests\StoreMenuItemsRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreMenuItemsRequest $request)
    {
        $menu_item = MenuItems::create(
            $request->validated(),
        );

        return response()->json([
            'status'=> 'success',
            'data' =>$menu_item
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function show(MenuItems $menuItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItems $menuItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuItemsRequest  $request
     * @param  \App\Models\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuItemsRequest $request, MenuItems $menuItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItems $menuItems)
    {
        //
    }
}
