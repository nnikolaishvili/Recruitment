<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('email');
            $table->decimal('min_salary', 8, 1)->nullable();
            $table->decimal('max_salary', 8, 1)->nullable();
            $table->string('education')->nullable();
            $table->text('description')->nullable();
            $table->string('current_employer')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('cv_url')->nullable();
            $table->foreignId('position_id')->constrained()->restrictOnDelete();
            $table->foreignId('seniority_id')->constrained()->restrictOnDelete();
            $table->foreignId('hiring_status_id')->constrained()->restrictOnDelete();
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
        Schema::dropIfExists('candidates');
    }
}
