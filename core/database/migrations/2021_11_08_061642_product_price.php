<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('products', 'start_date')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dateTime('start_date')->nullable();
            });
        }
        
        if (!Schema::hasColumn('products', 'end_date')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dateTime('end_date')->nullable();
            });
        }

        if (!Schema::hasColumn('products', 'start_price')) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('start_price')->default(0);
            });
        }

        if (!Schema::hasColumn('products', 'sale_price')) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('sale_price')->default(0);
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
        //
    }
}
