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
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->foreignId('street_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->string('edifice_number');
            $table->string('postal_code');
            $table->string('city');
            $table->integer('household_size')->default(0);
            $table->integer('number_family')->default(0);
            $table->integer('income')->default(0);
            $table->string('income_classification')->default('Poor');
            $table->string('waste_management');
            $table->string('toilet');
            $table->string('dwelling_type');
            $table->string('ownership');
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
        Schema::dropIfExists('households');
    }
};
