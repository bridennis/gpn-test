<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNumbersLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('numbers_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            // IP адрес лучше хранить в VARBINARY(16), но sqlite не поддерживает такой тип данных
            $table->string('ip_address', 45);
            $table->timestamp('created_at')->useCurrent();
            $table->text('request');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('numbers_log');
    }
}
