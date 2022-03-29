<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBiddings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('product_biddings')) {
            Schema::create('product_biddings', function (Blueprint $table) {
                $table->id();
                $table->integer('product_id');
                $table->integer('user_id');
                $table->decimal('bid_amount', 28,2)->default(0);
                $table->char('status',1)->default('P')->comment('P:pending, A:accepted, R:rejected');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_bidding');
    }
}
