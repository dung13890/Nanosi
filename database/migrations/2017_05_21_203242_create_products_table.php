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
            $table->increments('id');
            $table->string('name', 150);
            $table->string('code', 50)->unique();
            $table->string('slug', 150)->index()->unique();
            $table->string('image')->nullable();
            $table->string('size', 100)->nullable();
            $table->string('material', 100)->nullable();
            $table->string('origin', 100)->nullable();
            $table->integer('price')->default(0);
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->text('properties')->nullable();
            $table->text('guide')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('locked')->default(false);
            $table->integer('user_id')->index()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
