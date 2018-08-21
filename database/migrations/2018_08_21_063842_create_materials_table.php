<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration{
    public function up(){
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lecture');
            $table->string('title');
            $table->string('file');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('materials');
    }
}
