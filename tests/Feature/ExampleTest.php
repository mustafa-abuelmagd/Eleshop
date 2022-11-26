<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\MenuItems;
use App\Models\Order;
use App\Models\OrderEstimatedDates;
use App\Models\OrderItem;
use App\Models\Supplier;
use App\Models\SupplierItems;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_order_delivery_date_is_not_before_creation_date()
    {

        /*
         * test that an order cannot be delivered on a date that is before the order creation date
        1- create a new supplier
        2- create a new menu item
        -  associate the menu item with its quantity to the supplier
        3- create a new order with that menu item
        4- confirm the order for the supplier for a date that is equal or greater than the initial date for the order
        5- set the order as delivered on a date that is before the order creation date (assert delivery time is greater than order creation date)
         */

        $supplier = new Supplier();
        $supplier->name = 'supplier1';
        $supplier->save();

        $this->assertDatabaseHas('suppliers', [
            'name' => 'supplier1'
        ]);

        $menu_item = new MenuItems();
        $menu_item->name = 'ipad';
        $menu_item->price = 2000;
        $menu_item->description = 'apple device';
        $menu_item->default_delivery_time = 3;
        $menu_item->save();

        $supplier_item = new SupplierItems();
        $supplier_item->supplier_id = $supplier->id;
        $supplier_item->menu_item_id = $menu_item->id;
        $supplier_item->quantity = 1;
        $supplier_item->save();

        $order = new Order();
        $order->supplier_id = $supplier->id;
        $order->total_price = 2000;
        $order->save();

        $order_item = new OrderItem();
        $order_item->order_id = $order->id;
        $order_item->menu_item_id = $menu_item->id;
        $order_item->quantity = 1;
        $order_item->save();
        $this->assertEquals(Carbon::now()->format('Y-m-d'), Carbon::parse($order->initial_date)->format('Y-m-d'));
        $retrieved_order = Order::findOrFail($order->id);
        $this->assertEquals(Order::SHIPPED, $retrieved_order->status);

        $order_estimated_date = new OrderEstimatedDates();
        $order_estimated_date->order_id = $order->id;
        $order_estimated_date->phase = OrderEstimatedDates::CONFIRMED;
        $order_estimated_date->estimated_date = Carbon::parse('2022-12-29');
        $order_estimated_date->save();

        $order_estimated_date2 = new OrderEstimatedDates();
        $order_estimated_date2->order_id = $order->id;
        $order_estimated_date2->phase = OrderEstimatedDates::DELIVERED;
        $order_estimated_date2->estimated_date = Carbon::parse('2022-12-29');
        $order_estimated_date2->save();

        $retrieved_order = OrderEstimatedDates::where('order_id', $order->id)
            ->where('phase', OrderEstimatedDates::DELIVERED)->first();
        $result = Carbon::parse($retrieved_order->estimated_date)->gte(Carbon::parse($order->created_at));
//        $this->assertLessThan(0.0 , $retrieved_order->delay );
        $this->assertTrue($result);



    }
//    public function test_the_application_returns_a_successful_response()
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }
}
