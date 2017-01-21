<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksInHandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_in_hands', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->integer('book_unit_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamp('take_at')->useCurrent();
            $table->timestamp('return_at')->nullable();
            $table->timestamps();
            
            // index
            $table->unique(['book_unit_id', 'return_at']);
            $table->foreign('book_unit_id')->references('id')->on('book_units')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::table('books_in_hands', function (Blueprint $table) {
        //  $table->dropUnique('books_in_hands_book_unit_id_user_id_unique');
        //  $table->dropForeign('books_in_hands_book_unit_id_foreign');
        //  $table->dropForeign('books_in_hands_user_id_foreign');
        //});
        Schema::dropIfExists('books_in_hands');
    }
}
