<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name',200)->nullable();
            $table->string('sub_name',100)->nullable();
            $table->text('sub_code')->nullable();
            $table->text('department')->nullable();
            $table->text('year')->nullable();
            $table->text('publication')->nullable();
            $table->text('regulation')->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->text('image')->nullable();
            $table->text('book_image')->nullable();
            $table->text('document')->nullable();
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
        Schema::dropIfExists('books');
    }
}
