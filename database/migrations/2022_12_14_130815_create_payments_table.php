<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('pid');
            $table->integer('preceiptno');
            $table->date('preceiptdt');
            $table->integer('pamount');
            $table->string('pmode',10);
            $table->unsignedBigInteger('cid');
            $table->timestamps();

            $table->foreign('cid')->references('cid')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
