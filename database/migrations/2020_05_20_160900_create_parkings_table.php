<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vehicle');
            $table->string('profile');
            $table->string('month');
            $table->timestamp('intime');
            $table->timestamp('outtime')->nullable();
            $table->timestamp('time')->nullable();
            $table->decimal('amount',5,2)->nullable();
            $table->timestamps();
        });
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->boolean('paymentrequired');
            $table->string('paymentperiod');
            $table->decimal('amoutperunit',5,2);
            $table->timestamps();
        });
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('registrationnumber')->unique();
            $table->string('owner');
            $table->string('profile');
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('api_token', 80)->after('password')
            ->unique()
            ->nullable()
            ->default(null);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parkings');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('users');
    }
}
