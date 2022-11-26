<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\OrderEstimatedDates;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_estimated_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->text('reason')->nullable();
            $table->date('estimated_date')->nullable();
            $table->enum('phase' , OrderEstimatedDates::STATUSES)->default(OrderEstimatedDates::INITIAL);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_estimated_dates');
    }
};
