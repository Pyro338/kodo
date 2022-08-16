<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('card_number');
            $table->dropColumn('card_cvc');
            $table->dropColumn('card_date');
            $table->dropColumn('card_name');
            $table->string('passport_series')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_first_name')->nullable();
            $table->string('passport_second_name')->nullable();
            $table->string('passport_third_name')->nullable();
            $table->string('passport_place_issue')->nullable();
            $table->date('passport_date_issue')->nullable();
            $table->string('passport_code_issue')->nullable();
            $table->date('passport_birth_date')->nullable();
            $table->string('passport_birth_place')->nullable();
            $table->string('passport_registration')->nullable();
            $table->string('passport_sex')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
