<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->Integer('cat_id');
            $table->string('name');
            $table->mediumText('small_description');
            $table->longText('description');
            $table->integer('original_price');
            $table->integer('selling_price');
            $table->string('image');
            $table->integer('qty');
            $table->integer('tax');
            $table->tinyInteger('status');
            $table->tinyInteger('trending');
            $table->string('meta_title');
            $table->mediumText('meta_keywords');
            $table->longText('meta_description');
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
