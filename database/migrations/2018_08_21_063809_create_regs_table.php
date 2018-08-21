<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegsTable extends Migration{
    public function up(){
        Schema::create('regs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student');
            $table->string('unit');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('regs');
    }
}
