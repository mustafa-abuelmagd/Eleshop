<?php

namespace Tests\Unit;

use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_that_can_create_an_order()
    {
        $supplier = new Supplier();
        $boolean_result = !$supplier->name;
        $this->assertTrue($boolean_result);

    }
}
