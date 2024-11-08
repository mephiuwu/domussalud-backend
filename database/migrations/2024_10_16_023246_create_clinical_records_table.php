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

            // $table->string('address');
            // $table->string('marital_status');
            // $table->date('birthdate');
            // $table->string('profession');
            // $table->string('occupation');
            // $table->date('admission_date');
            // $table->string('medical_service');
            // $table->text('household_members');
            // Medical consultation fields
            // $table->text('consultation_reason');
            // $table->text('medical_history');
            // $table->text('medications')->nullable();
            // $table->text('allergies')->nullable();
            // $table->text('anamnesis')->nullable();
            // $table->text('physical_exam')->nullable();
            // $table->text('instructions')->nullable();

            $table->string('name');
            $table->string('rut');
            $table->integer('age');
            $table->string('phone');
            $table->string('responsible_family_member');

            $table->integer('date'); //Fecha que se creó
            $table->string('number'); //Fecha que se creó

            $table->string('older_adults'); //Adultos mayores con quien vive
            $table->string('minor_adults'); //Adultos menores con quien vive
            $table->string('children'); //Niños
            $table->longText('medications'); //Medicamentos/tratamientos
            $table->longText('health_history'); //Antecedentes morbidos de salud
            $table->longText('reason'); //Motivo de consulta
            $table->longText('anamnesis');
            $table->longText('physical_examination'); //Exámen físico
            $table->longText('diagnosis'); //Diagnóstico
            $table->longText('indications'); //Indicaciones
            $table->longText('others'); //Otros
            $table->string('name_provider');
            $table->string('rut_provider');
            $table->integer('registration_number');
            $table->string('signature');
            $table->longText('pdf_data');
            
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
