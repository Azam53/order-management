<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->decimal('total_amount', 5, 2);
            $table->integer('user_id')->unsigned(); 
            $table->index('user_id');   // adding index of user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // making userid foreign from user table
            $table->integer('product_id')->unsigned(); 
            $table->index('product_id');   // adding index of user_id
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade'); // making productid foreign from product table
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
         Schema::table('articles', function ($table) {
           $table->dropForeign('order_user_id_foreign');
           $table->dropIndex('order_user_id_index');
           $table->dropColumn('user_id');   
           $table->dropForeign('product_user_id_foreign');
           $table->dropIndex('product_user_id_index');
           $table->dropColumn('product_id');    
        });
         Schema::drop('order'); 
    }
}
