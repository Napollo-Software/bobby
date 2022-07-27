<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('claim_title');
            $table->string('expense_date');
            $table->string('claim_description');
            $table->string('claim_category');
            $table->string('claim_amount');
            $table->string('claim_bill_attachment');
            $table->string('payment_method');
            $table->string('claim_status');
            $table->string('claim_user');
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
        Schema::dropIfExists('claims');
    }
}
