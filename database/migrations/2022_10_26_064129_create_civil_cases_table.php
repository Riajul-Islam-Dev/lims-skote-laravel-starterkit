<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCivilCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('civil_cases', function (Blueprint $table) {
            $table->id();
            $table->string('filed_case_name');
            $table->string('case_category');
            $table->string('court_name');
            $table->string('division');
            $table->string('district');
            $table->string('region');
            $table->string('plaintiff_name');
            $table->string('defendant_name');
            $table->string('case_filling_date');
            $table->string('assigned_lawyer_name');
            $table->string('case_created_by');
            $table->string('admin_approval');
            $table->string('document_status');
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
        Schema::dropIfExists('civil_cases');
    }
}
