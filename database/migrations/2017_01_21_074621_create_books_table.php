<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->string('name');
            $table->string('autor');
            $table->text('description');
            $table->timestamps();
            
            // index
            $table->unique(['name', 'autor']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::table('books', function (Blueprint $table) {
        //  $table->dropUnique('books_name_autor_unique');
        //});
        Schema::dropIfExists('books');
    }
}
