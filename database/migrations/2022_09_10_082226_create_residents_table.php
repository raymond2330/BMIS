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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('household_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->string('surname');
            $table->string('given_name');
            $table->string('middle_name')->nullable();
            $table->string('birth_date');
            $table->integer('age');
            $table->string('sex');
            $table->string('pregnant')->nullable();
            $table->string('religion');
            $table->string('civil_status');
            $table->string('nationality');
            $table->string('contact')->nullable();
            $table->string('household_head');
            $table->string('bona_fide');
            $table->string('resident_six_months');
            $table->string('solo_parent');
            $table->string('voter');
            $table->string('pwd');
            $table->string('disability')->nullable();
            $table->string('is_studying');
            $table->string('education');
            $table->string('institution')->nullable();
            $table->string('graduate_year')->nullable();
            $table->string('specialization')->nullable();
            $table->integer('income')->nullable();
            $table->string('income_classification');
            $table->string('is_employed');
            $table->string('job_title')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residents');
    }
};
