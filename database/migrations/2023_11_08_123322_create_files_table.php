<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('path');
            $table->string('title');
            $table->unsignedBigInteger('id_category');
            $table->date('date_entered');
            $table->unsignedBigInteger('id_type');
            $table->string('file_name');
            
            // Define foreign key constraints
            // $table->foreign('id_category')->references('id')->on('category');
            // $table->foreign('id_type')->references('id')->on('file_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
};
