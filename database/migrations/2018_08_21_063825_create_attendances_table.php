<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration{
    public function up(){
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unit');
            $table->string('student');
            $table->string('lec');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('attendances');
    }
}
