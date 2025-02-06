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
            $table->increments('id');
            $table->timestamps();
            $table->string('name',20);
            $table->string('password');
            $table->string('civilite',3)->default('M.');
            $table->string('nom',50);
            $table->string('prenom',50);
            $table->string('email',50)->unique();
            $table->rememberToken();
            $table->boolean('actif');

            $table->unsignedInteger('secteur_id')->nullable()->index('secteurs_users')->comment('Relation vers Secteur');
        });
        
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email',191)->primary();
            $table->string('token',200);
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id',50)->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
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
