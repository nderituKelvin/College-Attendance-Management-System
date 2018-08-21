<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturesTable extends Migration{
    public function up(){
        Schema::create('lectures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('time');
            $table->string('title');
            $table->string('lec');
            $table->string('unit');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('lectures');
    }
}
