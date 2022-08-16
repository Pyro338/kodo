<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOkopfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('okopfs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('code');
            $table->timestamps();
        });
        \App\Http\Controllers\OkopfController::getOkopf();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('okopfs');
    }
}
