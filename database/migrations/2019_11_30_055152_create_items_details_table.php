<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_details', function (Blueprint $table) {
            $table->bigIncrements('item_detail_id');
            $table->integer('item_id');
            $table->integer('item_weight');
            $table->string('netWeight');
            $table->integer('item_qty');
            $table->integer('item_price');
            $table->string('qty_min');
            $table->string('qty_max');
            $table->string('i_Detailstatus');
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
        Schema::dropIfExists('items_details');
    }
}
