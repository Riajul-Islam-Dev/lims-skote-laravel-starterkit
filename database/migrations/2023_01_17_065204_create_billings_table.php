<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('case_id');
            $table->string('case_type');
            $table->string('lawyer_id');
            $table->string('bill_amount');
            $table->string('bill_date');
            $table->string('district');
            $table->string('generated_by');
            $table->string('updated_by')->nullable();
            $table->string('bank_name');
            $table->string('cheque_number');
            $table->string('bill_status');
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
        Schema::dropIfExists('billings');
    }
}
