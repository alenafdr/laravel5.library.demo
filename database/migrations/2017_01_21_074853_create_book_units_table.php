<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_units', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->string('barcode')->unique();
            $table->integer('book_id')->unsigned();
            $table->timestamps();
            
            // index
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::table('book_units', function (Blueprint $table) {
        //  $table->dropUnique('book_units_barcode_unique');
        //  $table->dropForeign('book_units_book_id_foreign');
        //});
        Schema::dropIfExists('book_units');
    }
}
