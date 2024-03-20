<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubfoldersTable  extends Migration
{
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent_id')->nullable(); // Nullable for root folders
            $table->timestamps();

            // Define the foreign key relationship
            // $table->foreign('parent_id')->references('id')->on('folders')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('folders');
    }
}

