<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->string('profession')->nullable();
            $table->string('occupation')->nullable();
            $table->string('rut')->unique();
            $table->json('address');
            $table->string('marital_status');
            $table->enum('gender', ['male', 'female', 'other']);

            $table->boolean('account_verified')->default(false);
            $table->integer('birthdate');
            $table->boolean('is_active')->default(true);
            $table->enum('role', ['patient', 'provider', 'admin', 'superadmin']);
            
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
