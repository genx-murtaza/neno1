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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('cid');
            $table->string('cname',50);
            $table->string('ccontact',10)->nullable();
            $table->string('cemail',50)->nullable();
            $table->date('cdob')->nullable();
            $table->string('ctreatment',250);
            $table->integer('camount');
            $table->integer('cdisc')->default('0');
            $table->string('creference',50)->nullable();
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
        Schema::dropIfExists('customers');
    }
};
