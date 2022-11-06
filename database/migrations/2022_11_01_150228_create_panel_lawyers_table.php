<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanelLawyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panel_lawyers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('contact_number');
            $table->string('nationality');
            $table->string('religion');
            $table->string('district_name');
            $table->string('date_of_enrollment');
            $table->string('name_of_the_bar');
            $table->string('membership_number');
            $table->string('address_of_chamber');
            $table->string('address_of_residence');
            $table->string('specialized_practicing_area');
            $table->string('professional_experience');
            $table->string('case_conducted');
            $table->string('references');
            $table->string('remarks');
            $table->string('status');
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
        Schema::dropIfExists('panel_lawyers');
    }
}
