<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Http\Controllers\TerroristsController;

class CreateTerroristsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terrorists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('surname')->nullable();
            $table->string('name')->nullable();
            $table->string('thirdname')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('birthplace')->nullable();
            $table->timestamps();
        });
        TerroristsController::getTerrorists();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terrorists');
    }
}
