<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bin');
            $table->string('brand');
            $table->string('issuer');
            $table->string('type');
            $table->string('category');
            $table->string('country_name');
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
        Schema::table('bins', function (Blueprint $table) {
            //
        });
    }
}
