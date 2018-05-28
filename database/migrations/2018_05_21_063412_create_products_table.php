<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('status');
            $table->integer('min_amount');
            $table->integer('shelf');
            $table->integer('risk');
            $table->integer('rank');
            $table->integer('life');
            $table->date('product_start');
            $table->date('product_end');
            $table->integer('min_rate');
            $table->integer('max_rate');
            $table->integer('area');
            $table->string('bank');
            $table->string('product_name');
            $table->string('introduction');
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
        Schema::dropIfExists('products');
    }
}
