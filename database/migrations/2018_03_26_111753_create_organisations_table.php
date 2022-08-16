<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'organisations',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('okopf_code')->nullable();
                $table->string('okopf_name')->nullable();
                $table->string('name')->nullable();
                $table->string('ogrn')->nullable();
                $table->string('inn')->nullable();
                $table->string('kpp')->nullable();
                $table->string('ogrn_date')->nullable();
                $table->string('ur_address_region_code')->nullable();
                $table->string('ur_address_name')->nullable();
                $table->string('fact_address_region_code')->nullable();
                $table->string('fact_address_name')->nullable();
                $table->string('okved_code')->nullable();
                $table->string('okved_name')->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisations');
    }
}
