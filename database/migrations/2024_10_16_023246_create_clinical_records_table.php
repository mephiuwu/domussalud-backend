<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_records', function (Blueprint $table) {
            $table->id();
            // Identification fields
            $table->string('first_name');
            $table->string('rut')->unique();
            $table->integer('age');
            $table->string('address');
            $table->string('phone');
            $table->string('marital_status');
            $table->date('birthdate');
            $table->string('profession');
            $table->string('occupation');
            $table->date('admission_date');
            $table->string('medical_service');
            $table->text('household_members'); // People they live with

            // Medical consultation fields
            $table->text('consultation_reason');
            $table->text('medical_history');
            $table->text('medications')->nullable();
            $table->text('allergies')->nullable();
            $table->text('anamnesis')->nullable();
            $table->text('physical_exam')->nullable();
            $table->text('instructions')->nullable();

            // Relationships
            $table->foreignId('provider_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');

            // Timestamps and soft deletes
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
        Schema::dropIfExists('clinical_records');
    }
}
