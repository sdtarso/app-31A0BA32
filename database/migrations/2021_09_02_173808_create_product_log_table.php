<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_log', function (Blueprint $table) {

            $table->id('product_log_id');
            $table->integer('prl_quantity');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('product_id')
                ->references('product_id')
                ->on('product')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_log');
    }
}
