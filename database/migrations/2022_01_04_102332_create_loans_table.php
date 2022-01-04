<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->integer('recurring_at');
            $table->double('total');
            $table->double('balance');
            $table->double('monthly');
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('loan_logs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('loan_id')->constrained();
            $table->double('total');
            $table->double('balance');
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
        Schema::dropIfExists('loan_logs');
        Schema::dropIfExists('loans');
    }
}
